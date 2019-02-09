<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;


class UserController extends Controller
{

    public function index() {
        $data = User::all();
        return $this->response($data);
    }

    public function show($id)
    {
        $data = User::find($id);
        return $this->response($data);
    }

    public function validarUserBD() {
        $users = User::all();
        $emails = [];
        
        foreach($users as $user) {
            array_push($emails, $user->email);
        }

        return $emails;
    }
}
