<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\User;
use App\Models\UserTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::get();

        foreach ($data as &$user) {
            $user->table_list = implode(', ', Arr::pluck($user->tables, 'name'));
        }

        return view('users.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('users.create');
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);

        $array = $request->only([
            'name', 'email', 'password'
        ]);

        $array['password'] = Hash::make($array['password']);
        $user = User::create($array);

        return redirect('users')->with('success_message', 'Data successfully saved');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        if (!$user) return redirect()->route('users.index')
            ->with('error_message', 'User with id ' . $id . ' not found');

        return view('users.edit', [
            'user' => $user
        ]);
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
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required|confirmed'
        ]);

        $array = $request->only([
            'name', 'email', 'password'
        ]);
        $array['password'] = Hash::make($array['password']);

        $user = User::find($id);
        $user->name =  $request->get('name');
        $user->email = $request->get('email');
        $user->password = $array['password'] ;
        $user->save();
 
        return redirect('/users')->with('success', 'Data successfully updated');
    }

    public function accessTable($id)
    {
        $user = User::find($id);
        $tables = Table::get();

        $user->table_list = Arr::pluck($user->tables, 'name');

        return view('users.access-table', ['user' => $user, 'tables' => $tables]);
    }

    public function updateAccessTable(Request $request, $id)
    {
        $request->validate([
            'tables' => 'required'
        ]);

        $data = [];
        $params = $request->all();
        $now = Carbon::now()->toDateTimeString();

        foreach ($params['tables'] as $tableId) {
            $data[] = [
                'user_id' => $id,
                'table_id' => $tableId,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        UserTable::where('user_id', $id)->delete();
        UserTable::insert($data);

        return redirect('/users')->with('success', 'Data successfully updated');
    }
}
