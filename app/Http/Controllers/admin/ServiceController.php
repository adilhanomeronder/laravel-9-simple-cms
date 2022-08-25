<?php

namespace App\Http\Controllers\admin;

use App\Helper\customHelper;
use App\Http\Controllers\Controller;
use App\Models\ServiceImages;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Service::leftJoin('service_images', function ($join){
            $join->on("services.id","=","service_images.service_id");
        })
            ->groupBy("services.id")
            ->get(["service_images.image", "services.*"]);

        return view("admin.service.index", ["datas" => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.service.add");
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

            $service_id = Service::create($data)->id;

            if ($request->file) {
                foreach($request->file as $file){
                    $fileNewName = Str::random(10) . "." . $file->getClientOriginalExtension();
                    ServiceImages::create([
                        "service_id" => $service_id,
                        "image" => $fileNewName
                    ]);
                    $file->move(public_path("assets/images/service/"), $fileNewName);
                }
            }


            return customHelper::alert("Başarılı", "Hizmet başarıyla eklendi.", "success", true);

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
        return Service::where("id", $id)->first();
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
            $images = ServiceImages::where("service_id", $id)
                ->orderBy("queue", "ASC")
                ->get();
            return view("admin.service.edit", ["data" => $data, "images" => $images]);
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
                "content" => $request->content
            ];

            $service_id = Service::where("id", $id)
                ->update($data);

            if ($request->file) {
                foreach($request->file as $file){
                    $fileNewName = Str::random(10) . "." . $file->getClientOriginalExtension();
                    ServiceImages::create([
                        "service_id" => $service_id,
                        "image" => $fileNewName
                    ]);
                    $file->move(public_path("assets/images/service/"), $fileNewName);
                }
            }


            return customHelper::alert("Başarılı", "Ürün başarıyla güncellendi.", "success", true);

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
            $images = ServiceImages::where("service_id", $id)->get(["image"]);

            if($images){
                foreach ($images as $image) {
                    $path = public_path("assets/images/service/".$image->image);
                    if(file_exists($path) && !empty($image->image)){
                        unlink($path);
                    }
                }
            }

            Service::where("id", $id)->delete();

            return customHelper::alert("Başarılı", "Hizmet başarıyla silindi.", "success", true);

        }catch(\Exception $e){
            return customHelper::alert("Hata", "Bir sorun oluştu: " . $e->getMessage(), "error");
        }
    }

    public function getProductImage($id){
        return ServiceImages::where("id", $id)->first();
    }

    public function deletePicture(Request $request)
    {
        try {
            $get = $this->getProductImage($request->id);

            if($get->image){

                $path = public_path("assets/images/service/".$get->image);
                if(file_exists($path)){
                    unlink($path);
                }
                ServiceImages::where("id", $request->id)
                    ->delete();
            }

            return customHelper::alert("Başarılı", "Hizmet resmi başarıyla silindi.", "success", true);

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

            Service::where("id", $request->id)
                ->update(["status" => $status]);

            return customHelper::alert("Başarılı", "Durum güncellendi.", "success", true);

        }catch (\Exception $e){
            return customHelper::alert("Hata", "Bir sorun oluştu: ".$e->getMessage(), "error");
        }
    }

    public function sortable(Request $request){
        if(isset($request->data)){
            foreach($request->data as $key => $data){
                ServiceImages::where("id", $data)
                    ->update([
                        "queue" => $key
                    ]);
            }
        }
    }
}
