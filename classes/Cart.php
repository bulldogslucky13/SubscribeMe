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

  public function returnCart($id, $field){
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

  public function returnCartCount($id, $field){
      $user = new User();
      if($user->isLoggedIn()){
        $items = self::returnCart($id, $field);
        return count($items);
      } else {
        return 0;
      }
  }

  public function count($id){
      $user = new User();
      if($user->isLoggedIn()){
        $cart_check = self::returnCartByID($user->data()->id);
        return count($cart_check);
      } else {
        return 0;
      }
  }
}
?>
