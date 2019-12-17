<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 12/12/2019
     * Time: 8:54 PM
     */
    class Session{
        
        public static function init()
        {
            session_start();
        }
        
        public static function set($key, $val)
        {
            $_SESSION[$key] = $val;
        }
        
        public static function get($key)
        {
            if (isset($_SESSION[$key]))
            {
                return $_SESSION[$key];
            }else{
                return false;
            }
        }
        
        public static function checkSession()
        {
            self::init();
            if (self::get("login") == false)
            {
                self::destory();
                header("Location: login.php");
            }
        }
    
        public static function checkLogin()
        {
            self::init();
            if (self::get("login") == true)
            {
                header("Location: index.php");
            }
        }
        
        public static function destory()
        {
            session_destroy();
            header("Location: login.php");
        }
    }