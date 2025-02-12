<?php
include_once 'Conexion.php';

class EmpleadoModel
{

    public static function mdlRegistrarEmpleado($nombre_completo, $correo, $cargo, $telefono, $cedula, $admin_id)
    {
        try {
            $conn = Conexion::conectar();
            $stmt = $conn->prepare("INSERT INTO empleados (nombre_completo, correo, cargo, telefono, cedula, Admin_idAdmin) VALUES (:nombre_completo, :correo, :cargo, :telefono, :cedula, :admin_id)");
            $stmt->bindParam(":nombre_completo", $nombre_completo, PDO::PARAM_STR);
            $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
            $stmt->bindParam(":cargo", $cargo, PDO::PARAM_STR);
            $stmt->bindParam(":telefono", $telefono, PDO::PARAM_STR);
            $stmt->bindParam(":cedula", $cedula, PDO::PARAM_STR);
            $stmt->bindParam(":admin_id", $admin_id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function mdlRegistrarHora($idEmpleados, $hora_llegada, $hora_salida)
    {
        try {
            $conn = Conexion::conectar();
            $stmt = $conn->prepare("INSERT INTO control (Empleados_idEmpleados, hora_llegada, hora_salida) VALUES (:idEmpleados, :hora_llegada, :hora_salida)");
            $stmt->bindParam(":idEmpleados", $idEmpleados, PDO::PARAM_INT);
            $stmt->bindParam(":hora_llegada", $hora_llegada, PDO::PARAM_STR);
            $stmt->bindParam(":hora_salida", $hora_salida, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}
