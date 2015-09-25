<?php

class Template
{
    private $_file,
            $_values = array();
  
    public function __construct($file)
    {
        if (file_exists($file.'/index.html')) {
            $this->_file = $file.'/index.html';
        }
        else {
            die('Error loading theme ('.$file.')');
        }
    }
    
    public function set($array)
    {
        foreach($array as $key => $value) {
            $this->_values[$key] = $value;
        }
    }

    public function output()
    {
        $output = file_get_contents($this->_file);

        foreach ($this->_values as $key => $value) {
            $tagToReplace = "{{ $key }}";
            $output = str_replace($tagToReplace, $value, $output);
        }

        echo $output;
    }

}