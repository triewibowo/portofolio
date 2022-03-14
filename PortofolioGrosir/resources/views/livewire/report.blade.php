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
                 <div class="card-header">
                     <nav class="navbar navbar-expand-lg navbar-light bg-light">
                         <div class="container-fluid">
                             <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                                 data-mdb-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01"
                                 aria-expanded="false" aria-label="Toggle navigation">
                                 <i class="fas fa-bars"></i>
                             </button>
                             <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                                 <a class="navbar-brand" href="#">Income per Day</a>
                                 <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                     <li class="nav-item">
                                         <a class="nav-link" href="#"></a>
                                     </li>
                                     <li class="nav-item">
                                         <select wire:model="numbPage1" class="form-select form-control rounded me-3"
                                             aria-label="Default select example">
                                             <option value="10" selected>Page</option>
                                             <option value="15">15</option>
                                             <option value="50">50</option>
                                             <option value="100">100</option>
                                         </select>
                                     </li>
                                 </ul>
                                 <form class="d-flex input-group w-auto">
                                     <input wire:model="search" type="search" class="form-control"
                                         placeholder="Type here" aria-label="Search" />
                                     <button class="btn btn-outline-primary" type="button" data-mdb-ripple-color="dark">
                                         Search
                                     </button>
                                 </form>
                             </div>
                         </div>
                     </nav>
                 </div>
                 <div class="card-body">
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
                 <div class="card-header">
                     <nav class="navbar navbar-expand-lg navbar-light bg-light">
                         <div class="container-fluid">
                             <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                                 data-mdb-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01"
                                 aria-expanded="false" aria-label="Toggle navigation">
                                 <i class="fas fa-bars"></i>
                             </button>
                             <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                                 <a class="navbar-brand" href="#">All Transactions</a>
                                 <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                     <li class="nav-item">
                                         <a class="nav-link" href="#"></a>
                                     </li>
                                     <li class="nav-item">
                                         <select wire:model="numbPage2" class="form-select form-control rounded me-3"
                                             aria-label="Default select example">
                                             <option value="10" selected>Page</option>
                                             <option value="15">15</option>
                                             <option value="50">50</option>
                                             <option value="100">100</option>
                                         </select>
                                     </li>
                                 </ul>
                                 <form class="d-flex input-group w-auto">
                                     <input wire:model="search1" type="search" class="form-control"
                                         placeholder="Type here" aria-label="Search" />
                                     <button class="btn btn-outline-primary" type="button" data-mdb-ripple-color="dark">
                                         Search
                                     </button>
                                 </form>
                             </div>
                         </div>
                     </nav>
                 </div>
                 <div class="card-body">
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
