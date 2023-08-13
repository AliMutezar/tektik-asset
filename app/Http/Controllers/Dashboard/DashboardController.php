<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetLoan;
use App\Models\AssetReturn;
use App\Models\Loan;
use App\Models\Vendor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total_asset = Asset::count();
        $total_vendor = Vendor::count();
        $total_loan = AssetLoan::count();
        $total_return = AssetReturn::count();
        return view('dashboard', compact(
            'total_asset', 'total_vendor', 'total_loan', 'total_return'
        ));
    }
}