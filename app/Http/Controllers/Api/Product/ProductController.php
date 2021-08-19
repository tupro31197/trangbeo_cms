<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Api\Admin\CtvController;
use App\Http\Controllers\ControllerBase;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Response;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrderExport;
use App\Exports\PacketExport;


class ProductController extends ControllerBase
{
    public function listProduct(Request $request, $page)
    {
        try {
            $token = $request->cookie('token');
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ],
            ]);

            $data = $client->get($this->urlAPI() . "/ctv/product/list-product?page=" .$page);
            $response = json_decode($data->getBody()->getContents(), true);
            $listProduct = $response['data']['data'];

            $datainfor = $client->get($this->urlAPI() . "/ctv/get-user-infomation");
            $responseinfor = json_decode($datainfor->getBody()->getContents(), true);
            $infor = $responseinfor['data'];


            return view('includes.product.list_product', compact('listProduct', 'response', 'infor'));
        } catch (\Throwable $th) {
            alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    } 
    public function detailProduct($id, Request $request)
    {
        try {
            $token = $request->cookie('token');
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ],
            ]);

            $data = $client->get($this->urlAPI() . "/ctv/product/detail-product/".$id);
            $response = json_decode($data->getBody()->getContents(), true);
            $detailProduct = $response['data'];

            return view('includes.product.detail_product', compact('detailProduct'));
        } catch (\Throwable $th) {
            alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    } 

    public function addCart( Request $request){
        try {
            $token = $request->cookie('token');
           
            $body = [
                'product_id' => $request->id
            ];
                $input = json_encode($body);
                
                $url = $this->urlAPI() . '/ctv/product/add-cart';
                $client = new Client([
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Bearer ' . $token
                    ],
                ]);
                $req = $client->post($url,
                    ['body' => $input]
                );
                $response = json_decode($req->getBody()->getContents(), true);
              
                if ($response['status'] == 0) {
                  
                    return 0;
                }
                else {

                    $data2 = $client->get($this->urlAPI() . "/ctv/product/detail-cart");
                    $response2 = json_decode($data2->getBody()->getContents(), true);
                    $total = $response2['data']['total_number'];
        
                    return $total;
                    
                }
                // $url = redirect()->route('danh-sach-san-pham', ['page'=>1])->getTargetUrl();
               
                //     return redirect($url);
            } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function updateCart(Request $request){
        try {
            $token = $request->cookie('token');
           
            $body = [
                'product_id' => $request->id,
                'number'     => $request->qty,
                '_method'    => 'put'
            ];
                $input = json_encode($body);
               
                $url = $this->urlAPI() . '/ctv/product/update-cart';
                $client = new Client([
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Bearer ' . $token
                    ],
                ]);
                $req = $client->post($url,
                    ['body' => $input]
                );
                $response = json_decode($req->getBody()->getContents(), true);
           
                if ($response['status'] == 1) {
                    $data2 = $client->get($this->urlAPI() . "/ctv/product/detail-cart");
                    $response2 = json_decode($data2->getBody()->getContents(), true);
                    $cart = [
                        'product' => ($response['data']['number']*$response['data']['price']),
                        'total_product' => $response2['data']['total_number'],
                        'total_money_product' => $response2['data']['total_money']
                    ];
        
                    return $cart;
                }
                
                $url = redirect()->route('danh-sach-san-pham', ['page'=>1])->getTargetUrl();
               
                    return redirect($url);
                } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function detailCart(Request $request){
        try {
            $token = $request->cookie('token');
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ],
            ]);

            $data = $client->get($this->urlAPI() . "/ctv/product/detail-cart");
            $response = json_decode($data->getBody()->getContents(), true);
            $cart = $response['data'];

            return view('includes.product.cart', compact('cart'));
        } catch (\Throwable $th) {
            alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function infoOrder(Request $request){
        try {
            
            $token = $request->cookie('token');
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ],
            ]);

            $data = $client->get($this->urlAPI() . "/ctv/get-user-infomation");
            $response = json_decode($data->getBody()->getContents(), true);
            $infor = $response['data'];

            return view('includes.product.infoOrder', compact('infor'));
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function createOrder(Request $request){
       try {
        $token = $request->cookie('token');
        $money = (int)str_replace([',','.',':', '\\', '/', '*'],'',$request->total_money_product);
        $body = [
            'name_user' => $request->name_user,
            'phone_order' => $request->phone_order,
            'address_order' => $request->address_order,
            'total_product' => $request->total_product,
            'total_money_product' => $money,
            'content' => $request->content,

        ];
            $input = json_encode($body);
            
            $url = $this->urlAPI() . '/ctv/product/order';
            $client = new Client([
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $token
                ],
            ]);
            $req = $client->post($url,
                ['body' => $input]
            );
            $response = json_decode($req->getBody()->getContents(), true);
    
            if ($response['status'] == 0) {
                alert()->warning($response['message']);
                return back();
            }
            else {
                alert()->success($response['message']);
                $url = redirect()->route('danh-sach-san-pham', ['page'=>1])->getTargetUrl();
           
                return redirect($url);
            }
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    
    public function listOrder(Request $request, $page){
        try {
            
            $token = $request->cookie('token');
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ],
            ]);

            $data = $client->get($this->urlAPI() . "/ctv/product/list-order?page=" .$page);
            $response = json_decode($data->getBody()->getContents(), true);
            $listOrder = $response['data'];
            // dd($infor);

            return view('includes.product.listOrder', compact('listOrder'));
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function excelOrder(Request $request){
        try {
            
            $token = $request->cookie('token');
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ],
            ]);

            $data = $client->get($this->urlAPI() . "/ctv/product/excel-order");
            $response = json_decode($data->getBody()->getContents(), true);
            $listOrder = $response['data'];
            $key=0;
            foreach ($listOrder as  $index=>$value) {
                
                if($value['status']==1) $status = 'Chờ xác nhận';
                else if($value['status']==2) $status = 'Đang giao hàng';
                else if($value['status']==3) $status = 'Đã giao hàng';
                else if($value['status']==4) $status = 'Đã huỷ';
                $order[$key ] = [
                    'stt' => $index + 1,
                    'id' => $value['id'],
                    'ctv' => $value['user']['code_branch'] .'-'.$value['user']['code_ordinal'],
                    'name' => $value['name_user'],
                    'address' => $value['address_order'],
                    'phone' => $value['phone_order'],
                    'total_product'  => $value['total_product'],
                    'total_money_product' => $value['total_money_product'],
                    'ship'=>$value['ship'],
                    'status' => $status,
                ];
               
                foreach ($value['detail_order'] as $key2 => $value2) {
                    $dem = 11;
                    $order[$key][$dem] = $value2['product_name'];
                    $order[$key][++$dem] = $value2['number'];
                    $order[$key][++$dem] = $value2['price'];
                    $key++;
                    $order[$key ] = [
                        'stt' => '',
                        'id' =>'',
                        'ctv' => '',
                        'name' => '',
                        'address' => '',
                        'phone' => '',
                        'total_product'  => '',
                        'total_money_product' => '',
                        'ship'=>'',
                        'status' => '',
                    ];
                }
                $key++;
            }
            // dd($order);
            $export = (new OrderExport($order));
            
                 return Excel::download($export, 'don-hang.xlsx');
            // dd($infor);

            return view('includes.product.listOrder', compact('listOrder'));
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function detailOrder(Request $request, $id){
        try {
            
            $token = $request->cookie('token');
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ],
            ]);

            $data = $client->get($this->urlAPI() . "/ctv/product/detail-order/" .$id);
            $response = json_decode($data->getBody()->getContents(), true);
            if($response['status'] == 0){
                alert()->warning($response['message']);
                return back();
            }
            $detail = $response['data'];
            return view('includes.product.detailOrder', compact('detail'));
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function listContent($i, Request $request)
    {
        try {

        $token = Cookie::get('token');
        if (isset($token) && $token != null) {
            $body = Session::get('content');

            if (isset($request->from_date)) {
                $from_date = $request->from_date;
            } elseif (isset($body['from_date']) && isset($body['page']) && $i != $body['page']) {
                $from_date = $body['from_date'];
            } else {
                $from_date = '';
            }

            if (isset($request->to_date)) {
                $to_date = $request->to_date;
            } elseif (isset($body['to_date']) && isset($body['page']) && $i != $body['page']) {
                $to_date = $body['to_date'];
            } else {
                $to_date = '';
            }

            if (isset($request->title)) {
                $title = $request->title;
            } elseif (isset($body['title']) && isset($body['page']) && $i != $body['page']) {
                $title = $body['title'];
            } else {
                $title = null;
            }

            if (isset($request->category_id)) {
                $category_id = $request->category_id;
            } elseif (isset($body['category_id']) && isset($body['page']) && $i != $body['page']) {
                $category_id = $body['category_id'];
            } else {
                $category_id = null;
            }

            if (isset($request->user_id)) {
                $user_id = $request->user_id;
            } elseif (isset($body['user_id']) && isset($body['page']) && $i != $body['page']) {
                $user_id = $body['user_id'];
            } else {
                $user_id = null;
            }

            $body = [
                'from_date' => $from_date,
                'to_date' => $to_date,
                'title' => $title,
                'category_id' => $category_id,
                'user_id' => $user_id,
                'page'  => $i,
            ];
            // dd($body);
            //dd($body);
            Session::put('content', $body);


            $client = new Client();
        
                $data = $client->get($this->urlAPI() . "/admin/content/list-content?title=$title&category_id=$category_id&from_date=$from_date&to_date=$to_date&user_id=$user_id&page=$i", [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
            


            $response = json_decode($data->getBody()->getContents(), true);
            $listContent = $response['data'];

            $data = $client->get($this->urlAPI() . '/admin/content/list-all-category', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ],
            ]);
            // dd($listContent);
            $response = json_decode($data->getBody()->getContents(), true);
            $listCategory = $response;

            $data = $client->get($this->urlAPI() . '/admin/content/listUserContent', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ],
            ]);
            // dd($listContent);
            $response = json_decode($data->getBody()->getContents(), true);
            $listUserContent = $response['data'];
            // dd($listUserContent);

            return view('includes.content.listContent', compact('listContent', 'listCategory','listUserContent', 'from_date', 'to_date', 'title', 'category_id', 'user_id'));
        }

        // return view('includes.index');
    } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function detailContent($id, Request $request)
    {
        try {

        $token = Cookie::get('token');
        if (isset($token) && $token != null) {

            $client = new Client();
            $data = $client->get($this->urlAPI() . '/admin/content/detail-content/' .$id, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ],
            ]);
            $response = json_decode($data->getBody()->getContents(), true);
            // dd($response);
            if ($response['status'] == 1) {
                $content = $response['data'];
            } else {
                
                    alert()->warning($response['message']);

                return redirect()->route('trang-chu');
            }
            // dd($listOrder);
            return view('includes.content.detailContent', compact('content'));
        }

        return view('includes.index');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function deleteCart(Request $request,$id)
    {
        try {
            $token = $request->cookie('token');
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ],
            ]);

            $data = $client->delete($this->urlAPI() . "/ctv/product/delete-cart/" .$id);
            $response = json_decode($data->getBody()->getContents(), true);
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
    public function excelPacket()
    {
        try {
        $token = Cookie::get('token');
        if (isset($token) && $token != null) {

            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                ],
            ]);
            $data = $client->get($this->urlAPI() . "/ctv/packet/excel-packet");
            $response = json_decode($data->getBody()->getContents(), true);

            // dd($response);
            if ($response['status'] == 1) {
                $listPacket = $response['data'];
               
                foreach ($listPacket as $key => $value) {
                    if($value['status']==1) $status = 'Chờ xác nhận';
                    else if($value['status']==2) $status = 'Đang giao hàng';
                    else if($value['status']==3) $status = 'Đã giao hàng';
                    else if($value['status']==4) $status = 'Đã huỷ';

                    $packet[$key ] = [
                        'stt' => $key + 1,
                        'packet_id' => $value['packet_id'],
                        'packet_name' => $value['packet']['name'],
                        'price'  => $value['price'],
                        'code'  => $value['code_ctv'],
                        'name' => $value['name'],
                        'address' => $value['address'],
                        'phone' => $value['phone'],
                        'status' => $status,
                        'content' => $value['content'],
                     
                    ];
                }
                $export = (new PacketExport($packet));

                 return Excel::download($export, 'ds-mua-goi.xlsx');
                //  dd($infor);
                 return view('includes.revenue.ctvrevenue', compact('revenue', 'infor'));
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

    public function viewOrderKH(Request $request)
    {
        try {
            $product_id = $request->id;
            $cmt = base64_decode($request->key);
            if($product_id && $cmt){
                $client = new Client();
    
                $data = $client->get($this->urlAPI() . "/share-product/".$product_id);
                $response = json_decode($data->getBody()->getContents(), true);
                $detailProduct = $response['data']['product'];
                $slider = $response['data']['slider'];
            
                $data2 = $client->get($this->urlAPI() . "/infor-ctv/" .$cmt);
                $response2 = json_decode($data2->getBody()->getContents(), true);
                $ctv = $response2['data'];
               if($ctv == null ){
                   alert()->warning('Không có thông tin phù hợp!');
                   return view('welcome');
               }
                return view('includes.shareProduct.shareProduct', compact('detailProduct', 'cmt', 'slider', 'ctv'));
            }
          
        } catch (\Throwable $th) {
            alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    } 

    public function createOrderKH(Request $request){
           try {
           $cmt = $request->cmt;
            $body = [
                'name_user' => $request->name_user,
                'phone_order' => $request->phone_order,
                'address_order' => $request->address_order,
                'product_id' => $request->product_id,
                'number' => $request->number,
                'content' => $request->content,
                'cmt' => $cmt  
            ];
                $input = json_encode($body);
                
                $url = $this->urlAPI() . '/create-order';
                $client = new Client([
                    'headers' => [
                        'Content-Type' => 'application/json',
                       
                    ],
                ]);
                $req = $client->post($url,
                    ['body' => $input]
                );
                $response = json_decode($req->getBody()->getContents(), true);
                
                $data2 = $client->get($this->urlAPI() . "/share-product/".$request->product_id);
                $response2 = json_decode($data2->getBody()->getContents(), true);
                $detailProduct = $response2['data'];
        
                if ($response['status'] == 0) {
                    alert()->warning($response['message']);
                   
                }
                else {
                    alert()->success($response['message']);
                
                }
                return back();
           } catch (\Throwable $th) {
               //throw $th;
           }
        }
    

}