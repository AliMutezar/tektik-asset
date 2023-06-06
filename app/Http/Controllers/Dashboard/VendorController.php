<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Http\Requests\StoreVendorRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\Village;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $vendors = Vendor::all();
        $title = 'Data Vendors';
        return view('dashboard.vendor.index', compact(['vendors', 'title']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $title = 'Add Vendor';
        $provinces = Province::all();
        $cities = City::all();
        $districts = District::all();
        $villages = Village::all();

        return view('dashboard.vendor.create', compact('title', 'provinces', 'cities', 'districts', 'villages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVendorRequest $request): RedirectResponse
    {
        $data = $request->all();

        // Kalo mau dd, jangan pake form request
        // dd($data);

        Vendor::create($data);
        return redirect()->route('vendors.index')->with('success', 'Data vendor has been inserted successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor): View
    {
        $title = 'Edit Vendor';
        $vendor = Vendor::where('id', $vendor->id)->first();
        $provinces = Province::all();
        $cities = City::all();
        $districts = District::all();
        $villages = Village::all();

        return view('dashboard.vendor.edit', compact('vendor','title', 'provinces', 'cities', 'villages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreVendorRequest $request, Vendor $vendor)
    {
        $data = $request->validated();
        $vendor_name = $vendor->company_name;
        $vendor->update($data);

        return redirect()->back()->with('success', $vendor_name . 'vendor has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        $vendor = Vendor::findOrFail($vendor->id);
        $vendor_name = $vendor->company_name;
        $vendor->delete();

        return redirect()->route('vendors.index')->with('success', 'Data ' . $vendor_name . 'has been deleted successfully');
    }
}