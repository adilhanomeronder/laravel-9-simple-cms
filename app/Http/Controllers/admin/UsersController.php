<?php

namespace App\Http\Controllers\admin;

use App\Helper\customHelper;
use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Users::all();
        return view("admin.users.index", ["datas" => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.users.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        try {
            $request->validate([
                "name_surname" => "required",
                "username" => "required|unique:users",
                "password" => "required|same:password_repeat",
                "password_repeat" => "required"
            ]);

            $data = [
                "user_name_surname" => $request->name_surname,
                "username" => $request->username,
                "user_password" => Hash::make($request->password),
                "user_permission" => 9,
                "user_status" => 1
            ];

            if ($request->file) {
                $fileNewName = Str::random(10) . "." . $request->file->getClientOriginalExtension();
                $data["image"] = $fileNewName;
                $request->file->move(public_path("assets/images/users/"), $fileNewName);
            }

            Users::create($data);

            return customHelper::alert("Başarılı", "Üye başarıyla eklendi.", "success", true);

        } catch (\Exception $e) {
            return customHelper::alert("Hata", "Bir sorun oluştu: " . $e->getMessage(), "error");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Users::where("user_id", $id)->first();
    }


    public function show_by_username($id)
    {
        return Users::where("username", $id)->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->show($id);
        if($data){
            return view("admin.users.edit", ["data" => $data]);
        }else{
            return redirect()->route("admin.404");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $get = $this->show("user_id", $id);

            $request->validate([
                "name_surname" => "required",
                "username" => "required"
            ]);

            $posts = [
                "user_name_surname" => $request->name_surname,
                "username" => $request->username
            ];

            if ($request->username != $get->username) {
                $isset_user = $this->show_by_username($request->username);
                if ($isset_user) {
                    throw new \Exception("Bu kullanıcı adı sistemde mevcut");
                }
            }

            if ($request->password || $request->password_repeat) {
                if ($request->password != $request->password_repeat) {
                    throw new \Exception("Üye şifreleri uyuşmuyor!");
                } else {
                    $posts["user_password"] = Hash::make($request->password);
                }
            }

            if ($request->file) {
                $path = public_path("assets/images/users/" . $get->image);
                if (file_exists($path) && !empty($get->image)) {
                    unlink($path);
                }
                $fileNewName = Str::random(10) . "." . $request->file->getClientOriginalExtension();
                $posts["image"] = $fileNewName;
                $request->file->move(public_path("assets/images/users/"), $fileNewName);
            }

            Users::where("user_id", $id)
                ->update($posts);

            return customHelper::alert("Başarılı", "Üye başarıyla güncellendi.", "success", true);

        } catch (\Exception $e) {
            return customHelper::alert("Hata", "Bir sorun oluştu: " . $e->getMessage(), "error");
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $get = $this->show($id);

            if($get->image){
                $path = public_path("assets/images/users/".$get->image);
                if(file_exists($path) && !empty($get->image)){
                    unlink($path);
                }
            }

            Users::where("user_id", $id)->delete();

            return customHelper::alert("Başarılı", "Üye başarıyla silindi.", "success", true);

        }catch(\Exception $e){
            return customHelper::alert("Hata", "Bir sorun oluştu: " . $e->getMessage(), "error");
        }

    }


    public function deletePicture(Request $request)
    {
        try {
            $get = $this->show($request->id);
            if($get->image){
                $path = public_path("assets/images/users/".$get->image);
                if(file_exists($path)){
                    unlink($path);
                }
                Users::where("user_id", $request->id)
                    ->update(["image" => NULL]);
            }

            return customHelper::alert("Başarılı", "Üye resmi başarıyla silindi.", "success", true);

        }catch (\Exception $e){
            return customHelper::alert("Hata", "Bir sorun oluştu: ".$e->getMessage(), "error");
        }
    }

    public function status(Request $request){
        try {
            $user_status = 0;
            $get = $this->show($request->id);
            if(!$get->user_status){
                $user_status = 1;
            }

            Users::where("user_id", $request->id)
                ->update(["user_status" => $user_status]);

            return customHelper::alert("Başarılı", "Durum güncellendi.", "success", true);

        }catch (\Exception $e){
            return customHelper::alert("Hata", "Bir sorun oluştu: ".$e->getMessage(), "error");
        }
    }

    public function logout(){
        session()->flush();
        return redirect("/admin");
    }
}
