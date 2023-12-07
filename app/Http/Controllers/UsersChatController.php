<?php

namespace App\Http\Controllers;

use App\Events\NewMessageSellerEvent;
use App\Events\NewMessageUserEvent;
use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use App\Models\UsersChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UsersChatController extends Controller
{

    public function addMsgDefault(Request $request){
        $checkInfo = $request->validate([
            'productID' => ['required', 'numeric'],
            'sendID' => ['required', 'numeric']
        ]);
        $status = false;
        $receiverID = Product::where('id', $checkInfo['productID'])->first();
        if($receiverID){
            $chat = new UsersChat();
            $chat->senderID = $receiverID->seller_id;
            $chat->receiverID = Auth::user()->id;
            $chat->message = "Xin chào ".Auth::user()->name;
            $chat->product_id = $checkInfo['productID'];
            $chat->user_type = "seller";
            if($chat->save()){
                $status = true;
            }

        }
        return response()->json(['status' => $status] );
    }

    public function listChatSeller(){
        $UsersChatOne = UsersChat::where('user_type', 'seller')->Where('senderID', Auth::user()->seller->id)->orderBy('created_at', 'DESC')->get();
        $UsersChatSecond = UsersChat::where('user_type', 'user')->Where('receiverID', Auth::user()->seller->id)->orderBy('created_at', 'DESC')->get();
        $UsersOne = [];
        if($UsersChatOne !== null || $UsersChatSecond !== null){
            foreach ([$UsersChatOne, $UsersChatSecond] as $chat) {
                if($chat != null){
                    foreach ($chat as $key => $value) {
                        $userType = $value->user_type == 'seller' ? 'receiverID' : 'senderID';
                        $UserOne = User::where('id', $value->$userType)->first();
                        if(!array_key_exists($value->$userType, $UsersOne)){
                            $UsersOne[$value->$userType]['user_id'] = $value->$userType;
                            $UsersOne[$value->$userType]['name'] = $UserOne->name;
                            $UsersOne[$value->$userType]['logo'] = "https://dummyimage.com/800x700/000000/ffffff&text=Avatar";
                            $UsersOne[$value->$userType]['msg'] = $value->message;
                            $UsersOne[$value->$userType]['time'] = $value->created_at;
                            $UsersOne[$value->$userType]['timeago'] = Carbon::parse($value->created_at)->ago();
                        }else{
                            if(strtotime($UsersOne[$value->$userType]['time']) <  strtotime($value->created_at)){
                                $UsersOne[$value->$userType]['user_id'] = $value->$userType;
                                $UsersOne[$value->$userType]['name'] = $UserOne->name;
                                $UsersOne[$value->$userType]['logo'] = "https://dummyimage.com/800x700/000000/ffffff&text=Avatar";
                                $UsersOne[$value->$userType]['msg'] = $value->message;
                                $UsersOne[$value->$userType]['time'] = $value->created_at;
                                $UsersOne[$value->$userType]['timeago'] = Carbon::parse($value->created_at)->ago();
                            }
                        }

                    }
                }

            }
        }
return response()->json($UsersOne );
    }

    public function listChatUser(){
        $userId = Auth::user()->id;

        $usersChatOne = UsersChat::where('user_type', 'seller')->where('receiverID', $userId)->orderBy('created_at', 'DESC')->get();
        $usersChatSecond = UsersChat::where('user_type', 'user')->where('senderID', $userId)->orderBy('created_at', 'DESC')->get();
        $response = [];
        $sellers = [];
        if($usersChatOne !== null || $usersChatSecond !== null){
            foreach ([$usersChatOne, $usersChatSecond] as $usersChat) {
                if($usersChat != null){
                    foreach ($usersChat as $key => $value) {
                        $userType = $value->user_type == 'seller' ? 'senderID' : 'receiverID';
                        $seller = Seller::where('id', $value->$userType)->first();
                        if(!array_key_exists($value->$userType, $sellers)){
                            $sellers[$value->$userType]['seller_id'] = $value->$userType;
                            $sellers[$value->$userType]['name'] = $seller->name;
                            $sellers[$value->$userType]['logo'] = $seller->logo != null ? $seller->logo : "https://dummyimage.com/800x700/000000/ffffff&text=Avatar";
                            $sellers[$value->$userType]['msg'] = $value->message;
                            $sellers[$value->$userType]['time'] = $value->created_at;
                            $sellers[$value->$userType]['timeago'] = Carbon::parse($value->created_at)->ago();
                        }else{
                            if(strtotime($sellers[$value->$userType]['time']) <  strtotime($value->created_at)){
                                $sellers[$value->$userType]['seller_id'] = $value->$userType;
                                $sellers[$value->$userType]['name'] = $seller->name;
                                $sellers[$value->$userType]['logo'] = $seller->logo != null ? $seller->logo : "https://dummyimage.com/800x700/000000/ffffff&text=Avatar";
                                $sellers[$value->$userType]['msg'] = $value->message;
                                $sellers[$value->$userType]['time'] = $value->created_at;
                                $sellers[$value->$userType]['timeago'] = Carbon::parse($value->created_at)->ago();
                            }
                        }
                    }

                }
            }
        }
        return response()->json($sellers);
    }

    public function listChat(Request $request){
        $data = [];
        $checkInfo = $request->validate([
            'sellerID' => ['required', 'numeric'],
        ]);
        $sellerOne = Seller::where('id', $checkInfo['sellerID'])->first();
        if($sellerOne && $sellerOne->count() > 0){
            $data['name'] =  $sellerOne->name;
            $data['logo'] = $sellerOne->logo != null ? $sellerOne->logo : "https://dummyimage.com/800x700/000000/ffffff&text=Avatar";
            $UsersChatOne = UsersChat::where('user_type', 'seller')->Where('senderID', $checkInfo['sellerID'])->Where('receiverID', Auth::user()->id)->get();
            $UsersChatSecond = UsersChat::where('user_type', 'user')->Where('receiverID', $checkInfo['sellerID'])->Where('senderID', Auth::user()->id)->get();
            $mergedChats = $UsersChatOne->merge($UsersChatSecond)->toArray();
            usort($mergedChats, function ($a, $b) {
                return strtotime($a['created_at']) - strtotime($b['created_at']);
            });
            $data['msg'] = $mergedChats;
        }
        return response()->json($data);
    }


    public function listDetailChatUser(Request $request){
        $data = [];
        $checkInfo = $request->validate([
            'userID' => ['required', 'numeric'],
        ]);
        $User = User::where('id', $checkInfo['userID'])->first();

        if($User && $User->count() > 0){
            $data['name'] =  $User->name;
            $data['logo'] = "https://dummyimage.com/800x700/000000/ffffff&text=Avatar";
            $UsersChatOne = UsersChat::where('user_type', 'seller')->Where('receiverID', $checkInfo['userID'])->Where('senderID', Auth::user()->seller->id)->get();
            $UsersChatSecond = UsersChat::where('user_type', 'user')->Where('senderID', $checkInfo['userID'])->Where('receiverID', Auth::user()->seller->id)->get();
            $mergedChats = $UsersChatOne->merge($UsersChatSecond)->toArray();
            usort($mergedChats, function ($a, $b) {
                return strtotime($a['created_at']) - strtotime($b['created_at']);
            });
            $data['msg'] = $mergedChats;
        }
        return response()->json($data);
    }

    public function sendChatUser(Request $request){
        $status = false;
        $checkInfo = $request->validate([
            'id' => ['required', 'numeric'],
            'msg' => ['required', 'string', 'max:255']
        ]);

        $chat = new UsersChat();
        $chat->senderID = Auth::user()->id;
        $chat->receiverID = $checkInfo['id'];
        $chat->message = $checkInfo['msg'];
        $chat->product_id = 0;
        $chat->user_type = "user";
        if( $chat->save()){
            $status = true;
            event(new NewMessageSellerEvent($chat));
        }

        return response()->json(['status' => $status]);
    }

    public function sendChatSeller(Request $request){
        $status = false;
        $checkInfo = $request->validate([
            'id' => ['required', 'numeric'],
            'msg' => ['required', 'string', 'max:255']
        ]);

        $chat = new UsersChat();
        $chat->senderID = Auth::user()->seller->id;
        $chat->receiverID = $checkInfo['id'];
        $chat->message = $checkInfo['msg'];
        $chat->product_id = 0;
        $chat->user_type = "seller";
        if( $chat->save()){
            $status = true;
            event(new NewMessageUserEvent($chat));
        }

        return response()->json(['status' => $status]);
    }

}
