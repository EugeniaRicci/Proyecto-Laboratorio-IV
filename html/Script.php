function borrarRegistro(NumID){
	var opcion = confirm("¿Esta seguro que desea borrar este registro?");
	if (opcion == true){
		document.getElementById('hiddenID').value = NumID;
		//var X = document.getElementById('hiddenID').value;
		document.getElementById('hiddenform').submit();
		document.getElementById('hiddenID').value = '';
		alert ("El registro " + NumID + " ha sido borrado.");
	}
}

function borrarCliente(NumID){
	var opcion = confirm("Si borra el cliente se borraran los pacientes asociados. ¿Desea continuar?");
	if (opcion == true){
		document.getElementById('hiddenID').value = NumID;
		document.getElementById('hiddenform').submit();
		document.getElementById('hiddenID').value = '';
		alert ("El cliente " + NumID + " ha sido borrado.");
	}
}


function anularTurno(NumID){
	var opcion1 = confirm("¿Esta seguro que desea anular este turno?");
	if (opcion1 == true){
		document.getElementById('hiddenID').value = NumID;
		document.getElementById('hiddenform').submit();
		document.getElementById('hiddenID').value = '';
		alert ("El turno " + NumID + " ha sido anulado.");
	}
}

function reservarTurno(NumID){
		document.getElementById('hiddenIDt').value = NumID;
		document.getElementById('hiddenIDc').value = document.getElementById(NumID).value;
		document.getElementById('hiddenform').submit();

		alert ("El turno " + NumID + " ha sido reservado.");

}







