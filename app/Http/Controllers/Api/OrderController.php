<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ControllerBase;
use App\Helpers\Helpers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

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
            $body = Session::get('order');

            if (isset($request->order_code)) {
                $order_code = $request->order_code;
            } elseif (isset($body['order_code']) && isset($body['page']) && $page != $body['page']) {
                $order_code = $body['order_code'];
            } else {
                $order_code = '';
            }

            if (isset($request->type_payment)) {
                $type_payment = $request->type_payment;
            } elseif (isset($body['type_payment']) && isset($body['page']) && $page != $body['page']) {
                $type_payment = $body['type_payment'];
            } else {
                $type_payment = '';
            }

            $body = [
                'order_code' => $order_code,
                'type_payment' => $type_payment,
                'page' => $page,
            ];

            Session::put('order', $body);

            $url = $this->urlAPI() . '/list-order?page=' . $page . '&status=' . $status . '&search=' . $order_code . '&type_payment=' . $type_payment;

            $data = $client->get($url);

            $response = json_decode($data->getBody()->getContents(), true);
            $orders = $response['data'];
            if ($response['status'] == 0) {
                alert()->warning($response['message']);
                return back();
            }
            return view('includes.order.index', compact('orders', 'status', 'type_payment', 'order_code'));
        } catch (\Throwable $th) {
            alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function updateOrder(Request $request, $code)
    {
        try {
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
            if ($status == 9) {
                $url = $this->urlAPI() . '/store-confirm-order';
            } elseif ($status == 5) {
                $url = $this->urlAPI() . '/finish-order';
            } elseif ($status == 8) {
                $url = $this->urlAPI() . '/cancel-order';
            } elseif ($status == 4) {
                $url = $this->urlAPI() . '/store-comming-order';
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
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }
}
