<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Transaction;

class Invoice extends Component
{
    public function render()
    {
        $invoices = Transaction::with('user')->orderBy('created_at', 'DESC')->get();
        return view('livewire.invoice', compact('invoices'));
    }
}
