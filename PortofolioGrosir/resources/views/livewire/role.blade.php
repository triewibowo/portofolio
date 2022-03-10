<div>
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
    <div class="container">
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
                                <td>{{ $user->role }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <i wire:click="roleEdit({{ $user->id }})" class='bx bxs-edit'
                                        data-bs-toggle="modal" data-bs-target="#staticBackdrop"
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
    <div wire:ignore.self class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
                    <button wire:click="resetFilter()" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="container justify-content-center">
                    <form enctype="multipart/form-data">
                        <div class="form-group mb-3 p-1">
                            <input wire:model='categoryId' type="hidden" class="form-control">
                            <label>User Name</label>
                            <input wire:model='name' type="text" class="form-control" name="name"
                                value="{{ old('name') }}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3 p-1">
                            <label>Role</label>
                            <select wire:model='role' class="form-select" aria-label="Default select example">
                                <option selected value="0">Your Role</option>
                                <option value="admin" {{ Auth::user()->role == 'admin' ? 'selected' : '' }}>Admin
                                </option>
                                <option value="user">User</option>
                            </select>
                            @error('role')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3 p-1">
                            <label>Email</label>
                            <input wire:model='email' type="email" class="form-control" name="name"
                                value="{{ old('email') }}">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button wire:click="resetFilter()" type="button" class="btn"
                        data-bs-dismiss="modal">Close</button>
                    <button wire:click.prevent="store()" type="button" class="btn"
                        style="background-color: #20B2AA; color:aliceblue">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
