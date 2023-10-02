<?php

namespace App\Charts;

use App\Models\Asset;
use App\Models\Division;
use App\Models\Loan;
use App\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class DivisionAssetChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $loans = Loan::with('user')->where('status', 0)->get();
        // dd($loans);
        
        $assetLoan = Loan::with('assets')->get();
        // $loan_users = $assetLoan->groupBy($loans->user->division->name);
        // dd($loan_users);

        $loan_users = $loans->groupBy('user.division.name');
        // dd($loan_users);


        $assetLoanDivision = $loan_users->map(function ($loans) {
            return $loans->count();
        }); 

        // dd($assetLoanDivision); 

        $xAxisLabel = $assetLoanDivision->keys()->toArray();
        $title = 'Asset Per Divison';

        $assets = Asset::with('categoryAsset')->get();
        // $title = 'Stock Asset by Category';

        // Mengelompokkan data aset berdasarkan kategori
        $assetsByCategory = $assets->groupBy('categoryAsset.name');

        // Menghitung total stok untuk setiap kategori
        $stockData = $assetsByCategory->map(function ($assets) {
            return $assets->sum('stock_unit');
        });

        $xAxisLabels = $stockData->keys()->toArray();

        return $this->chart->barChart()
            ->setTitle($title)
            ->setXAxis($xAxisLabel)
            ->addData('Loans', $assetLoanDivision->values()->toArray());
    }
}
