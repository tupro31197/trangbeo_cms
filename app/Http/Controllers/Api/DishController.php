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
        try {
            $token = $request->cookie('token');
            if ($token != null && $token != '') {
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

                $data = $client->get($this->urlAPI() . '/list-dish?paginate=12&page=' . $page . '&category_parent_id=' . $category_parent_id . '&category_child_id=' . $category_child_id);
                $response = json_decode($data->getBody()->getContents(), true);
                $dishes = $response['data'];

                $data2 = $client->get($this->urlAPI() . '/list-category');
                $response2 = json_decode($data2->getBody()->getContents(), true);
                $categories = $response2['data'];

                return view('includes.dish.index', compact('dishes', 'categories', 'category_parent_id', 'category_child_id'));
            } else {
                return view('welcome');
            }
        } catch (\Throwable $th) {
            alert()->error('H??? th???ng ??ang ???????c b???o tr??. Vui l??ng th??? l???i sau!');
            return back();
        }
    }

    public function detailDish(Request $request, $id)
    {
        try {
            $token = $request->cookie('token');
            if ($token != null && $token != '') {
                $client = new Client([
                    'headers' => [
                        'token' => $token,
                        'Content-Type' => 'application/json',
                    ],
                ]);

                $data = $client->get($this->urlAPI() . '/detail-dish?dish_id=' . $id);
                $response = json_decode($data->getBody()->getContents(), true);
                $detail = $response['data']['data'];
                // dd($detail);
                return view('includes.dish.detail', compact('detail'));
            } else {
                return view('welcome');
            }
        } catch (\Throwable $th) {
            alert()->error('H??? th???ng ??ang ???????c b???o tr??. Vui l??ng th??? l???i sau!');
            return back();
        }
    }

    public function addDish(Request $request)
    {
        try {
            $token = $request->cookie('token');
            if ($token != null && $token != '') {
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
                $req = $client->post($url, [
                    'multipart' => $dish,
                ]);

                $response = json_decode($req->getBody()->getContents(), true);

                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('dish.listDish', ['page' => 1]);
                } else {
                    alert()->error($response['message'], '');
                    return back();
                }
            } else {
                return view('welcome');
            }
        } catch (\Throwable $th) {
            alert($th)->error('H??? th???ng ??ang ???????c b???o tr??. Vui l??ng th??? l???i sau!');
            return back();
        }
    }

    public function updateDish(Request $request)
    {
        try {
            $token = $request->cookie('token');
            if ($token != null && $token != '') {
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
                $req = $client->post($url, [
                    'multipart' => $dish,
                ]);

                $response = json_decode($req->getBody()->getContents(), true);

                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('dish.listDish', ['page' => 1]);
                } else {
                    alert()->error($response['message'], '');
                    return back();
                }
            } else {
                return view('welcome');
            }
        } catch (\Throwable $th) {
            alert($th)->error('H??? th???ng ??ang ???????c b???o tr??. Vui l??ng th??? l???i sau!');
            return back();
        }
    }

    public function deleteParrent(Request $request, $id)
    {
        try {
            $token = $request->cookie('token');
            if ($token != null && $token != '') {
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

                $response = json_decode($req->getBody()->getContents(), true);
                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                } else {
                    alert()->warning($response['message']);
                }
                return back();
            } else {
                return view('welcome');
            }
        } catch (\Throwable $th) {
            alert()->error('H??? th???ng ??ang ???????c b???o tr??. Vui l??ng th??? l???i sau!');
            return back();
        }
    }

    public function overTopping(Request $request, $id)
    {
        try {
            echo "123123123";
            $token = $request->cookie('token');
            if ($token != null && $token != '') {
                $url = $this->urlAPI() . '/over-topping?topping_id='.$id;
                $client = new Client([
                    'headers' => [
                        'token' => $token,
                        'Content-Type' => 'application/json',
                    ],
                ]);
                $req = $client->get($url);

                $response = json_decode($req->getBody()->getContents(), true);
                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                } else {
                    alert()->warning($response['message']);
                }
                return back();
            } else {
                return view('welcome');
            }
        } catch (\Throwable $th) {
            alert()->error('H??? th???ng ??ang ???????c b???o tr??. Vui l??ng th??? l???i sau!');
            return back();
        }
    }

    public function overDish(Request $request, $id)
    {
        try {
            $token = $request->cookie('token');
            if ($token != null && $token != '') {
                $url = $this->urlAPI() . '/over-dish?dish_id='.$id;
                $client = new Client([
                    'headers' => [
                        'token' => $token,
                        'Content-Type' => 'application/json',
                    ],
                ]);
                $req = $client->get($url);

                $response = json_decode($req->getBody()->getContents(), true);
                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                } else {
                    alert()->warning($response['message']);
                }
                return back();
            } else {
                return view('welcome');
            }
        } catch (\Throwable $th) {
            alert()->error('H??? th???ng ??ang ???????c b???o tr??. Vui l??ng th??? l???i sau!');
            return back();
        }
    }
    public function addDishTopping(Request $request)
    {
        try {
            $token = $request->cookie('token');
            if ($token != null && $token != '') {
                $topping = [
                    'name' => $request->name,
                    'dish_id' => $request->dish_id,
                    'limit' => $request->limit,
                ];
                foreach ($request['topping_name'] as $key => $value) {
                    $topping['topping'][] = [
                        'name' => $value,
                        'money' => $request['topping_price'][$key],
                    ];
                }

                $input = json_encode($topping);
                $url = $this->urlAPI() . '/create-topping-dish';
                $client = new Client([
                    'headers' => [
                        'token' => $token,
                        'Content-Type' => 'application/json',
                    ],
                ]);
                $req = $client->post($url, ['body' => $input]);

                $response = json_decode($req->getBody()->getContents(), true);

                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('dish.detailDish', ['id' => $request->dish_id]);
                } else {
                    alert()->error($response['message'], '');
                    return back();
                }
            } else {
                return view('welcome');
            }
        } catch (\Throwable $th) {
            alert($th)->error('H??? th???ng ??ang ???????c b???o tr??. Vui l??ng th??? l???i sau!');
            return back();
        }
    }

    public function addTypeToping(Request $request)
    {
        try {
            $token = $request->cookie('token');
            if ($token != null && $token != '') {
                $topping = [
                    'category_topping_id' => $request->category_topping_id,
                    'name' => $request->name,
                    'money' => $request->money,
                    'limit' => $request->limit,
                ];
                $input = json_encode($request->all());

                $url = $this->urlAPI() . '/create-topping-category';
                $client = new Client([
                    'headers' => [
                        'token' => $token,
                        'Content-Type' => 'application/json',
                    ],
                ]);
                $req = $client->post($url, ['body' => $input]);

                $response = json_decode($req->getBody()->getContents(), true);

                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('dish.detailDish', ['id' => $request->dish_id]);
                } else {
                    alert()->error($response['message'], '');
                    return back();
                }
            } else {
                return view('welcome');
            }
        } catch (\Throwable $th) {
            alert($th)->error('H??? th???ng ??ang ???????c b???o tr??. Vui l??ng th??? l???i sau!');
            return back();
        }
    }
    public function deleteTopping(Request $request, $id)
    {
        try {
            $token = $request->cookie('token');
            if ($token != null && $token != '') {
                $body = [
                    'topping_id' => $id,
                ];
                $input = json_encode($body);

                $url = $this->urlAPI() . '/delete-topping-dish';
                $client = new Client([
                    'headers' => [
                        'token' => $token,
                        'Content-Type' => 'application/json',
                    ],
                ]);
                $req = $client->post($url, ['body' => $input]);

                $response = json_decode($req->getBody()->getContents(), true);

                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                } else {
                    alert()->warning($response['message']);
                }
                return back();
            } else {
                return view('welcome');
            }
        } catch (\Throwable $th) {
            alert()->error('H??? th???ng ??ang ???????c b???o tr??. Vui l??ng th??? l???i sau!');
            return back();
        }
    }

    public function updateDishTopping(Request $request)
    {
        try {
            $token = $request->cookie('token');
            if ($token != null && $token != '') {
                $topping = [
                    'name' => $request->name,
                    'topping_id' => $request->topping_id,
                    'money' => $request->money,
                ];

                $input = json_encode($topping);
                $url = $this->urlAPI() . '/update-topping-dish';
                $client = new Client([
                    'headers' => [
                        'token' => $token,
                        'Content-Type' => 'application/json',
                    ],
                ]);
                $req = $client->post($url, ['body' => $input]);

                $response = json_decode($req->getBody()->getContents(), true);

                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('dish.detailDish', ['id' => $request->dish_id]);
                } else {
                    alert()->error($response['message'], '');
                    return back();
                }
            } else {
                return view('welcome');
            }
        } catch (\Throwable $th) {
            alert($th)->error('H??? th???ng ??ang ???????c b???o tr??. Vui l??ng th??? l???i sau!');
            return back();
        }
    }
}
