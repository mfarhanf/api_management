<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use App\Models\ApiResult;
use App\Models\User;
use App\Services\QueryGeneratorService;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $userId = Auth::id();
        $data = User::select(['id', 'name', 'email'])
            ->get()
            ->toArray();

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

        //return back()->with('success_message','Berhasil menambah user baru');
        return redirect('users')->with('success_message', 'Berhasil menambah user baru');

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
         $user = User::find($id);
            if (!$user) return redirect()->route('users.index')
                ->with('error_message', 'User dengan id'.$id.' tidak ditemukan');
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
        'email' => 'required|email,email',
        'password' => 'required|confirmed'
        ]);
        $array = $request->only([
            'name', 'email', 'password'
        ]);
        $array['password'] = Hash::make($array['password']);
        //$user = User::create($array);

        $user->save();
            return redirect('users')->with('success_message', 'Berhasil mengubah user');

        $user = User::find($id);
        // Getting values from the blade template form
        $user->name =  $request->get('name');
        $user->email = $request->get('email');
        $user->password =  $array['password'] ;
        $stock->save();
 
        return redirect('/users')->with('success', 'Berhasil mengubah user!'); // -> resources/views/stocks/index.blade.php

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
