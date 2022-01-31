<?php

namespace App\Http\Livewire;
use App\Models\Product as ModelsProduct;
use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithPagination;

class Cart extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $payment = '';

    public $tax = "0%";

    public function render()
    {
        $products = ModelsProduct::where('name', 'like', '%'.$this->search.'%')->OrderBy('created_at', 'DESC')->paginate(12);

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
            'summary'       => $summary
        ]);
    }

    public function addItem($id){
        $rowId = "Cart".$id;
        $cart  = \Cart::session(Auth()->id())->getContent();
        $cekItemId = $cart->whereIn('id', $rowId);

        if($cekItemId->isNotEmpty()){
            \Cart::session(Auth()->id())->update($rowId, [
                'quantity' => [
                    'relative' => true,
                    'value' => 1
                ]
                ]);
        }else{
            $product = ModelsProduct::findOrFail($id);
            \Cart::session(Auth()->id())->add([
                'id' => "Cart".$product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'attributes' => [
                    'added_at' => Carbon::now()
                ],
            ]);
        }
    }

    public function enableTax(){
        $this->tax = "+10%";
    }

    public function disableTax(){
        $this->tax = "0%";
    }

    public function increaseItem($rowId){
        $idProduct = substr($rowId, 4,5);
        $product   = ModelsProduct::find($idProduct);
        $cart      = \Cart::session(Auth()->id())->getContent();
        $checkitem = $cart->WhereIn('id', $rowId);

        if($product->qty == $checkitem[$rowId]->quantity){
            session()->flash('error', 'Jumlah Tidak Cukup');
        }else{
            \Cart::session(Auth()->id())->update($rowId,[
                'quantity' => [
                    'relative' => true,
                    'value' => 1
                ]
            ]);
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
    
    public function handleSubmit(){
        dd($this->payment);
    }
}
