<?php

namespace App\Http\Controllers\admin;

use App\Helper\customHelper;
use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function index(){
        if(!session()->has("login_user")):
            return view("admin.login");
        else:
            return view("admin.homepage");
        endif;
    }

    public function check(Request $request){
        try {
            $request->validate([
                "username" => "required",
                "password" => "required"
            ]);


            $data = Users::where("username", $request->username)
                ->first();

            if($data){

                if(!Hash::check($request->password, $data->user_password)){
                    return customHelper::alert("Hata", "Lütfen bilgilerinizi kontrol ediniz!","error");
                }

                session(["login_user" => $this->getUser($data["user_id"])]);
                return customHelper::alert("", "", "success", true);

            }else{
                return customHelper::alert("Hata", "Lütfen bilgilerinizi kontrol ediniz!","error");
            }
        }catch (\Exception $e){
            return customHelper::alert("Hata", "Bir sorun oluştu: " . $e->getMessage(), "error");
        }

    }

    public function getUser($user_id){
        return Users::where("user_id", $user_id)
            ->where("user_status", 1)
            ->where("user_permission", 9)
            ->first();
    }
}
