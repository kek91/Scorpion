<?php

class Scorpion
{
    private $_installed = false,
            $_pages = array(),
            $_users = array(),
            $_config = array(),
            $_theme = 'default';
            
    public function __construct()
    {
        $this->_config['header_title']          = isset($this->_config['header_title'])          ? $this->_config['header_title']          : 'Scorpion CMS';
        $this->_config['header_slogan']         = isset($this->_config['header_slogan'])         ? $this->_config['header_slogan']         : 'This is our slogan';
        $this->_config['site_meta_title']       = isset($this->_config['site_meta_title'])       ? $this->_config['site_meta_title']       : 'Scorpion';
        $this->_config['site_meta_description'] = isset($this->_config['site_meta_description']) ? $this->_config['site_meta_description'] : 'Scorpion is a flat-file based content management system';
        $this->_config['theme']                 = isset($this->_config['theme'])                 ? $this->_config['theme']                 : 'default';
        $this->_config['navigation']            = isset($this->_config['navigation'])            ? $this->_config['navigation']            : 'Home, Download, Screenshots, Docs, Source';
        $this->_config['index']                 = isset($this->_config['index'])                 ? $this->_config['index']                 : 'Home';
        $this->_config['cache']                 = isset($this->_config['cache'])                 ? $this->_config['cache']                 : 'false';
        $this->_config['cache_time']            = isset($this->_config['cache_time'])            ? $this->_config['cache_time']            : '604800';
        $this->_config['date_year']             = isset($this->_config['date_year'])             ? $this->_config['date_year']             : date("Y");
        $this->_config['date']                  = isset($this->_config['date'])                  ? $this->_config['date']                  : date("d.m.Y H:i:s");

        if(SCORPION_DEVMODE) {
            echo '<pre>';
            print_r($this->_config);
            echo '</pre>';
        }
 
        /*
         * Check if ScorpionCMS is installed...
         */

    }
    
    public function show()
    {
//        $url = '';
//        $request_url = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : '';
//        $script_url = (isset($_SERVER['PHP_SELF'])) ? $_SERVER['PHP_SELF'] : '';
//        // Get our url path and trim the / of the left and the right
//        if ($request_url != $script_url) {
//            $url = trim(preg_replace('/' . str_replace('/', '\/', str_replace('index.php', '', $script_url)) . '/', '',
//                $request_url, 1), '/');
//        }
//        $url = preg_replace('/\?.*/', '', $url); // Strip query string
        
        $url = explode('/', $_SERVER['REQUEST_URI']);
        if(count($url) == 4) {
            $urldir = escape($url[count($url)-2]);
            $url = escape($url[count($url)-1]);
        }
        else {
            $urldir = "";
            $url = escape($url[count($url)-1]);
        }

        /*
         * TODO sjekk REQUEST_URI for antall. Hvis X, så betyr det at det er en subpost
         */
        /*
         * TODO eller... fortsett som før og bare list X category posts i get_pages()
         */
        
        if($url && $urldir) {
            $file = SCORPION_DIR_CONTENT . $urldir .'/'. $url;
        }
        elseif($url) {
            if($url == strtolower($this->get_config('index'))) {
                $file = SCORPION_DIR_CONTENT . 'index';
            }
            elseif(strstr($url, 'admin')) {
                Redirect::to(SCORPION_DIR_ADMIN . 'index.php');
                die();
            }
            else {
                $file = SCORPION_DIR_CONTENT . $url;
            }
        }
        else {
            $file = SCORPION_DIR_CONTENT . 'index';
        }

        if (is_dir($file)) {
            $file = SCORPION_DIR_CONTENT . $url . '/index' . SCORPION_CONTENT_EXT;
        } 
        else {
            $file .= SCORPION_CONTENT_EXT;
        }

        if(file_exists($file)) {
            $content = file_get_contents($file);
        }
        else {
            $content = file_get_contents(SCORPION_DIR_CONTENT . '404' . SCORPION_CONTENT_EXT);
            header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
        }

        $navigation = $this->generate_navigation();
        $meta = $this->read_file_meta($content);
        $content = $this->parse_content($content);
        
        $website = new Template($this->get_theme_path());
        $codes = array(
            'header_title'      => $this->get_config('header_title'),
            'header_slogan'     => $this->get_config('header_slogan'),
            'meta'              => $meta,
            'content'           => $content,
            'navigation'        => $navigation,
            'comments'          => "--Comments--",
            'addcomment'        => "--Add comment--",
            'theme_path'        => $this->get_theme_path(),
            'theme_url'         => $this->base_url() . '/' . basename(SCORPION_DIR_THEMES) . '/' . $this->get_config('theme'),
            'base_url'          => $this->base_url(),
            'visitor'           => $_SERVER['REMOTE_ADDR'],
            'date'              => date("d.m.Y H:i:s"),
            'date_year'         => date("Y")
        );

        $website->set($codes);
        $website->output();
    }
 
    
    
    private function read_file_meta($content)
    {
        $headers = array(
            'title' => 'Title',
            'description' => 'Description',
            'author' => 'Author',
            'date' => 'Date',
            'robots' => 'Robots',
            'template' => 'Template',
            'category' => 'Category',
            'type' => 'Type'
        );
        foreach ($headers as $field => $regex) {
            if (preg_match('/^[ \t\/*#@]*' . preg_quote($regex, '/') . ':(.*)$/mi', $content, $match) && $match[1]) {
                $headers[$field] = trim(preg_replace("/\s*(?:\*\/|\?>).*/", '', $match[1]));
            } 
            else {
                $headers[$field] = '';
            }
        }
        if (isset($headers['date'])) {
            $headers['date_formatted'] = utf8_encode(strftime(SCORPION_DATE_FORMAT, strtotime($headers['date'])));
        }
        return $headers;
    }
    
    
    
    private function parse_content($content)
    {
        $content = preg_replace('#/\*.+?\*/#s', '', $content, 1); // Remove first comment (with meta)
        $parsedown = new ParsedownExtra();
	$content = $parsedown->text($content);
        return $content;
    }
    
    
    
    private function limit_words($string, $word_limit)
    {
        $words = explode(' ', $string);
        $excerpt = trim(implode(' ', array_splice($words, 0, $word_limit)));
        if (count($words) > $word_limit) {
            $excerpt .= '&hellip;';
        }

        return $excerpt;
    }
    
    
    
    private function base_url()
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

    
    
    private function get_protocol()
    {
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' && $_SERVER['HTTPS'] != '') {
            $protocol = 'https';
        }
        else {
            $protocol = 'http';
        }
        return $protocol;
    }
    
    
    
    private function generate_navigation()
    {
        if(!empty($this->get_config('navigation'))) {
            $nav = explode(',', $this->get_config('navigation'));
            $navigation = '<ul>';
            foreach($nav as $navitem) {
                $navitem = escape(trim($navitem));
                $navigation .= '<li><a href="'.strtolower($navitem).'">'.$navitem.'</a></li>';
            }
            $navigation .= '</ul>';
            return $navigation;
        }
        return false;
    }
    
    
    
    
    
     /* 
      * Getters 
      */
    
    public function get_theme_path()
    {
        return SCORPION_DIR_THEMES . $this->get_config('theme') . '/';
    }
    
    public function get_config($key)
    {
        if(isset($this->_config[escape($key)])) {
            return $this->_config[escape($key)];
        }
        return false;
    }
    
    
    
    
    
    /* 
     * Setters 
     */
    
    public function set_theme($theme)
    {
        $theme = escape($theme);
        if(file_exists(SCORPION_DIR_THEMES . $theme . '/index.html')) {
            $this->_theme = $theme;
            return true;
        }
        return false;
    }
    
    public function set_config($key, $value)
    {
        if($this->_config[escape($key)] = escape($value)) {
            return true;
        }
        return false;
    }
    




/*
 * //
 * //
 * //
 */


    public function get_files($directory = SCORPION_DIR_CONTENT, $ext = SCORPION_CONTENT_EXT)
    {
        $filelist = array();
        if($files = scandir($directory)) {
            foreach($files as $file) {
                if(in_array(substr($file, -1), array('~', '#'))) {
                    continue;
                }
                if(preg_match("/^(^\.)/", $file) === 0) {
                    if(is_dir($directory . "/" . $file)) {
                        $filelist = array_merge($filelist, $this->get_files($directory . "/" . $file, $ext));
                    }
                    else {
                        $file = $directory . "/" . $file;
                        if(!$ext || strstr($file, $ext)) {
                            $filelist[] = preg_replace("/\/\//si", "/", $file);
                        }
                    }
                }
            }
        }
        return $filelist;
    }
    
    /**
     * Get a list of pages
     *
     * @param string $base_url the base URL of the site
     * @param string $order_by order by "alpha" or "date"
     * @param string $order order "asc" or "desc"
     * @return array $sorted_pages an array of pages
     */
    public function get_pages($type = '', $base_url = '', $order_by = 'date', $order = 'desc', $excerpt_length = 50)
    {
//        $config = $this->config;
//        $pages = $filelist;
        $base_url = $this->base_url();
        $pages = $this->get_files();
        $sorted_pages = array();
        $date_id = 0;
        foreach ($pages as $key => $page) {

            // Get title and format $page
            $page_content = file_get_contents($page);
            $page_meta = $this->read_file_meta($page_content);
            $page_content = $this->parse_content($page_content);
            
            if(!empty($type)) {
                if($page_meta['type'] != $type) {
                    continue;
                }
            }
            
//            $url = str_replace($config['content_dir'], $base_url . '/', $page);
            $url = str_replace(SCORPION_DIR_CONTENT, $this->base_url().'/', $page);
//            $url = $this->base_url() . '/' . basename(SCORPION_DIR_THEMES) . '/' . $this->get_theme(),
            $url = str_replace('index' . SCORPION_CONTENT_EXT, '', $url);
            $url = str_replace(SCORPION_CONTENT_EXT, '', $url);
            $data = array(
                'filename' => basename($page),
                'url' => $url,
                'title' => isset($page_meta['title']) ? $page_meta['title'] : '',
                'description' => isset($page_meta['description']) ? $page_meta['description'] : '',
                'type' => isset($page_meta['type']) ? $page_meta['type'] : '',
                'excerpt' => $this->limit_words(strip_tags($page_content), $excerpt_length),
                'author' => isset($page_meta['author']) ? $page_meta['author'] : '',
                'date' => isset($page_meta['date']) ? $page_meta['date'] : '',
                'date_formatted' => isset($page_meta['date']) ? utf8_encode(strftime(SCORPION_DATE_FORMAT, strtotime($page_meta['date']))) : '',
                'category' => isset($page_meta['category']) ? $page_meta['category'] : '',
                'content' => $page_content
            );

            if ($order_by == 'date' && isset($page_meta['date'])) {
                $sorted_pages[$page_meta['date'] . $date_id] = $data;
                $date_id++;
            } 
            else {
                $sorted_pages[$page] = $data;
            }
        }

        if ($order == 'desc') {
            krsort($sorted_pages);
        } 
        else {
            ksort($sorted_pages);
        }

        return $sorted_pages;
    }
    
    
}