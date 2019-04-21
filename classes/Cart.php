<?php
class Cart{
  private $_db;

  public function __construct(){
    $this->_db = DB::getInstance();
  }

  public function addItem($fields = array()){
    if(!$this->_db->insert('cart', $fields))  {
      throw new Exception('There was a problem adding this item to your cart');
    }
  }
}
?>
