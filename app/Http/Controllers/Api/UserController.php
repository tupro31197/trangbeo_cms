<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ControllerBase;
use App\Helpers\Helpers;
use GuzzleHttp\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

class UserController extends ControllerBase
{
    public function register(Request $request)
    {
        try {
            $body = [
                'name' => $request->name,
                'phone' => $request->phone,
                'cmt' => $request->cmt,
                'address' => $request->address,
                'password' => $request->password,
                'password_confirmation' => $request->password_confirmation,
                'key' => $request->key,
            ];
            $input = json_encode($body);

            $url = $this->urlAPI() . '/User/register-User';
            $client = new Client([
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]);
            $req = $client->post($url, ['body' => $input]);
            $response = json_decode($req->getBody()->getContents(), true);

            if ($response['status'] == 0) {
                alert()->warning($response['message']);
                return back();
            } else {
                $url = redirect()
                    ->route('trang-chu')
                    ->getTargetUrl();
                return redirect($url)->withCookie(cookie('token', $response['data']['token'], 1440));
            }
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }
    public function login(Request $request)
    {
        try {
            $body = [
                'phone' => $request->phone,
                'password' => $request->password,
            ];

            $input = json_encode($body);
            $url = $this->urlAPI() . '/login';
            $client = new Client([
                'headers' => ['Content-Type' => 'application/json'],
            ]);
            $req = $client->post($url, ['body' => $input]);

            $response = json_decode($req->getBody()->getContents(), true);
            // dd($response);

            if ($response['status'] == 0) {
                alert()->warning($response['message']);
                return back();
            } else {
                alert()->success($response['message']);
                $url = redirect()
                    ->route('trang-chu')
                    ->getTargetUrl();
                Cookie::queue('user_id', $response['data']['user']['id'], 1440);
                // cookie('user_id', $response['data']['user']['id'], 1440);
                return redirect($url)->withCookie(cookie('token', $response['data']['token'], 1440));
            }
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function logout(Request $request)
    {
        // try {
        $token = $request->cookie('token');
        $client = new Client();
        $data = $client->get($this->urlAPI() . '/logout', [
            'headers' => [
                'token' => $token,
                'Accept' => 'application/json',
            ],
        ]);
        $response = json_decode($data->getBody()->getContents(), true);

        if ($response['status'] == 1) {
            Cookie::queue(Cookie::forget('token'));
            return redirect()->route('dang-nhap');
        }

        return redirect()
            ->route('trang-chu')
            ->getTargetUrl();
        // } catch (\Throwable $th) {
        //     alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
        //     return back();
        // }
    }

    public function listUser(Request $request, $page)
    {
        try {
            $token = $request->cookie('token');

            $client = new Client([
                'headers' => [
                    'token' => $token,
                ],
            ]);

            $data = $client->get($this->urlAPI() . '/list-user?page=' . $page);
            $response = json_decode($data->getBody()->getContents(), true);
            $users = $response['data'];

            return view('includes.user.index', compact('users'));
        } catch (\Throwable $th) {
            alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function updateInfoPayment(Request $request)
    {
        // try{
        $token = $request->cookie('token');

        $topping = [
            'name' => $request->name,
            'bank_number' => $request->bank_number,
            'bank_name' => $request->bank_name,
            'agency' => $request->agency,
            'payment_id' => $request->id
        ];
        // dd($topping);
        $input = json_encode($topping);
        $url = $this->urlAPI() . '/info-payment';
        $client = new Client([
            'headers' => [
                'token' => $token,
                'Content-Type' => 'application/json',
            ],
        ]);
        $req = $client->post($url, ['body' => $input]);
        // dd($req);

        $response = json_decode($req->getBody()->getContents(), true);
        // dd($response);
        if ($response['status'] == 1) {
            alert()->success($response['message']);
            return redirect()->route('trang-chu');
        } else {
            alert()->error($response['message'], '');
            return back();
        }
        // } catch (\Throwable $th) {
        //         alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
        //         return back();
        //     }
    }
}
