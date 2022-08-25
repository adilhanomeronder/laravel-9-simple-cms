<?php

namespace App\Http\Controllers\admin;

use App\Helper\customHelper;
use App\Http\Controllers\Controller;
use App\Models\Comments;
use App\Models\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Comments::all();
        return view("admin.comments.index", ["datas" => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.comments.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $request->validate([
                "commenter" => "required",
                "comment" => "required"
            ]);

            $data = [
                "commenter" => $request->commenter,
                "comment" => $request->comment,
                "title" => $request->title
            ];

            if ($request->file) {
                $fileNewName = Str::random(10) . "." . $request->file->getClientOriginalExtension();
                $data["image"] = $fileNewName;
                $request->file->move(public_path("assets/images/comments/"), $fileNewName);
            }

            Comments::create($data);

            return customHelper::alert("Başarılı", "Yorum başarıyla eklendi.", "success", true);


        }catch (\Exception $e){
            return customHelper::alert("Hata", "Bir sorun oluştu: " . $e->getMessage(), "error");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Comments::where("id", $id)->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->show($id);
        if($data){
            return view("admin.comments.edit", ["data" => $data]);
        }else{
            return redirect()->route("admin.404");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $get = $this->show($id);

            $request->validate([
                "commenter" => "required",
                "comment" => "required"
            ]);

            $posts = [
                "commenter" => $request->commenter,
                "comment" => $request->comment,
                "title" => $request->title
            ];

            if ($request->file) {
                $path = public_path("assets/images/comments/" . $get->image);
                if (file_exists($path) && !empty($get->image)) {
                    unlink($path);
                }
                $fileNewName = Str::random(10) . "." . $request->file->getClientOriginalExtension();
                $posts["image"] = $fileNewName;
                $request->file->move(public_path("assets/images/comments/"), $fileNewName);
            }

            Comments::where("id", $id)
                ->update($posts);

            return customHelper::alert("Başarılı", "Yorum başarıyla güncellendi.", "success", true);

        } catch (\Exception $e) {
            return customHelper::alert("Hata", "Bir sorun oluştu: " . $e->getMessage(), "error");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $get = $this->show($id);

            if($get->image){
                $path = public_path("assets/images/comments/".$get->image);
                if(file_exists($path) && !empty($get->image)){
                    unlink($path);
                }
            }

            Comments::where("id", $id)->delete();

            return customHelper::alert("Başarılı", "Yorum başarıyla silindi.", "success", true);

        }catch(\Exception $e){
            return customHelper::alert("Hata", "Bir sorun oluştu: " . $e->getMessage(), "error");
        }
    }

    public function deletePicture(Request $request)
    {
        try {
            $get = $this->show($request->id);
            if($get->image){
                $path = public_path("assets/images/comments/".$get->image);
                if(file_exists($path)){
                    unlink($path);
                }
                Comments::where("id", $request->id)
                    ->update(["image" => NULL]);
            }

            return customHelper::alert("Başarılı", "Yorum resmi başarıyla silindi.", "success", true);

        }catch (\Exception $e){
            return customHelper::alert("Hata", "Bir sorun oluştu: ".$e->getMessage(), "error");
        }
    }

    public function status(Request $request){
        try {
            $status = 0;
            $get = $this->show($request->id);
            if(!$get->status){
                $status = 1;
            }

            Comments::where("id", $request->id)
                ->update(["status" => $status]);

            return customHelper::alert("Başarılı", "Durum güncellendi.", "success", true);

        }catch (\Exception $e){
            return customHelper::alert("Hata", "Bir sorun oluştu: ".$e->getMessage(), "error");
        }
    }
}
