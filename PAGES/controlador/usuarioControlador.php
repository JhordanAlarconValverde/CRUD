<?php
    require '../../BD/conexion.php';
    require '../modelo/usuario/Usuario.php';
    require '../modelo/usuario/M_Usuario.php';
    $usuario = new Usuario();
    $m_usuario = new M_Usuario();

    // Agregar / Actualizar
    if(isset($_POST["p"])){
        $procedimiento = $_POST["p"];

        $codigo = !empty($_POST["txtID"]) ? trim($_POST["txtID"]) : '';
        $nombre = !empty($_POST["txtNombre"]) ? trim($_POST["txtNombre"]) : '';
        $apellido = !empty($_POST["txtApellido"]) ? trim($_POST["txtApellido"]) : '';
        $celular = !empty($_POST["txtCelular"]) ? trim($_POST["txtCelular"]) : '';
        $correo = !empty($_POST["txtCorreo"]) ? trim($_POST["txtCorreo"]) : '';
        $codRol = !empty($_POST["txtRol"]) ? trim($_POST["txtRol"]) : '';

        if($nombre == "" || $apellido == "" || $celular == "" || $correo == "" || $codRol == ""){
            echo "empty";
        }else{
            $m_usuario->codigo = $codigo;
            $m_usuario->nombre = $nombre;
            $m_usuario->apellido = $apellido;
            $m_usuario->celular = $celular;
            $m_usuario->correo = $correo;
            $m_usuario->codRol = $codRol;

            if($procedimiento == "Agregar"){
                echo $usuario->insertarUsuario($m_usuario);
            }

            if($procedimiento == "Actualizar"){
                echo $usuario->actualizarUsuario($m_usuario);
            }
        }
    }

    // Editar
    if(isset($_POST["idEditar"])){
        $codigo = $_POST["idEditar"];
        echo json_encode($usuario->buscarUsuarioPorCodigo($codigo));
    }

    // Eliminar
    if(isset($_POST["idEliminar"])){
        $codigo = $_POST["idEliminar"];
        echo $usuario->eliminarUsuario($codigo);
    }
?>