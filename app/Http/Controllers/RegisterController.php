<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\users;
use Illuminate\Support\Facades\Hash;
class RegisterController extends Controller
{
    public function index(){
        return view('register');
    }
    public function handleRegister(request $request){
        if($request->password==$request->confirmPass){
            $user=new users();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->phone=$request->phone;
            $user->sex=$request->gender;
            $user->address=$request->address;
            $user->password= Hash::make($request->password);
            $user->save();
            // $data=[$request->name,$request->email,$request->phone,$request->gender,$request->address,$request->password];
            return redirect()->to('/login');

        }else{
            echo "<script>alert('mat khau khong trung!')</script>";
            return redirect()->to('/register');
        }


    }
}
