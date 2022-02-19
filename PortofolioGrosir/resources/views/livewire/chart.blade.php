<div>
    <div class="mb-4">
        <h3 class="text-muted">Dashboard</h3>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body position-relative">
                            <div class="icon_dash"><i class='bx bxs-wallet' id="icon"></i></div>
                            <p class="card-title">Sales Today</p>
                            <h4 class="card-text">{{ 'Rp ' . number_format($profit_today, 2, ',', '.') }}</h4>
                        </div>
                        <div class="card-footer text-muted" id="card-footer">
                            <span class="fw-light" id="cashier">
                                <i class='bx bxs-calculator' id="icon2"></i> {{ Auth::user()->name }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="icon_dash"><i class='bx bx-male-female' id="icon"></i></div>
                            <p class="card-title">Guest Today</p>
                            <h4 class="card-text">{{ $guest_today }}</h4>
                        </div>
                        <div class="card-footer text-muted" id="card-footer">
                            <span class="fw-light" id="cashier">
                                <i class='bx bxs-calculator' id="icon2"></i> {{ Auth::user()->name }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="icon_dash"><i class='bx bxs-cart-alt' id="icon"></i></div>
                            <p class="card-title">Often Sale Today</p>
                            @if ($product_today)
                                <h4 class="card-text">{{ $product_today }}</h4>
                            @else
                                <h4 class="card-text">Empty</h4>
                            @endif
                        </div>
                        <div class="card-footer text-muted" id="card-footer">
                            <span class="fw-light" id="cashier">
                                <i class='bx bxs-calculator' id="icon2"></i> {{ Auth::user()->name }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="icon_dash"><i class='bx bxs-package' id="icon"></i></div>
                            <p class="card-title">Total Product</p>
                            <h4 class="card-text">{{ $total_product }}</h4>
                        </div>
                        <div class="card-footer text-muted" id="card-footer">
                            <span class="fw-light" id="cashier">
                                <i class='bx bxs-calculator' id="icon2"></i> {{ Auth::user()->name }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 mb-4">
            <div class="card">
                <div class="card-header text-center">
                    <h5 class="ms-4">Profit Monthly Transaction {{ $year }}</h5>
                </div>
                <div class="card-body" style="height: 19rem;">
                    <livewire:livewire-column-chart :column-chart-model="$chart" />
                </div>
            </div>
        </div>
        <div class="col-md-3 px-3 mb-4">
            <div class="card">
                <div class="card-header text-center">
                    <h5 class="ms-4">Monthly Transaction {{ $year }}</h5>
                </div>
                <div class="card-body" style="height: 19rem;">
                    <livewire:livewire-pie-chart :pie-chart-model="$pieChart" />
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9" mb-4>
            <div class="card">
                <div class="card-header">
                    <h5 class="ms-4">Data Daily Transaction on {{ $today }}</h5>
                </div>
                <div class="card-body" style="height: 19rem;">
                    <livewire:livewire-column-chart :column-chart-model="$colChart" />
                </div>
            </div>
        </div>
        <div class="col-md-3 px-3" mb-4>
            <div class="card">
                <div class="card-header text-center">
                    <h5 class="ms-4">History Transaction Today</h5>
                </div>
                <div class="card-body p-4 " id="historyChart" style="height: 19rem;">
                    @foreach ($history as $item)
                        <span style="font-size: 12px">{{ $item->created_at->format('h:i:s A') }} -
                            {{ $item->invoice_number }} - Cashier {{ $item->user->name }} - Total
                            {{ 'Rp ' . number_format($item->total, 2, ',', '.') }} -
                            Bayar
                            {{ 'Rp ' . number_format($item->pay, 2, ',', '.') }}</span>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
