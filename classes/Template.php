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
            if(is_array($value)) {
                foreach($value as $newkey => $newvalue) {
                    $this->_values[$key.'.'.$newkey] = $newvalue;
                }
            }
            else {
                $this->_values[$key] = $value;
            }
        }
    }

    public function output()
    {
        $output = file_get_contents($this->_file);

        foreach ($this->_values as $key => $value) {
            $tagToReplace = "{{ $key }}";
            $output = str_replace($tagToReplace, $value, $output);
        }

        if(SCORPION_DEVMODE) {
            echo '<pre>';
            print_r($this->_values);
            echo '</pre>';
        }
        echo $output;
    }

}