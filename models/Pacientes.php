<?php

	// ../models/Pacientes.php LEFT JOIN clientes c on p.cliente_id=c.cliente_id"); 

	class Pacientes extends Model {

		//RETORNAR TODAS LAS FILAS
		public function getTodos(){
			$this->db->query("SELECT * FROM pacientes p
				INNER JOIN especies e on p.especie_id=e.especie_id
				INNER JOIN clientes c on p.cliente_id =c.cliente_id");				
			if($this->db->numRows()<1)die("Error: no hay pacientes a mostrar");

			return $this->db->fetchAll();
		}

		//FLAG EXISTE PACIENTE
		private function getPacienteID($id){
			$this->db->query("SELECT *	FROM pacientes
				WHERE paciente_id = '$id' LIMIT 1");

				if($this->db->numRows()!=1){
					return false;
				}
				else return true;
		}

		//BUSCAR
		public function getPacientesFiltro($valor){
			
			$valor = $this->db->escape($valor);
    		$valor = str_replace("%", "\%", $valor);
    		$valor = str_replace("_", "\_", $valor);

			//POR ID
			if (ctype_digit($valor)){
				
				if(!($this->getPacienteID("$valor")))die("Error: no existe mascota con ese ID.");
				$this->db->query("SELECT * FROM pacientes p
				INNER JOIN especies e on p.especie_id=e.especie_id 
				INNER JOIN clientes c on p.cliente_id=c.cliente_id 
				WHERE p.paciente_id = '$valor'");

				return $this->db->fetchAll();
			}
			//POR NOMBRE
			else {
				
				$this->db->query("SELECT * FROM pacientes p
				INNER JOIN especies e on p.especie_id=e.especie_id 
				INNER JOIN clientes c on p.cliente_id=c.cliente_id 
				WHERE nombre_paciente like '$valor'");

				if($this->db->numRows()<1) die("Error: No se encontro un paciente con ese nombre.");

				return $this->db->fetchAll();
			}

		}

		//ALTAS
		public function cargarPacientes($nombre, $edad, $peso, $sexo, $especie, $raza, $dueño){

			//VALIDACIONES
			$nombre = trim($nombre);
			$edad = trim($edad);
			$peso = trim ($peso);
			$raza = trim ($raza);

			$regex = "/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#]+/i";
			if (preg_match($regex, $nombre)) die ("Error: se ingreso un nombre no valido.");
			if (preg_match($regex, $raza)) die ("Error: se ingreso una raza no valida.");
			if ($sexo <> 'm' and $sexo <> 'h') die ("Error: se ingreso un sexo no valido.");
			if(!ctype_digit($peso))die("Error: el peso debe ser numerico.");
			if(!ctype_digit($edad))die("Error: la edad debe ser numerica.");

			
			$this->db->query("SELECT * from clientes WHERE cliente_id = '$dueño'");
			if($this->db->numRows()<1)die("Error: no existe el cliente seleccionado.");

			$this->db->query("SELECT * from especies WHERE especie_id = '$especie'");
			if($this->db->numRows()<1)die("Error: no existe la especie seleccionada.");

			//Evitar cargar el mismo paciente de nuevo
			$this->db->query("SELECT * FROM pacientes p, clientes c
				WHERE p.nombre_paciente = '$nombre' and
				p.cliente_id = c.cliente_id = '$dueño'");
			if($this->db->numRows()>=1)die("Error: ya existe un paciente cargado con ese nombre para ese cliente.");
			
			//INSERT
			$this->db->query("INSERT INTO pacientes (nombre_paciente, edad, peso, sexo, especie_id, raza, cliente_id) VALUES ('$nombre', '$edad', '$peso', '$sexo', '$especie', '$raza', '$dueño'); ");
		}

		//MODIFICACIONES
		public function modificarPacientes($id, $nombre, $edad, $peso, $sexo, $especie, $raza, $dueño){

			//VALIDACION
			if(!ctype_digit($id))die("Error en el ID del paciente.");
			if($id < 1) die("Error en el ID del paciente.");
			if(!($this->getPacienteID("$id")))die("Error: no existe el paciente que desea modificar.");

			$regex = "/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#]+/i";
			if (preg_match($regex, $nombre)) die ("Error: se ingreso un nombre no valido.");
			if (preg_match($regex, $raza)) die ("Error: se ingreso una raza no valida.");
			if ($sexo <> 'm' and $sexo <> 'h') die ("Error: se ingreso un sexo no valido.");
			
			$this->db->query("SELECT * from clientes WHERE cliente_id = '$dueño'");
			if($this->db->numRows()<1)die("Error: no existe el dueño seleccionado.");

			$this->db->query("SELECT * from especies WHERE especie_id = '$especie'");
			if($this->db->numRows()<1)die("Error: no existe la especie seleccionada.");


			//SET DATOS
			$consulta = "UPDATE pacientes set ";
			$flag=0;
			if (!empty($nombre)){
				$nombre = trim($nombre);
				$consulta.="nombre_paciente='".$nombre."'";
				$flag=1;
			}
			if (!empty($edad)){
				$edad = trim($edad);
				if($flag==1) $consulta.=",edad='".$edad."'";
				else
				$consulta.="edad='".$edad."'";
				$flag=1;
			}
			if (!empty($peso)){
				$peso = trim ($peso);
				if(!ctype_digit($peso))die("Error: el peso debe ser numerico.");
				if($flag==1) $consulta.=",peso=".$peso;
				else
				$consulta.=",peso=".$peso;
				$flag=1;
			}
			if (!empty($raza)){
				$raza = trim($raza);
				if($flag==1) $consulta.=",raza='".$raza."'";
				else
				$consulta.="raza='".$raza."'";
				$flag=1;			
			}

			if ($flag==1) $consulta.=",sexo='".$sexo."'";
			else {
				$consulta.="sexo='".$sexo."'";
				$flag=1;
			}
			if ($flag==1) $consulta.=",especie_id=".$especie;
			else {
				$consulta.=" especie_id=".$especie;
				$flag=1;
			}
			if ($flag==1) $consulta.=",cliente_id=".$dueño;
			else $consulta.=" cliente_id=".$dueño;
			
			$consulta.=" WHERE paciente_id= ".$id;
			$this->db->query($consulta);
		}

		//BAJAS
		public function borrarPacientes($id){

			//VALIDACION
			if(!ctype_digit($id))die("Error en el ID de paciente.");
			if($id < 1) die("Error en el ID de paciente.");
			
			if(!($this->getPacienteID("$id")))die("Error: no existe el paciente que desea eliminar o ya ha sido eliminado.");
			
			$this->db->query("DELETE from pacientes WHERE paciente_id = '$id'");
		}
	}
