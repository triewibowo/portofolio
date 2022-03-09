<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        try{
            DB::table('users')->insert([
                'name'      => 'Admin',
                'role'      => 'admin',
                'email'     => 'admin@admin.com',
                'password'  => bcrypt('12345678')
            ]);
            DB::commit();
        }catch (\Throwable $th){
            DB::rollback();
            return session()->flash('error', $th);
        }
    }
}
