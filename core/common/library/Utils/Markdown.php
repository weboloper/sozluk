<?php
 
namespace Weboloper\Utils;

 
class Markdown
{
 
    public static function create($string, $replace = array(), $delimiter = '-')
    {   
        $string = trim($string);

        $string = preg_replace_callback("(\[\[(.*?)\]\])is", function ($matches) {
     
            $data = '(bkz:  <a href="/?s='.$matches[1].'">'.$matches[1].'</a>)';
            return $data;
        }, $string);

        $string = preg_replace_callback("(\{\{(.*?)\}\})is", function ($matches) {
     
            $data = '(<a href="/?s='.$matches[1].'">*</a>)';
            return $data;
        }, $string);


        return $string;
    }
}
