<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    function users(){
        return DB::select("select * from users");
    }
    function login(Request $request){
        $validated=$request->validate([
            "email"=>"required|email|max:100",
            "password"=>"required|string|max:255|min:8"
        ]);

        $users=DB::select("select * from users where email=?", [$validated['email']]);
        if(count($users)>0){
            if(password_verify($validated['password'], $users[0]->password)){
                $token=random_int(1000, 10000);
                DB::update("update users set remember_token=?, email_verified_at=? where email=? and password=?", 
                [$token, now(), $validated['email'], $users[0]->password]);
                return "token=$token";
            }else return $validated['password'];
        }
    }
    function register(Request $request){
        $validated=$request->validate([
            "fname"=>"required|string|max:20",
            "mname"=>"max:50",
            "lname"=>"required|string|max:20",
            "dob"=>"required|date",
            "phone"=>"required|size:10",
            "address"=>"required|string|max:255",
            "gender"=>"required|string|max:10",
            "email"=>"required|email|max:100",
            "password"=>"required|string|min:8",
            "confirm"=>"required|string|min:8"
        ]);
        $full_name="";
        $token=random_int(1000, 10000);
        $hash=password_hash($validated['password'], PASSWORD_BCRYPT);
        try{
            if(isset($validated['mname']) && trim($validated['mname'])!="") $full_name="{$validated['fname']} {$validated['mname']} {$validated['lname']}";
            else $full_name="{$validated['fname']} {$validated['lname']}";
            DB::insert("insert into users(`Full name`, `Date of Birth`, gender, `Mobile No`, Address,Email, Password, email_verified_at, remember_token, created_at, updated_at) values(?,?,?,?,?,?,?,?,?,?,?)",
            [$full_name, $validated['dob'], $validated['gender'], $validated['phone'], $validated['address'], $validated['email'], $hash, now(), $token, now(), now()]);
            return "token: $token";
        }catch(Exception $e){
            return "error: $e";
        }
    }
}
