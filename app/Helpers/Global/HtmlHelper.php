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
}
