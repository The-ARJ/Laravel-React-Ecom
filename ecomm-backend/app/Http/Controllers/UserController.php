<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    //
    function register(Request $req){
        $user = new User;
        $user->name=$req->input('name');
        $user->email=$req->input('email');
        $user->password=Hash::make($req->input('password'));
        $user->save();
        return $user;
}
function login(Request $req)
{
    $user = User::where('name',$req->name)->first(); #I have used name instead of email doue to some conflict
    if(!$user || !Hash::check($req->password,$user->password)){
        return response([
            'error'=>["Email or Password do not match"]
        ]);
    }
    return $user;
}

}