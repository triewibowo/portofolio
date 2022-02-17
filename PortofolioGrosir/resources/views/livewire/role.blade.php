<div>
    <div class="container">
        <div>
            <div class="card">
                <div class="card-body">
                    <h2 class="font-weight-bold mb-3">Grant Permission</h2>
                    <form wire:submit.prevent="roleCreate">
                        <div class="form-group">
                            <label>Role Name</label>
                            <input wire:model='name' type="text" class="form-control">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button class="btn btn-primary mt-3" type="submit">Grant</button>
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
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <button wire:click="roleEdit({{ $user->id }})"
                                            class="btn btn-danger">Edit</button>
                                        <button wire:click="roleRemove({{ $user->id }})"
                                            class="btn btn-danger">Remove</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
