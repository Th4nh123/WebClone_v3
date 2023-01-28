<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HwpCampaign;
use Illuminate\Support\Facades\Artisan;

class ChienDichController extends Controller
{
    public function getCam()
    {
        return HwpCampaign::all();
    }

    public function saveCam(Request $request)
    {
        $arr = [];
        foreach ($request->data_json as $value) {
            array_push($arr, $value['campaign']);
        }
        if (HwpCampaign::whereIn('campaign', $arr)->count() == 0) {
            foreach ($request->data_json as $value) {
                HwpCampaign::firstOrCreate([
                    "campaign" => $value['campaign'],
                    "language" => $value['language']
                ]);
            }
            return response([
                'message' => 'Lưu thành công, đã lưu chiến dịch vào cơ sở dữ liệu',
                'success' => true
            ], 201);
        } else {
            return response([
                'message' => 'Lưu không thành công. Vui lòng thử lại',
                'success' => false
            ], 202);
        }
        return response([
            'message' => 'Lưu thành công, đã lưu chiến dịch vào cơ sở dữ liệu',
            'success' => true
        ], 201);
    }

    public function deleteCam(Request $request)
    {
        $arr = [];
        foreach ($request->data_json as $value) {
            array_push($arr, $value["id_cam"]);
        }
        if (HwpCampaign::whereIn('_id', $arr)->delete()) {
            return response([
                'message' => 'Xóa chiến dịch thành công',
                'success' => true
            ], 200);
        } else {
            return response([
                'message' => 'Xóa chiến dịch thất bại . Vui lòng thử lại',
                'success' => false
            ], 202);
        }
    }

    public function deleteAllCam()
    {
        if (!Artisan::call('migrate:refresh', ['--force' => true])) {
            return response([
                'message' => 'Xóa tất cả chiến dịch thành công ',
                'success' => true
            ], 200);
        } else {
            return response([
                'message' => 'Xóa chiến dịch thất bại',
                'success' => false
            ], 202);
        }
    }

    public function updateStatusCam(HwpCampaign $id_campaign)
    {
        $id_campaign->update(['check' => true]);
        return ["code" => 200];
    }

    public function resetStatusCam(HwpCampaign $id_campaign)
    {
        $id_campaign->update(['check' => false]);
        return ["code" => 200];
    }
}
