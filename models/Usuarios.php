<?php

// ../models/Usuarios.php

class Usuarios extends Model {

  public function validarSesion($email, $password) {
    if(strlen($email) < 5 || strlen($email) > 30)
    {
      echo 'Error: email fuera de rango.';
      header("Location: ../controllers/login.php");
      exit;
    }
    $email = $this->db->escape($email);
    $email = str_replace("%", "\%", $email);
    $email = str_replace("", "\\", $email);

    $password = $this->db->escape($password);
    $password = sha1($password);
    //var_dump($password);
    //var_dump($email);

    $this->db->query("SELECT *
                      FROM usuarios
                      WHERE email = '$email' AND
                      contrasena = '$password'");
    if($this->db->numRows() != 1) return false;

    return true;
  }


}