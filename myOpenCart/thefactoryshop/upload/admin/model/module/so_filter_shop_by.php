<?php
class ModelModuleSofiltershopby extends Model {
	public function getModuleId() {
		$sql = " SHOW TABLE STATUS LIKE '" . DB_PREFIX . "module'" ;
		$query = $this->db->query($sql);
		return $query->rows;
	}
	public function getAllLanguages(){
		$sql = 'SELECT * FROM '.DB_PREFIX.'language WHERE status = 1' ;
		$query = $this->db->query($sql);
		if(count($query->rows) > 0){
			return $query->rows;
		}else{
			return 0;
		}	
	}
	public function getFieldAtribute(){
		$sql = 'SELECT a.name AS name,a.attribute_id AS id,l.language_id AS language_id FROM '.DB_PREFIX.'attribute_description as a INNER JOIN '.DB_PREFIX.'language AS l ON a.language_id = l.language_id WHERE l.status = 1' ;
		$query = $this->db->query($sql);
		if(count($query->rows) > 0){
			return $query->rows;
		}else{
			return 0;
		}	
	}
	public function getMenufacture(){
		$sql = 'SELECT * FROM '.DB_PREFIX.'manufacturer' ;
		$query = $this->db->query($sql);
		if(count($query->rows) > 0){
			return $query->rows;
		}else{
			return 0;
		}	
	}
	public function checkFieldColor(){
		$sql = 'SELECT option_id AS id FROM '.DB_PREFIX.'option_description WHERE name = "Colors"' ;
		$query = $this->db->query($sql);
		if(count($query->rows) > 0){
			return $query->rows[0]['id'];
		}else{
			return 0;
		}	
	}
	
	public function getLanguagePublish(){
		$sql = 'SELECT language_id AS id FROM '.DB_PREFIX.'language WHERE status = 1' ;
		$query = $this->db->query($sql);
		if(count($query->rows) > 0){
			return $query->rows[0]['id'];
		}else{
			return 0;
		}	
	}
	public function getFieldColor(){
		$sql = 'SELECT d.name AS name FROM '.DB_PREFIX.'option_description as d INNER JOIN '.DB_PREFIX.'option as o ON d.option_id = o.option_id WHERE o.type = "image"';
		$query = $this->db->query($sql);
		if(count($query->rows) > 0){
			return $query->rows;
		}else{
			return 0;
		}	
	}
	public function updateFieldColor($language_id){
		$sql = 'SELECT option_id AS id FROM '.DB_PREFIX.'option WHERE type="image"' ;
		$query = $this->db->query($sql);

		if(count($query->rows) == 0){
			$sql = 'INSERT INTO '.DB_PREFIX.'option (type) VALUES ("image")' ;
			$query = $this->db->query($sql);
			$sql = 'SELECT option_id AS id FROM '.DB_PREFIX.'option' ;
			$query = $this->db->query($sql);
			if(count($query->rows) > 0){
				$id_F = count($query->rows) + 1;
			}else{
				$id_F = 1;
			}
			$sql = 'INSERT INTO '.DB_PREFIX.'option_description (option_id,language_id,name) VALUES ('.$id_F.','.$language_id.',"Colors")' ;
			$query = $this->db->query($sql);
			$sql = 'SELECT option_value_id AS id FROM '.DB_PREFIX.'option_value ORDER BY option_value_id DESC' ;
			$query = $this->db->query($sql);
			if(count($query->rows) > 0){
				$id_O = $query->rows[0]['id'] + 1;
			}else{
				$id_O = 1;
			}
			$sql = 'INSERT INTO '.DB_PREFIX.'option_value (option_value_id,option_id,image) VALUES ('.$id_O.','.$id_F.',"catalog/red-100x100.jpg")' ;
			$query = $this->db->query($sql);
			$sql = 'INSERT INTO '.DB_PREFIX.'option_value_description (option_value_id,language_id,option_id,name) VALUES ('.$id_O.','.$language_id.','.$id_F.',"Red")' ;
			$query = $this->db->query($sql);
			$id_O++;
			$sql = 'INSERT INTO '.DB_PREFIX.'option_value (option_value_id,option_id,image) VALUES ('.$id_O.','.$id_F.',"catalog/blue-100x100.jpg")' ;
			$query = $this->db->query($sql);
			$sql = 'INSERT INTO '.DB_PREFIX.'option_value_description (option_value_id,language_id,option_id,name) VALUES ('.$id_O.','.$language_id.','.$id_F.',"Blue")' ;
			$query = $this->db->query($sql);
			$id_O++;
			$sql = 'INSERT INTO '.DB_PREFIX.'option_value (option_value_id,option_id,image) VALUES ('.$id_O.','.$id_F.',"catalog/brown-100x100.jpg")' ;
			$query = $this->db->query($sql);
			$sql = 'INSERT INTO '.DB_PREFIX.'option_value_description (option_value_id,language_id,option_id,name) VALUES ('.$id_O.','.$language_id.','.$id_F.',"Brown")' ;
			$query = $this->db->query($sql);
			$id_O++;
			$sql = 'INSERT INTO '.DB_PREFIX.'option_value (option_value_id,option_id,image) VALUES ('.$id_O.','.$id_F.',"catalog/green-100x100.jpg")' ;
			$query = $this->db->query($sql);
			$sql = 'INSERT INTO '.DB_PREFIX.'option_value_description (option_value_id,language_id,option_id,name) VALUES ('.$id_O.','.$language_id.','.$id_F.',"Green")' ;
			$query = $this->db->query($sql);
			$id_O++;
			$sql = 'INSERT INTO '.DB_PREFIX.'option_value (option_value_id,option_id,image) VALUES ('.$id_O.','.$id_F.',"catalog/violet-100x100.jpg")' ;
			$query = $this->db->query($sql);
			$sql = 'INSERT INTO '.DB_PREFIX.'option_value_description (option_value_id,language_id,option_id,name) VALUES ('.$id_O.','.$language_id.','.$id_F.',"Violet")' ;
			$query = $this->db->query($sql);
		}else{
			$id_F = $query->rows[0]['id'];
		}
		
		
	}
	public function deleteFieldColor(){
		$sql = 'SELECT option_id AS id FROM '.DB_PREFIX.'option_description WHERE name="Color"';
		$query = $this->db->query($sql);
		if(count($query->rows) > 0){
			$id_O = $query->rows[0]['id'];
		}else{
			$id_O = 1;
		}

		$sql = 'DELETE FROM  '.DB_PREFIX.'option_description WHERE option_id = '.$id_O;
		$query = $this->db->query($sql);
		$sql = 'DELETE FROM  '.DB_PREFIX.'option_value WHERE option_id = '.$id_O;
		$query = $this->db->query($sql);
		$sql = 'DELETE FROM  '.DB_PREFIX.'option_value_description WHERE option_id = '.$id_O;
		$query = $this->db->query($sql);
		
	}
}

?>