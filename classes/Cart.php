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

  public function returnCartCount($id){
      $user = new User();
      if($user->isLoggedIn()){
        $cart_check = $this->_db->get('cart', array('shopper_id', '=', $id));
        $data = $cart_check->first();
        $item_array = $data->items;
        $items = explode(",", $item_array);
        return count($items);
      } else {
        return 0;
      }
  }
}
?>
