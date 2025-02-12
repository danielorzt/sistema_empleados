<?php
session_start();

include_once "../models/AdminModel.php";

class AdminController
{
    public $correo;
    public $contrasena;

    public function ctrLogin()
    {
        $respuesta = AdminModel::mdlLogin($this->correo, $this->contrasena);
        if ($respuesta['codigo'] == '200') {
            $_SESSION['idAdmin'] = $respuesta['idAdmin'];
            $_SESSION['correo'] = $this->correo;
            header("Location: ../views/dashboard.php?msg=Inicio de sesión exitoso&status=success");
        } else {
            header("Location: ../views/login.php?msg=" . urlencode($respuesta['mensaje']) . "&status=error");
        }
    }
}

if (isset($_POST["correo"]) && isset($_POST["contrasena"])) {
    $objAdmin = new AdminController();
    $objAdmin->correo = $_POST["correo"];
    $objAdmin->contrasena = $_POST["contrasena"];
    $objAdmin->ctrLogin();
}
