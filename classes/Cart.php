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

  public function returnItems($id, $field){
      $user = new User();
      $cart_check = $this->_db->get('cart', array('shopper_id', '=', $id));
      $data = $cart_check->first();
      $array = $data->$field;
      $items = explode(",", $array);
      return $items;
  }

  public function returnCartByID($id){
    $user = new User();
    $cart_check = $this->_db->get('cart', array('shopper_id', '=', $id));
    $data = $cart_check->first();
    return $data;
  }

  public function count($id){
      $user = new User();
      if($user->isLoggedIn()){
        if(self::returnCartByID($user->data()->id)){
          $cart_check = self::returnItems($user->data()->id, 'items');
          return count($cart_check);
        } else {
          return 0;
        }
      } else {
        return 0;
      }
  }
}
?>
