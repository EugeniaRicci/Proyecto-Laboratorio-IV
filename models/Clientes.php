<?php

// ../models/Clientes.php

	
	class Clientes extends Model {

		public function getTodos(){
			$this->db->query("SELECT c.cliente_id, c.nombre_cliente, c.apellido_cliente, c.dni,
				c.telefono, c.email, c.direccion,
				GROUP_CONCAT(p.nombre_paciente) as mascota
				from clientes c left join pacientes p 
				on c.cliente_id = p.cliente_id
				group by c.cliente_id");
			if ($this->db->numRows()<1) die ("Error: no hay clientes a mostrar");
			return ($this->db->FetchAll());
		}
	

	//ALTAS
		public function cargarClientes($nombre, $apellido, $telefono, $direccion, $dni, $email){

			//VALIDACIONES
			$nombre = trim($nombre);
			$apellido = trim($apellido);
			$telefono = trim ($telefono);
			$direccion = trim($direccion);
			$dni = trim ($dni);
			$email = $this->db->escape($email);
    		$email = str_replace("%", "\%", $email);
    		$email = str_replace("", "\\", $email);


			$regex = "/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#]+/i";
			if (preg_match($regex, $nombre)) die ("Error: se ingreso un nombre no valido.");
			if (preg_match($regex, $apellido)) die ("Error: se ingreso un apellido no valido.");

			if(!ctype_digit($telefono))die("Error: el telefono debe ser numerico.");

			if (preg_match($regex, $direccion)) die("Error: la direccion contiene caracteres no permitidos.");

			if(!ctype_digit($dni)) die ("Error: el DNI debe ser numerico.");


			//Evitar cargar el mismo cliente de nuevo
			$this->db->query("SELECT *	FROM clientes
				WHERE dni = '$dni'");
			if($this->db->numRows()>=1)die("Error: ya existe un cliente con ese DNI.");
			
			//INSERT
			$this->db->query("INSERT INTO clientes (nombre_cliente, apellido_cliente, telefono, direccion, dni, email) VALUES ('$nombre', '$apellido', '$telefono', '$direccion', '$dni', '$email');");
		}

		//MODIFICACIONES
		public function modificarClientes($id, $nombre, $apellido, $telefono, $direccion, $dni, $email){

			//VALIDACION
			if(!ctype_digit($id))die("Error en el ID del cliente.");
			if($id < 1) die("Error en el ID del cliente.");
			if(!($this->getClienteID("$id")))die("Error: no existe el cliente que desea modificar.");

			$regex = "/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#]+/i";
			if (preg_match($regex, $nombre)) die ("Error: se ingreso un nombre no valido.");
			if (preg_match($regex, $apellido)) die ("Error: se ingreso un apellido no valido.");
			if (preg_match($regex, $direccion)) die("Error: la direccion contiene caracteres no permitidos.");
			$email = $this->db->escape($email);
    		$email = str_replace("%", "\%", $email);
    		$email = str_replace("", "\\", $email);
			

			//SET DATOS
			$consulta = "UPDATE clientes set ";
			$flag=0;
			if (!empty($nombre)){
				$nombre = trim($nombre);
				$consulta.="nombre_cliente='".$nombre."'";
				$flag=1;
			}
			if (!empty($apellido)){
				$apellido = trim($apellido);
				if($flag==1) $consulta.=",apellido_cliente='".$apellido."'";
				else
				$consulta.="apellido_cliente='".$apellido."'";
				$flag=1;
			}
			if (!empty($telefono)){
				$telefono = trim ($telefono);
				if(!ctype_digit($telefono))die("Error: el telefono debe ser numerico.");
				if($flag==1) $consulta.=",telefono=".$telefono;
				else
				$consulta.=",telefono=".$telefono;
				$flag=1;
			}
			if (!empty($direccion)){
				$direccion = trim($direccion);
				if($flag==1) $consulta.=",direccion='".$direccion."'";
				else
				$consulta.="direccion='".$direccion."'";
				$flag=1;			
			}
			if (!empty($dni)){
				$dni = trim ($dni);
				if(!ctype_digit($dni)) die ("Error: el DNI debe ser numerico.");
				if($flag==1) $consulta.=",dni= ".$dni;
				else
				$consulta.="dni= ".$dni;
				$flag=1;
			}
			if (!empty($email)){
				$email = trim ($email);
				if($flag==1) $consulta.=",email= ".$email;
				else
				$consulta.="email= ".$email;
				$flag=1;
			}
			
			$consulta.=" WHERE cliente_id= ".$id;
			$this->db->query($consulta);
		}


		//RETORNAR MASCOTAS
		public function getMascotas($id){
			$this->db->query("SELECT p.nombre_paciente FROM pacientes p, clientes c
				INNER JOIN especies e on p.especie_id = e.especie_id
				WHERE c.cliente_id = p.cliente_id");
			return $this->db->fetchAll();
		}

		//FLAG EXISTE EMPLEADO
		private function getClienteID($id){
			$this->db->query("SELECT *	FROM clientes
				WHERE cliente_id = '$id' LIMIT 1");

				if($this->db->numRows()!=1){
					return false;
				}
				else return true;
		}

		//BAJAS
		public function borrarClientes($id){

			//VALIDACION
			if(!ctype_digit($id))die("Error en el ID del cliente.");
			if($id < 1) die("Error en el ID del cliente.");
			
			if(!($this->getCLienteID("$id")))die("Error: no existe el cliente que desea eliminar o ya ha sido eliminado.");
			
			$this->db->query("DELETE from pacientes WHERE cliente_id = '$id'");
			$this->db->query("DELETE from clientes WHERE cliente_id = '$id'");
			
		}


		/*
		public function getUltimoCliente() {
			return $this->db->insertId();
		}*/
	}