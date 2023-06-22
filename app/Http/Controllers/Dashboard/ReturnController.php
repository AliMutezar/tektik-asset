<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReturnRequest;
use App\Models\Asset;
use App\Models\AssetLoan;
use App\Models\AssetReturn;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

       $return = AssetReturn::create([
            'return_code' => $request->return_code,
            'loan_id' => $request->loan_id,
            'signature_returner' => null,
            'admin_user_id' => Auth::user()->id,
            'signature_admin' => null,
            'date_returned' => $request->date_returned,
            'photo_returned' => $request->photo_returned
       ]);

       if ($request->hasFile('photo_returned')) {
            $photoPath = $request->file('photo_returned')->store('photo_returned', 'public');
            $return->photo_returned = $photoPath;
            $return->save();
       }

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
