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
        $vendors = Vendor::latest()->get();
        $title = 'Data Vendors';
        return view('dashboard.vendor.index', compact(['vendors', 'title']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $title = 'Add Vendor';
        $provinces = Province::where('code', '>', 1)->orderBy('name')->pluck('name', 'code');
        // dd($provinces);
        $first_province = Province::where('code', '>', 1)
            ->orderBy('name')
            ->first();

        $cities = City::where('code', '>', 1)
            ->where('province_code', $first_province->code)
            ->orderBy('name')
            ->pluck('name', 'code');

        $first_city = City::where('province_code', $first_province->code)
            ->orderBy('name')
            ->first();

        $districts = District::where('code', '>', 1)
            ->where('city_code', $first_city->code)
            ->orderBy('name')
            ->pluck('name', 'code');
        // dd($districts);

        $first_district = District::where('city_code', $first_city->code)
            ->orderBy('name')
            ->first();

        $villages = Village::where('code', '>', 1)
            ->where('district_code', $first_district->code)
            ->orderBy('name')
            ->pluck('name', 'code');
            // dd($villages);

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
        $provinces = Province::orderBy('name')->pluck('name', 'code');
        // dd($provinces);
        $province_code = Vendor::where('id', $vendor->id)->where('province_code', $vendor->province_code)->pluck('province_code');
        // dd($province_code);
        $cities = City::where('province_code', $province_code)->orderBy('name')->pluck('name', 'code');
        // dd($cities);
        $cities_code = Vendor::where('id', $vendor->id)->where('city_code', $vendor->city_code)->pluck('city_code');
        // dd($cities_code);
        $districts = District::where('city_code', $cities_code)->orderBy('name')->pluck('name', 'code');
        $district_code = Vendor::where('id', $vendor->id)->where('district_code', $vendor->district_code)->pluck('district_code');
        $villages = Village::where('district_code', $district_code)->orderBy('name')->pluck('name', 'code');
        // $province_code = Vendor::where('province_code', $vendor->province_code)->pluck('province_code');
        // $provinces = Province::where('code', $vendor->province_code)->orderBy('name')->pluck('name', 'code');
        // $cities = City::where('province_code', $province_code)->orderBy('name')->pluck('name', 'code');
        // $cities_code = Vendor::where('city_code', $vendor->city_code)->pluck('city_code');
        // $districts = District::where('city_code', $cities_code)->orderBy('name')->pluck('name', 'code');
        // $district_code = Vendor::where('district_code', $vendor->district_code)->pluck('district_code');
        // $villages = Village::where('district_code', $district_code)->orderBy('name')->pluck('name', 'code');

        return view('dashboard.vendor.edit', compact('vendor', 'title', 'provinces', 'cities', 'districts', 'villages'));
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
