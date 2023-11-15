<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\UsersShippingAddresses;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    private $userController;

    public function __construct(UserController $userController)
    {
        $this->userController = $userController;
    }

    public function index(){
        $priceShippingSPX = 0;
        $Weight = 1;
        $seller = Seller::where("id", 1)->first();
        $dataShipping = UsersShippingAddresses::where("user_id", auth()->user()->id)->where("is_used", 1)->first();
        if($dataShipping && $dataShipping->count() > 0){
            $idProvinceTo = $this->userController->getIDSubLocation(-1,$dataShipping->province);
            $idCityTo = $this->userController->getIDSubLocation($idProvinceTo,$dataShipping->city);
            $idDistrictTo = $this->userController->getIDSubLocation($idCityTo,$dataShipping->district);
            $idProvinceFrom = $this->userController->getIDSubLocation(-1,$seller->province);
            $idCityFrom = $this->userController->getIDSubLocation($idProvinceFrom,$seller->city);
            $idDistrictFrom = $this->userController->getIDSubLocation($idCityFrom,$seller->district);
            $priceShippingSPX = $this->getPriceShippingSPX($idProvinceTo, $idCityTo, $idDistrictTo, $dataShipping->province, $dataShipping->city, $dataShipping->district,  $idProvinceFrom , $idCityFrom, $idDistrictFrom, $seller->province, $seller->city, $seller->district, $Weight);
        }
        return view('checkout.default', ['dataShipping' => $dataShipping, 'priceShippingSPX' => $priceShippingSPX]);
    }


    public function getPriceShippingSPX($idProvinceTo, $idCityTo, $idDistrictTo, $provinceTo, $cityTo, $districtTo,  $idProvinceFrom , $idCityFrom, $idDistrictFrom, $provinceFrom, $cityFrom, $districtFrom, $Weight){
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
        CURLOPT_POSTFIELDS =>'{
            "list": [
                {
                    "from": {
                        "post_code": "",
                        "admin_address": [
                            {
                                "label": "'.$provinceFrom.'",
                                "value": '.$idProvinceFrom.'
                            },
                            {
                                "label": "'.$cityFrom.'",
                                "value": '.$idCityFrom.'
                            },
                            {
                                "label": "'.$districtFrom.'",
                                "value": '.$idDistrictFrom.'
                            }
                        ],
                        "detail_address": ""
                    },
                    "to": {
                        "post_code": "",
                        "admin_address": [
                            {
                                "label": "'.$provinceTo.'",
                                "value": '.$idProvinceTo.'
                            },
                            {
                                "label": "'.$cityTo.'",
                                "value": '.$idCityTo.'
                            },
                            {
                                "label": "'.$districtTo.'",
                                "value": '.$idDistrictTo.'
                            }
                        ],
                        "detail_address": ""
                    },
                    "parcel_weight": '.$Weight.',
                    "sender_info": {
                        "sender_country": "VN",
                        "sender_post_code": "",
                        "sender_admin_address": [
                            {
                                "label": "'.$provinceFrom.'",
                                "value": '.$idProvinceFrom.'
                            },
                            {
                                "label": "'.$cityFrom.'",
                                "value": '.$idCityFrom.'
                            },
                            {
                                "label": "'.$districtFrom.'",
                                "value": '.$idDistrictFrom.'
                            }
                        ],
                        "sender_detail_address": "",
                        "sender_state": "'.$provinceFrom.'",
                        "sender_state_location_id": '.$idProvinceFrom.',
                        "sender_city": "'.$cityFrom.'",
                        "sender_city_location_id": '.$idCityFrom.',
                        "sender_district": "'.$districtFrom.'",
                        "sender_district_location_id": '.$idDistrictFrom.',
                        "sender_address_id": "5749782345442508"
                    },
                    "deliver_info": {
                        "deliver_country": "VN",
                        "deliver_post_code": "",
                        "deliver_admin_address": [
                            {
                                "label": "'.$provinceTo.'",
                                "value": '.$idProvinceTo.'
                            },
                            {
                                "label": "'.$cityTo.'",
                                "value": '.$idCityTo.'
                            },
                            {
                                "label": "'.$districtTo.'",
                                "value": '.$idDistrictTo.'
                            }
                        ],
                        "deliver_detail_address": "",
                        "deliver_state": "'.$provinceTo.'",
                        "deliver_state_location_id": '.$idProvinceTo.',
                        "deliver_city": "'.$cityTo.'",
                        "deliver_city_location_id": '.$idCityTo.',
                        "deliver_district": "'.$districtTo.'",
                        "deliver_district_location_id": '.$idDistrictTo.',
                        "deliver_address_id": "5749782345442508"
                    },
                    "parcel_info": {
                        "parcel_weight": [
                            '.$Weight.'
                        ],
                        "parcel_category": 0,
                        "parcel_item_quantity": 1
                    },
                    "fulfillment_info": {
                        "pickup_time": 1700038800,
                        "pickup_time_range_id": 1,
                        "collect_type": 1,
                        "cod_collection": 0,
                        "payment_role": 1,
                        "insurance_collection": 1,
                        "deliver_type": 1,
                        "is_pickup_weight": 1
                    },
                    "base_info": {
                        "product_id": 53001,
                        "order_type": 1
                    }
                }
            ]
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        ));
        $response = curl_exec($curl);

        curl_close($curl);
        dd($response);

    }
}
