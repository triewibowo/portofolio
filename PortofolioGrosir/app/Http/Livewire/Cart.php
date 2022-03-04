<?php

namespace App\Http\Livewire;
use App\Models\Product as ModelsProduct;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\ProductTransaction;

use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithPagination;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use DB;

class Cart extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $payment;

    public $tax = "+10%";

    public function render()
    {
        $current = Carbon::now()->format('Ymd');

        // History
        $history = Transaction::with('user')->orderBy('created_at', 'DESC')->whereDate('created_at', $current)->get();
        $categories = Category::all();
        $products = ModelsProduct::where('name', 'like', '%'.$this->search.'%')->orWhere('category_id', 'LIKE',  '%' . $this->search . '%')->OrderBy('created_at', 'DESC')->paginate(4);
        $condition = new \Darryldecode\Cart\CartCondition([
            'name'      => 'pajak',
            'type'      => 'tax',
            'target'    => 'total',
            'value'     => $this->tax,
            'order'     => 1
        ]);

        \Cart::session(Auth()->id())->condition($condition);
        $items = \Cart::session(Auth()->id())->getContent()->sortBy(function ($cart){
            return $cart->attributes->get('added_at');
        });

        if(\Cart::isEmpty()){
            $cartData = [];
        }else{
            foreach($items as $item){
                $cart[] = [
                    'rowId'         => $item->id,
                    'name'          => $item->name,
                    'qty'           => $item->quantity,
                    'pricesingle'   => $item->price,
                    'price'         => $item->getPriceSum(),
                ];
            }

            $cartData = collect($cart);
        }

        $sub_total = \Cart::session(Auth()->id())->getSubTotal();
        $total = \Cart::session(Auth()->id())->getTotal();

        $newCondition = \Cart::session(Auth()->id())->getCondition('pajak');
        $pajak = $newCondition -> getCalculatedValue($sub_total);

        $summary =[
            'sub_total' => $sub_total,
            'pajak'     => $pajak,
            'total'     => $total
        ];

        

        return view('livewire.cart', [
            'products'      => $products,
            'carts'         => $cartData,
            'categories'    => $categories,
            'history'       => $history,
            'summary'       => $summary
        ]);
    }

    public function addItem($id){
        $rowId = "Cart".$id;

        $idProduct = substr($rowId, 4,5);
        $product   = ModelsProduct::find($idProduct);

        $cart  = \Cart::session(Auth()->id())->getContent();
        $cekItemId = $cart->whereIn('id', $rowId);

        if($cekItemId->isNotEmpty()){
            return session()->flash('error', 'Item has been chosen');
        }else{
            
            if($cekItemId->isNotEmpty()){
                \Cart::session(Auth()->id())->update($rowId, [
                    'quantity' => [
                        'relative' => true,
                        'value' => 1
                    ]
                    ]);
            }elseif($product->qty == 0) {
                    return session()->flash('error', 'Out of stock');
            }else{
                    \Cart::session(Auth()->id())->add([
                        'id' => "Cart".$product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                        'quantity' => 1,
                        'attributes' => [
                            'added_at' => Carbon::now(),
                            'status' => true
                        ],
                    ]); 
            }   
        } 
 }


    // public function enableTax(){
    //     $this->tax = "+10%";
    // }

    // public function disableTax(){
    //     $this->tax = "0%";
    // }

    public function increaseItem($rowId){
        $idProduct = substr($rowId, 4,5);
        $product   = ModelsProduct::find($idProduct);
        $cart      = \Cart::session(Auth()->id())->getContent();
        $checkitem = $cart->WhereIn('id', $rowId);

        if($product->qty == $checkitem[$rowId]->quantity){
            session()->flash('error', 'Item is out of stock');
        }else{
            if($product->qty == 0){
                return session()->flash('error', 'out of stock');
            }else{
            \Cart::session(Auth()->id())->update($rowId,[
                'quantity' => [
                    'relative' => true,
                    'value' => 1
                ]
            ]);
        }
        }
     }

    public function decreaseItem($rowId){
        $idProduct = substr($rowId, 4,5);
        $product   = ModelsProduct::find($idProduct);
        $cart      = \Cart::session(Auth()->id())->getContent();
        $checkitem = $cart->WhereIn('id', $rowId);

        if($checkitem[$rowId]->quantity == 1){
            $this->removeItem($rowId);
        }else{
            \Cart::session(Auth()->id())->update($rowId,[
                'quantity' => [
                    'relative' => true,
                    'value' => -1
                ]
            ]);
        }
    }

    public function removeItem($rowId){
        \Cart::session(Auth()->id())->remove($rowId);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function clear(){
        $this->dispatchBrowserEvent('format');
    }

    public function handleSubmit(){
        $cartTotal = \Cart::session(Auth()->id())->getTotal();
        $cart = \Cart::session(Auth()->id())->getContent();
        $bayar = $this->payment;
        $kembalian = (int) $bayar - (int) $cartTotal;

                if($cart -> isNotEmpty()){
                    if($kembalian >= 0){
                        DB::beginTransaction();

                        try{
                        $allCart = \Cart::session(Auth()->id())->getContent();

                        $filterCart = $allCart->map(function ($item) {
                            return [
                                'id' => substr($item->id, 4,5 ),
                                'quantity' => $item->quantity
                            ];
                        });

                        foreach ($filterCart as $cart) {
                            $product = ModelsProduct::find($cart['id']);

                            if($product->qty === 0){
                                return session()->flash('error', 'Out of stock');
                            }

                            $product->decrement('qty', $cart['quantity']);
                        }

                        $id = IdGenerator::generate([
                            'table' => 'transactions',
                            'length' => 10,
                            'prefix' => 'INV-',
                            'field'  => 'invoice_number'
                        ]);

                        Transaction::create([
                            'invoice_number' => $id,
                            'user_id' => Auth()->id(),
                            'pay'     => $bayar,
                            'total'   => $cartTotal  
                        ]);

                        foreach ($filterCart as $cart) {
                            ProductTransaction::create([
                                'product_id' => $cart['id'],
                                'invoice_number' => $id,
                                'qty' => $cart['quantity']
                            ]);
                        }

                        \Cart::session(Auth()->id())->clear();
                        $this->payment = 0;
                        $this->dispatchBrowserEvent('format');
                            DB::commit();
                            return session()->flash('success', 'Transaction successfully');
                        }catch (\Throwable $th){
                            DB::rollback();
                            return session()->flash('error', $th);
                        }
                    }
                }else{
                    $this->payment = 0;
                    return session()->flash('error', 'Enter Product');
                }
       
    }
}
