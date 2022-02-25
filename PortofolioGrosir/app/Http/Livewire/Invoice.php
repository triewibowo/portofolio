<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Transaction;
use App\Models\ProductTransaction;

class Invoice extends Component
{
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $search1 = '';

    public function render()
    {
        $invoices = Transaction::where('invoice_number', 'like', '%'.$this->search.'%')->orderBy('created_at', 'DESC')->get();
        $products = ProductTransaction::where('invoice_number', 'like', '%'.$this->search1.'%')->orderBy('created_at', 'DESC')->get();
        return view('livewire.invoice', compact('invoices', 'products'));
    }
}
