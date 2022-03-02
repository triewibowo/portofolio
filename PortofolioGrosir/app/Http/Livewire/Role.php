<?php

namespace App\Http\Livewire;
use Spatie\Permission\Models\Role as ModelRole;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Livewire\Component;

class Role extends Component
{
    public $name,$email;
    public $userId;

    

    // public function permission(){
    //     $role = ModelRole::create(['name' => 'admin']);
    //     $permission = Permission::create(['name' => 'CRUD']);

    //     $role->givePermissionTo($permission);
    //     $permission->assignRole($role);
    // }

    public function api(){
        $users = User::with('roles')->get();
        $auth  = Auth::user();
        return $users;
    }

    public function render()
    {   
        if(Auth()->user()->can('CRUD')){
        $users = User::with('roles')->get();
        return view('livewire.role', compact('users'));
        }else{
            return abort('403');
        } 
    }

    public function resetField(){
        $this->name = '';
    }

    public function roleCreate(){
        $user = User::where('id', $this->userId)->first();
        $user->assignRole('admin');
        $this->reset();
        return session()->flash('success', 'Successfully'); 
    }

    public function roleEdit($id){
        $user = User::findOrFail($id);
        $this->userId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function roleRemove($id){
        $user = User::findOrFail($id);
        // dd($user);
        $user->removeRole('admin');
        return session()->flash('success', 'Successfully'); 
    }
}
