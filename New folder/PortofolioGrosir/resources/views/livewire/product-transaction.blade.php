@section('css')
    <link href="{{ asset('css/style3.css') }}" rel="stylesheet">
@endsection
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Timeline</h6>
                    <div id="content">
                        <ul class="timeline">
                            @foreach ($products as $product)
                                <li class="event" data-date="{{ $product->created_at }}">
                                    <h3>{{ $product->product_id }}</h3>
                                    <p class="text-muted">Invoice Number : {{ $product->invoice_number }}</p>
                                    <p class="text-muted">Quantity : {{ $product->qty }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
