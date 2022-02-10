<div>
    <div class="container justify-content-center">
        <form enctype="multipart/form-data">
            <div class="form-group">
                <input wire:model='productId' type="hidden" class="form-control">
                <label>Product Name</label>
                <input wire:model='name' type="text" class="form-control">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label>Product Image</label>
                <div class="custom-file">
                    <input wire:model="image" type="file" class="form-control" id="image">
                    @error('image') <small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <label class="mt-2">Image Preview:</label>
                @if ($image)
                    <img src="{{ $image->temporaryUrl() }}" class="img-fluid" alt="Preview Image">
                @endif
            </div>
            <div class="form-group">
                <label>Product Category</label>
                <select wire:model='category_id' class="form-select" aria-label="Default select example">
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
        <button wire:click="resetFilters()" type="button" class="btn btn-secondary"
            data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
    </div>
    </form>
</div>
</div>
