<div class="d-flex justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h2 class="font-weight-bold mb-3">Invoice Log</h2>
                <table class="table table-bordered table-hovered table-striped">
                    <thead>
                        <tr>
                            <th>Invoice Number</th>
                            <th>User Name</th>
                            <th>Pay</th>
                            <th>Total (10%tax)</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $item)
                            <tr>
                                <td>{{ $item->invoice_number }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->pay }}</td>
                                <td>{{ $item->total }}</td>
                                <td>{{ $item->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
