<?php
require '../../../BD/conexion.php';
require '../../modelo/usuario/Usuario.php';
$usuario = new Usuario();


foreach ($usuario->listarUsuario() as $data) { ?>
    <tr class="row-table-usuarios">
        <td class="d-none row-codigo"><?= $data->codigo ?></td>
        <td class="row-usuario"><?= $data->nombre . " " . $data->apellido ?></td>
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

<script src="http://localhost/CRUD/JS/usuario/usuario.js"></script>