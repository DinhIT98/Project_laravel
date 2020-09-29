<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
// use Illuminate\Database\Eloquent\Model\users;
use Illuminate\Http\Request;
use App\Models\dt_products;
use App\Models\users;
use Illuminate\Support\Facades\Hash;
use Auth;



class LoginController extends Controller
{
    public function index(){
        return view('login');
    }
    public function handleLogin(request $request){
       $data =[$request->email,$request->pass];
       $checkEmail=users::where('email',$request->email)->get();
       $pass=$checkEmail[0]['password'];


    //    echo $checkEmail[0]['password'];


       if($request){
           if(isset($checkEmail[0]['email'])){
            if(Hash::check($request->pass, $pass)){
                return redirect()->to('/home');
            }else{
               echo "<script>alert('password khong dung!')</script>";
               return redirect()->back();
           }

           }else{
               return redirect()->back();
           }
       }else{
           return redirect()->back();
       }

    }
    public function authLogin(request $request){


            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                $user=users::where('email',$request->email)->get();
                return redirect()->to('/home');
            }else{
                echo "<script>alert('dang nhap that bai! ')</script>";
                return redirect()->to('/login');
            }
    }
    public function logout(){
        Auth::logout();
        return redirect()->back();
    }

}
