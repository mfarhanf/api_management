<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Arr;
use App\Models\ApiResult;
use App\Models\Table;
use App\Services\QueryGeneratorService;
use Illuminate\Support\Facades\Gate;
use DB;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ApiResult::select(['id', 'api_name', 'table_name', 'created_by']);

        if (Gate::allows('isUser')) {
            $userId = Auth::id();
            $data->where('created_by', $userId);
        }

        $data = $data->get();

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
        $tables = $this->getTableOptions();
        $columns = $this->getColumnOptions($tables);

        $data = [
            'tables' => $tables,
            'columns' => $columns,
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
        $request->validate([
            'api_name' => 'required',
            'table_name' => 'required',
        ]);

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
        return redirect('api')->with(['success' => 'Data successfully saved']);
    }

    private function getTableOptions()
    {
        $tables = Gate::allows('isAdmin') ? Table::get() : Auth::user()->tables;
        $tables = Arr::pluck($tables, 'name');

        return transform_array($tables);
    }

    private function getColumnOptions($tables)
    {
        $columnOptions = [];

        foreach ($tables as $key => $value) {
            $columns = DB::connection('mysql2')
                ->getSchemaBuilder()
                ->getColumnListing($key);
            $columnOptions[$key] = transform_array($columns);
        }

        return $columnOptions;
    }
}
