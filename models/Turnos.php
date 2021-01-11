<?php

// .../models/Turnos.php

class Turnos extends Model {

//Todos los turnos ocupados
	public function getTurnosOcupados(){
		$this->db->query("SELECT t.turno_id, e.nombre, e.apellido, c.nombre_cliente, c.apellido_cliente, t.estado, con.descripcion, DATE_FORMAT(t.fecha, '%e/%m/%Y') as fecha, DATE_FORMAT(t.hora, '%H:%i') as hora
                      FROM turnos t
                      LEFT JOIN empleados e ON t.empleado_id = e.empleado_id
                      LEFT JOIN clientes c ON t.cliente_id = c.cliente_id
                      LEFT JOIN consultorios con ON t.consultorio_id = con.consultorio_id
                      WHERE t.fecha > DATE_FORMAT(CURDATE(), '%e/%m/%Y') AND
                      	t.estado like 'Ocupado'");
		return $this->db->fetchAll();
	}

//Todos los turnos disponibles
	public function getTurnosDisponibles($selec){
		if ($selec == 1){
			$selec = time();
			$fecha = date('d', $selec);

		$this->db->query("SELECT t.turno_id, e.nombre, e.apellido, con.descripcion, DATE_FORMAT(t.fecha, '%e/%m/%Y') as fecha, 
			DATE_FORMAT(t.hora, '%H:%i') as hora
                      FROM turnos t
                      LEFT JOIN empleados e ON t.empleado_id = e.empleado_id
                      LEFT JOIN consultorios con ON t.consultorio_id = con.consultorio_id
                      WHERE DAY(t.fecha) like $fecha AND
                      	t.estado like 'disponible'");
		return $this->db->fetchAll();
		}

		if ($selec == 2){
			$selec = time();
			$fecha = date('m', $selec);

		$this->db->query("SELECT t.turno_id, e.nombre, e.apellido, con.descripcion, DATE_FORMAT(t.fecha, '%e/%m/%Y') as fecha, 
			DATE_FORMAT(t.hora, '%H:%i') as hora
                      FROM turnos t
                      LEFT JOIN empleados e ON t.empleado_id = e.empleado_id
                      LEFT JOIN consultorios con ON t.consultorio_id = con.consultorio_id
                      WHERE t.estado like 'disponible' AND  
                      MONTH(t.fecha) like $fecha");
		return $this->db->fetchAll();
		}
	}


	//BUSCAR
	public function getTurnosClientes($valor){
		$valor = trim($valor);
		$regex = "/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#]+/i";
		if (preg_match($regex, $valor)) die ("Error: los datos del cliente solo pueden incluir letras y espacios.");

		$this->db->query("SELECT t.turno_id, e.nombre, e.apellido, c.nombre_cliente, c.apellido_cliente, t.estado, con.descripcion, DATE_FORMAT(t.fecha, '%e/%m/%Y') AS fecha, DATE_FORMAT(t.hora, '%H:%i') AS hora
                      FROM turnos t
                      LEFT JOIN empleados e ON t.empleado_id = e.empleado_id
                      LEFT JOIN clientes c ON t.cliente_id = c.cliente_id
                      LEFT JOIN consultorios con ON con.consultorio_id = con.consultorio_id
                      WHERE t.fecha > DATE_FORMAT(CURDATE(), '%e/%m/%Y') AND
                   		  c.apellido_cliente like '$valor' AND
                      	  t.estado = 'Ocupado'");
		
		if($this->db->numRows()<1) die("Error: No se encontro un turno para un cliente con ese apellido.");
		return $this->db->fetchAll();

		
	}

	//FLAG EXISTE TURNO
		private function getTurnoID($id){
			$this->db->query("SELECT *	FROM turnos
				WHERE turno_id = '$id' LIMIT 1");

				if($this->db->numRows()!=1){
					return false;
				}
				else return true;
		}

	//ANULAR TURNO - UPDATE DE ESTADO
		public function anularTurnos($id){

			//VALIDACION
			if(!ctype_digit($id))die("Error en el ID del turno.");
			if($id < 1) die("Error en el ID del turno.");
			
			if(!($this->getTurnoID("$id")))die("Error: no existe el turno que desea anular.");
			$this->db->query("UPDATE turnos SET estado= 'disponible',
					cliente_id = NULL
				 	WHERE turno_id = '$id'");
		}
	//RESERVAR TURNO - UPDATE DE ESTADO
		public function reservarTurnos($id, $cliente){

			//VALIDACION
			if(!ctype_digit($id))die("Error en el ID del turno.");
			if($id < 1) die("Error en el ID del turno.");

			if(!ctype_digit($cliente))die("Error en el ID del cliente.");
			if($cliente < 1) die("Error en el ID del cliente.");
			
			if(!($this->getTurnoID("$id")))die("Error: no existe el turno que desea anular.");
			$this->db->query("UPDATE turnos SET estado= 'ocupado',
					cliente_id = '$cliente'
				 	WHERE turno_id = '$id'");
		}


}		
