<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Parte Taba Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.min.css">
</head>

<body>
    <main>
        <div class="contenedor__todo">
            <div class="caja__trasera">
                <div class="caja__trasera-login">
                    <h3>¿Ya estás registrado?</h3>
                    <p>Registra tu hora de llegada y salida</p>
                    <button id="btn__registrar_hora" class="btn btn-primary">Registrar Hora</button>
                </div>
                <div class="caja__trasera-saber">
                    <h3>¿Aún no estás registrado?</h3>
                    <p>Regístrate para que puedas ingresar tu hora de llegada y salida</p>
                    <button id="btn__registrar_empleado" class="btn btn-secondary">Registrar Empleado</button>
                </div>
            </div>
            <div class="contenedor__login-register">
                <form action="../controllers/ControlController.php" method="POST" class="formulario__login">
                    <h2>Registra hora de llegada y salida</h2>
                    <div class="mb-3">
                        <label for="selectNombreEmpleado" class="form-label">Selecciona nombre del empleado</label>
                        <select id="selectNombreEmpleado" class="form-control" name="idEmpleados">
                            <?php
                            include_once "../models/Conexion.php";
                            $conn = Conexion::conectar();
                            $stmt = $conn->prepare("SELECT idEmpleados, nombre_completo FROM empleados");
                            $stmt->execute();
                            $empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($empleados as $empleado) {
                                echo "<option value='" . $empleado['idEmpleados'] . "'>" . $empleado['nombre_completo'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn btn-primary" id="btnHoraLlegada" data-bs-toggle="modal" data-bs-target="#modalHoraLlegada">Hora de llegada</button>
                        <p id="mostrarHoraLlegada"></p> <!-- Aquí se muestra la hora de llegada seleccionada -->
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn btn-secondary" id="btnHoraSalida" data-bs-toggle="modal" data-bs-target="#modalHoraSalida">Hora de salida</button>
                        <p id="mostrarHoraSalida"></p> <!-- Aquí se muestra la hora de salida seleccionada -->
                    </div>
                    <input type="hidden" name="hora_llegada" id="horaLlegada" />
                    <input type="hidden" name="hora_salida" id="horaSalida" />
                    <button type="submit" id="btnGuardar" class="btn btn-success">Guardar</button>
                </form>
                <form action="../controllers/EmpleadoController.php" method="POST" class="formulario__register">
                    <h2>Registrar al Empleado</h2>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Nombre Completo" name="nombre_completo" required />
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Correo Electrónico" name="correo" required />
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Cargo" name="cargo" required />
                    </div>
                    <div class="mb-3">
                        <input type="tel" class="form-control" placeholder="Teléfono" name="telefono" required />
                    </div>
                    <div class="mb-3">
                        <input type="tel" class="form-control" placeholder="Cedula" name="cedula" required />
                    </div>
                    <input type="hidden" name="admin_id" value="1" />
                    <button type="submit" class="btn btn-primary" id="btnRegistrarEmpleado">Registrar</button>
                </form>
            </div>
        </div>
        <div class="container mt-5">
            <h2 class="text-center">Listado de Horas de Empleados</h2>
            <div class="table-responsive">
                <table id="tablaHoras" class="table table-hover" style="width: 100%;">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Nombre Completo</th>
                            <th scope="col">Hora de Llegada</th>
                            <th scope="col">Hora de Salida</th>
                        </tr>
                    </thead>
                    <tbody id="cuerpoTablaHoras">
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Modal Hora de Llegada -->
    <div class="modal fade" id="modalHoraLlegada" tabindex="-1" aria-labelledby="modalHoraLlegadaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHoraLlegadaLabel">Hora de Llegada</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="datetime-local" id="inputHoraLlegada" class="form-control" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="saveHoraLlegada()">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hora de Salida -->
    <div class="modal fade" id="modalHoraSalida" tabindex="-1" aria-labelledby="modalHoraSalidaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHoraSalidaLabel">Hora de Salida</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="datetime-local" id="inputHoraSalida" class="form-control" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="saveHoraSalida()">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../views/js/main.js"></script>
    <script>
        function saveHoraLlegada() {
            const horaLlegada = document.getElementById("inputHoraLlegada").value;
            document.getElementById("horaLlegada").value = horaLlegada;
            document.getElementById("mostrarHoraLlegada").innerText = "Hora de llegada: " + horaLlegada;
        }

        function saveHoraSalida() {
            const horaSalida = document.getElementById("inputHoraSalida").value;
            document.getElementById("horaSalida").value = horaSalida;
            document.getElementById("mostrarHoraSalida").innerText = "Hora de salida: " + horaSalida;
        }

        $(document).ready(function() {
            $('#tablaHoras').DataTable({
                "ajax": {
                    "url": "../controllers/ControlController.php",
                    "type": "POST",
                    "data": {
                        "listarHoras": "ok"
                    },
                    "dataSrc": function(json) {
                        if (json.codigo === "200") {
                            return json.listaHoras;
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: json.mensaje,
                            });
                            return [];
                        }
                    }
                },
                "columns": [{
                        "data": "nombre_completo"
                    },
                    {
                        "data": "hora_llegada"
                    },
                    {
                        "data": "hora_salida"
                    }
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json"
                }
            });
        });
    </script>
</body>

</html>