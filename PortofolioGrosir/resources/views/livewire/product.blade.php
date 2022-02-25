<div>
    <div class="mb-4">
        <h3 class="text-muted">Product Data</h3>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="card-header">
                    <h5 class="text-muted">Product List</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col">
                            <div class="input-group mt-3 mb-2">
                                <button wire:click="create()" type="button" class="btn"
                                    style="background-color: #20B2AA; color:aliceblue;">
                                    Create Product
                                </button>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group mt-3 mb-2">
                                <select wire:model="search" class="form-select form-control rounded"
                                    aria-label="Default select example">
                                    <option value="" selected>Category</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mt-3 mb-2">
                                <input wire:model="search" id="search-input" type="search" class="form-control rounded"
                                    placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                                <button type="button" class="btn"
                                    style="background-color: #20B2AA; color:aliceblue;">search</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-hovered table-striped" id="example2">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Qty</th>
                                <th>Price</th>
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
                                            style="font-size: 20px; color: salmon; cursor: pointer;"></i>

                                        <i wire:click="edit({{ $product->id }})" class='bx bxs-edit'
                                            data-mdb-toggle="modal" data-mdb-target="#staticBackdrop"
                                            style="font-size: 20px; color: #20B2AA; cursor: pointer;"></i>

                                        <i wire:click="delete({{ $product->id }})" class='bx bxs-trash'
                                            style="font-size: 20px;cursor: pointer; color:sienna;"></i>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center pt-1">
                {{ $products->links() }}
            </div>
        </div>

        <!-- Modal Edit-->
        <div wire:ignore.self class="modal fade" id="staticBackdrop" data-mdb-backdrop="static"
            data-mdb-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header mb-3">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                        <button wire:click="resetFilters()" type="button" class="btn-close"
                            data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="container justify-content-center">
                        <form enctype="multipart/form-data">
                            <div class="form-group mb-3 p-1">
                                <input wire:model='productId' type="hidden" class="form-control">
                                <label>Product Name</label>
                                <input wire:model='name' type="text" class="form-control">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3 p-1">
                                <label>Product Category</label>
                                <select wire:model='category_id' class="form-select"
                                    aria-label="Default select example">
                                    <option selected>Open this select menu</option>
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
                                <textarea wire:model='desc' class="form-control"></textarea>
                                @error('desc')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3 p-1">
                                <label>Product Quantity</label>
                                <input wire:model='qty' type="number" class="form-control">
                                @error('qty')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3 p-1">
                                <label>Product Price</label>
                                <input wire:model='price' type="number" class="form-control">
                                @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button wire:click="resetFilters()" type="button" class="btn"
                            data-mdb-dismiss="modal">Close</button>
                        <button wire:click.prevent="update()" type="button" class="btn"
                            style="background-color: #20B2AA; color:aliceblue">Save</button>
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
                        <button wire:click="resetFilters()" type="button" class="btn-close"
                            data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="container justify-content-center">
                        <form enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <div class="custom-file">
                                    <input wire:model="image" type="file"
                                        value="{{ asset('storage/app/public/livewire-tmp/' . $image) }}"
                                        class="custom-file-upload" id="image" onchange="previewImage()">
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
                                                        <label for="image" type="button" class="btn">
                                                            <strong>Upload</strong>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                @if ($image)
                                                    <img wire:ignore
                                                        src="{{ asset('storage/public/images/' . $image) }}"
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
                        <button wire:click.prevent="updateImage()" type="button" class="btn"
                            style="background-color: #20B2AA; color:aliceblue">Save</button>
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

            window.livewire.on('close', () => {
                $('#staticBackdrop').modal('hide');
            });
        </script>
    @endpush
