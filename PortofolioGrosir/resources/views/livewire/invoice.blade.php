@section('css')
    <link href="{{ asset('css/style3.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
@endsection
<div>
    <div>
        <h3 id="icon2">History</h3>
    </div>
    <div class="row d-flex justify-content-center mt-70 mb-70">
        <div class="col-md-6">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title">Invoice Timeline</h5>
                        </div>
                        <div class="col">
                            <div class="input-group">
                                <input wire:model="search" id="search-input" type="search" class="form-control rounded"
                                    placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                            </div>
                        </div>
                    </div>
                    <div class="scroll-area">
                        @foreach ($invoices as $invoice)
                            <div class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                <div class="vertical-timeline-item vertical-timeline-element">
                                    <div> <span class="vertical-timeline-element-icon bounce-in"> <i
                                                class="badge badge-dot badge-dot-xl badge-success"></i> </span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                            <h4 class="timeline-title">{{ $invoice->invoice_number }}</h4>
                                            <p class="timeline-p">Total
                                                {{ 'Rp ' . number_format($invoice->total, 2, ',', '.') }}, Pay
                                                {{ 'Rp ' . number_format($invoice->pay, 2, ',', '.') }}, Input by
                                                {{ $invoice->user->name }}
                                                <a href="javascript:void(0);"
                                                    data-abc="true">{{ $invoice->created_at->format('h:i A') }}</a>
                                            </p>
                                            <span
                                                class="vertical-timeline-element-date">{{ $invoice->created_at->format('j F, Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title">Product Timeline</h5>
                        </div>
                        <div class="col">
                            <div class="input-group">
                                <input wire:model="search1" id="search-input" type="search" class="form-control rounded"
                                    placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                            </div>
                        </div>
                    </div>
                    <div class="scroll-area">
                        @foreach ($products as $item)
                            <div class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                <div class="vertical-timeline-item vertical-timeline-element">
                                    <div> <span class="vertical-timeline-element-icon bounce-in"> <i
                                                class="badge badge-dot badge-dot-xl badge-success"></i> </span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                            <h4 class="timeline-title">{{ $item->name }}</h4>
                                            <p class="timeline-p">Invoice Number {{ $item->invoice_number }},
                                                Quantity
                                                <a href="javascript:void(0);" data-abc="true">{{ $item->qty }}</a>
                                            </p>
                                            <span
                                                class="vertical-timeline-element-date">{{ $item->created_at->format('j F, Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script-custom')
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endpush
