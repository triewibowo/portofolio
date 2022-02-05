<div class="d-flex justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h2 class="font-weight-bold mb-3">Product Transaction Log</h2>
                <table class="table table-bordered table-hovered table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Product</th>
                            <th>Invoice Number</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                            <tr>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->invoice_number }}</td>
                                <td>{{ $item->qty }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
