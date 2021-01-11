<?php

	// ../models/Consultorios.php
	

	class Consultorios extends Model {
		
		//RETORNAR FILAS
		public function getTodos(){
			$this->db->query("SELECT * FROM consultorios");
			if($this->db->numRows()<1)die("Error: no hay consultorios cargados");

			return $this->db->fetchAll();
		}


	}