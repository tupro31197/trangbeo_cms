<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ControllerBase;
use App\Helpers\Helpers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class RateController extends ControllerBase
{
    public function listRate(Request $request)
    {
        try {
            $token = $request->cookie('token');
            if ($token != null && $token != '') {
                $client = new Client([
                    'headers' => [
                        'token' => $token,
                    ],
                ]);
                $dish = $request->dish;
                $data = $client->get($this->urlAPI() . '/list-rate?dish_id=' . $request->dish_id);
                $response = json_decode($data->getBody()->getContents(), true);
                $ratings = $response['data']['data'];
                if ($response['status'] == 0) {
                    alert()->warning($response['message']);
                    return back();
                }
                return view('includes.rating.index', compact('ratings', 'dish'));
            } else {
                return view('welcome');
            }
        } catch (\Throwable $th) {
            alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }
}
