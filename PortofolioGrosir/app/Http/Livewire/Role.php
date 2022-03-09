<?php

namespace App\Http\Livewire;
use Spatie\Permission\Models\Role as ModelRole;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use App\Models\Product as ModelsProduct;
use App\Models\User;

use DB;

use Livewire\Component;

class Role extends Component
{
    public $name,$email;
    public $userId;
    public $search = '';
    public $role;

    

    // public function permission(){
    //     $role = ModelRole::create(['name' => 'admin']);
    //     $permission = Permission::create(['name' => 'CRUD']);

    //     $role->givePermissionTo($permission);
    //     $permission->assignRole($role);

    //     $user = auth()->user();
    //     $user->assignRole('admin');
    //     return $user;
    // }

    public function api(){
        $products = ModelsProduct::with(['category'])->where('name', 'like', '%'.$this->search.'%')->orWhereHas('category',function($query){$query->where('name', 'like', '%'.$this->search.'%');})->OrderBy('products.created_at', 'DESC')->paginate(15);
        $users = User::with('roles')->get();
        $auth  = Auth::user();
        return $products;
    }

    public function render()
    {   
        if(Auth()->user()->can('isAdmin')){
        $users = User::get();
        return view('livewire.role', compact('users'));
        }else{
            return abort('403');
        } 
    }

    public function resetFilter(){
        $this->name = '';
    }



    public function store(){
        DB::beginTransaction();
        try{
            User::updateOrCreate(['id' => $this->userId],[
                'name'          => $this->name,
                'role'          => $this->role,
                'email'          => $this->email
            ]);
            $this->reset();
            DB::commit();
            return session()->flash('success', 'Successfully'); 
        }catch (\Throwable $th){
            DB::rollback();
            return session()->flash('error', $th);
         }
    }

    public function roleEdit($id){
        $user = User::findOrFail($id);
        $this->userId = $id;
        $this->name = $user->name;
        $this->role = $user->role;
        $this->email = $user->email;
    }

    public function roleRemove($id){
        $user = User::findOrFail($id)->delete();
    }
}
