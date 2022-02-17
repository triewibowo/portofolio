<div class="mb-4">
    <h3 class="text-muted">Dashboard</h3>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Profit Today</p>
                        <h4 class="card-text">{{ 'Rp ' . number_format($profit_today, 2, ',', '.') }}</h4>
                    </div>
                    <div class="card-footer text-muted">
                        Cashier : {{ Auth::user()->name }}
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Profit Today</p>
                        <h4 class="card-text">{{ 'Rp ' . number_format($profit_today, 2, ',', '.') }}</h4>
                    </div>
                    <div class="card-footer text-muted">
                        Cashier : {{ Auth::user()->name }}
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-5">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Profit Today</p>
                        <h4 class="card-text">{{ 'Rp ' . number_format($profit_today, 2, ',', '.') }}</h4>
                    </div>
                    <div class="card-footer text-muted">
                        Cashier : {{ Auth::user()->name }}
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-5">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Profit Today</p>
                        <h4 class="card-text">{{ 'Rp ' . number_format($profit_today, 2, ',', '.') }}</h4>
                    </div>
                    <div class="card-footer text-muted">
                        Cashier : {{ Auth::user()->name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5 mb-5">
        <div class="card">
            <div class="card-header">
                <h5 class="ms-4">Profit Monthly Transaction {{ $year }}</h5>
            </div>
            <div class="card-body" style="height: 19rem;">
                <livewire:livewire-column-chart :column-chart-model="$chart" />
            </div>
        </div>
    </div>
    <div class="col-md-3 px-3 mb-5">
        <div class="card">
            <div class="card-header">
                <h5 class="ms-4">Monthly Transaction {{ $year }}</h5>
            </div>
            <div class="card-body" style="height: 19rem;">
                <livewire:livewire-pie-chart :pie-chart-model="$pieChart" />
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <h5 class="ms-4">Data Daily Transaction on {{ $today }}</h5>
            </div>
            <div class="card-body" style="height: 19rem;">
                <livewire:livewire-column-chart :column-chart-model="$colChart" />
            </div>
        </div>
    </div>
    <div class="col-md-3 px-3">
        <div class="card">
            <div class="card-header">
                <h5 class="ms-4">Data Monthly Transaction</h5>
            </div>
            <div class="card-body" style="height: 19rem;">
                <livewire:livewire-pie-chart :pie-chart-model="$pieChart" />
            </div>
        </div>
    </div>
</div>
</div>
