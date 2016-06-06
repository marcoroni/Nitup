<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function loginRequest(Request $request) {
        $userData = $request->all();;

        $check = $this->validatorLogin($userData);
        if ($check->fails()) {
            return redirect('/login')
                ->withErrors("de gebruikersnaam, email of wachtwoord is incorrect / komen niet overeen.")
                ->withInput();
        } else {
            if (\Auth::attempt([
                'email'    => $request->get('email'),
                'password' => $request->get('password')
            ])
            ) {
                return redirect('/');
            } else {
                return redirect('/login')
                    ->withErrors("de gebruikersnaam, email of wachtwoord is incorrect / komen niet overeen.")
                    ->withInput();
            }
        }
    }

    public function registerRequest(Request $request)
    {
        $userData = $request->all();
        $validator = $this->validatorRegister($userData);
        if ($validator->fails()) {
            return redirect('/register')->withErrors($validator)->withInput();
        }
        \Auth::login($this->createAcc($userData));
        return redirect('/');

    }

    public function logoutRequest() {
        \Auth::logout();
        return \Redirect::to('/login');
    }

    public function validatorRegister(array $data)
    {
        return \Validator::make($data, [
            'email'    => 'required|email|max:32|unique:users',
            'password' => 'required|min:6:max:32',
        ]);
    }

    public function validatorLogin(array $data)
    {
        return \Validator::make($data, [
            'email'    => 'required|email|max:32',
            'password' => 'required|min:6:max:32',
        ]);
    }


    protected function createAcc(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'sex' => $data['sex'],
            'tel' => $data['tel'],
            'city' => $data['city'],
            'street' => $data['street'],
            'house_number' => $data['house_number'],
            //'remember_token' => $data['_token'],
        ]);
    }
}
