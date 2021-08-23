<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ControllerBase;
use App\Helpers\Helpers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CategoryController extends ControllerBase
{
    public function listCategory(Request $request)
    {
        try {
            $token = $request->cookie('token');

            $client = new Client([
                'headers' => [
                    'token' => $token,
                ],
            ]);

            $data = $client->get($this->urlAPI() . '/list-category');
            $response = json_decode($data->getBody()->getContents(), true);
            $categories = $response['data'];
            // foreach ($categories as $key => $item) {
            //     $body = [
            //         'category_parent_id' => $item['id'],
            //     ];
            //     $input = json_encode($body);
            //     $data = $client->get($this->urlAPI() . '/list-category-child', ['body' => $input]);
            //     $response = json_decode($data->getBody()->getContents(), true);
            //     $child[$key] = $response['data'];
            // }
            // dd($child);

            return view('includes.category.index', compact('categories'));
        } catch (\Throwable $th) {
            alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function addParrent(Request $request)
    {
        // try{
        $token = $request->cookie('token');

        $category = [];
        foreach ($request->except('_token') as $key => $value) {
            if ($key == 'sampleFile') {
                if ($request->hasFile('sampleFile')) {
                    $category[] = Helpers::imageAttribute($request->sampleFile, 'sampleFile');
                }
            } else {
                $category[] = [
                    'name' => $key,
                    'contents' => $value,
                ];
            }
        }

        $url = $this->urlAPI() . '/create-category-parent';
        $client = new Client([
            'headers' => [
                'token' => $token,
                'Content-Type' => 'multipart/form-data',
            ],
        ]);
        $req = $client->post(
            $url,
            [
                'multipart' => $category,
            ],
            // ['form_params']
        );
        // dd($req);

        $response = json_decode($req->getBody()->getContents(), true);
        // dd($response);
        if ($response['status'] == 1) {
            alert()->success($response['message']);
            return redirect()->route('category.listCategory');
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

        $category = [];
        foreach ($request->except('_token') as $key => $value) {
            if ($key == 'sampleFile') {
                if ($request->hasFile('sampleFile')) {
                    $category[] = Helpers::imageAttribute($request->sampleFile, 'sampleFile');
                }
            } else {
                $category[] = [
                    'name' => $key,
                    'contents' => $value,
                ];
            }
        }

        $url = $this->urlAPI() . '/update-category-parent';
        $client = new Client([
            'headers' => [
                'token' => $token,
                'Content-Type' => 'multipart/form-data',
            ],
        ]);
        $req = $client->post(
            $url,
            [
                'multipart' => $category,
            ],
            // ['form_params']
        );
        // dd($req);

        $response = json_decode($req->getBody()->getContents(), true);
        // dd($response);
        if ($response['status'] == 1) {
            alert()->success($response['message']);
            return redirect()->route('category.listCategory');
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
            'id' => $id,
        ];
        $input = json_encode($body);

        $url = $this->urlAPI() . '/delete-category-parent';
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

    public function addChild(Request $request)
    {
        // try{
        $token = $request->cookie('token');

        $category = [];
        foreach ($request->except('_token') as $key => $value) {
            if ($key == 'sampleFile') {
                if ($request->hasFile('sampleFile')) {
                    $category[] = Helpers::imageAttribute($request->sampleFile, 'sampleFile');
                }
            } else {
                $category[] = [
                    'name' => $key,
                    'contents' => $value,
                ];
            }
        }

        $url = $this->urlAPI() . '/create-category-child';
        $client = new Client([
            'headers' => [
                'token' => $token,
                'Content-Type' => 'multipart/form-data',
            ],
        ]);
        $req = $client->post(
            $url,
            [
                'multipart' => $category,
            ],
            // ['form_params']
        );
        // dd($req);

        $response = json_decode($req->getBody()->getContents(), true);
        // dd($response);
        if ($response['status'] == 1) {
            alert()->success($response['message']);
            
        } else {
            alert()->error($response['message'], '');
           
        }
        return back();
        // } catch (\Throwable $th) {
        //         alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
        //         return back();
        //     }
    }

    public function listChild(Request $request, $id)
    {
        // try {
            $token = $request->cookie('token');

            $client = new Client([
                'headers' => [
                    'token' => $token,
                ],
            ]);
        
            $data = $client->get($this->urlAPI() . '/list-category-child?category_parent_id='.$id);
            $response = json_decode($data->getBody()->getContents(), true);
            $child = $response['data'];
           

            return view('includes.category.child', compact('id','child'));
        // } catch (\Throwable $th) {
        //     alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
        //     return back();
        // }
    }

    public function deleteChild(Request $request, $id)
    {
        try {
        $token = $request->cookie('token');

        $body = [
            'id' => $id,
        ];
        $input = json_encode($body);

        $url = $this->urlAPI() . '/delete-category-child';
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
        } catch (\Throwable $th) {
            alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function updateChild(Request $request)
    {
        try{
        $token = $request->cookie('token');

        $category = [];
        foreach ($request->except('_token') as $key => $value) {
            if ($key == 'sampleFile') {
                if ($request->hasFile('sampleFile')) {
                    $category[] = Helpers::imageAttribute($request->sampleFile, 'sampleFile');
                }
            } else {
                $category[] = [
                    'name' => $key,
                    'contents' => $value,
                ];
            }
        }

        $url = $this->urlAPI() . '/update-category-child';
        $client = new Client([
            'headers' => [
                'token' => $token,
                'Content-Type' => 'multipart/form-data',
            ],
        ]);
        $req = $client->post(
            $url,
            [
                'multipart' => $category,
            ],
            // ['form_params']
        );
        // dd($req);

        $response = json_decode($req->getBody()->getContents(), true);
        // dd($response);
        if ($response['status'] == 1) {
            alert()->success($response['message']);
        } else {
            alert()->error($response['message'], '');
            
        }
        return back();
        } catch (\Throwable $th) {
                alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
                return back();
            }
    }
}
