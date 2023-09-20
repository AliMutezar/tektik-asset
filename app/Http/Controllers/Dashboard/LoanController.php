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
        $assets = Asset::with('vendor')->where('stock_unit', '>', 0)->get();
        $users = User::where('role', 'staff')->get();
        return view('dashboard.loan.create', compact('assets', 'users')); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLoanRequest $request, Loan $loan)
    {

        $validated = $request->validated();
        // dd($validated);

        $assetsIds = $request->asset_id;
        $unitBorrowed = $request->unit_borrowed;
        $errors = [];

        foreach ($assetsIds as $index => $assetsId) {
            $asset = Asset::findOrFail($assetsId);
            if ($asset->stock_unit < intval($unitBorrowed[$index])) {
                $errors[$assetsId] = "Stock yang dipinjam, melebihi stock yang tersedia . $asset->asset_name"; 
            }
        }

        if(!empty($errors)) {
            return redirect()->back()->withErrors($errors)->withInput()->with('error', "stock yang dipinjam, melebihi stock yang tersedia " . $asset->asset_name . " - " . $asset->vendor->company_name);
        }

        $loan = loan::create([
            'loan_code' => $request->loan_code,
            'loan_user_id' => $request->loan_user_id,
            'admin_user_id' => Auth::user()->id,
            'date_receipt' => $request->date_receipt,
            'signature_admin' => null,
            'status' => 0,
            'return_code' => null,
            'photo_receipt' => $request->photo_receipt
        ]);

       if ($request->hasFile('photo_receipt')) {
            $photoPath = $request->file('photo_receipt')->store('photo_receipt', 'public');
            $loan->photo_receipt = $photoPath;
            $loan->save();
       }
       
    //    if ($request->has('signature_loan')) {
    //         $signatureData = $request->input('signature_loan');

    //         $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
    //         $signatureData = str_replace(' ', '+', $signatureData);
    //         $signatureImage = base64_decode($signatureData);

    //         $loan = new Loan();
    //         $loan->signature_loan = $signatureImage;
    //         $loan->save();
    //    }

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