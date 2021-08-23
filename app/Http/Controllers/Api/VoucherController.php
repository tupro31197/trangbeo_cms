<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ControllerBase;
use App\Helpers\Helpers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class VoucherController extends ControllerBase
{
    public function listVoucher(Request $request, $page)
    {
        try {
            $token = $request->cookie('token');

            $client = new Client([
                'headers' => [
                    'token' => $token,
                ],
            ]);

            $data = $client->get($this->urlAPI() . '/history-voucher?page='.$page);
            $response = json_decode($data->getBody()->getContents(), true);
            $vouchers = $response['data'];

            return view('includes.voucher.index', compact('vouchers'));
        } catch (\Throwable $th) {
            alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function addVoucher(Request $request)
    {
        // try {
            $token = $request->cookie('token');

            $body = [
                'percent' => $request->percent,
            ];
            $input = json_encode($body);
            $client = new Client([
                'headers' => [
                    'Content-Type' => 'application/json',
                    'token' => $token,
                ],
            ]);
           
         $url = $this->urlAPI() . '/create-voucher';
          
            $req = $client->post($url, ['body' => $input]);
            $response = json_decode($req->getBody()->getContents(), true);
          
            if ($response['status'] == 0) {
                alert()->warning($response['message']);
                return back();
            }
            alert()->success($response['message']);
            $url = redirect()
                ->route('voucher.listVoucher', ['page' => 1])
                ->getTargetUrl();

            return redirect($url);
        // } catch (\Throwable $th) {
        //     alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
        //     return back();
        // }
    }

    public function updateVoucher(Request $request, $id)
    {
        // try {
            $token = $request->cookie('token');

            $body = [
                'voucher_id' => $id,
            ];
            $input = json_encode($body);
            $client = new Client([
                'headers' => [
                    'Content-Type' => 'application/json',
                    'token' => $token,
                ],
            ]);
           
         $url = $this->urlAPI() . '/update-voucher';
          
            $req = $client->post($url, ['body' => $input]);
            $response = json_decode($req->getBody()->getContents(), true);
          
            if ($response['status'] == 0) {
                alert()->warning($response['message']);
                return back();
            }
            alert()->success($response['message']);
            $url = redirect()
                ->route('voucher.listVoucher', ['page' => 1])
                ->getTargetUrl();

            return redirect($url);
        // } catch (\Throwable $th) {
        //     alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
        //     return back();
        // }
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

}