<?php

use App\Models\Frontend;
use App\Models\Counter;
use Carbon\Carbon;

if (! function_exists('activeClass')) {
    /**
     * Get the active class if the condition is not falsy.
     *
     * @param  $condition
     * @param  string  $activeClass
     * @param  string  $inactiveClass
     * @return string
     */
    function activeClass($condition, $activeClass = 'active', $inactiveClass = '')
    {
        return $condition ? $activeClass : $inactiveClass;
    }
}

if (! function_exists('htmlLang')) {
    /**
     * Access the htmlLang helper.
     */
    function htmlLang()
    {
        return str_replace('_', '-', app()->getLocale());
    }

    if(! function_exists('getContent')){

        function getContent($data_keys, $singleQuery = false, $limit = null,$orderById = false){
            if ($singleQuery) {
        $content = Frontend::where('data_keys', $data_keys)->orderBy('id','desc')->first();
    } else {
        $article = Frontend::query();
        $article->when($limit != null, function ($q) use ($limit) {
            return $q->limit($limit);
        });
        if($orderById){
            $content = $article->where('data_keys', $data_keys)->orderBy('id')->get();
        }else{
            $content = $article->where('data_keys', $data_keys)->orderBy('id','desc')->get();
        }
    }
    return $content;

        }
    }


    if(!function_exists('stoppageCombination')){

        function stoppageCombination($numbers, $arraySize, $level = 1, $i = 0, $addThis = [])
        {
            // If this is the last layer, use a different method to pass the number.
            if ($level == $arraySize) {
                $result = [];
                for (; $i < count($numbers); $i++) {
                    $result[] = array_merge($addThis, array($numbers[$i]));
                }
               
                return $result;
            }

            $result = [];
            $nextLevel = $level + 1;
            for (; $i < count($numbers); $i++) {
                // Add the data given from upper level to current iterated number and pass
                // the new data to a deeper level.
                $newAdd = array_merge($addThis, array($numbers[$i]));
                $temp = stoppageCombination($numbers, $arraySize, $nextLevel, $i, $newAdd);


                $result = array_merge($result, $temp);

            }
              //dd($result) ;
            return $result;
        }
    }

    if(!function_exists('getStoppageInfo')){
        function getStoppageInfo($stoppages){
             $data = Counter::routeStoppages($stoppages);
         return $data;
        }
    }


    if(!function_exists('showDateTime')){

        function showDateTime($date, $format = 'Y-m-d h:i A'){

            $lang = session()->get('lang');
              Carbon::setlocale($lang);
              return Carbon::parse($date)->translatedFormat($format);


        }
    }

    if(!function_exists('showDayOff')){

        function showDayOff($val){


            $result = '';
        if(gettype($val) == 'array'){
             foreach($val as $value) {
                $result .= getDay($value);
             }

          }else{
             $result = getDay($val);
          }
           return $result;

        }
    }

    if(!function_exists('getDay')){

        function getDay($val){
    switch ($val) {
        case $val==6:
            $result = 'Saturday';
            break;
        case $val==0:
            $result = 'Sunday';
            break;
        case $val==1:
            $result = 'Monday';
            break;
        case $val==2:
            $result = 'Tuesday';
            break;
        case $val==3:
            $result = 'Wednesday';
            break;
        case $val==4:
            $result = 'Thursday';
            break;
        case $val==5:
            $result = 'Friday';
            break;
        default:
            $result = '';
            break;
    }
    return $result;
}
    }

    if(!function_exists('showAmount')){

        function showAmount( $amount, $decimal = 2, $separate = true,$exceptZeros = false){

            $separator ='';
            if($separate){
                $separator = ',';
            }
             $printAmount = number_format($amount, $decimal, '.', $separator);

              return $printAmount;


        }
    }

    if(!function_exists('slug')){

        function slug($string){

        return Illuminate\Support\Str::slug($string);

        }
    }
}
