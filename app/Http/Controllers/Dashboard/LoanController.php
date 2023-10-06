<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLoanRequest;
use App\Models\Asset;
use App\Models\AssetLoan;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $loans = Loan::with(['user', 'admin_user'])->get();

        $title = "Data Asset Loans";
        return view('dashboard.loan.index', compact('loans', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $role = Auth::user()->role;
        // dd($role);
        $assets = Asset::with('vendor')->where('stock_unit', '>', 0)->get();
        $users = User::where('role', 'staff')->get();
        return view('dashboard.loan.create', compact('assets', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLoanRequest $request, Loan $loan)
    {

        $data = $request->validated();
        // dd($data);

        $assetsIds = $request->asset_id;
        $unitBorrowed = $request->unit_borrowed;
        $errors = [];

        foreach ($assetsIds as $index => $assetsId) {
            $asset = Asset::findOrFail($assetsId);
            if ($asset->stock_unit < intval($unitBorrowed[$index])) {
                $errors[$assetsId] = "Stock yang dipinjam, melebihi stock yang tersedia . $asset->asset_name";
            }
        }

        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors)->withInput()->with('error', "stock yang dipinjam, melebihi stock yang tersedia " . $asset->asset_name . " - " . $asset->vendor->company_name);
        }


        if ($request->hasFile('photo_receipt')) {
            $photo_path = $request->file('photo_receipt');
            $photo_name = uniqid() . "." . $photo_path->getClientOriginalExtension(); //jpg, jpeg, png
            $photo_path->storeAs('public/photo_receipt/', $photo_name);
        }
        
        // signature Admin
        $admin_name = Auth::user()->name;
        // dd($admin_name);
        $image_partsAdmin = explode(";base64,", $request->signature_admin);

        $image_type_auxAdmin = explode("image/", $image_partsAdmin[0]);
        // dd($image_type_aux);
        $image_typeAdmin = $image_type_auxAdmin[1];
        $image_base64Admin = base64_decode($image_partsAdmin[1]);

        $signature_nameAdmin = uniqid() . '_'. $admin_name . '.' . $image_typeAdmin;
        
        Storage::put('public/signature_loan/admin/'. $signature_nameAdmin, $image_base64Admin);

        // signature borrower
        $borrower_id = User::where('id', '=', $request->loan_user_id)->first();
        $borrower_name = $borrower_id->name;
        // dd($borrower_name);

        $image_partsBorrower = explode(";base64,", $request->signature_borrower);

        $image_type_auxBorrower = explode("image/", $image_partsBorrower[0]);
        // dd($image_type_auxBorrower);
        $image_typeBorrower = $image_type_auxBorrower[1];
        // dd($image_partsBorrower);
        $image_base64Borrower = base64_decode($image_partsBorrower[1]);

        $signature_nameBorrower = uniqid(). '_' . $borrower_name . '.' . $image_typeBorrower;
        
        Storage::put('public/signature_loan/borrower/'. $signature_nameBorrower, $image_base64Borrower);

        $data['signature_admin'] = $signature_nameAdmin;
        $data['signature_borrower'] = $signature_nameBorrower;     
        $data['photo_receipt'] = $photo_name;
        $data['admin_user_id'] = Auth::user()->id;
        $data['status'] = 0;
        $data['return_code'] = null;

        $loan = loan::create($data);


        foreach ($assetsIds as $index => $assetsId) {
            $asset = Asset::findOrFail($assetsId);
            if ($asset->stock_unit >= intval($unitBorrowed[$index])) {
                $asset->stock_unit -= intval($unitBorrowed[$index]);
                $asset->save();

                AssetLoan::create([
                    'loan_id' => $loan->id,
                    'asset_id' => $assetsId,
                    'unit_borrowed' => $unitBorrowed[$index],
                    'serial_number' => $request->serial_number[$index],
                ]);
            }
        }

        return redirect()->route('loans.index')->with('success', 'Data loan has been inserted successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        $record = Loan::with('assets')->find($loan->id);
        // dd($record->admin_user);
        $data['record'] = $record;
        $data['title'] = 'Detail Asset Loan ' . $loan->user->name;
        $data['active_breadcrumb'] = 'Show Asset Loan';

        // dd($data['record']);
        return view('dashboard.loan.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan)
    {
        $role = Auth::user()->role;
        // dd($role);
        if ($role) {
            return redirect()->route('loans.index')->with('error', 'You dont have permission for deleting loan data');
        }

        $loanId = $loan->id;
        $assetLoanData = AssetLoan::where('loan_id', $loanId)->get();


        foreach ($assetLoanData as $assetLoan) {
            $asset = Asset::findOrFail($assetLoan->asset_id);
            $asset->stock_unit += $assetLoan->unit_borrowed;
            $asset->save();
        }

        $loan->delete();
        return redirect()->route('loans.index')->with('success', 'Data loan has been deleted successfully');
    }
}
