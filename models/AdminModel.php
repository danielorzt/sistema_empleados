<?php
session_start();

include_once "conexion.php";

class AdminModel
{
    public static function mdlLogin($correo, $contrasena)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM admin WHERE correo = :correo");
            $objRespuesta->bindParam(":correo", $correo);
            $objRespuesta->execute();

            $resultado = $objRespuesta->fetch(PDO::FETCH_ASSOC);
            if ($resultado && password_verify($contrasena, $resultado['contrasena'])) {
                $mensaje = array("codigo" => "200", "mensaje" => "Bienvenido Admin", "idAdmin" => $resultado['idAdmin']);
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Usuario no existe o contraseña incorrecta, por favor verifique los datos introducidos");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }
}
