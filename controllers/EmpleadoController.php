<?php
include_once '../models/EmpleadoModel.php';

class EmpleadoController
{

    public static function ctrRegistrarEmpleado()
    {
        if ($_POST) {
            $nombre_completo = $_POST['nombre_completo'];
            $correo = $_POST['correo'];
            $cargo = $_POST['cargo'];
            $telefono = $_POST['telefono'];
            $cedula = $_POST['cedula'];
            $admin_id = $_POST['admin_id'];

            $respuesta = EmpleadoModel::mdlRegistrarEmpleado($nombre_completo, $correo, $cargo, $telefono, $cedula, $admin_id);

            if ($respuesta) {
                echo json_encode(['codigo' => 200, 'mensaje' => 'Empleado registrado correctamente']);
            } else {
                echo json_encode(['codigo' => 500, 'mensaje' => 'Error al registrar el empleado']);
            }
        }
    }

    public static function ctrRegistrarHora()
    {
        if ($_POST) {
            $idEmpleados = $_POST['idEmpleados'];
            $hora_llegada = $_POST['hora_llegada'];
            $hora_salida = $_POST['hora_salida'];

            $respuesta = EmpleadoModel::mdlRegistrarHora($idEmpleados, $hora_llegada, $hora_salida);

            if ($respuesta) {
                echo json_encode(['codigo' => 200, 'mensaje' => 'Hora registrada correctamente']);
            } else {
                echo json_encode(['codigo' => 500, 'mensaje' => 'Error al registrar la hora']);
            }
        }
    }
}   

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nombre_completo'])) {
        EmpleadoController::ctrRegistrarEmpleado();
    } elseif (isset($_POST['idEmpleados'])) {
        EmpleadoController::ctrRegistrarHora();
    }
}
