<?php

namespace App\Http\Controllers;

use App\Password;
use Illuminate\Http\Request;
use App\Http\Requests\StoresPassword;
use App\Http\Requests\UpdatesPassword;

class PasswordController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $passwords = Password::where('user_id', auth()->id())->latest()->paginate(10);

        return view('passwords.index')->with('passwords', $passwords);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('passwords.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoresPassword $request)
    {
        $password = $request->store();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Password  $password
     * @return \Illuminate\Http\Response
     */
    public function edit(Password $password)
    {
        $this->authorize('update', $password);
        return view('passwords.edit')->with('password', $password);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Password  $password
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatesPassword $request, Password $password)
    {
        $this->authorize('update', $password);
        $request->update($password);

        return redirect()->route('passwords.index')
            ->with('flash', 'Password Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Password  $password
     * @return \Illuminate\Http\Response
     */
    public function destroy(Password $password)
    {
        //
    }
}
