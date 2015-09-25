<?php

class Scorpion
{
    private $_installed = false,
            $_pages = array(),
            $_users = array(),
            $_theme = 'default';
            
    public function __construct()
    {

    }
    
    public function check_install_status()
    {
        
    }
    
    public function start()
    {
//        $pages = get_pages();
        
        $website = new Template($this->get_theme_path());
        $codes = array(
//            'pages' => $pages,
//            'meta' => $meta,
//            'content' => $content,
//            'comments' => $comments,
//            'addcomment' => $addcomment,
//            'theme_path' => $this->get_theme_path(),
            'theme_url' => $this->base_url() . '/' . basename(SCORPION_DIR_THEMES) . '/' . $this->get_theme(),
            'visitor' => $_SERVER['REMOTE_ADDR'],
            'date' => date("d.m.Y H:i:s"),
            'date_year' => date("Y")
        );
        $website->set($codes);
        $website->output();
    }
    
    public function get_theme()
    {
        return $this->_theme;
    }
    public function get_theme_path()
    {
        return SCORPION_DIR_THEMES . $this->_theme . '/';
    }
    public function set_theme($theme)
    {
        if(file_exists(SCORPION_DIR_THEMES . $theme . '/index.html')) {
            $this->_theme = $theme;
            return true;
        }
        else {
            return false;
        }
    }
    
    public function get($property)
    {
        $match = '';
        $property = '_' . escape($property);
        foreach($this as $key => $val) {
            if($property == $key) {
                $match = $val;
                break;
            }
        }
        if(!empty($match)) {
            return $match;
        }
        else {
            return "$property not found";
        }
    }

    protected function base_url()
    {
        $url = '';
        $request_url = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : '';
        $script_url = (isset($_SERVER['PHP_SELF'])) ? $_SERVER['PHP_SELF'] : '';
        if ($request_url != $script_url) {
            $url = trim(preg_replace('/' . str_replace('/', '\/', str_replace('index.php', '', $script_url)) . '/', '',
                $request_url, 1), '/');
        }

        $protocol = $this->get_protocol();

        return rtrim(str_replace($url, '', $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']), '/');
    }

    protected function get_protocol()
    {
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' && $_SERVER['HTTPS'] != '') {
            $protocol = 'https';
        }
        else {
            $protocol = 'http';
        }
        return $protocol;
    }
    

    
}

