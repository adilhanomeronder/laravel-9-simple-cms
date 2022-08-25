<?php

namespace App\Http\Controllers\admin;

use App\Helper\customHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::all();
        return view("admin.category.index", ["datas" => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.category.add");
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
                "title" => "required"
            ]);

            $data = [
                "seo_title" => $request->seo_title,
                "seo_keyw" => $request->seo_keyw,
                "seo_desc" => $request->seo_desc,
                "url" => customHelper::permalink($request->title),
                "title" => $request->title,
                "short_content" => $request->short_content,
                "content" => $request->content
            ];

            if ($request->file) {
                $fileNewName = Str::random(10) . "." . $request->file->getClientOriginalExtension();
                $data["image"] = $fileNewName;
                $request->file->move(public_path("assets/images/category/"), $fileNewName);
            }

            Category::create($data);

            return customHelper::alert("Başarılı", "Kategori başarıyla eklendi.", "success", true);

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
        return Category::where("id", $id)->first();
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
        if($data) {
            return view("admin.category.edit", ["data" => $data]);
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
                "title" => "required"
            ]);

            $posts = [
                "seo_title" => $request->seo_title,
                "seo_keyw" => $request->seo_keyw,
                "seo_desc" => $request->seo_desc,
                "url" => customHelper::permalink($request->title),
                "title" => $request->title,
                "short_content" => $request->short_content,
                "content" => $request->content
            ];

            if ($request->file) {
                $path = public_path("assets/images/category/" . $get->image);
                if (file_exists($path) && !empty($get->image)) {
                    unlink($path);
                }
                $fileNewName = Str::random(10) . "." . $request->file->getClientOriginalExtension();
                $posts["image"] = $fileNewName;
                $request->file->move(public_path("assets/images/category/"), $fileNewName);
            }

            Category::where("id", $id)
                ->update($posts);

            return customHelper::alert("Başarılı", "Kategori başarıyla güncellendi.", "success", true);

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
                $path = public_path("assets/images/category/".$get->image);
                if(file_exists($path) && !empty($get->image)){
                    unlink($path);
                }
            }

            Category::where("id", $id)->delete();

            return customHelper::alert("Başarılı", "Kategori başarıyla silindi.", "success", true);

        }catch(\Exception $e){
            return customHelper::alert("Hata", "Bir sorun oluştu: " . $e->getMessage(), "error");
        }
    }

    public function deletePicture(Request $request)
    {
        try {
            $get = $this->show($request->id);
            if($get->image){
                $path = public_path("assets/images/category/".$get->image);
                if(file_exists($path)){
                    unlink($path);
                }
                Category::where("id", $request->id)
                    ->update(["image" => NULL]);
            }

            return customHelper::alert("Başarılı", "Kategori resmi başarıyla silindi.", "success", true);

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

            Category::where("id", $request->id)
                ->update(["status" => $status]);

            return customHelper::alert("Başarılı", "Durum güncellendi.", "success", true);

        }catch (\Exception $e){
            return customHelper::alert("Hata", "Bir sorun oluştu: ".$e->getMessage(), "error");
        }
    }
}
