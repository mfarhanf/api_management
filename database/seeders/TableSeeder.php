<?php

namespace Database\Seeders;

use DB;
use App\Models\Table;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('tables')->delete();

        $now = Carbon::now()->toDateTimeString();
        Table::insert([
            [
                'name' => 'customers',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'employees',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'offices',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'orderdetails',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'orders',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'payments',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'productlines',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'products',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
