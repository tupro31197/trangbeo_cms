<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ControllerBase;
use App\Helpers\Helpers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class DishController extends ControllerBase
{
    public function listDish(Request $request, $page)
    {
        // try {
        $token = $request->cookie('token');

        $client = new Client([
            'headers' => [
                'token' => $token,
                'Content-Type' => 'application/json',
            ],
        ]);

        $body = Session::get('category');

        if (isset($request->category_parent_id)) {
            $category_parent_id = $request->category_parent_id;
        } elseif (isset($body['category_parent_id']) && isset($body['page']) && $page != $body['page']) {
            $category_parent_id = $body['category_parent_id'];
        } else {
            $category_parent_id = '';
        }

        if (isset($request->category_child_id)) {
            $category_child_id = $request->category_child_id;
        } elseif (isset($body['category_child_id']) && isset($body['page']) && $page != $body['page']) {
            $category_child_id = $body['category_child_id'];
        } else {
            $category_child_id = '';
        }

        $body = [
            'category_parent_id' => $category_parent_id,
            'category_child_id' => $category_child_id,
            'page' => $page,
        ];

        Session::put('category', $body);


        $data = $client->get($this->urlAPI() . '/list-dish?paginate=12&page=' . $page . '&category_parent_id=' . $category_parent_id . '&category_child_id' . $category_child_id);
        $response = json_decode($data->getBody()->getContents(), true);
        $dishes = $response['data'];

        $data2 = $client->get($this->urlAPI() . '/list-category');
        $response2 = json_decode($data2->getBody()->getContents(), true);
        $categories = $response2['data'];

        return view('includes.dish.index', compact('dishes', 'categories', 'category_parent_id', 'category_child_id'));
        // } catch (\Throwable $th) {
        //     alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
        //     return back();
    }

    public function addDish(Request $request)
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
            return redirect()->route('dish.listDish', ['page' => 1]);
        } else {
            alert()->error($response['message'], '');
            return back();
        }
        // } catch (\Throwable $th) {
        //         alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
        //         return back();
        //     }
    }

    public function updateDish(Request $request)
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
            return redirect()->route('dish.listDish', ['page' => 1]);
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
