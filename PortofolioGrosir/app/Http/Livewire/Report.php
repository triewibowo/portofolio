<?php

namespace App\Http\Livewire;
use Carbon\Carbon;
use Livewire\WithPagination;
use DB;

use App\Models\ProductTransaction;
use App\Models\Transaction;
use Livewire\Component;

use App\Exports\TransactionsExport;
use Maatwebsite\Excel\Facades\Excel;

class Report extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $search1 = '';
    public $numbPage1 = 10;
    public $numbPage2 = 10;

    public function api(){
        $current = Carbon::now()->format('Ymd');

        $profit_today = Transaction::with('product')
        ->join('product_transactions', 'product_transactions.invoice_number', '=', 'transactions.invoice_number')
        ->join('products', 'product_transactions.id', '=', 'products.id')
        ->whereDate('transactions.created_at', $current)
        ->get();

        return $profit_today;
    }
    
    public function render()
    {
        $current = Carbon::now()->format('Ymd');

        if(Auth()->user()->can('isAdmin')){
        $profit_today = Transaction::where('invoice_number', 'like', '%'.$this->search.'%')
        ->whereDate('created_at', $current)
        ->whereMonth('created_at', date('m'))
        ->paginate($this->numbPage1);

        $profit_month = Transaction::where('invoice_number', 'like', '%'.$this->search1.'%')
        ->paginate($this->numbPage2);


        // dd($profit_month);
        return view('livewire.report', compact('profit_today', 'profit_month'));
        }else{
            return abort('404');
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function export_excel()
	{
		return Excel::download(new TransactionsExport, 'transactions.xlsx');
	}
}
