<?php

namespace App\Http\Controllers;

use DB;
use App\Models\ApiResult;

class ApiGeneratorController extends Controller
{
    public function show($model, $id)
    {
        $api = ApiResult::find($id);
        $data = DB::connection('mysql2')->select($api->query);

        return $data;
    }
}
