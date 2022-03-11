<div>
    <div class="mb-4">
        <h3 id="icon2">Cashier</h3>
    </div>

    <div class="row">
        <div class="col-md-7 mb-4">
            <div class="card p-1">
                <div class="card-header">
                    <h5 class="text-muted">Product List</h5>
                </div>
                <div class="card-body p-2">
                    <div class="row">
                        <div class="col-3">
                            <div class="input-group mt-2 mb-2">
                                <select wire:model="search" class="form-select form-control rounded"
                                    aria-label="Default select example">
                                    <option value="" selected>Category</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">

                        </div>
                        <div class="col">
                            <div class="input-group mt-2 mb-2">
                                <input wire:model="search" id="search-input" type="search" class="form-control rounded"
                                    placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @forelse ($products as $product)
                            <div class="col-md-6 mt-2">
                                <div wire:click="addItem({{ $product->id }})" class="card mb-3 border p-2"
                                    style="max-width: 540px; cursor: pointer;">
                                    <div class="icon_dash"><i class='bx bxs-cart-add' id="icon"></i></div>
                                    <div class="row g-0">
                                        <div class="col-md-4 pt-3">
                                            <img src="{{ asset('storage/public/images/' . $product->image) }}"
                                                alt="product" style="object-fit: contain;"
                                                class="img-fluid rounded-start">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $product->name }}</h5>
                                                <p class="card-text text-muted" id="desc" style="height: 50px;">
                                                    {{ $product->desc }}
                                                </p>
                                                <span class="card-text fw-bold">
                                                    {{ 'Rp ' . number_format($product->price, 2, ',', '.') }}
                                                </span>
                                                <div class="row">
                                                    <div class="col">
                                                        <p class="card-text" style="font-size: 15px;"><small
                                                                class="text-muted">Product
                                                                Quantity
                                                                {{ $product->qty }}</small></p>
                                                    </div>
                                                    <div class="col">
                                                        <p class="card-text" style="font-size: 15px;"><small
                                                                class="text-muted">
                                                                {{ $product->category->name }}</small></p>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <h5 class="text-center sm mt-5">No Product Found</h4>
                        @endforelse
                    </div>
                </div>
                <div class="d-flex justify-content-center pt-1">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card p-1 mb-4" style="background-color: #E8FFC2">
                <div class="card-header">
                    <div class="row">
                        <div class="col-3">
                            <h5 class="text-muted">Cart</h5>
                        </div>
                        <div class="col">
                            <h5 class="text-muted text-end">{{ Auth::user()->name }}</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (session()->has('error'))
                        <div class="alert alert-success d-flex align-items-center" role="alert"
                            style="background-color: rgba(50, 205, 50, 0.25)">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                                <use xlink:href="#exclamation-triangle-fill" />
                            </svg>
                            <div>
                                {{ session('error') }}
                            </div>
                            <button type="button" class="btn-close" id="close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('success'))
                        <div class="alert alert-success d-flex align-items-center" role="alert"
                            style="background-color: rgba(50, 205, 50, 0.25)">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                                <use xlink:href="#check-circle-fill" />
                            </svg>
                            <div>
                                {{ session('success') }}
                            </div>
                            <button type="button" class="btn-close" id="close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col" class="text-center">Quantity</th>
                                    <th scope="col">Action</th>
                                    <th scope="col" class="text-end">Price</th>
                                    <th scope="col" class="text-end"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($carts as $index=>$cart)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>
                                            <span href="#">{{ $cart['name'] }}</span>
                                        </td>
                                        <td scope="row" class="text-center">
                                            {{ $cart['qty'] }}
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button wire:click="increaseItem('{{ $cart['rowId'] }}')"
                                                    type="button" class="btn btn-success btn-sm">+</button>
                                                <button wire:click="decreaseItem('{{ $cart['rowId'] }}')"
                                                    type="button"
                                                    class="btn btn-success btn-sm border-start border-light">-</button>
                                            </div>
                                        </td>
                                        <td scope="row" class="text-end">
                                            {{ 'Rp' . number_format($cart['price'], 2, ',', '.') }}
                                        </td>
                                        <td>
                                            <i wire:click="removeItem('{{ $cart['rowId'] }}')"
                                                class='bx bxs-x-circle' data-bs-toggle="tooltip" title="Delete"
                                                style="font-size: 20px;cursor: pointer; color:#F93154;"></i>
                                        </td>
                                    </tr>
                                @empty
                                    <td colspan="6">
                                    </td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col mb-4">
                    <div class="card" style="background-color: #E8FFC2">
                        <div class="card-header text-center">
                            <h5 class="text-muted">Transaction History</h5>
                        </div>
                        <div class="card-body p-3" id="historyChart" style="height: 22rem;">
                            @foreach ($history as $item)
                                <span style="font-size: 12px">{{ $item->created_at->format('h:i:s A') }} -
                                    {{ $item->invoice_number }} - Cashier {{ $item->user->name }} - Total
                                    {{ 'Rp ' . number_format($item->total, 2, ',', '.') }} -
                                    Bayar
                                    {{ 'Rp ' . number_format($item->pay, 2, ',', '.') }}</span>
                                <hr>
                            @endforeach
                        </div>
                        <div class="card-footer">

                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="background-color: #E8FFC2">
                        <div class="card-body" style="height: 27rem;">
                            <div class="row">
                                <div class="col">
                                    <div>
                                        <h5 class="text-muted sm text-end">Sub Total : </h5>
                                        <hr>
                                        <h5 class="text-muted sm text-end">Tax : </h5>
                                        <hr>
                                        <h5 class="text-muted sm text-end">Total : </h5>
                                        <hr>
                                    </div>
                                </div>
                                <div class="col">
                                    <div>
                                        <h5 class="text-muted sm text-end">
                                            {{ 'Rp. ' . number_format($summary['sub_total'], 2, ',', '.') }}</h5>
                                        <hr>
                                        <h5 class="text-muted sm text-end">
                                            {{ 'Rp. ' . number_format($summary['pajak'], 2, ',', '.') }}
                                        </h5>
                                        <hr>
                                        <h5 class="text-muted sm text-end">
                                            {{ 'Rp. ' . number_format($summary['total'], 2, ',', '.') }}
                                        </h5>
                                        <hr>
                                    </div>
                                </div>
                            </div>

                            <form wire:submit.prevent="handleSubmit">
                                <div class="col">
                                    <div wire:ignore.self class="form-outline">
                                        <input type="number" wire:model="payment" class="form-control rounded mb-3"
                                            id="payment" id="typeNumber">
                                        <label class="form-label" for="payment">Input Payment</label>
                                        <input type="hidden" id="total" value="{{ $summary['total'] }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <h5 class="text-muted sm text-end">Total Cash : </h5>
                                        <hr>
                                        <h5 class="text-muted sm text-end">Chance : </h5>
                                        <hr>
                                    </div>
                                    <div class="col">
                                        <h5 wire:ignore class="text-muted sm text-end" id="paymentText">Rp. 0</h5>
                                        <hr>
                                        <h5 wire:ignore class="text-muted sm text-end" id="kembalianText">Rp. 0</h5>
                                        <hr>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button wire:ignore type="submit" id="saveButton" disabled
                                        class="btn btn-block btn-success" color:aliceblue;" id="saveButton"><i
                                            class="fas fa-save fa-lg"></i> Save
                                        Transaction</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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

            window.addEventListener('format', event => {
                document.getElementById("kembalianText").innerHTML = new Intl.NumberFormat('id', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(0)

                document.getElementById("paymentText").innerHTML = new Intl.NumberFormat('id', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(0)
            })

            const saveButton = document.getElementById("saveButton")

            if (kembalian < 0) {
                saveButton.disabled = true
            } else {
                saveButton.disabled = false
            }
        }
    </script>
@endpush
