<div>
    <div class="row">
        <div class="col-md-8">
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="font-weight-bold mb-3">Create Category</h2>
                    <form wire:submit.prevent="store">
                        <div class="form-group">
                            <label>Product Name</label>
                            <input wire:model='name' type="text" class="form-control">
                            @error('name')
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
                </div>
            </div>
        </div>
    </div>
</div>
