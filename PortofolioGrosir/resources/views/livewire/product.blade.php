<div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h2 class="font-weight-bold mb-3">Product List</h2>
                <table class="table table-bordered table-hovered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th> </th>
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
                                <td>{{ $product->price }}</td>
                                <td>
                                    <div>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#modal">
                                            Launch static backdrop modal
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h2 class="font-weight-bold mb-3">Create Product</h2>
                <form wire:submit.prevent="store">
                    <div class="form-group">
                        <label>Product Name</label>
                        <input wire:model='name' type="text" class="form-control">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Product Image</label>
                        <div class="custom-file">
                            <div class="d-block"><input wire:model="image" type="file" class="form-control"
                                    id="customFile"></div>
                            @error('image') <small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        @if ($image)
                            <label class="mt-2">Image Preview</label>
                            <img src="{{ $image->temporaryUrl() }}" class="img-fluid" alt="Preview Image">
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Product Category</label>
                        <select wire:model='category_id' class="form-select" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Product Description</label>
                        <textarea wire:model='desc' class="form-control"></textarea>
                        @error('desc')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Product Quantity</label>
                        <input wire:model='qty' type="number" class="form-control">
                        @error('qty')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Product Price</label>
                        <input wire:model='price' type="number" class="form-control">
                        @error('price')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button class="btn btn-primary btn-block mt-3" type="submit">Save Product</button>
                </form>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <h3>{{ $name }}</h3>
                <h3>{{ $image }}</h3>
                <h3>{{ $category_id }}</h3>
                <h3>{{ $desc }}</h3>
                <h3>{{ $qty }}</h3>
                <h3>{{ $price }}</h3>
            </div>
        </div>
    </div>
</div> --}}
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Product Name</label>
                            <input wire:model='name' type="text" class="form-control">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Product Image</label>
                            <div class="custom-file">
                                <div class="d-block"><input wire:model="image" type="file" class="form-control"
                                        id="customFile"></div>
                                @error('image') <small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            @if ($image)
                                <label class="mt-2">Image Preview</label>
                                <img src="{{ $image->temporaryUrl() }}" class="img-fluid" alt="Preview Image">
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Product Category</label>
                            <select wire:model='category_id' class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Product Description</label>
                            <textarea wire:model='desc' class="form-control"></textarea>
                            @error('desc')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Product Quantity</label>
                            <input wire:model='qty' type="number" class="form-control">
                            @error('qty')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Product Price</label>
                            <input wire:model='price' type="number" class="form-control">
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button wire:click.prevent="store()" class="btn btn-primary btn-block mt-3" type="submit">Save
                        Product</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('script-custom')
    <script>
        window.livewire.on('confirm', () => {
            // $('modal').modal('hide');
            alert('bagiot');
        });
    </script>

@endpush
