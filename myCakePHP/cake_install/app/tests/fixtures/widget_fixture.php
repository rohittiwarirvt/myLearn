<?php 
/* SVN FILE: $Id$ */
/* Widget Fixture generated on: 2017-02-03 14:20:05 : 1486111805*/

class WidgetFixture extends CakeTestFixture {
	var $name = 'Widget';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'part_no' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 12),
		'quantity' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id' => 1,
		'name' => 'Lorem ipsum dolor sit amet',
		'part_no' => 'Lorem ipsu',
		'quantity' => 1
	));
}
?>