<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;

class getGeoController extends Controller
{
    public function getCityByProvince($provinceCode)
    {
        $cities = City::where('province_code', $provinceCode)->orderBy('name')->get();
        return response()->json($cities);
    }

    public function getDistrictByCity($cityCode)
    {
        $districts = District::where('city_code', $cityCode)->orderBy('name')->get();
        return response()->json($districts);
    }

    public function getVillageByDistrict($districtCode)
    {
        $villages = Village::where('district_code', $districtCode)->orderBy('name')->get();
        return response()->json($villages);
    }
}
