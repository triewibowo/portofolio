<div>
    <div class="mb-4">
        <div class="mb-4">
            <div class="row">
                <div class="col">
                    <h3 class="text-muted">Role Permission</h3>
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
            <div class="card-header">
                <h4>Permision</h4>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="roleCreate">
                    <div class="form-group">
                        <label>Role Name</label>
                        <input wire:model='name' type="text" class="form-control">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button class="btn mt-3" type="submit"
                        style="background-color: #20B2AA; color:aliceblue;">Grant</button>
                    <button wire:click="resetField()" class="btn btn-warning mt-3" type="button">Clear</button>
                </form>
            </div>
        </div>

        <div>
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hovered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th width="90px"> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->roles }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <i wire:click="roleEdit({{ $user->id }})" class='bx bxs-edit'
                                            data-mdb-toggle="modal" data-mdb-target="#staticBackdrop"
                                            style="font-size: 20px; color: #20B2AA; cursor: pointer;"></i>

                                        <i wire:click="roleRemove({{ $user->id }})" class='bx bxs-trash'
                                            style="font-size: 20px;cursor: pointer; color:sienna;"></i>
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
