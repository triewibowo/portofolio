<div>
    <div class="mb-3">
        <div class="card">
            <div class="card-body">
                <h2 class="font-weight-bold mb-3">Create Category</h2>
                <form wire:submit.prevent="store">
                    <div class="form-group">
                        <label>Product Name</label>
                        <input wire:model='categoryId' type="hidden" class="form-control">
                        <input wire:model='name' type="text" class="form-control">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button class="btn btn-primary mt-3" type="submit">Save Product</button>
                    <button wire:click="resetFilter()" class="btn btn-danger mt-3" type="submit">Reset</button>
                </form>
            </div>
        </div>
    </div>
    <div>
        <div class="card">
            <div class="card-body">
                <h2 class="font-weight-bold mb-3">Cagetory List</h2>
                <table class="table table-bordered table-hovered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $index => $category)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td><button wire:click="edit({{ $category->id }})"
                                        class="btn btn-success">Edit</button>
                                    <button wire:click="delete({{ $category->id }})"
                                        class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
