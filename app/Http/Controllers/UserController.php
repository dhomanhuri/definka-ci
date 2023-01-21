<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session()->get('role') == "Admin") {
            $user = User::all();
            return view('users.index')->with('users', $user);
        } else {
            return redirect('/beranda');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (session()->get('role') == "Admin") {
            return view('users.create');
        } else {
            return redirect('/akun');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(
            [
                'name' => 'required',
                'username' => 'required|unique:users,username',
                'password' => 'required',
                'role' => 'required'
            ]);
        $input = $request->all();
        User::create($input);
        return redirect('/akun')->withErrors('flash_message', 'User telah ditambahkan.'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (session()->get('role') == "Admin") {
            $user = User::find($id);
            return view('users.show')->with('users', $user);
        } else {
            return redirect('/akun');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (session()->get('role') == "Admin") {
            $user = User::find($id);
            return view('users.edit')->with('users', $user);
        } else {
            return redirect('/akun');
        }
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
        $user = User::find($id);
        $input = $request->all();
        $user->update($input);
        return redirect('/akun')->withErrors('flash_message', 'Akun berhasil diperbaharui.'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('/akun')->withErrors('flash_message', 'Akun berhasil dihapus.'); 
    }
}
