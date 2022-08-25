<?php

namespace App\Http\Controllers\admin;

use App\Helper\customHelper;
use App\Http\Controllers\Controller;
use App\Models\FixedPages;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FixedPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = FixedPages::all();
        return view("admin.fixedpages.index", ["datas" => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return FixedPages::where("id", $id)->first();
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
        if ($data){
            return view("admin.fixedpages.edit", ["data" => $data]);
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
                "name" => "required"
            ]);

            $posts = [
                "name" => $request->name,
                "title" => $request->title,
                "keyw" => $request->keyw,
                "desc" => $request->desc
            ];

            if ($request->file) {
                $path = public_path("assets/images/fixedpages/" . $get->image);
                if (file_exists($path) && !empty($get->image)) {
                    unlink($path);
                }
                $fileNewName = Str::random(10) . "." . $request->file->getClientOriginalExtension();
                $posts["image"] = $fileNewName;
                $request->file->move(public_path("assets/images/fixedpages/"), $fileNewName);
            }

            FixedPages::where("id", $id)
                ->update($posts);

            return customHelper::alert("Başarılı", "Sabit sayfa başarıyla güncellendi.", "success", true);

        } catch (\Exception $e) {
            return customHelper::alert("Hata", "Bir sorun oluştu: " . $e->getMessage(), "error");
        }
    }

    public function deletePicture(Request $request)
    {
        try {
            $get = $this->show($request->id);
            if($get->image){
                $path = public_path("assets/images/pages/".$get->image);
                if(file_exists($path)){
                    unlink($path);
                }
                FixedPages::where("id", $request->id)
                    ->update(["image" => NULL]);
            }

            return customHelper::alert("Başarılı", "Sabit sayfa resmi başarıyla silindi.", "success", true);

        }catch (\Exception $e){
            return customHelper::alert("Hata", "Bir sorun oluştu: ".$e->getMessage(), "error");
        }
    }
}
