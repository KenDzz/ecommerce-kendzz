<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckBadWordsController extends Controller
{
    public function checkBadWordString($string){
        $ArrstringFilter = explode(" ", str_replace(["\r", "\n"], '', strip_tags($string)));
        $data = $this->getBadWord();
        $arr = array_intersect($data,$ArrstringFilter);
        if(count($arr) > 0){
            return true;
        }
        return false;
    }

    public function checkBadWordStringArr($string){
        $ArrstringFilter = explode(" ", str_replace(["\r", "\n"], '', strip_tags($string)));
        $data = $this->getBadWord();
        $arr = array_intersect($data,$ArrstringFilter);
        if(count($arr) > 0){
            return $arr;
        }
        return [];
    }

    private function getBadWord(){
        $jsonEN = json_decode(file_get_contents('badwords/lang/en.json'), true);
        $jsonVI = json_decode(file_get_contents('badwords/lang/vi.json'), true);
        $jsonResult = array_merge($jsonEN, $jsonVI);
        return $jsonResult;
    }
}
