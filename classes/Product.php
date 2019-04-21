<?php
class Product {
  private $_db, $_data;
  public function __construct($product){
    $this->_db = DB::getInstance();

    $this->find($product);
  }

  public function find($product = null){
    if($product){
      $field = (is_numeric($user)) ? 'id' : 'product_name';
      $data = $this->_db->get('products', array($field, '=', $product));
      if ($data->count()) {
        $this->_data = $data->first();
        return true;
      }
    }
    return false;
  }
}
?>
