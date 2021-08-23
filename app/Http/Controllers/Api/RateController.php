<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ControllerBase;
use App\Helpers\Helpers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class RateController extends Controller
{
    public function listRate(Request $request, $page)
    {
        try {
            $token = $request->cookie('token');

            $client = new Client([
                'headers' => [
                    'token' => $token,
                ],
            ]);

            $data = $client->get($this->urlAPI() . '/list-rate?page='.$page);
            $response = json_decode($data->getBody()->getContents(), true);
            $rates = $response['data'];
            if ($response['status'] == 0) {
                alert()->warning($response['message']);
                return back();
            }
            return view('includes.rate.index', compact('rates'));
        } catch (\Throwable $th) {
            alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }
}
