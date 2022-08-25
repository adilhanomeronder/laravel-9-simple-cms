<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Helper\customHelper;

class SettingController extends Controller
{
    public function contact(){
        $data = Setting::where("name", "CONTACT")->first();
        $data = json_decode($data["value"], true);
        return view("admin.setting.contact", ["datas" => $data]);
    }

    public function contactStore(Request $request){
        try {
            $request->validate([
                "type" => "required|array",
            ]);

            $data = [];
            foreach($request->type as $key => $type){
                $data[] = [
                    "type" => $type,
                    "value" => $request->value[$key]
                ];
            }

            $data = json_encode($data, JSON_UNESCAPED_UNICODE);

            Setting::where("name", "CONTACT")
                ->update([
                    "value" => $data
                ]);

            return customHelper::alert("Başarılı", "İletişim ayarlarınız başarıyla güncellendi.", "success", true);

        } catch (\Exception $e) {
            return customHelper::alert("Hata", "Bir sorun oluştu: " . $e->getMessage(), "error");
        }
    }

    public function social(){
        $data = Setting::where("name", "SOCIAL")->first();
        $data = json_decode($data["value"], true);
        return view("admin.setting.social", ["datas" => $data]);
    }

    public function socialStore(Request $request){
        try {
            $request->validate([
                "type" => "required|array",
            ]);

            $data = [];
            foreach($request->type as $key => $type){
                $data[] = [
                    "type" => $type,
                    "value" => $request->value[$key]
                ];
            }

            $data = json_encode($data, JSON_UNESCAPED_UNICODE);

            Setting::where("name", "SOCIAL")
                ->update([
                    "value" => $data
                ]);

            return customHelper::alert("Başarılı", "Sosyal medya ayarlarınız başarıyla güncellendi.", "success", true);

        } catch (\Exception $e) {
            return customHelper::alert("Hata", "Bir sorun oluştu: " . $e->getMessage(), "error");
        }
    }
}
