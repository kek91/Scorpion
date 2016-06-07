<?php
class Validate
{
    private $_passed = false,
            $_errors = array();

    public function check($source, $items = array())
    {
        foreach($items as $item => $rules)
        {
            foreach($rules as $rule => $rule_value)
            {
                $value = trim($source[$item]);
                $item = escape($item);

                if($rule === 'required' && empty($value))
                {
                        $this->addError("The input field <b>{$item}</b> is required.");
                }
                elseif (!empty($value)) 
                {
                    switch($rule)
                    {
                        case 'min':
                            if(strlen($value) < $rule_value)
                            {
                                    $this->addError("<b>{$item}</b> must be a minimum of <b>{$rule_value}</b> characters.");
                            }
                        break;
                        case 'max':
                            if(strlen($value) > $rule_value)
                            {
                                    $this->addError("<b>{$item}</b> must be a maximum of <b>{$rule_value}</b> characters.");
                            }
                        break;
                        case 'matches':
                            if($value != $source[$rule_value])
                            {
                                    $this->addError("<b>{$rule_value}</b> must match <b>{$item}</b>.");
                            }
                        break;
                        case 'uniqueURL':
                            $check = $this->_db->query("SELECT title_url FROM ".Config::get('tables/articles')." WHERE title_url = ?", array($value));
                            if($check->count() > 0)
                            {
                                    $this->addError("The article title URL <b>{$value}</b> already exists in database. Please append something to the URL field to make it unique.");
                            }
                        break;
                        case 'mailcheck':
                            if(!filter_var($value, FILTER_VALIDATE_EMAIL))
                            {
                                    $this->addError("<b>{$value}</b> is not a valid email address.");
                            }
                        break;
                        case 'telephone':
                            if(!ctype_digit($value))
                            {
                                    $this->addError("<b>{$item}</b> contains illegal characters. Only numbers 0-9 are allowed.");
                            }
                        break;
                        case 'onlyNumeric':
                            if(!ctype_digit($value))
                            {
                                    $this->addError("<b>{$item}</b> contains illegal characters. Only numbers 0-9 are allowed.");
                            }
                        break;
                        case 'onlyAlphabetic':
                            if (!ctype_alpha($value))
                            {
                                    $this->addError("<b>{$item}</b> contains illegal characters. Only alphabetic letters A-Z are allowed.");
                            }
                        break;
                        case 'onlyAlphaNumeric':
                            if(!ctype_alnum($value))
                            {
                                    $this->addError("<b>{$item}</b> contains illegal characters. Only alphanumeric characters (A-Z and 0-9) are allowed.");
                            }
                        break;
                    }
                }
                else
                {
                    return $this;
                }
            }
        }
        if(empty($this->_errors))
        {
                $this->_passed = true;
        }
        return $this;
    }

    private function addError($error)
    {
        $this->_errors[] = $error;
    }

    public function errors()
    {
        return $this->_errors;
    }

    public function passed()
    {
        return $this->_passed;
    }
}