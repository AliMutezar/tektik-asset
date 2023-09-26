<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReturnRequest;
use App\Models\Asset;
use App\Models\AssetLoan;
use App\Models\AssetReturn;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $returns = AssetReturn::with(['loan'])->get();
        $title = "Data Asset Returns";
        return view('dashboard.return.index', compact('returns', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $loans = Loan::where('return_code', null)->get();
        return view('dashboard.return.create', compact('loans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReturnRequest $request)
    {

        $data = $request->validated();

        $loanId = $request->loan_id;
        $assetLoanData = AssetLoan::where('loan_id', $loanId)->get();
        //    dd($assetLoanData);

        foreach ($assetLoanData as $assetLoan) {
            $asset = Asset::findOrFail($assetLoan->asset_id);
            $asset->stock_unit += $assetLoan->unit_borrowed;
            $asset->save();

            $assetLoan->unit_borrowed = 0;
            $assetLoan->save();
        }

        if ($request->hasFile('photo_returned')) {
            $photoPath = $request->file('photo_returned');
            $photoName = uniqid() . "." . $photoPath->getClientOriginalExtension();
            $photoPath->storeAs('public/photo_returned/', $photoName);
        }

        // signature Admin
        $admin_name = Auth::user()->name;
        // dd($admin_name);
        $image_partsAdmin = explode(";base64,", $request->signature_admin);

        $image_type_auxAdmin = explode("image/", $image_partsAdmin[0]);
        // dd($image_type_aux);
        $image_typeAdmin = $image_type_auxAdmin[1];
        $image_base64Admin = base64_decode($image_partsAdmin[1]);

        $signature_nameAdmin = uniqid() . '_' . $admin_name . '.' . $image_typeAdmin;

        Storage::put('public/signature_returned/admin/' . $signature_nameAdmin, $image_base64Admin);

        // signature returner
        $returner_id = Loan::where('id', '=', $request->loan_id)->first();
        $returner_name = $returner_id->user->name;
        // dd($returner_name);

        $image_partsReturner = explode(";base64,", $request->signature_returner);

        $image_type_auxReturner = explode("image/", $image_partsReturner[0]);
        // dd($image_type_auxReturner);
        $image_typeReturner = $image_type_auxReturner[1];
        // dd($image_typeReturner);
        $image_base64Returner = base64_decode($image_partsReturner[1]);
        // dd($image_base64Returner);
        $signature_nameReturner = uniqid(). '_' . $returner_name . '.' . $image_typeReturner;

        Storage::put('public/signature_returned/returner/' . $signature_nameReturner, $image_base64Returner);
        
        $data['signature_admin'] = $signature_nameAdmin;
        $data['signature_returner'] = $signature_nameReturner;
        $data['photo_returned'] = $photoName;
        $data['admin_user_id'] = Auth::user()->id;


        AssetReturn::create($data);




        // update return_code and status di loan
        Loan::where('id', $loanId)->update([
            'status' => 1,
            'return_code' => $request->return_code
        ]);

        return redirect()->route('returns.index')->with('success', 'Asset telah dikembalikan, stock asset bertambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
