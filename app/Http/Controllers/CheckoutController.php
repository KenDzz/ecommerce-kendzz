<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Seller;
use App\Models\UsersOrder;
use App\Models\UsersShippingAddresses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    private $userController;
    private $productController;

    public function __construct(UserController $userController, ProductController $productController)
    {
        $this->userController = $userController;
        $this->productController = $productController;
    }

    public function index(){
        $dataShipping = UsersShippingAddresses::where("user_id", auth()->user()->id)->where("is_used", 1)->first();
        return view('checkout.default', ['dataShipping' => $dataShipping]);
    }

    public function addOrder(){
        $dataPrice = $this->getPriceShippingSPX();
        $dataShipping = UsersShippingAddresses::where("user_id", auth()->user()->id)->where("is_used", 1)->first();
        $index = 0;
        foreach (session('cart') as $id => $details){
            $order = new UsersOrder();
            $order->user_id = auth()->user()->id;
            $order->product_id = $details['id'];
            $order->describes = $details['name'] . "," . $details['category'] . "," . $details['size'];
            $order->quantity = $details['quantity'];
            $order->users_shipping_address_id = $dataShipping->id;
            $order->cost_shipping =  $dataPrice[$index];
            $order->total_price = $details['price'] * $details['quantity'];
            $order->transporters = "SPX";
            $order->url_img = $details['image'];
            $order->save();
            $index++;
        }
    }

    public function pay(){
        $moneyShip = $this->getTotalPriceShippingSPXJson();
        $totalCart = $this->getTotalCart();
        $data['status'] = false;
        DB::beginTransaction();

        try {
            if($this->userController->checkBalance($moneyShip + $totalCart)){
                $user = Auth::user();
                $user->money -= ($moneyShip + $totalCart);
                if($user->save()){
                    $this->addOrder();
                    $this->productController->removeToCartAll();
                    $data['status'] = true;
                    DB::commit();
                }
            } else {
          $data['content'] = "Số dư không đủ";
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $data['content'] = "Lỗi trong quá trình thanh toán.";
        }

        return response()->json($data);
    }


    public function getTotalCart(){
        $total = 0;
        foreach ((array) session('cart') as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }
        return $total;
    }

    public function getPriceShippingSPX(){
        $data['price'] = 0;
        $dataShipping = UsersShippingAddresses::where("user_id", auth()->user()->id)->where("is_used", 1)->first();
        if($dataShipping && $dataShipping->count() > 0 && session('cart')){
            $idProvinceTo = $this->userController->getIDSubLocation(-1,$dataShipping->province);
            $idCityTo = $this->userController->getIDSubLocation($idProvinceTo,$dataShipping->city);
            $idDistrictTo = $this->userController->getIDSubLocation($idCityTo,$dataShipping->district);
            $Weight = 1;
            $dataCurl = ['list' => []];
            $listItems = [];
            foreach (session('cart') as $id => $details){
                $product = Product::Where('id', $details['id'])->first();
                $idProvinceFrom = $this->userController->getIDSubLocation(-1,$product->seller->province);
                $idCityFrom = $this->userController->getIDSubLocation($idProvinceFrom,$product->seller->city);
                $idDistrictFrom = $this->userController->getIDSubLocation($idCityFrom,$product->seller->district);

                $newItem =
                    [
                        'from' => [
                            'post_code' => '',
                            'admin_address' => [
                                ['label' => $product->seller->province, 'value' => $idProvinceFrom],
                                ['label' => $product->seller->city, 'value' => $idCityFrom],
                                ['label' => $product->seller->district, 'value' => $idDistrictFrom],
                            ],
                            'detail_address' => '',
                        ],
                        'to' => [
                            'post_code' => '',
                            'admin_address' => [
                                ['label' => $dataShipping->province, 'value' => $idProvinceTo],
                                ['label' => $dataShipping->city, 'value' => $idCityTo],
                                ['label' => $dataShipping->district, 'value' => $idDistrictTo],
                            ],
                            'detail_address' => '',
                        ],
                        'parcel_weight' => $product->weight * $details['quantity'],
                        'sender_info' => [
                            'sender_country' => 'VN',
                            'sender_post_code' => '',
                            'sender_admin_address' => [
                                ['label' => $product->seller->province, 'value' => $idProvinceFrom],
                                ['label' => $product->seller->city, 'value' => $idCityFrom],
                                ['label' => $product->seller->district, 'value' => $idDistrictFrom],
                            ],
                            'sender_detail_address' => '',
                            'sender_state' => $product->seller->province,
                            'sender_state_location_id' => $idProvinceFrom,
                            'sender_city' => $product->seller->city,
                            'sender_city_location_id' => $idCityFrom,
                            'sender_district' => $product->seller->district,
                            'sender_district_location_id' => $idDistrictFrom,
                            'sender_address_id' => '5749782345442508',
                        ],
                        'deliver_info' => [
                            'deliver_country' => 'VN',
                            'deliver_post_code' => '',
                            'deliver_admin_address' => [
                                ['label' => $dataShipping->province, 'value' => $idProvinceTo],
                                ['label' =>$dataShipping->city, 'value' => $idCityTo],
                                ['label' => $dataShipping->district, 'value' => $idDistrictTo],
                            ],
                            'deliver_detail_address' => '',
                            'deliver_state' => $dataShipping->province,
                            'deliver_state_location_id' => $idProvinceTo,
                            'deliver_city' => $dataShipping->city,
                            'deliver_city_location_id' => $idCityTo,
                            'deliver_district' => $dataShipping->district,
                            'deliver_district_location_id' => $idDistrictTo,
                            'deliver_address_id' => '5749782345442508',
                        ],
                        'parcel_info' => [
                            'parcel_weight' => [$product->weight * $details['quantity']],
                            'parcel_category' => 0,
                            'parcel_item_quantity' => 1,
                        ],
                        'fulfillment_info' => [
                            'pickup_time' => 2000038800,
                            'pickup_time_range_id' => 1,
                            'collect_type' => 1,
                            'cod_collection' => 0,
                            'payment_role' => 1,
                            'insurance_collection' => 1,
                            'deliver_type' => 1,
                            'is_pickup_weight' => 1,
                        ],
                        'base_info' => [
                            'product_id' => 53001,
                            'order_type' => 1,
                        ],
                    ];


                $listItems[] = $newItem;
            }
            $dataCurl['list'] = $listItems;
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => env('API_ORDER_SPX'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($dataCurl),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
            ));
            $response = curl_exec($curl);

            curl_close($curl);
            $resp = json_decode($response,true);
            $price = [];
            foreach ($resp['data']['list'] as $key => $value) {
                foreach ($value['fee_info']  as $key2 => $value2){
                    $price[$key2] = $value2['estimated_shipping_fee'];
                }
            }
        }
        return $price;
    }

    public function getTotalPriceShippingSPXJson(){
        $dataPrice = $this->getPriceShippingSPX();
        $total = 0;
        foreach ($dataPrice as $key => $value) {
            $total += $value;
        }
        return $total;
    }

    public function getPriceShippingSPXJson(){
        $data['price'] = $this->getTotalPriceShippingSPXJson();
        return response()->json($data);
    }
}
