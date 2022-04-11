<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerBase;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use stdClass;

class BannerController extends ControllerBase
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
                $banners = $setting['images_banner'];
                if ($response['status'] == 0) {
                    alert()->warning($response['message']);
                    return back();
                }
                return view('includes.banners.index', compact('banners'));
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
    public function store(Request $request)
    {
        try {
            $token = $request->cookie('token');
           if ($token != null && $token != '') {
                $data = [];
                foreach ($request->except('_token') as $key => $value) {
                    if ($key == 'sampleFile') {
                        if ($request->hasFile('sampleFile')) {
                            $data[] = Helpers::imageAttribute($request->sampleFile, 'sampleFile');
                        }
                    } else {
                        $data[] = [
                            'name' => $key,
                            'contents' => $value,
                        ];
                    }
                }
                $url = $this->urlAPI() . '/config/add-banner';
                $client = new Client([
                    'headers' => [
                        'token' => $token,
                        'Content-Type' => 'multipart/form-data',
                    ],
                ]);
                $req = $client->post($url, [
                    'multipart' => $data,
                ]);

                $response = json_decode($req->getBody()->getContents(), true);

                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('banners.index');
                } else {
                    alert()->error($response['message'], '');
                    return back();
                }
            } else {
                return view('welcome');
            }
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $token = $request->cookie('token');
            if ($token != null && $token != '') {
                $client = new Client([
                    'headers' => [
                        'token' => $token,
                    ],
                ]);
                $data = $client->get($this->urlAPI() . "/config/delete-banner?banner=$id");
                $response = json_decode($data->getBody()->getContents(), true);
                if ($response['status'] == 0) {
                    alert()->warning($response['message']);
                    return back();
                }
                alert()->success($response['message']);
                return redirect()->route('banners.index');
            } else {
                return view('welcome');
            }
        } catch (\Throwable $th) {
            alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

}
