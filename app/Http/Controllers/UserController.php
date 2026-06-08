<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    //
    function users(){
        return DB::select("select * from users");
    }
    function login(Request $request){
        $validated=$request->validate([
            "email"=>"required|email|max:100",
            "password"=>"required|string|max:30|min:8"
        ]);

        $users=User::where("email", $validated['email'])
                    ->first();
        // if(count($users)>0){
        //     if(password_verify($validated['password'], $users[0]->password)){
        //         $token=random_int(1000, 10000);
        //         DB::update("update users set remember_token=?, email_verified_at=? where email=? and password=?", 
        //         [$token, now(), $validated['email'], $users[0]->password]);
        //         return "token=$token";
        //     }else return $validated['password'];
        // }
        if($users){
            if(password_verify($validated['password'], $users->password)) return "Login successful";
        }
        throw ValidationException::withMessages([
            'error'=>"Invalid email or password"
        ]);
    }
    function register(Request $request){
        $validated=$request->validate([
            "fname"=>"required|string|max:20|min:2",
            "mname"=>"max:50",
            "lname"=>"required|string|max:20",
            "dob"=>"required|date",
            "phone"=>"required|size:10",
            "address"=>"required|string|max:255|min:3",
            "gender"=>"required|string|max:10",
            "email"=>"required|email|max:100|min:10",
            "password"=>"required|string|min:8|regex:/^[a-zA-Z0-9_ !@#\$%\^\&\*.,\?]+$/",
            "confirm"=>"required|string|min:8|regex:/^[a-zA-Z0-9_ !@#\$%\^\&\*.,\?]+$/"
        ],[
            "*.required"=>"This field is required",
            "*.max"=>"The maximum length is exceed",
            "*.min"=>"The minimum length is not reached",
            "*.regex"=>"Only alphanumeric characters and `!@#$%^&*_.,? allowed"
        ]);
        $full_name="";
        try{
            if(isset($validated['mname']) && trim($validated['mname'])!="") $full_name="{$validated['fname']} {$validated['mname']} {$validated['lname']}";
            else $full_name="{$validated['fname']} {$validated['lname']}";
            // DB::table('users')->insert([
            //     "id"=>uuid_create(),
            //     "Full Name"=>$full_name,
            //     "Date of Birth"=>$validated['dob'],
            //     "gender"=>$validated['gender'],
            //     "Mobile No"=>$validated['phone'],
            //     "Address"=>$validated['address'],
            //     "Email"=>$validated['email'],
            //     "Password"=>$validated['password']
            // ]);
            User::create([
                "Full Name"=>$full_name,
                "Date of Birth"=>$validated['dob'],
                "Gender"=>$validated['gender'],
                "Mobile No"=>$validated['phone'],
                "Address"=>$validated['address'],
                "Email"=>$validated['email'],
                "password"=>bcrypt($validated['password'])
            ]);
            return "Registration successful";
        }catch(Exception $e){
            if(strpos($e->getMessage(), "Duplicate entry")){
                throw ValidationException::withMessages([
                    'error'=>"Duplicate email address"
                ]);
            }else{
                throw ValidationException::withMessages([
                    'error'=>"An error occured while registration"
                ]);
            }
        }
    }
}
