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
        /* get config */
        
        /* If Scorpion NOT installed, do installation */
        
        /* Else, start() (?) */
        
        /* get_files */
    }
    
    public function start()
    {
        $url = '';
        $request_url = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : '';
        $script_url = (isset($_SERVER['PHP_SELF'])) ? $_SERVER['PHP_SELF'] : '';

        // Get our url path and trim the / of the left and the right
        if ($request_url != $script_url) {
            $url = trim(preg_replace('/' . str_replace('/', '\/', str_replace('index.php', '', $script_url)) . '/', '',
                $request_url, 1), '/');
        }
        $url = preg_replace('/\?.*/', '', $url); // Strip query string

        if ($url) {
            $file = SCORPION_DIR_CONTENT . $url;
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

        if (file_exists($file)) {
            $content = file_get_contents($file);
        } 
        else {
            $content = file_get_contents(SCORPION_DIR_CONTENT . '404' . CONTENT_EXT);
            header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
        }

        $meta = $this->read_file_meta($content);
        $content = $this->parse_content($content);
        
//        $filelist = get_files();
//        $pages = get_pages($filelist);
        
        $website = new Template($this->get_theme_path());
        $codes = array(
            'site_title' => 'test, fix this to $config getter',
            'pages' => "--ListAllPages--",
            'meta' => $meta,
            'content' => $content,
            'comments' => "--Comments--",
            'addcomment' => "--Add comment--",
            'theme_path' => $this->get_theme_path(),
            'theme_url' => $this->base_url() . '/' . basename(SCORPION_DIR_THEMES) . '/' . $this->get_theme(),
            'visitor' => $_SERVER['REMOTE_ADDR'],
            'date' => date("d.m.Y H:i:s"),
            'date_year' => date("Y")
        );
        $website->set($codes);
        $website->output();
    }
 
    private function get_files($directory = SCORPION_DIR_CONTENT, $ext = SCORPION_CONTENT_EXT)
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
    protected function get_pages($filelist, $base_url, $order_by = 'date', $order = 'desc', $excerpt_length = 50)
    {
        $config = $this->config;

//        $pages = $this->get_files($config['content_dir'], CONTENT_EXT);
        $pages = $filelist;
        $sorted_pages = array();
        $date_id = 0;
        foreach ($pages as $key => $page) {
            // Skip 404
            if (basename($page) == '404' . CONTENT_EXT) {
                unset($pages[$key]);
                continue;
            }
            // Get title and format $page
            $page_content = file_get_contents($page);
            $page_meta = $this->read_file_meta($page_content);
            $page_content = $this->parse_content($page_content);
//            $url = str_replace($config['content_dir'], $base_url . '/', $page);
            
            $url = str_replace(SCORPION_DIR_CONTENT, $this->base_url().'/', $page);
            
//            $url = $this->base_url() . '/' . basename(SCORPION_DIR_THEMES) . '/' . $this->get_theme(),
            $url = str_replace('index' . CONTENT_EXT, '', $url);
            $url = str_replace(SCORPION_CONTENT_EXT, '', $url);
            $data = array(
                'url' => $url,
                'title' => isset($page_meta['title']) ? $page_meta['title'] : '',
                'description' => isset($page_meta['description']) ? $page_meta['description'] : '',
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
            } else {
                $sorted_pages[$page] = $data;
            }
        }

        if ($order == 'desc') {
            krsort($sorted_pages);
        } else {
            ksort($sorted_pages);
        }

        return $sorted_pages;
    }
    
    /**
     * Parses the file meta from the txt file header
     *
     * @param string $content the raw txt content
     * @return array $headers an array of meta values
     */
    private function read_file_meta($content)
    {
        $headers = array(
            'title' => 'Title',
            'description' => 'Description',
            'author' => 'Author',
            'date' => 'Date',
            'robots' => 'Robots',
            'template' => 'Template',
            'category' => 'Category'
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
//        $content = str_replace('%base_url%', $this->base_url(), $content);
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
    
    
    
    
    
     /* Getters */
    
    public function get_theme()
    {
        return $this->_theme;
    }
    public function get_theme_path()
    {
        return SCORPION_DIR_THEMES . $this->_theme . '/';
    }
    
    public function get_config()
    {
        include_once(SCORPION_DIR_ROOT.'core/config.php');
        $this->_config = array_merge($config, $this->_config);
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
    
    
    
    
    
    /* Setters */
    
    public function set_theme($theme)
    {
        $theme = escape($theme);
        if(file_exists(SCORPION_DIR_THEMES . $theme . '/index.html')) {
            $this->_theme = $theme;
            return true;
        }
        return false;
    }
    
}