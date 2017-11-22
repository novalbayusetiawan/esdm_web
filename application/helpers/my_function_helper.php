<?php

if(!function_exists("substr_link"))
{
    function substr_link($url, $pos, $len)
    {
        $url1 = $url;
        $url2 = substr($url, $pos, $len);
        $output = "<a href=\"{$url1}\" target=\"_blank\">{$url2}</a>";
        return $output;
    }
}
