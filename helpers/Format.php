<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 12/11/2019
     * Time: 2:07 PM
     */
    
    class Format{
        public function formatDate($date)
        {
            return date('F j, Y, g:i:a', strtotime($date));
        }
        
        public function textShorten($text, $limit=400)
        {
            $text = $text." ";
            $text = substr($text, 0,$limit);
            $text = substr($text, 0, strrpos($text, ' '));
            $text = $text."...";
            return $text;
        }
    }