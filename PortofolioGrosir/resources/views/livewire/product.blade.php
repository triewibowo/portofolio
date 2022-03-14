<div>
    <div class="mb-4">
        <div class="row">
            <div class="col">
                <h3 id="icon2">Product Data</h3>
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
                @if (session()->has('update'))
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                            <use xlink:href="#check-circle-fill" />
                        </svg>
                        <div>
                            {{ session('update') }}
                        </div>
                        <button type="button" class="btn-close" id="close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif
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
                                <a class="navbar-brand" href="#">Product List</a>
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <button wire:click="create()" class="btn btn-outline-success" type="button"
                                            data-mdb-ripple-color="dark">
                                            Create
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"></a>
                                    </li>
                                    <li class="nav-item">
                                        <select wire:model="search" class="form-select form-control rounded me-3"
                                            aria-label="Default select example">
                                            <option value="" selected>Category</option>
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
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
                        <table class="table table-hovered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th width="400px">Description</th>
                                    <th>Qty</th>
                                    <th width="160px">Price</th>
                                    <th width="120px"> </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $index => $product)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->desc }}</td>
                                        <td>{{ $product->qty }}</td>
                                        <td>{{ 'Rp ' . number_format($product->price, 2, ',', '.') }}</td>
                                        <td>
                                            <i wire:click="edit({{ $product->id }})" class='bx bx-show-alt'
                                                data-mdb-toggle="modal" data-mdb-target="#staticBackdrop1"
                                                style="font-size: 22px; color: salmon; cursor: pointer;"></i>

                                            <i wire:click="edit({{ $product->id }})" class='bx bxs-edit'
                                                data-mdb-toggle="modal" data-mdb-target="#staticBackdrop"
                                                style="font-size: 20px; color: #20B2AA; cursor: pointer;"></i>

                                            <i wire:click="deleteId({{ $product->id }})" class='bx bxs-trash'
                                                style="font-size: 20px;cursor: pointer; color:sienna;"
                                                data-mdb-toggle="modal" data-mdb-target="#exampleModal"></i>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center pt-1">
                {{ $products->links() }}
            </div>
        </div>

        <!-- Modal -->
        <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true" data-mdb-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Confirm</h5>
                        <button type="button" class="close" data-mdb-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn close-btn" data-mdb-dismiss="modal">Close</button>
                        <button type="button" wire:click.prevent="delete()" class="btn btn-danger close-modal"
                            data-mdb-dismiss="modal">Yes, Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit-->
    <div wire:ignore.self class="modal fade" id="staticBackdrop" data-mdb-backdrop="static"
        data-mdb-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header mb-3">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                    <button wire:click="resetFilters()" type="button" class="btn-close" data-mdb-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="container justify-content-center">
                    <form enctype="multipart/form-data">
                        <div class="form-group mb-3 p-1">
                            <input wire:model='productId' type="hidden" class="form-control">
                            <label>Product Name</label>
                            <input wire:model='name' type="text" class="form-control" name="name"
                                value="{{ old('name') }}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3 p-1">
                            <label>Product Category</label>
                            <select wire:model='category_id' class="form-select" aria-label="Default select example">
                                <option selected value="0">Open this select menu</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3 p-1">
                            <label>Product Description</label>
                            <textarea wire:model='desc' class="form-control" name="desc" value="{{ old('desc') }}"></textarea>
                            @error('desc')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3 p-1">
                            <label>Product Quantity</label>
                            <input wire:model='qty' type="number" class="form-control" name="qty"
                                value="{{ old('qty') }}">
                            @error('qty')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3 p-1">
                            <label>Product Price</label>
                            <input wire:model='price' type="number" class="form-control" name="price"
                                value="{{ old('price') }}">
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button wire:click="resetFilters()" type="button" class="btn"
                        data-mdb-dismiss="modal">Close</button>
                    <button wire:click.prevent="update()" type="button" class="btn btn-success">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Image-->
    <div wire:ignore.self class="modal fade" id="staticBackdrop1" data-mdb-backdrop="static"
        data-mdb-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header mb-3">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Image</h5>
                    <button wire:click="resetFilters()" type="button" class="btn-close" data-mdb-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="container justify-content-center">
                    <form enctype="multipart/form-data">
                        <div class="form-group mb-3">
                            <div class="custom-file">
                                <input wire:model="image" type="file" class="custom-file-upload" id="image"
                                    onchange="previewImage()">
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="mb-2 mt-2">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col">
                                                    Preview Image
                                                </div>
                                                <div class="col d-flex justify-content-end">
                                                    <label for="image" type="button" class="btn"
                                                        style="background-color: #E8FFC2; color:#0E185F;">
                                                        <strong>Upload</strong>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @if ($image)
                                                <img wire:ignore src="{{ asset('storage/public/images/' . $image) }}"
                                                    class="img-preview img-fluid" alt="Preview Image">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button wire:click="resetFilters()" type="button" class="btn"
                        data-mdb-dismiss="modal">Close</button>
                    <button wire:click.prevent="updateImage()" type="button" class="btn btn-success">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script-custom')
    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endpush
