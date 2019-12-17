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
        
        public function validationData($data)
        {
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);
            
            return $data;
        }
        
        public function title()
        {
            $path = $_SERVER['SCRIPT_FILENAME'];
            $title = basename($path,'.php');
            //$title = str_replace('-',' ',$title);
            if($title == 'index')
            {
                $title = 'home';
            }elseif ($title == 'contact')
            {
                $title = 'contact';
            }
            return $title = ucfirst($title);
        }
    }