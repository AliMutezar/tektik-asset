<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAssetRequest;
use App\Models\Asset;
use App\Models\Vendor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $assets = Asset::with('vendor')->get();
            return DataTables::of($assets)
                ->addColumn('action', function ($asset) {
                    $editUrl = route('assets.edit', $asset->id);
                    $deleteUrl = route('assets.destroy', $asset->id);
                    return '
                        <div class="d-flex">
                            <a href="'.$editUrl.'" class="icon me-3">
                                <i class="bi bi-pencil-fill" style="font-size:0.8rem;"></i>
                            </a>
                            <form action="'.$deleteUrl.'" method="POST">
                                <a href="" class="icon text-danger delete-btn" data-id="'.$asset->id.'" id="btn-delete">
                                    <i class="bi bi-x" style="font-size: 1.2rem;"></i>
                                </a>
                            </form>
                        </div><x></x>
                    ';

                    
                })->rawColumns(['action'])->make(true);

        }

        $title = 'Data Assets';
        return view('dashboard.asset.index', compact('title'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $title = 'Add Asset';
        $vendors = Vendor::all();

        return view('dashboard.asset.create', compact(['title', 'vendors']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAssetRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Asset::create($data);
        return redirect()->route('assets.index')->with('success', 'Data asset has been inserted succesfully');
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
    public function edit(Asset $asset): View
    {
        $title = 'Edit Asset';
        $asset = Asset::where('id', $asset->id)->first();
        $vendors = Vendor::all();
        return view('dashboard.asset.edit', compact(['title', 'asset', 'vendors']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAssetRequest $request, Asset $asset)
    {
        $data = $request->validated();
        $asset->update($data);

        return redirect()->route('assets.index')->with('success', 'Asset has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asset $asset)
    {
        // tidak perlu reload model asset seperti kode yang dicomment dibawah, karena sudah digunakan sebagai parameter destroy, maka instance dari model $asset dapat kita digunakan
        // $asset = Asset::findOrFail($asset->id);

        $asset->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data asset has been deleted successfully'
        ], 200);
    }
}
