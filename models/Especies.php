<?php

// ../models/Especies.php

	
	class Especies extends Model {

		public function getTodos(){
			$this->db->query("SELECT * FROM especies");
			if ($this->db->numRows()<1) die ("Error: no hay especies cargadas");

			return ($this->db->FetchAll());
		}
	}
