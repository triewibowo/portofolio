<div>
    <div class="mb-4">
        <div class="mb-4">
            <div class="row">
                <div class="col">
                    <h3 id="icon2">Category Data</h3>
                </div>
                <div class="col-3">
                    @if (session()->has('success'))
                        <div class="alert alert-success d-flex align-items-center" role="alert">
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
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="card-header">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container-fluid">
                            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                                data-mdb-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                                <a class="navbar-brand" href="#">Category List</a>
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <button class="btn btn-outline-success" type="button"
                                            data-mdb-ripple-color="dark" data-mdb-toggle="modal"
                                            data-mdb-target="#staticBackdrop">
                                            Create
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"></a>
                                    </li>
                                    <li class="nav-item">
                                        <select wire:model="numbPage" class="form-select form-control rounded me-3"
                                            aria-label="Default select example">
                                            <option value="5" selected>Page</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </li>
                                </ul>
                                <form class="d-flex input-group w-auto">
                                    <input wire:model="search" type="search" class="form-control"
                                        placeholder="Type query" aria-label="Search" />
                                    <button class="btn btn-outline-primary" type="button" data-mdb-ripple-color="dark">
                                        Search
                                    </button>
                                </form>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="card-body">
                    <table class="table table-hovered table-striped" id="example2">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Name</th>
                                <th width="90px"> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $index => $category)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <i wire:click="edit({{ $category->id }})" class='bx bxs-edit'
                                            data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                            style="font-size: 20px; color: #20B2AA; cursor: pointer;"></i>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center pt-1">
                {{ $categories->links() }}
            </div>
        </div>

        {{-- modal --}}
        <div wire:ignore.self class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
                        <button wire:click="resetFilter()" type="button" class="btn-close" data-mdb-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="container justify-content-center">
                        <form enctype="multipart/form-data">
                            <div class="form-group">
                                <input wire:model='categoryId' type="hidden" class="form-control">
                                <label>Category Name</label>
                                <input wire:model='name' type="text" class="form-control" name="name"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button wire:click="resetFilter()" type="button" class="btn"
                            data-mdb-dismiss="modal">Close</button>
                        <button wire:click.prevent="store()" type="button" class="btn"
                            style="background-color: #20B2AA; color:aliceblue">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
