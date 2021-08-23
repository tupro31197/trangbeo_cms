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
    // public function setCookie($token){
    //     $minutes = 60;
    //     $response = new Response('Set Cookie');
    //     $response->withCookie(cookie('token', $token, $minutes));
    //     return $response;
    //  }
    //  public function getCookie(Request $request){
    //     $value = $request->cookie('token');
    //     return $value;
    //  }
    //  public function checkToken(Request $request)
    // {
    //     $token = $request->cookie('token');
    //     if (isset($token) && $token != null) {
    //         return view('includes.index');
    //     } else {
    //         return view('welcome');
    //     }
    // }

    public function excelUser()
    {
        try {
            $token = Cookie::get('token');
            if (isset($token) && $token != null) {
                $client = new Client([
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                    ],
                ]);
                $data = $client->get($this->urlAPI() . '/User/revenue/list-revenue-User');
                $response = json_decode($data->getBody()->getContents(), true);
                $revenue = $response['data'];

                $datainfor = $client->get($this->urlAPI() . '/User/get-user-infomation');
                $responseinfor = json_decode($datainfor->getBody()->getContents(), true);
                $infor = $responseinfor['data'];

                // dd($response);
                if ($response['status'] == 1) {
                    $listUser = $response['data']['list']['data'];

                    foreach ($listUser as $key => $value) {
                        $User[$key] = [
                            'stt' => $key + 1,
                            'id' => $value['id'],
                            'name' => $value['name'],
                            'email' => $value['email'],
                            'phone' => $value['phone'],
                            'cmt' => $value['cmt'],
                            'address' => $value['address'],
                            'code' => $value['code_branch'] . '-' . $value['code_ordinal'],
                            'identifier_name' => $value['identifier_name'],
                            'user_introduce_id' => $value['user_introduce_id'],
                            'total_money' => $value['total_money'],
                        ];
                    }
                    $export = new UsersExport($User);

                    return Excel::download($export, 'list-User.xlsx');
                    //  dd($infor);
                    return view('includes.revenue.Userrevenue', compact('revenue', 'infor'));
                } else {
                    return redirect()->route('trang-chu');
                }
            }

            return view('includes.index');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

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
        try {
            $token = $request->cookie('token');
            Cookie::queue('token', null);
                return redirect()->route('dang-nhap');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
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

            $data = $client->get($this->urlAPI() . '/list-user?page='.$page);
            $response = json_decode($data->getBody()->getContents(), true);
            $users = $response['data'];

            return view('includes.user.index', compact('users'));
        } catch (\Throwable $th) {
            alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }
}
