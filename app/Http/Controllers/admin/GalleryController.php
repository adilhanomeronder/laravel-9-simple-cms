<?php

namespace App\Http\Controllers\admin;

use App\Helper\customHelper;
use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Gallery::all();
        return view("admin.gallery.index", ["datas" => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.gallery.add");
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
                "title" => "required",
                "area" => "required"
            ]);

            $data = [
                "title" => $request->title,
                "area" => $request->area
            ];

            if ($request->file) {
                $fileNewName = Str::random(10) . "." . $request->file->getClientOriginalExtension();
                $data["image"] = $fileNewName;
                $request->file->move(public_path("assets/images/gallery/"), $fileNewName);
            }

            Gallery::create($data);

            return customHelper::alert("Başarılı", "Resim başarıyla eklendi.", "success", true);

        } catch (\Exception $e) {
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
        return Gallery::where("id",$id)->first();
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
            return view("admin.gallery.edit", ["data" => $data]);
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
                "title" => "required",
                "area" => "required"
            ]);

            $data = [
                "title" => $request->title,
                "area" => $request->area
            ];

            if ($request->file) {
                $path = public_path("assets/images/gallery/" . $get->image);
                if (file_exists($path) && !empty($get->image)) {
                    unlink($path);
                }
                $fileNewName = Str::random(10) . "." . $request->file->getClientOriginalExtension();
                $data["image"] = $fileNewName;
                $request->file->move(public_path("assets/images/gallery/"), $fileNewName);
            }

            Gallery::where("id", $id)
                ->update($data);

            return customHelper::alert("Başarılı", "Resim başarıyla güncellendi.", "success", true);

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
                $path = public_path("assets/images/gallery/".$get->image);
                if(file_exists($path) && !empty($get->image)){
                    unlink($path);
                }
            }

            Gallery::where("id", $id)->delete();

            return customHelper::alert("Başarılı", "Resim başarıyla silindi.", "success", true);

        }catch(\Exception $e){
            return customHelper::alert("Hata", "Bir sorun oluştu: " . $e->getMessage(), "error");
        }
    }

    public function deletePicture(Request $request)
    {
        try {
            $get = $this->show($request->id);
            if($get->image){
                $path = public_path("assets/images/gallery/".$get->image);
                if(file_exists($path)){
                    unlink($path);
                }
                Gallery::where("id", $request->id)
                    ->update(["image" => NULL]);
            }

            return customHelper::alert("Başarılı", "Resim başarıyla silindi.", "success", true);

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

            Gallery::where("id", $request->id)
                ->update(["status" => $status]);

            return customHelper::alert("Başarılı", "Durum güncellendi.", "success", true);

        }catch (\Exception $e){
            return customHelper::alert("Hata", "Bir sorun oluştu: ".$e->getMessage(), "error");
        }
    }
}
