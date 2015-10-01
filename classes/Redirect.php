<?php
class Redirect
{
    public static function to($location = null)
    {
        if($location)
        {
            if(is_numeric($location))
            {
                switch($location)
                {
                    case 404:
                        header("HTTP/1.0 404 Not found");
                        include("inc/errors/404.php");
                        exit();
                    break;
                    case 403:
                        header("HTTP/1.0 403 Forbidden");
                        include("inc/errors/403.php");
                        exit();
                    break;
                    case 500:
                        header("HTTP/1.0 500 Internal server error");
                        include("inc/errors/500.php");
                        exit();
                    break;
                }
            }
            header("Location:$location");
            exit();
        }
    }
}