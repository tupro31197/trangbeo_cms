<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ControllerBase;
use App\Helpers\Helpers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class OrderController extends ControllerBase
{
    public function listOrder(Request $request, $page, $status)
    {
        try {
            $token = $request->cookie('token');

            $client = new Client([
                'headers' => [
                    'token' => $token,
                ],
            ]);
            $url = $this->urlAPI() . '/list-order?page=' . $page . '&status=' . $status;

            if ($request->order_code) {
                $url = $url . '&search=' . $request->order_code;
            }
            $data = $client->get($url);

            $response = json_decode($data->getBody()->getContents(), true);
            $orders = $response['data'];
            if ($response['status'] == 0) {
                alert()->warning($response['message']);
                return back();
            }
            return view('includes.order.index', compact('orders', 'status'));
        } catch (\Throwable $th) {
            alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function updateOrder(Request $request, $code)
    {
        // try {
        $token = $request->cookie('token');

        $body = [
            'order_code' => $code,
        ];
        $input = json_encode($body);
        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'token' => $token,
            ],
        ]);
        $status = $request->status;
        $url = '';
        if ($status == 4) {
            $url = $this->urlAPI() . '/store-confirm-order';
        } elseif ($status == 5) {
            $url = $this->urlAPI() . '/finish-order';
        } elseif ($status == 8) {
            $url = $this->urlAPI() . '/cancel-order';
        }
        $req = $client->post($url, ['body' => $input]);
        $response = json_decode($req->getBody()->getContents(), true);

        if ($response['status'] == 0) {
            alert()->warning($response['message']);
            return back();
        }
        alert()->success($response['message']);
        $url = redirect()
            ->route('order.listOrder', ['page' => 1, 'status' => 0])
            ->getTargetUrl();

        return redirect($url);
        // } catch (\Throwable $th) {
        //     alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
        //     return back();
        // }
    }
}
