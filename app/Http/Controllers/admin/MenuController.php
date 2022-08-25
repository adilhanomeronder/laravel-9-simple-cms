<?php

namespace App\Http\Controllers\admin;

use App\Helper\customHelper;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Menus;
use App\Models\Pages;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Menus::all();
        foreach($datas as $key => $data){
            if($parent = $this->show($data->parent_id)){
                $datas[$key]["parent_name"] = $parent->title;
            }
        }

        return view("admin.menus.index", ["datas" => $datas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = $this->parent_menu(0, 0);
        $pages = Pages::where("page_status", 1)->get();
        $blog = Blog::where("status", 1)->get();
        $products = Product::where("status", 1)->get();
        $categories = Category::where("status", 1)->get();
        $services = Service::where("status", 1)->get();
        return view("admin.menus.add", ["menus" => $menus, "pages" => $pages, "blogs" => $blog, "products" => $products, "categories" => $categories, "services" => $services]);
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
                "type" => "required",
                "parent_id" => "required",
                "href" => "required"
            ]);

            $data = [
                "title" => $request->title,
                "type" => $request->type,
                "parent_id" => $request->parent_id,
                "href" => $request->href,
                "target" => $request->target
            ];

            if ($request->file) {
                $fileNewName = Str::random(10) . "." . $request->file->getClientOriginalExtension();
                $data["icon"] = $fileNewName;
                $request->file->move(public_path("assets/images/menu/"), $fileNewName);
            }

            Menus::create($data);

            return customHelper::alert("Başarılı", "Menü başarıyla eklendi.", "success", true);

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
        return Menus::where("id", $id)->first();
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
            $pages = Pages::where("page_status", 1)->get();
            $blog = Blog::where("status", 1)->get();
            $products = Product::where("status", 1)->get();
            $categories = Category::where("status", 1)->get();
            $services = Service::where("status", 1)->get();
            $menus = $this->parent_menu(0,0,$data->parent_id);
            return view("admin.menus.edit", ["data" => $data, "menus" => $menus, "pages" => $pages, "blog" => $blog, "products" => $products, "categories" => $categories, "services" => $services]);
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
                "type" => "required",
                "parent_id" => "required",
                "href" => "required"
            ]);

            $posts = [
                "title" => $request->title,
                "type" => $request->type,
                "parent_id" => $request->parent_id,
                "href" => $request->href,
                "target" => $request->target
            ];

            if ($request->file) {
                $path = public_path("assets/images/menu/" . $get->icon);
                if (file_exists($path) && !empty($get->icon)) {
                    unlink($path);
                }
                $fileNewName = Str::random(10) . "." . $request->file->getClientOriginalExtension();
                $posts["icon"] = $fileNewName;
                $request->file->move(public_path("assets/images/menu/"), $fileNewName);
            }

            Menus::where("id", $id)
                ->update($posts);

            return customHelper::alert("Başarılı", "Menü başarıyla güncellendi.", "success", true);

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

            if($get->icon){
                $path = public_path("assets/images/menu/".$get->icon);
                if(file_exists($path) && !empty($get->icon)){
                    unlink($path);
                }
            }

            Menus::where("id", $id)->delete();

            return customHelper::alert("Başarılı", "Menü başarıyla silindi.", "success", true);

        }catch(\Exception $e){
            return customHelper::alert("Hata", "Bir sorun oluştu: " . $e->getMessage(), "error");
        }
    }


    /**
     * Prints menus and submenus.
     */
    public $printMenus = "";
    public function parent_menu($tree,$level,$parentId = null){
        $q = Menus::where("parent_id", $tree)
            ->where("status", 1)
            ->get();

        if(count($q)){
            foreach ($q as $item)
            {
                if($parentId==$item["id"]){$sel = " selected ";}else{$sel="";}
                $this->printMenus.= '<option value="'.$item["id"].'" '.$sel.'>'.str_repeat('-', $level*3).$item['title'].'</option>';
                $this->parent_menu($item["id"], $level + 1, $parentId);
            }
        }

        return $this->printMenus;
    }

    public function deletePicture(Request $request)
    {
        try {
            $get = $this->show($request->id);
            if($get->icon){
                $path = public_path("assets/images/menu/".$get->icon);
                if(file_exists($path)){
                    unlink($path);
                }
                Menus::where("id", $request->id)
                    ->update(["icon" => NULL]);
            }

            return customHelper::alert("Başarılı", "Menü resmi başarıyla silindi.", "success", true);

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

            Menus::where("id", $request->id)
                ->update(["status" => $status]);

            return customHelper::alert("Başarılı", "Durum güncellendi.", "success", true);

        }catch (\Exception $e){
            return customHelper::alert("Hata", "Bir sorun oluştu: ".$e->getMessage(), "error");
        }
    }
}
