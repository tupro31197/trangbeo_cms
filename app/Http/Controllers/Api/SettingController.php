<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerBase;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use stdClass;

class SettingController extends ControllerBase
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $token = $request->cookie('token');
            if ($token != null && $token != '') {
                $client = new Client([
                    'headers' => [
                        'token' => $token,
                    ],
                ]);
                $data = $client->get($this->urlAPI() . '/config');
                $response = json_decode($data->getBody()->getContents(), true);
                $setting = $response['data'];
                if ($response['status'] == 0) {
                    alert()->warning($response['message']);
                    return back();
                }
                return view('includes.settings.index', compact('setting'));
            } else {
                return view('welcome');
            }
        } catch (\Throwable $th) {
            alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
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
            $token = $request->cookie('token');
            if ($token != null && $token != '') {
                $client = new Client([
                    'headers' => [
                        'token' => $token,
                    ],
                ]);
                $shipCosts = [];

                foreach($request->input('from') as $key => $value){
                    $shipCosts[$key]['from'] = (int)$request->input('from')[$key];
                    $shipCosts[$key]['to'] = (int)$request->input('to')[$key];
                    $shipCosts[$key]['price'] = (int)$request->input('price')[$key];
                }
                $data['register_money'] = (int)$request->input('register_money');
                $data['distance_price'] = $shipCosts;
                $data['store_address'] = $request->input('store_address');
                $data['bank_setting'] = $request->input('bank_setting');
                $data['store_address']['long'] = (float)$data['store_address']['long'];
                $data['store_address']['lat'] = (float)$data['store_address']['lat'];
                $url = $this->urlAPI() . '/config';
                $client = new Client([
                    'headers' => [
                        'token' => $token,
                        'Content-Type' => 'application/json',
                    ],
                ]);
                $req = $client->post($url, [
                    'body' => json_encode($data),
                ]);

                $response = json_decode($req->getBody()->getContents(), true);

                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('settings.index');
                } else {
                    alert()->error($response['message'], '');
                    return back();
                }
                return back();
            } else {
                return view('welcome');
            }
        } catch (\Throwable $th) {
            alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

}
