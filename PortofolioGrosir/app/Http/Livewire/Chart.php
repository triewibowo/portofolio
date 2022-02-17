<?php

namespace App\Http\Livewire;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Carbon\Carbon;

use DB;
use App\Models\ProductTransaction;
use App\Models\Transaction;

use Livewire\Component;
use Faker\Factory;

class Chart extends Component
{
    public $bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    public $hari  = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10',
                    '11', '12', '13', '14', '15', '16', '17', '18', '19', '20',
                    '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'
];
    

    public function render()
    {
        $faker = Factory::create();
        $current = Carbon::now()->format('Ymd');

        // profit today
        $profit_today = Transaction::select(DB::raw("SUM(Total) as total"))->whereDate('created_at', $current)->first()->total;
        // dd($profit_today);

        // Month
        foreach (range(1,12) as $month) {
            $data_month1[] = ProductTransaction::select(DB::raw("COUNT(*) as total"))->whereMonth('created_at', $month)->first()->total;
        }

        // Profit
        foreach (range(1,12) as $month) {
            $data_month[] = Transaction::select(DB::raw("SUM(Total) as total"))->whereMonth('created_at', $month)->first()->total;
        }


        // Day
        foreach (range(1,31) as $day) {
            $data_day[] = Transaction::select(DB::raw("SUM(total) as total"))->whereDay('created_at', $day)->first()->total;
        }

        // Chart Column
        $chart = (new ColumnChartModel());
        foreach (array_combine($this->bulan , $data_month) as $bulan => $item) {
            $chart->addColumn($bulan, $item, $faker->hexColor());
        }

        $chart
            ->setTitle('Jumlah Transaksi')
            ->withoutLegend();
        // End Column
    
        // Chart Pie
        $pieChart = (new PieChartModel());
        foreach (array_combine($this->bulan , $data_month1) as $bulan => $item) {
            $pieChart->addSlice($bulan, $item, $faker->hexColor());
        }     
        
        $pieChart
            ->withLegend()
            ->withDataLabels();
        // End Pie

        // Column MultiLine
        $colChart = (new ColumnChartModel());
        foreach (array_combine($this->hari , $data_day) as $hari => $item) {
            $colChart->addColumn($hari, $item, $faker->hexColor());
        }  

        $colChart
            ->setTitle('Jumlah Transaksi')
            ->withoutLegend();
        // End MultiChart

        $today = Carbon::now()->isoFormat('MMMM Y');
        $year = Carbon::now()->isoFormat('Y');

        // dd($pieChart);
        return view('livewire.chart', compact('chart', 'pieChart', 'colChart', 'today', 'year', 'profit_today'));
    }
}
