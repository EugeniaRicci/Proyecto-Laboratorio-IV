<?php

	// ../models/Empleados.php

	class Empleados extends Model {
		
		//BUSCAR
		public function getEmpleadosFiltro($valor){
			
			$valor = trim($valor);
			$regex = "/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#]+/i";
			if (preg_match($regex, $valor)) die ("Error: El DNI debe incluir solo numeros, y el apellido solo letras y espacios.");

			//POR DNI
			if (ctype_digit($valor)){
				
				if (strlen($valor)<7 || strlen($valor)>9) die("Error: el DNI debe tener la cantidad correcta de digitos.");

				$this->db->query("SELECT *	FROM empleados e
				WHERE dni = '$valor'");

				if($this->db->numRows()<1) die("Error: No se encontro un empleado con ese DNI.");

				return $this->db->fetchAll();
			}
			//POR APELLIDO, seria mejor usar LIKE con ESCAPE-ESCAPEWILDCARDS? en vez del regex para evitar injec	
			else {
				
				$this->db->query("SELECT * FROM empleados e 
				WHERE apellido like '$valor'");

				if($this->db->numRows()<1) die("Error: No se encontro un empleado con ese apellido.");

				return $this->db->fetchAll();
			}

		}

		//FLAG EXISTE EMPLEADO
		private function getEmpleadoID($id){
			$this->db->query("SELECT *	FROM empleados
				WHERE empleado_id = '$id' LIMIT 1");

				if($this->db->numRows()!=1){
					return false;
				}
				else return true;
		}

		//RETORNAR TODAS LAS FILAS
		public function getTodos(){
			$this->db->query("SELECT * FROM empleados e");
			if($this->db->numRows()<1)die("Error: no hay empleados a mostrar");

			return $this->db->fetchAll();
		}

		//ALTAS
		public function cargarEmpleados($nombre, $apellido, $telefono, $direccion, $dni){

			//VALIDACIONES
			$nombre = trim($nombre);
			$apellido = trim($apellido);
			$telefono = trim ($telefono);
			$direccion = trim($direccion);
			$dni = trim ($dni);

			$regex = "/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#]+/i";
			if (preg_match($regex, $nombre)) die ("Error: se ingreso un nombre no valido.");
			if (preg_match($regex, $apellido)) die ("Error: se ingreso un apellido no valido.");

			if(!ctype_digit($telefono))die("Error: el telefono debe ser numerico.");

			if (preg_match($regex, $direccion)) die("Error: la direccion contiene caracteres no permitidos.");

			if(!ctype_digit($dni)) die ("Error: el DNI debe ser numerico.");

			//Evitar cargar el mismo empleado de nuevo
			$this->db->query("SELECT *	FROM empleados e 
				WHERE dni = '$dni'");
			if($this->db->numRows()>=1)die("Error: ya existe un empleado con ese DNI.");
			
			//INSERT
			$this->db->query("INSERT INTO empleados (nombre, apellido, telefono, direccion, dni, horario_id) VALUES ('$nombre', '$apellido', '$telefono', '$direccion', '$dni', '$horario'); ");
		}

		//MODIFICACIONES
		public function modificarEmpleados($id, $nombre, $apellido, $telefono, $direccion, $dni){

			//VALIDACION
			if(!ctype_digit($id))die("Error en el ID del empleado.");
			if($id < 1) die("Error en el ID del empleado.");
			if(!($this->getEmpleadoID("$id")))die("Error: no existe el empleado que desea modificar.");

			$regex = "/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#]+/i";
			if (preg_match($regex, $nombre)) die ("Error: se ingreso un nombre no valido.");
			if (preg_match($regex, $apellido)) die ("Error: se ingreso un apellido no valido.");
			if (preg_match($regex, $direccion)) die("Error: la direccion contiene caracteres no permitidos.");
			


			//SET DATOS
			$consulta = "UPDATE empleados set ";
			$flag=0;
			if (!empty($nombre)){
				$nombre = trim($nombre);
				$consulta.="nombre='".$nombre."'";
				$flag=1;
			}
			if (!empty($apellido)){
				$apellido = trim($apellido);
				if($flag==1) $consulta.=",apellido='".$apellido."'";
				else
				$consulta.="apellido='".$apellido."'";
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
			
			$consulta.=" WHERE empleado_id= ".$id;
			var_dump($consulta);
			$this->db->query($consulta);
		}

		
		//BAJAS
		public function borrarEmpleados($id){

			//VALIDACION
			if(!ctype_digit($id))die("Error en el ID del empleado.");
			if($id < 1) die("Error en el ID del empleado.");
			
			if(!($this->getEmpleadoID("$id")))die("Error: no existe el empleado que desea eliminar o ya ha sido eliminado.");
			
			$this->db->query("DELETE from empleados WHERE empleado_id = '$id'");
		}
		

	}

