<?php

namespace App\Http\Controllers\admin;

use App\Helper\customHelper;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogImages;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Blog::leftJoin('blog_images', function ($join){
            $join->on("blogs.id","=","blog_images.blog_id");
        })
            ->groupBy("blogs.id")
            ->get(["blog_images.image", "blogs.*"]);
        return view("admin.blog.index", ["datas" => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.blog.add");
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
                "content" => "required"
            ]);

            $data = [
                "seo_title" => $request->seo_title,
                "seo_keyw" => $request->seo_keyw,
                "seo_desc" => $request->seo_desc,
                "url" => customHelper::permalink($request->title),
                "title" => $request->title,
                "short_content" => $request->short_content,
                "content" => $request->content,
                "tags" => $request->tags,
                "category" => $request->category
            ];

            $blog_id = Blog::create($data)->id;

            if ($request->file) {
                foreach($request->file as $file){
                    $fileNewName = Str::random(10) . "." . $file->getClientOriginalExtension();
                    BlogImages::create([
                        "blog_id" => $blog_id,
                        "image" => $fileNewName
                    ]);
                    $file->move(public_path("assets/images/blog/"), $fileNewName);
                }
            }


            return customHelper::alert("Başarılı", "Blog başarıyla eklendi.", "success", true);

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
        return Blog::where("id", $id)->first();
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
            $images = BlogImages::where("blog_id", $id)
                ->orderBy("queue", "ASC")
                ->get();
            return view("admin.blog.edit", ["data" => $data, "images" => $images]);
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
                "content" => $request->content,
                "tags" => $request->tags,
                "category" => $request->category
            ];

            $blog_id = Blog::where("id", $id)
                ->update($data);

            if ($request->file) {
                foreach($request->file as $file){
                    $fileNewName = Str::random(10) . "." . $file->getClientOriginalExtension();
                    BlogImages::create([
                        "blog_id" => $id,
                        "image" => $fileNewName
                    ]);
                    $file->move(public_path("assets/images/blog/"), $fileNewName);
                }
            }


            return customHelper::alert("Başarılı", "Blog başarıyla güncellendi.", "success", true);

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
            $images = BlogImages::where("blog_id", $id)->get(["image"]);

            if($images){
                foreach ($images as $image) {
                    $path = public_path("assets/images/blog/".$image->image);
                    if(file_exists($path) && !empty($image->image)){
                        unlink($path);
                    }
                }
            }

            Blog::where("id", $id)->delete();

            return customHelper::alert("Başarılı", "Blog başarıyla silindi.", "success", true);

        }catch(\Exception $e){
            return customHelper::alert("Hata", "Bir sorun oluştu: " . $e->getMessage(), "error");
        }
    }

    public function getProductImage($id){
        return BlogImages::where("id", $id)->first();
    }

    public function deletePicture(Request $request)
    {
        try {
            $get = $this->getProductImage($request->id);

            if($get->image){

                $path = public_path("assets/images/blog/".$get->image);
                if(file_exists($path)){
                    unlink($path);
                }
                BlogImages::where("id", $request->id)
                    ->delete();
            }

            return customHelper::alert("Başarılı", "Blog resmi başarıyla silindi.", "success", true);

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

            Blog::where("id", $request->id)
                ->update(["status" => $status]);

            return customHelper::alert("Başarılı", "Durum güncellendi.", "success", true);

        }catch (\Exception $e){
            return customHelper::alert("Hata", "Bir sorun oluştu: ".$e->getMessage(), "error");
        }
    }

    public function sortable(Request $request){
        if(isset($request->data)){
            foreach($request->data as $key => $data){
                BlogImages::where("id", $data)
                    ->update([
                        "queue" => $key
                    ]);
            }
        }
    }
}
