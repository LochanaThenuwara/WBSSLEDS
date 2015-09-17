<?php

class Validate {

    private $_passed = false,
            $_error = array(),
            $_db = null;

    public function __construct() {

        $this->_db = DB::getInstance();
    }

    public function check($source, $items = array()) {

        foreach ($items as $item => $rules) {


            foreach ($rules as $rule => $rule_value) {
                $value = $source[$item];
                if ($rule === 'required' && empty($value)) {


                    $this->addError("${item} is Required");
                } else if (!empty($value)) {

                    if ($rule === 'check') {

                        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            $this->addError("{$item} is not valid");
                        }
                    } else if ($rule === 'checkno') {
                        if (!preg_match('/[0-9]+(v|V){1}+/', $value)) {
                          $this->addError("{$item} is not valid");
                        }
                    } else {
                        switch ($rule) {
                            case 'min':
                                if (strlen($value) < $rule_value) {
                                    $this->addError(" {$item} must be a minimum of {$rule_value} characters.");
                                }
                                break;
                            case 'max':
                                if (strlen($value) > $rule_value) {
                                    $this->addError(" {$item} Must be a maximum of {$rule_value} characters.");
                                }

                                break;
                            case 'matches':
                                if ($value != $source[$rule_value]) {
                                    $this->addError(" Password did not match");
                                }
                                break;
                            case 'unique':
                                $check = $this->_db->get('donors', array($item, '=', $value));

                                if ($check->count()) {
                                    $this->addError("{$item} already exists.");
                                }
                                break;
                        }
                    }
                }
            }
        }
        if (empty($this->_errors)) {
            $this->_passed = true;
        }


        return $this;
    }

    private function addError($error) {
        $this->_errors[] = $error;
    }

    public function errors() {
        return $this->_errors;
    }

    public function passed() {
        return $this->_passed;
    }

}

?>
