 <div>
     <div class="mb-4">
         <div class="row">
             <div class="col">
                 <h3 id="icon2">Report</h3>
             </div>
             <div class="col-3 d-flex justify-content-end">
                 <Button wire:click="export_excel()" class="btn btn-success">Export Excel</Button>
             </div>
         </div>
     </div>
     <div class="row d-flex justify-content-center mt-70 mb-70">
         <div class="col-md-6">
             <div class="main-card mb-3 card">
                 <div class="card-body">
                     <div class="row">
                         <div class="col">
                             <h5 class="card-title">Income per Day</h5>
                         </div>
                         <div class="col">
                             <div class="input-group">
                                 <input wire:model="search" id="search-input" type="search" class="form-control rounded"
                                     placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                             </div>
                         </div>
                     </div>
                     <div class="table-responsive">
                         <div class="scroll-area">
                             <table class="table table-bordered table-hovered table-striped mt-3" id="example2">
                                 <thead>
                                     <tr>
                                         <th width="5%">No</th>
                                         <th>Invoice Number</th>
                                         <th>Total</th>
                                         <th>Pay</th>
                                         <th>Date</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($profit_today as $index => $item)
                                         <tr>
                                             <td>{{ $index + 1 }}</td>
                                             <td>{{ $item->invoice_number }}</td>
                                             <td>{{ 'Rp ' . number_format($item->total, 2, ',', '.') }}</td>
                                             <td>{{ 'Rp ' . number_format($item->pay, 2, ',', '.') }}</td>
                                             <td>{{ $item->created_at->format('h:i A j F, Y ') }}</td>
                                         </tr>
                                     @endforeach
                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-md-6">
             <div class="main-card mb-3 card">
                 <div class="card-body">
                     <div class="row">
                         <div class="col">
                             <h5 class="card-title">All Transactions</h5>
                         </div>
                         <div class="col">
                             <div class="input-group">
                                 <input wire:model="search1" id="search-input" type="search"
                                     class="form-control rounded" placeholder="Search" aria-label="Search"
                                     aria-describedby="search-addon" />
                             </div>
                         </div>
                     </div>
                     <div class="table-responsive">
                         <div class="scroll-area">
                             <table class="table table-bordered table-hovered table-striped mt-3" id="example2">
                                 <thead>
                                     <tr>
                                         <th width="5%">No</th>
                                         <th>Invoice Number</th>
                                         <th>Total</th>
                                         <th>Pay</th>
                                         <th>Date</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($profit_month as $index => $item)
                                         <tr>
                                             <td>{{ $index + 1 }}</td>
                                             <td>{{ $item->invoice_number }}</td>
                                             <td>{{ 'Rp ' . number_format($item->total, 2, ',', '.') }}</td>
                                             <td>{{ 'Rp ' . number_format($item->pay, 2, ',', '.') }}</td>
                                             <td>{{ $item->created_at->format('h:i A j F, Y ') }}</td>
                                         </tr>
                                     @endforeach
                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 </div>
