<?php
class User {
  private $_db, $_data, $_sessionName, $_isLoggedIn;

  public function __construct($user = null){
    $this->_db = DB::getInstance();
    $this->_sessionName = Config::get(session/session_name);

    if (!$user) {
      if (Session::exists('id')) {
        $user = Session::get('id');

        if ($this->find(intval($user))){
          $this->_isLoggedIn = true;
        } else {
            $this->_isLoggedIn = false;
            $this->logout();
        }
      }
    } else {
      $this->find($user);
    }
  }

  public function create($fields = array()) {
    if(!$this->_db->insert('users', $fields))  {
      throw new Exception('There was a problem creating your account.');
    }
  }

  public function find($user = null){
    if($user){
      $field = (is_numeric($user)) ? 'id' : 'username';
      $data = $this->_db->get('users', array($field, '=', $user));
      if ($data->count()) {
        $this->_data = $data->first();
        return true;
      }
    }
    return false;
  }

  public function update($fields = array(), $id = null){

    if (!$id && $this->isLoggedIn()) {
      $id = $this->data()->id;
    }

    if (!$this->_db->update('users', $id, $fields)) {
      throw new Exception('There was a problem updating this.');
    }
  }

  public function login ($username = null, $password = null){
    $user = $this->find($username);
    if($user){
      if($this->data()->password == Hash::make($password, $this->data()->salt)){
        Session::put('id', $this->data()->id);
        return true;
      }
    }

    return false;
  }

  public function hasPermission($key){
    $group = $this->_db->get('groups', array('id', '=', $this->data()->group));

    if($group->count()){
      $permissions = json_decode($group->first()->permissions, true);
      if($permissions[$key] == true){
        return true;
      }
    }
    return false;
  }

  public function logout(){
    Session::delete($this->_sessionName);
    Session::delete('id');
  }

  public function data(){
    return $this->_data;
  }

  public function isLoggedIn(){
    return $this->_isLoggedIn;
  }
}
?>
