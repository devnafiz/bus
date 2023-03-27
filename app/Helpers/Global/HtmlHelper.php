<?php

use App\Models\Frontend;

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
}
