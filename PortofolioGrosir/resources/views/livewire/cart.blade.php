<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col">
                        <h2 class="font-weight-bold">Products List</h2>
                    </div>
                    <div class="col"><input wire:model="search" type="text" class="form-control"
                            placeholder="find something...">
                    </div>
                </div>
                <div class="row">
                    @forelse ($products as $product)
                        <div class="col-md-3 mb-3 mt-2">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{ asset('storage/public/images/' . $product->image) }}" alt="product"
                                        style="object-fit: contain;width:100%;height:100px;">
                                </div>
                                <div class="card-footer">
                                    <h6 class="text-center font-sm">{{ $product->name }}</h6>
                                    <button wire:click="addItem({{ $product->id }})" class="btn btn-primary">Add To
                                        Cart</button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h5 class="text-center sm mt-5">No Product Found</h4>
                    @endforelse
                </div>
            </div>
            {{ $products->links() }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <h2 class="font-weight-bold">Cart</h2>
            <div class="card-body">
                @if (session()->has('error'))
                    <p class="text-danger font-weight-bold">
                        {{ session('error') }}
                    </p>
                @endif
                <table class="table table-sm table-bordered table-hovered">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($carts as $index=>$cart)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <a href="#" class="font-weight-bold text-dark">{{ $cart['name'] }}</a>
                                    <br>
                                    Qty: {{ $cart['qty'] }}
                                    <span wire:click="increaseItem('{{ $cart['rowId'] }}')"
                                        class="font-weight-bold text-secondary"
                                        style="font-size: 18px;cursor: pointer">+</span>
                                    <span wire:click="decreaseItem('{{ $cart['rowId'] }}')"
                                        class="font-weight-bold text-secondary"
                                        style="font-size: 18px;cursor: pointer">-</span>
                                    <span wire:click="removeItem('{{ $cart['rowId'] }}')"
                                        class="font-weight-bold text-secondary"
                                        style="font-size: 13px;cursor: pointer">x</span>
                                </td>
                                <td>{{ 'Rp' . number_format($cart['price'], 2, ',', '.') }}</td>
                            </tr>
                        @empty
                            <td colspan="3">
                                <h6 class="text-center">Empty Cart</h6>
                            </td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="font-weight-bold">Cart Summary</h4>
                <h5 class="font-weight-bold">Sub Total:
                    {{ 'Rp' . number_format($summary['sub_total'], 2, ',', '.') }}</h5>
                <h5 class="font-weight-bold">Tax: {{ 'Rp' . number_format($summary['pajak'], 2, ',', '.') }}</h5>
                <h5 class="font-weight-bold">Total: {{ 'Rp' . number_format($summary['total'], 2, ',', '.') }}</h5>
                {{-- <div>
                    <button wire:click="enableTax" class="btn btn-primary btn-block">Add Tax</button>
                    <button wire:click="disableTax" class="btn btn-danger btn-block">Remove Tax</button>
                </div> --}}

                <div class="form-group">
                    <input type="number" wire:model="payment" class="form-control mt-4" id="payment"
                        placeholder="input Payment">
                    <input type="hidden" id="total" value="{{ $summary['total'] }}">
                </div>

                <form wire:submit.prevent="handleSubmit">
                    <div class="mt-3">
                        <label for="paymenttext">Total Uang</label>
                        <h4 wire:ignore id="paymentText">Rp. 0</h4>
                    </div>

                    <div>
                        <label for="kembalian">Kembalian</label>
                        <h4 wire:ignore id="kembalianText">Rp. 0</h4>
                    </div>


                    <div class="mt-4">
                        <button wire:ignore type="submit" id="saveButton" disabled class="btn btn-success btn-block"
                            id="saveButton"><i class="fas fa-save fa-lg"></i> Save Transaction</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script-custom')
    <script>
        payment.oninput = () => {
            const paymentAmount = document.getElementById("payment").value
            const totalAmount = document.getElementById("total").value

            const kembalian = paymentAmount - totalAmount

            document.getElementById("kembalianText").innerHTML = new Intl.NumberFormat('id', {
                style: 'currency',
                currency: 'IDR'
            }).format(kembalian)
            document.getElementById("paymentText").innerHTML = new Intl.NumberFormat('id', {
                style: 'currency',
                currency: 'IDR'
            }).format(paymentAmount)

            const saveButton = document.getElementById("saveButton")

            if (kembalian < 0) {
                saveButton.disabled = true
            } else {
                saveButton.disabled = false
            }
        }
    </script>
@endpush
