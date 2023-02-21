<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = Users::getAll();
        return view('users.index')
            ->with(['users' => $users]);
    }

    public function add(Request $request) {
        if(!empty($request->input('submit'))) {
            $request->validate([
                'name' => 'required',
                'email' => 'required'
            ]);

            Users::add($request);

            $request->session()->flash('alert-message', 'User added!');
            $request->session()->flash('alert-type', 'success');

            return redirect(route('users'));
        }
        return view('users.manage')
            ->with(['edit' => false]);
    }

    public function edit($id, Request $request) {
        $user = Users::view($id);
        if(!empty($request->input('submit'))) {
            $request->validate([
                'name' => 'required',
                'email' => 'required'
            ]);

            Users::edit($id, $request);

            $request->session()->flash('alert-message', 'User updated!');
            $request->session()->flash('alert-type', 'success');

            return redirect(route('users'));
        }
        return view('users.manage')
            ->with([
                'edit' => true,
                'user' => $user
            ]);
    }

    public static function delete($id, Request $request) {
        Users::remove($id);

        $request->session()->flash('alert-message', 'User deleted!');
        $request->session()->flash('alert-type', 'success');

        return redirect(route('users'));
    }
}
