<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\HwpUrl;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;

class UrlController extends Controller
{
    public function getUrlByIdKey($id_key)
    {
        $list_url = HwpUrl::query()
            ->leftJoin('hwp_posts', 'hwp_url.id', '=', 'hwp_posts.id_url')
            ->where("hwp_url.id_key", '=', $id_key)->orderBy('hwp_url.stt','asc')
            ->get()->toArray();
        return json_encode($list_url);
    }

    public function resetUrl($id_key)
    {
        HwpUrl::where('id_key', '=', $id_key)->update(['check' => false]);
        return array(["code" => 200]);
    }

    public function saveVideo(Request $request)
    {
        // try {
        // viet->eng
        $tr_vi_en = new GoogleTranslate('en', 'vi');
        //eng->japan
        $tr_en_ja = new GoogleTranslate('ja', 'en');
        //japan->france
        $tr_ja_fr = new GoogleTranslate('fr', 'ja');
        //france->viet
        $tr_fr_vi = new GoogleTranslate('vi', 'fr');
        $body = json_decode($request->getContent());
        for ($j = 0; $j < count($body); $j++) {
            // dịch sang tiếng Anh
            $desc = $body[$j]->url_description;
            $desc = $tr_vi_en->translate($desc);
            //dịch sang tiếng nhật
            $desc = $tr_en_ja->translate($desc);
            //dịch sang tiếng pháp
            $desc = $tr_ja_fr->translate($desc);
            //dịch sang tiếng việt
            $desc = $tr_fr_vi->translate($desc);
            $url = DB::table('hwp_url')->where('url', '=', $body[$j]->url)
                ->where('id_key', '=', $body[$j]->id_key)
                ->get()->toArray();
            if(count($url) == 0) {
                DB::table('hwp_url')->insert([
                    "url" => $body[$j]->url,
                    "url_title" => Addslashes($body[$j]->url_title),
                    "url_description" => Addslashes($desc),
                    "ky_hieu" => $body[$j]->ky_hieu,
                    "id_key" => $body[$j]->id_key,
                    "stt" => $body[$j]->stt
                ]);
            }
        }
        return array(
            'message' => 'Lưu thành công, đã lưu video vào cơ sở dữ liệu',
            'success' => true
        );
    }

    public function saveWeb(Request $request)
    {
        try {
            //viet->eng
            $tr_vi_en = new GoogleTranslate('en', 'vi');
            //eng->japan
            $tr_en_ja = new GoogleTranslate('ja', 'en');
//        japan->france
            $tr_ja_fr = new GoogleTranslate('fr', 'ja');
            //france->viet
            $tr_fr_vi = new GoogleTranslate('vi', 'fr');
            $body = json_decode($request->getContent());
            for ($j = 0; $j < count($body); $j++) {
                //dịch sang tiếng Anh
                $desc = $body[$j]->url_description;
                $desc = $tr_vi_en->translate($desc);
                //dịch sang tiếng nhật
                $desc = $tr_en_ja->translate($desc);
                //dịch sang tiếng pháp
                $desc = $tr_ja_fr->translate($desc);
                //dịch sang tiếng việt
                $desc = $tr_fr_vi->translate($desc);
                $url = DB::table('hwp_url')->where('url', '=', $body[$j]->url)
                    ->where('id_key', '=', $body[$j]->id_key)
                    ->get()->toArray();
                if(count($url) == 0) {
                    DB::table('hwp_url')->insert([
                        "url" => $body[$j]->url,
                        "url_image" => $body[$j]->url_image,
                        "url_title" => Addslashes($body[$j]->url_title),
                        "url_description" => Addslashes($desc),
                        "ky_hieu" => $body[$j]->ky_hieu,
                        "id_key" => $body[$j]->id_key,
                        "stt" => $body[$j]->stt
                    ]);
                }
            }
            return array(
                'message' => 'Lưu thành công, đã lưu Url web vào cơ sở dữ liệu',
                'success' => true
            );
        } catch(\Exception $e) {
            return array('code'=>500, 'message' => 'k lưu được web');
        }

    }

    public function saveImage(Request $request)
    {
        try {
            // viet->eng
            $tr_vi_en = new GoogleTranslate('en', 'vi');
            // eng->japan
            $tr_en_ja = new GoogleTranslate('ja', 'en');
            // japan->france
            $tr_ja_fr = new GoogleTranslate('fr', 'ja');
            // france->viet
            $tr_fr_vi = new GoogleTranslate('vi', 'fr');
            $body = json_decode($request->getContent());
            for ($j = 0; $j < count($body); $j++) {
                // dịch sang tiếng Anh
                $desc = $body[$j]->url_description;
                $desc = $tr_vi_en->translate($desc);
                // dịch sang tiếng nhật
                $desc = $tr_en_ja->translate($desc);
                // dịch sang tiếng pháp
                $desc = $tr_ja_fr->translate($desc);
                // dịch sang tiếng việt
                $desc = $tr_fr_vi->translate($desc);
                // $url = DB::table('hwp_url')->where('url', '=', $body[$j]->url)
                // ->where('id_key', '=', $body[$j]->id_key)
                // ->get()->toArray();
                // if(count($url) == 0) {
                DB::table('hwp_url')->insert([
                    "url" => $body[$j]->url,
                    "url_image" => $body[$j]->url_image,
                    "url_title" => Addslashes($body[$j]->url_title),
                    "url_description" => Addslashes($desc),
                    "ky_hieu" => $body[$j]->ky_hieu,
                    "id_key" => $body[$j]->id_key,
                    "stt" => $body[$j]->stt
                ]);
                // }

            }
            return array(
                'message' => 'Lưu thành công, đã lưu file vào cơ sở dữ liệu',
                'success' => true
            );
        } catch(\Exception $e) {
            return array('code'=>500, 'message' => 'k lưu được image');
        }

    }

    public function updateViTri($id_key){
        $ky_hieu = DB::table('hwp_key')->where('id','=',$id_key)->first();
        $list_kh = explode('.',$ky_hieu->ky_hieu);
//        $ar = array();
        for($i=0;$i < sizeof($list_kh);$i++) {
            if (str_contains($list_kh[$i], 'w')) {
                $num = str_replace("w", "", $list_kh[$i]); //3
                if (empty($num)){
                    $num =10;
                }
//                $ar[$i+1]= $num;
                DB::table('hwp_url')->where('id_key', '=', $id_key)
                    ->where('ky_hieu', '=', 'w')->where('stt', '=', 100)
                    ->limit($num)
                    ->update([
                        'stt' => $i + 1
                    ]);
            } elseif (str_contains($list_kh[$i], 'y')) {
                $num = str_replace("y", "", $list_kh[$i]); //3
//                $ar[$i+1]= $num;
                if (empty($num)){
                    $num =1;
                }
                DB::table('hwp_url')->where('id_key', '=', $id_key)
                    ->where('ky_hieu', '=', 'y')->where('stt', '=', 100)
                    ->limit($num)
                    ->update([
                        'stt' => $i + 1
                    ]);
            }
            elseif (str_contains($list_kh[$i], 'i')) {
                $num = str_replace("i", "", $list_kh[$i]); //3
//                $ar[$i+1]= $num;
                if (empty($num)){
                    $num =1;
                }
                DB::table('hwp_url')->where('id_key', '=', $id_key)
                    ->where('ky_hieu', '=', 'i')->where('stt', '=', 100)
                    ->limit($num)
                    ->update([
                        'stt' => $i + 1
                    ]);
            }
            elseif (str_contains($list_kh[$i], 'doc')) {
                $num = str_replace("doc", "", $list_kh[$i]); //3
//                $ar[$i+1]= $num;
                if (empty($num)){
                    $num =1;
                }
                DB::table('hwp_url')->where('id_key', '=', $id_key)
                    ->where('ky_hieu', '=', 'doc')->where('stt', '=', 100)
                    ->limit($num)
                    ->update([
                        'stt' => $i + 1
                    ]);
            }
            elseif (str_contains($list_kh[$i], 'pdf')) {
                $num = str_replace("pdf", "", $list_kh[$i]); //3
//                $ar[$i+1]= $num;
                if (empty($num)){
                    $num =1;
                }
                DB::table('hwp_url')->where('id_key', '=', $id_key)
                    ->where('ky_hieu', '=', 'pdf')->where('stt', '=', 100)
                    ->limit($num)
                    ->update([
                        'stt' => $i + 1
                    ]);
            }else{
                DB::table('hwp_url')->where('id_key', '=', $id_key)
                    ->where('stt', '=', 100)
                    ->update([
                        'stt' => $i + 1
                    ]);
            }
        }
        return array(
            'success' => true
        );
    }

    public function xoaURLByIdKey($id_key)
    {
        DB::table('hwp_url')->where('id_key', '=', $id_key)->delete();
        DB::table('hwp_posts')->where('id_key', '=', $id_key)->delete();
        return array(["code" => 200, 'message' => 'Success']);
    }

    public function xoaURL($id)
    {
        DB::table('hwp_url')->where('id', '=', $id)->delete();
        DB::table('hwp_posts')->where('id_url', '=', $id)->delete();
        return array(["code" => 200, 'message' => 'Success']);
    }
}
