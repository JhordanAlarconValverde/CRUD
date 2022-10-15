<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="CSS/bootstrap/bootstrap.min.css">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="CSS/fontawesome/css/all.min.css">
</head>

<body>

    <?php
    require 'BD/conexion.php';
    require 'PAGES/modelo/usuario/Usuario.php';

    $usuario = new Usuario();

    // echo "<pre>";
    // print_r($usuario->listarUsuario());
    // echo "</pre>";

    ?>

    <div class="container mt-4">
        <h2 class="h2 text-center">Lista de usuarios</h2>

        <!-- Modal -->
        <div class="modal fade" id="modalDialogo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="tituloModal">Agregar usuario</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="bodyModal">

                        <div class="alert alert-warning alert-dismissible fade show d-none" role="alert" id="alert-validacion-formulario">

                            <strong id="validacion-formulario"></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                        <form action="" id="formularioModal">
                            <input type="hidden" class="form-control shadow-none my-2" name="txtID" id="txtID">
                            <div class="row">
                                <div class="col my-2">
                                    <label for="txtNombre">Nombres</label>
                                    <input type="text" class="form-control shadow-none my-2" name="txtNombre" id="txtNombre" placeholder="Ingrese Nombre">

                                </div>
                                <div class="col my-2">
                                    <label for="txtApellido">Apellidos</label>
                                    <input type="text" class="form-control shadow-none my-2" name="txtApellido" id="txtApellido" placeholder="Ingrese Apellido">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col my-2">
                                    <label for="txtCelular">Celular</label>
                                    <input type="text" class="form-control shadow-none my-2" name="txtCelular" id="txtCelular" placeholder="Ingrese Celular">

                                </div>
                                <div class="col my-2">
                                    <label for="txtCorreo">Correo</label>
                                    <input type="text" class="form-control shadow-none my-2" name="txtCorreo" id="txtCorreo" placeholder="Ingrese Correo">

                                </div>
                            </div>
                            <div class="cor">
                                <div class="col my-2">
                                    <label for="txtRol">Rol</label><br>

                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="radio" name="txtRol" id="rbtadmin" value="1">
                                        <label class="form-check-label" for="txtRol">
                                            Administrador
                                        </label>
                                    </div>
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="radio" name="txtRol" id="rbtuser" value="2">
                                        <label class="form-check-label" for="txtRol">
                                            Usuario
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Cancelar</button>
                        <input type="submit" id="btnGuardarModal" class="btn btn-primary shadow-none" value="Agregar">
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="modalVerUsuario" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body" id="modalVerBody">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="modalEliminarUsuario" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Borrar Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modalEliminarBody">
                        Esta seguro que desea eliminar al usuario <span id="span-usuario"></span>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary shadow-none" id="btnModalEliminarUsuarioID">Continuar</button>
                    </div>
                </div>
            </div>
        </div>

        <button id="btnAgregar" class="btn btn-primary shadow-none rounded-4 px-4 py-2"><i class="fa-solid fa-plus"></i> Añadir</button>

        <div class="row">
            <div class="col-10 mx-auto mt-2">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center">
                        <thead class="table-dark">
                            <th>Usuario</th>
                            <th>Celular</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody id="table-tbody-usuario">
                            <?php
                            $cantidadUsuarios = count($usuario->listarUsuario());

                            if ($cantidadUsuarios > 0) {
                                foreach ($usuario->listarUsuario() as $data) { ?>
                                    <tr class="row-table-usuarios align-middle">
                                        <td class="d-none row-codigo"><?= $data->codigo ?></td>
                                        <td class="row-usuario">
                                            <img style="width:45px;margin-right:10px" src="imagenes/img-defult/user.png" alt="">
                                            <?= $data->nombre . " " . $data->apellido ?>
                                        </td>
                                        <td class="row-celular"><?= $data->celular ?></td>
                                        <td class="row-correo"><?= $data->correo ?></td>
                                        <td class="row-rol"><?= $data->rol ?></td>
                                        <td>
                                            <button class="btn btn-info btn-sm shadow-none btnModalVerUsuario"><i class="fa-sharp fa-solid fa-eye"></i></button>
                                            <button class="btn btn-warning btn-sm shadow-none btnEditar"><i class="fa-solid fa-pen-to-square"></i></button>
                                            <button class="btn btn-danger btn-sm shadow-none btnEliminarUsuario"><i class="fa-solid fa-trash-can"></i></button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="6">No hay datos registrados</td>
                                </tr>


                            <?php } ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- JQUERY SCRIPT -->
    <script src="JS/jquery-3.6.1.js"></script>
    <!-- BOOTSTRAP SCRIPT -->
    <script src="JS/bootstrap/bootstrap.min.js"></script>
    <!-- USUARIO SCRIPT -->
    <script src="JS/usuario/usuario.js"></script>
</body>

</html>