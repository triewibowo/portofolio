<?php

namespace App\Http\Livewire;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;

use DB;
use App\Models\ProductTransaction;

use Livewire\Component;

class Chart extends Component
{
    public $bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

    public function render()
    {


        foreach (range(1,12) as $month) {
            $data_month[] = ProductTransaction::select(DB::raw("COUNT(*) as total"))->whereMonth('created_at', $month)->first()->total;
        }

        // Chart Column
        $chart = (new ColumnChartModel());
        foreach (array_combine($this->bulan , $data_month) as $bulan => $item) {
            $chart->addColumn($bulan, $item, '#CD5C5C');
        }

        $chart
            ->setTitle('Data Transaksi Bulanan')
            ->withoutLegend()
            ->withDataLabels();
    
        // Chart Pie
        $pieChart = (new PieChartModel());
        foreach (array_combine($this->bulan , $data_month) as $bulan => $item) {
            $pieChart->addSlice($bulan, $item, '#CD5C5C');
        }     
        
        $pieChart
            ->setTitle('Data Transaksi Bulanan')
            ->withLegend()
            ->withDataLabels();


        // dd($pieChart);
        return view('livewire.chart', compact('chart', 'pieChart'));
    }
}
