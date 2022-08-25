<?php

namespace App\Http\Controllers\admin;

use App\Helper\customHelper;
use App\Http\Controllers\Controller;
use App\Models\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pages::all();
        return view("admin.pages.index", ["datas" => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.pages.add");
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
                "description" => "required",
                "content" => "required"
            ]);

            $data = [
                "seo_title" => $request->seo_title,
                "seo_keyw" => $request->seo_keyw,
                "seo_desc" => $request->seo_desc,
                "url" => customHelper::permalink($request->title),
                "page_title" => $request->title,
                "page_desc" => $request->description,
                "page_content" => $request->content
            ];

            if ($request->file) {
                $fileNewName = Str::random(10) . "." . $request->file->getClientOriginalExtension();
                $data["page_image"] = $fileNewName;
                $request->file->move(public_path("assets/images/pages/"), $fileNewName);
            }

            Pages::create($data);

            return customHelper::alert("", "", "success", true);

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
        return Pages::where("page_id", $id)->first();
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
            return view("admin.pages.edit", ["data" => $data]);
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
                "description" => "required",
                "content" => "required"
            ]);

            $posts = [
                "seo_title" => $request->seo_title,
                "seo_keyw" => $request->seo_keyw,
                "seo_desc" => $request->seo_desc,
                "url" => customHelper::permalink($request->title),
                "page_title" => $request->title,
                "page_desc" => $request->description,
                "page_content" => $request->content
            ];

            if ($request->file) {
                $path = public_path("assets/images/pages/" . $get->page_image);
                if (file_exists($path) && !empty($get->page_image)) {
                    unlink($path);
                }
                $fileNewName = Str::random(10) . "." . $request->file->getClientOriginalExtension();
                $posts["page_image"] = $fileNewName;
                $request->file->move(public_path("assets/images/pages/"), $fileNewName);
            }

            Pages::where("page_id", $id)
                ->update($posts);

            return customHelper::alert("Başarılı", "Sayfa başarıyla güncellendi.", "success", true);

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

            if($get->page_image){
                $path = public_path("assets/images/pages/".$get->page_image);
                if(file_exists($path) && !empty($get->page_image)){
                    unlink($path);
                }
            }

            Pages::where("page_id", $id)->delete();

            return customHelper::alert("Başarılı", "Sayfa başarıyla silindi.", "success", true);

        }catch(\Exception $e){
            return customHelper::alert("Hata", "Bir sorun oluştu: " . $e->getMessage(), "error");
        }
    }


    public function deletePicture(Request $request)
    {
        try {
            $get = $this->show($request->id);
            if($get->page_image){
                $path = public_path("assets/images/pages/".$get->page_image);
                if(file_exists($path)){
                    unlink($path);
                }
                Pages::where("page_id", $request->id)
                    ->update(["page_image" => NULL]);
            }

            return customHelper::alert("Başarılı", "Sayfa resmi başarıyla silindi.", "success", true);

        }catch (\Exception $e){
            return customHelper::alert("Hata", "Bir sorun oluştu: ".$e->getMessage(), "error");
        }
    }

    public function status(Request $request){
        try {
            $page_status = 0;
            $get = $this->show($request->id);
            if(!$get->page_status){
                $page_status = 1;
            }

            Pages::where("page_id", $request->id)
                ->update(["page_status" => $page_status]);

            return customHelper::alert("Başarılı", "Durum güncellendi.", "success", true);

        }catch (\Exception $e){
            return customHelper::alert("Hata", "Bir sorun oluştu: ".$e->getMessage(), "error");
        }
    }
}
