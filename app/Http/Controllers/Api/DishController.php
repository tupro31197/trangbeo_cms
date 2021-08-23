<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ControllerBase;
use App\Helpers\Helpers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class DishController extends ControllerBase
{
    public function listDish(Request $request)
    {
        // try {
        $token = $request->cookie('token');

        $client = new Client([
            'headers' => [
                'token' => $token,
            ],
        ]);

        $data = $client->get($this->urlAPI() . '/list-dish');
        $response = json_decode($data->getBody()->getContents(), true);
        $dishes = $response['data']['data'];

        $data2 = $client->get($this->urlAPI() . '/list-category');
        $response2 = json_decode($data2->getBody()->getContents(), true);
        $categories = $response2['data'];

        return view('includes.dish.index', compact('dishes', 'categories'));
        // } catch (\Throwable $th) {
        //     alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
        //     return back();
        // }
    }

    public function addParrent(Request $request)
    {
        // try{
        $token = $request->cookie('token');

        $dish = [];
        foreach ($request->except('_token') as $key => $value) {
            if ($key == 'sampleFile') {
                if ($request->hasFile('sampleFile')) {
                    $dish[] = Helpers::imageAttribute($request->sampleFile, 'sampleFile');
                }
            } else {
                $dish[] = [
                    'name' => $key,
                    'contents' => $value,
                ];
            }
        }

        $url = $this->urlAPI() . '/create-dish';
        $client = new Client([
            'headers' => [
                'token' => $token,
                'Content-Type' => 'multipart/form-data',
            ],
        ]);
        $req = $client->post(
            $url,
            [
                'multipart' => $dish,
            ],
            // ['form_params']
        );
        // dd($req);

        $response = json_decode($req->getBody()->getContents(), true);
        // dd($response);
        if ($response['status'] == 1) {
            alert()->success($response['message']);
            return redirect()->route('dish.listDish');
        } else {
            alert()->error($response['message'], '');
            return back();
        }
        // } catch (\Throwable $th) {
        //         alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
        //         return back();
        //     }
    }

    public function updateParrent(Request $request)
    {
        // try{
        $token = $request->cookie('token');

        $dish = [];
        foreach ($request->except('_token') as $key => $value) {
            if ($key == 'sampleFile') {
                if ($request->hasFile('sampleFile')) {
                    $dish[] = Helpers::imageAttribute($request->sampleFile, 'sampleFile');
                }
            } else {
                $dish[] = [
                    'name' => $key,
                    'contents' => $value,
                ];
            }
        }
        $url = $this->urlAPI() . '/update-dish';
        $client = new Client([
            'headers' => [
                'token' => $token,
                'Content-Type' => 'multipart/form-data',
            ],
        ]);
        $req = $client->post(
            $url,
            [
                'multipart' => $dish,
            ],
            // ['form_params']
        );
        // dd($req);

        $response = json_decode($req->getBody()->getContents(), true);
        // dd($response);
        if ($response['status'] == 1) {
            alert()->success($response['message']);
            return redirect()->route('category.listDish');
        } else {
            alert()->error($response['message'], '');
            return back();
        }
        // } catch (\Throwable $th) {
        //         alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
        //         return back();
        //     }
    }

    public function deleteParrent(Request $request, $id)
    {
        // try {
        $token = $request->cookie('token');

        $body = [
            'dish_id' => $id,
        ];
        $input = json_encode($body);

        $url = $this->urlAPI() . '/delete-dish';
        $client = new Client([
            'headers' => [
                'token' => $token,
                'Content-Type' => 'application/json',
            ],
        ]);
        $req = $client->post($url, ['body' => $input]);
        // dd($req);
        $response = json_decode($req->getBody()->getContents(), true);
        if ($response['status'] == 1) {
            alert()->success($response['message']);
        } else {
            alert()->warning($response['message']);
        }
        return back();
        // } catch (\Throwable $th) {
        //     alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
        //     return back();
        // }
    }
}
