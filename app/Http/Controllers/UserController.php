<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class UserController extends Controller
{

    public function logout() {
        auth()->logout();
        return redirect('/');
    }

    public function login(Request $request) {
        $loginField = $request->validate([
            'loginemail' => 'required',
            'loginpassword'=> 'required'
        ]);

        if (auth()->attempt(['email' => $loginField['loginemail'], 'password' => $loginField['loginpassword']])) {
           $request->session()->regenerate();
        }
        return redirect('/');
    }

    public function register(Request $request) {
        $incomingFields = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:20', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'name')],
            'password' => 'required|min:8|max:200'
        ]);
        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        auth()->login($user);
        return redirect('/');

    }
}
