<?php

class Conexion
{
    public static function conectar()
    {
        $nombreServidor = "localhost";
        $usuario = "root";
        $password = "";
        $baseDatos = "proyecto_mvc";
        $objConexion = null;

        try {
            $objConexion = new PDO("mysql:host=$nombreServidor;dbname=$baseDatos;charset=utf8", $usuario, $password);
            $objConexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error en la conexión: " . $e->getMessage();
        }

        return $objConexion;
    }
}
