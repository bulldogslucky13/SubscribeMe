<?php
 class Validate {
   private $_passed = false, $_errors = array(), $_db = null;

   public function __construct(){
     $this->_db = DB::getInstance();
   }

   public function check($source, $items = array()){
     foreach($items as $item => $rules){
       foreach($rules as $rule => $rule_value){
         $value = $source[$item];
         $item = escape($item);

         if($rule == 'required' && empty($value)){
          $this->addError("The {$rules['name']} is required. ");
        } else if (!empty($value)){
          switch ($rule){
            case 'min':
              if(strlen($value) < $rule_value){
                $this->addError("The {$rules['name']} must be a minimum of {$rule_value} characters. ");
              }
            break;
            case 'max':
            if(strlen($value) > $rule_value){
              $this->addError("The {$rules['name']} can not exceed {$rule_value} characters. ");
            }
            break;
            case 'matches':
              if($value != $source[$rule_value]){
                $this->addError("{$rules['name']} must match {$rule_value}. ");
              }
            break;
            case 'p_matches':
              if($value != $source[$rule_value]){
                $this->addError("Your two desired password values must match.");
              }
            break;
            case 'unique':
              $check = $this->_db->get($rule_value, array($item, '=', $value));
              if($check->count()){
                $this->addError("That {$rules['name']} already exists! ");
              }
            break;
          }
        }
       }
     }
     if (empty($this->_errors)){
       $this->_passed = true;
     }

     return $this;
   }

   private function addError($error){
     $this->_errors[] = $error;
   }

   public function errors(){
    return $this->_errors;
   }

   public function passed(){
     return $this->_passed;
   }

 }
?>
