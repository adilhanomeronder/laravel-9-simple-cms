<?php

namespace App\Http\Controllers\admin;

use App\Helper\customHelper;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImages;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use function public_path;
use function view;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::leftJoin('product_images', function ($join){
            $join->on("products.product_id","=","product_images.product_id");
        })
        ->groupBy("products.product_id")
        ->get(["product_images.image", "products.*"]);

        return view("admin.products.index", ["datas" => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.products.add");
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
                "name" => "required"
            ]);

            $data = [
                "seo_title" => $request->seo_title,
                "seo_keyw" => $request->seo_keyw,
                "seo_desc" => $request->seo_desc,
                "url" => customHelper::permalink($request->name),
                "name" => $request->name,
                "sku" => $request->sku,
                "short_content" => $request->short_content,
                "content" => $request->content,
                "price" => $request->price,
                "discount" => $request->discount,
                "stock" => $request->stock
            ];

            $product_id = Product::create($data)->id;

            if ($request->file) {
                foreach($request->file as $file){
                    $fileNewName = Str::random(10) . "." . $file->getClientOriginalExtension();
                    ProductImages::create([
                        "product_id" => $product_id,
                        "image" => $fileNewName
                    ]);
                    $file->move(public_path("assets/images/products/"), $fileNewName);
                }
            }


            return customHelper::alert("Başarılı", "Ürün başarıyla eklendi.", "success", true);

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
        return Product::where("product_id", $id)->first();
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
            $images = ProductImages::where("product_id", $id)
                ->orderBy("queue", "ASC")
                ->get();
            return view("admin.products.edit", ["data" => $data, "images" => $images]);
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
                "name" => "required"
            ]);

            $data = [
                "seo_title" => $request->seo_title,
                "seo_keyw" => $request->seo_keyw,
                "seo_desc" => $request->seo_desc,
                "url" => customHelper::permalink($request->name),
                "name" => $request->name,
                "sku" => $request->sku,
                "short_content" => $request->short_content,
                "content" => $request->content,
                "price" => $request->price,
                "discount" => $request->discount,
                "stock" => $request->stock
            ];

            $product_id = Product::where("product_id", $id)
                ->update($data);

            if ($request->file) {
                foreach($request->file as $file){
                    $fileNewName = Str::random(10) . "." . $file->getClientOriginalExtension();
                    ProductImages::create([
                        "product_id" => $id,
                        "image" => $fileNewName
                    ]);
                    $file->move(public_path("assets/images/products/"), $fileNewName);
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
            $images = ProductImages::where("product_id", $id)->get(["image"]);

            if($images){
                foreach ($images as $image) {
                    $path = public_path("assets/images/products/".$image->image);
                    if(file_exists($path) && !empty($image->image)){
                        unlink($path);
                    }
                }
            }

            Product::where("product_id", $id)->delete();

            return customHelper::alert("Başarılı", "Ürün başarıyla silindi.", "success", true);

        }catch(\Exception $e){
            return customHelper::alert("Hata", "Bir sorun oluştu: " . $e->getMessage(), "error");
        }
    }

    public function getProductImage($id){
        return ProductImages::where("id", $id)->first();
    }

    public function deletePicture(Request $request)
    {
        try {
            $get = $this->getProductImage($request->id);

            if($get->image){

                $path = public_path("assets/images/products/".$get->image);
                if(file_exists($path)){
                    unlink($path);
                }
                ProductImages::where("id", $request->id)
                    ->delete();
            }

            return customHelper::alert("Başarılı", "Ürün resmi başarıyla silindi.", "success", true);

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

            Product::where("product_id", $request->id)
                ->update(["status" => $status]);

            return customHelper::alert("Başarılı", "Durum güncellendi.", "success", true);

        }catch (\Exception $e){
            return customHelper::alert("Hata", "Bir sorun oluştu: ".$e->getMessage(), "error");
        }
    }

    public function sortable(Request $request){
        if(isset($request->data)){
            foreach($request->data as $key => $data){
                ProductImages::where("id", $data)
                    ->update([
                        "queue" => $key
                    ]);
            }
        }
    }
}
