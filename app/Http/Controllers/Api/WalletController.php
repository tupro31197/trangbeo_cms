<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ControllerBase;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

class WalletController extends ControllerBase
{
    public function myWallet(Request $request, $page)
    {
        try {
            if ($request->status) {
                $status = $request->status;
            } else {
                $status = '';
            }
            if ($request->from_date) {
                $from_date = date('Y-m-d', strtotime($request->from_date));
            } else {
                $from_date = '';
            }
            if ($request->to_date) {
                $to_date = date('Y-m-d', strtotime($request->to_date));
            } else {
                $to_date = '';
            }

            $token = $request->cookie('token');
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                ],
            ]);

            $data = $client->get($this->urlAPI() . '/ctv/wallet/withdraw-wallet?page=' . $page . '&status=' . $status . '&from_date=' . $from_date . '$to_date=' . $to_date);
            $response = json_decode($data->getBody()->getContents(), true);
            $withdraw = $response['data'];

            $data2 = $client->get($this->urlAPI() . '/ctv/wallet/recharge-wallet?page=' . $page . '&status=' . $status . '&from_date=' . $from_date . '$to_date=' . $to_date);
            $response2 = json_decode($data2->getBody()->getContents(), true);
            $recharge = $response2['data'];

            return view('includes.wallet.myWallet', compact('withdraw', 'recharge', 'status', 'from_date', 'to_date'));
        } catch (\Throwable $th) {
            alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function detailWallet(Request $request, $type, $id)
    {
        try {
            $token = $request->cookie('token');
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                ],
            ]);

            $withdraw = '';
            $recharge = '';
            $reward = '';
            if ($type == 'rut-tien') {
                $data = $client->get($this->urlAPI() . "/ctv/wallet/withdraw-wallet-detail/$id");
                $response = json_decode($data->getBody()->getContents(), true);
                $withdraw = $response['data'];
            } elseif ($type == 'nap-tien') {
                $data = $client->get($this->urlAPI() . "/ctv/wallet/recharge-wallet-detail/$id");
                $response = json_decode($data->getBody()->getContents(), true);
                $recharge = $response['data'];
            } elseif ($type == 'vi-thuong') {
                $data = $client->get($this->urlAPI() . "/ctv/wallet/reward-wallet-detail/$id");
                $response = json_decode($data->getBody()->getContents(), true);
                $reward = $response['data'];
            }

            if ($response['status'] == 0) {
                alert()->warning($response['message']);
                return back();
            }

            return view('includes.wallet.detailWallet', compact('withdraw', 'recharge', 'reward'));
        } catch (\Throwable $th) {
            alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function createWallet(Request $request)
    {
        try {
            $token = Cookie::get('token');

            if (isset($token) && $token != null) {
                $file_name = $request->file('image');
                if (isset($file_name) && $file_name != null) {
                    $image_path = $file_name->getPathname();
                    $image_mime = $file_name->getmimeType();
                    $image_org = $file_name->getClientOriginalName();
                    $image = [
                        'name' => 'image',
                        'filename' => $image_org,
                        'Mime-Type' => $image_mime,
                        'contents' => fopen($image_path, 'r'),
                    ];
                } else {
                    $image = [
                        'name' => 'image',
                        'contents' => '',
                    ];
                }

                $url = $this->urlAPI() . '/ctv/wallet/create-wallet';
                $client = new Client([
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Content-Type' => 'application/json',
                    ],
                ]);
                $req = $client->post(
                    $url,
                    [
                        'multipart' => [
                            $image,
                            [
                                'name' => 'wallet',
                                'contents' => $request->wallet,
                            ],
                            [
                                'name' => 'account_name',
                                'contents' => $request->account_name,
                            ],
                            [
                                'name' => 'bank_name',
                                'contents' => $request->bank_name,
                            ],
                            [
                                'name' => 'branch',
                                'contents' => $request->branch,
                            ],
                            [
                                'name' => 'account_stk',
                                'contents' => $request->account_stk,
                            ],
                            [
                                'name' => 'money',
                                'contents' => $request->money,
                            ],
                            [
                                'name' => 'content',
                                'contents' => $request->content,
                            ],
                        ],
                    ],
                    // ['form_params']
                );

                $response = json_decode($req->getBody()->getContents(), true);

                // dd($response);
                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('myWallet', ['page' => 1]);
                } else {
                    alert()->warning($response['message']);
                    return back();
                }

                return redirect()->back();
            }

            return view('admin.includes.login');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function rewardWallet(Request $request, $page)
    {
        try {
            $token = $request->cookie('token');
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                ],
            ]);

            if ($request->status) {
                $status = $request->status;
            } else {
                $status = '';
            }
            if ($request->from_date) {
                $from_date = date('Y-m-d', strtotime($request->from_date));
            } else {
                $from_date = '';
            }
            if ($request->to_date) {
                $to_date = date('Y-m-d', strtotime($request->to_date));
            } else {
                $to_date = '';
            }

            $data = $client->get($this->urlAPI() . "/ctv/wallet/reward-wallet?page=$page&status=$status&from_date=$from_date&to_date=$to_date");
            $response = json_decode($data->getBody()->getContents(), true);
            $reward = $response['data'];

            return view('includes.wallet.rewardWallet', compact('reward'));
        } catch (\Throwable $th) {
            alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function rewardToWallet(Request $request)
    {
        try {
            $token = Cookie::get('token');

            if (isset($token) && $token != null) {
                $body = [
                    'money' => $request->money,
                    'content' => $request->content,
                ];
                // dd($body);
                $input = json_encode($body);

                $url = $this->urlAPI() . '/ctv/wallet/reward-to-wallet';
                $client = new Client([
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Content-Type' => 'application/json',
                    ],
                ]);
                $req = $client->post($url, ['body' => $input]);

                $response = json_decode($req->getBody()->getContents(), true);

                // dd($response);
                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('rewardWallet', ['page' => 1]);
                } else {
                    alert()->warning($response['message']);
                    return back();
                }

                return redirect()->back();
            }

            return view('admin.includes.login');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }
}
