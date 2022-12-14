<?php

namespace Database\Seeders;

use DB;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RoleSeeder extends Seeder {
 
    public function run()
    {
        DB::table('roles')->delete();

        $now = Carbon::now()->toDateTimeString();
        Role::insert([
            [
                'role' => 'admin',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'role' => 'user',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
