<?php

namespace App\Http\Livewire;
use Spatie\Permission\Models\Role as ModelRole;
use Spatie\Permission\Models\Permission;
use App\Models\User;

use Livewire\Component;

class Role extends Component
{
    public $name,$email;
    public $userId;

    public function api(){
        $users = User::with('roles')->get();
        return $users;
    }

    public function render()
    {   
        if(Auth()->user()->can('CRUD')){
        $users = User::all();
        return view('livewire.role', compact('users'));
        }else{
            return abort('403');
        }
        
    }

    public function roleCreate(){
        $user = User::where('id', $this->userId)->first();
        $user->assignRole('admin');
        $this->reset();
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
    }
}
