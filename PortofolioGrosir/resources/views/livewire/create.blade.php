<div>
    <div class="mb-4">
        <div class="row">
            <div class="col">
                <h3 id="icon2">Create Product</h3>
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
                    <h5 class="text-muted">Product Data</h5>
                </div>
                <div class="card-body">
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
                        <div class="form-group mb-3">
                            <div class="custom-file">
                                <input wire:model="image" type="file" class="custom-file-upload" id="image">
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
                                        <div class=" card-body">
                                            @if ($image)
                                                <img src="{{ $image->temporaryUrl() }}" class="img-fluid"
                                                    alt="Preview Image">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                            <textarea wire:model='desc' class="form-control" name="desc"
                                value="{{ old('desc') }}"></textarea>
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
                        data-bs-dismiss="modal">Close</button>
                    <button wire:click.prevent="store()" type="button" class="btn btn-success"
                        color:aliceblue">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
