<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller {
    public function create() {
        return view( 'users.register' );
    }

    public function store( Request $request ) {
        $fields = $request->validate( [
            'name' => [ 'required', 'min:3' ],
            'email' => [ 'required', 'email', Rule::unique( 'users', 'email' ) ],
            'password' => 'required|confirmed|min:6'
        ] );
        $fields[ 'password' ] = bcrypt( $fields[ 'password' ] );

        $user = User::create( $fields );
        auth()->login( $user );
        return redirect( '/' )->with( 'message', 'User created and logged in' );
    }

    public function logout( Request $req ) {
        auth()->logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect( '/' )->with( 'message', 'You have been logged out!' );
    }

    public function login() {
        return view( 'users.login' );
    }

    public function authenticate( Request $req ) {
        $fields = $req->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        if (auth()->attempt($fields)){
            $req->session()->regenerate();
            return redirect('/')->with('message', 'You are now logged in!');
        }
        return back()->withErrors(['email' => 'Invalid credentials!'])->onlyInput('email');
    }
}
