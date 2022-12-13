<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use App\Models\ApiResult;
use App\Services\QueryGeneratorService;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::id();
        $data = ApiResult::select(['id', 'api_name', 'table_name'])
            ->where('created_by', $userId)
            ->get()
            ->toArray();

        if ($data) {
            foreach ($data as $key => $value) {
                // combine base url with table name and id
                $data[$key]['url'] = URL::to('') . '/' . $value['table_name'] . '/' . $value['id'];
            }
        }

        return view('api.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'tables' => [
                'products' => 'Products',
                'orders' => 'Orders',
            ],
            'columns' => [
                'products' => ['id' => 'ID', 'name' => 'Name'],
                'orders' => ['id' => 'ID', 'name' => 'Name'],
            ],
            'operators' => [
                '=' => '=',
                '<' => '<',
                '>' => '>',
                '<=' => '<=',
                '>=' => '>=',
            ],
        ];

        return view('api.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->all();
        $userId = Auth::id();

        $queryGenerator = new QueryGeneratorService;
        $query = $queryGenerator->generateQuery($params);

        $data = [
            'api_name' => $params['api_name'],
            'table_name' => $params['table_name'],
            'query' => $query,
            'created_by' => $userId,

        ];

        ApiResult::create($data);
        return redirect('api');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
