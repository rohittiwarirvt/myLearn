<?php
class User extends AppModel {

  var $name = 'User';
  var $validate = array(
    'username' => array('notempty'),
    'password' => array('notempty'),
    'group_id' => array('numeric')
  );

  //The Associations below have been created with all possible keys, those that are not needed can be removed
  var $belongsTo = array(
    'Group' => array(
      'className' => 'Group',
      'foreignKey' => 'group_id',
      'conditions' => '',
      'fields' => '',
      'order' => ''
    )
  );

  var $actsAs = array('Acl' => 'requester');
  var $hasMany = array(
    'Post' => array(
      'className' => 'Post',
      'foreignKey' => 'user_id',
      'dependent' => false,
      'conditions' => '',
      'fields' => '',
      'order' => '',
      'limit' => '',
      'offset' => '',
      'exclusive' => '',
      'finderQuery' => '',
      'counterQuery' => ''
    )
  );

  function parentNode() {
    if (!$this->id && empty($this->data)) {
      return NULL;
    }
    $data = $this->data;
    if (empty($data)) {
      $data = $this->read();
    }

    if (empty($data['User']['group_id'])) {
      return NULL;
    } else {
      return array( 'Group' => array('id' => $data['User']['group_id']));
    }
  }
}
?>
