<?php

namespace App\Http\Controllers\Dashboard;

use App\Charts\DivisionAssetChart;
use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetLoan;
use App\Models\AssetReturn;
use App\Models\Loan;
use App\Models\Vendor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(DivisionAssetChart $divisionAssetChart)
    {
        $assets = Asset::all();
        $total_asset = Asset::sum('stock_unit');
        $total_vendor = Vendor::count();
        $total_loan = AssetLoan::count();
        $total_return = AssetReturn::count();
        $chart = $divisionAssetChart->build();
        return view('dashboard', compact(
            'assets', 'total_asset', 'total_vendor', 'total_loan', 'total_return', 'chart'
        ));
    }
}
