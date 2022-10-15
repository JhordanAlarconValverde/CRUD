<?php
   
    class Usuario extends Conexion{

        // public $codigo;
        // public $nombre;
        // public $apellido;
        // public $celular;
        // public $correo;
        // public $codRol;

        // public function listarBloque(){
        //     $bloque = null;

        //     $consulta = $this->Conectar()->query("select * from tbBloque;");
            
        //     $bloque = $consulta->fetchAll(PDO::FETCH_OBJ);
            
        //     $conexion = null;

        //     return $bloque;
        // }

        public function listarUsuario(){
            $usuario = null;

            $conexion = $this->Conectar();

            $consulta = $conexion->prepare("call sp_listarUsuario()");

            $consulta->execute();
            
            $usuario = $consulta->fetchAll(PDO::FETCH_OBJ);
            
            $conexion = null;

            return $usuario;
        }


        public function buscarUsuarioPorCodigo($codigo){
           $usuario = null;

           $conexion = $this->Conectar();

           $consulta = $conexion->prepare("call sp_buscarUsuarioPorCodigo(:codigo)");

           $consulta->bindParam(":codigo", $codigo);

           $consulta->execute();

           $usuario = $consulta->fetch(PDO::FETCH_OBJ);

           $conexion = null;

           return $usuario;
        }


        public function insertarUsuario(M_Usuario $m_usuario){
            $condicion = false;

            $conexion = $this->Conectar();

            $consulta = $conexion->prepare("call sp_insertarUsuario(:nombre,:apellido,:celular,:correo,:codRol)");
            $consulta->bindParam(":nombre", $m_usuario->nombre, PDO::PARAM_STR);
            $consulta->bindParam(":apellido", $m_usuario->apellido, PDO::PARAM_STR);
            $consulta->bindParam(":celular", $m_usuario->celular, PDO::PARAM_STR);
            $consulta->bindParam(":correo", $m_usuario->correo, PDO::PARAM_STR);
            $consulta->bindParam(":codRol", $m_usuario->codRol, PDO::PARAM_INT);

            if($consulta->execute()){
                $condicion = true;
            }
            
            $conexion = null;
            return $condicion;
        }

        public function actualizarUsuario(M_Usuario $m_usuario){
            $condicion = false;

            $conexion = $this->Conectar();

            $consulta = $conexion->prepare("call sp_actualizarUsuario(:codigo,:nombre,:apellido,:celular,:correo,:codRol)");
            $consulta->bindParam(":codigo", $m_usuario->codigo, PDO::PARAM_INT);
            $consulta->bindParam(":nombre", $m_usuario->nombre, PDO::PARAM_STR);
            $consulta->bindParam(":apellido", $m_usuario->apellido, PDO::PARAM_STR);
            $consulta->bindParam(":celular", $m_usuario->celular, PDO::PARAM_STR);
            $consulta->bindParam(":correo", $m_usuario->correo, PDO::PARAM_STR);
            $consulta->bindParam(":codRol", $m_usuario->codRol, PDO::PARAM_INT);
            
            if($consulta->execute()){
                $condicion = true;
            }
            
            $conexion = null;
            return $condicion;
        }

        public function eliminarUsuario($codigo){
            $condicion = false;

            $conexion = $this->Conectar();

            $consulta = $conexion->prepare("call sp_eliminarUsuario(:codigo)");
            $consulta->bindParam(":codigo", $codigo, PDO::PARAM_INT);
            
            if($consulta->execute()){
                $condicion = true;
            }
            
            $conexion = null;
            return $condicion;
        }

        // public function actualizar(M_Alumno $m_alumno){
        //     $condicion = false;

        //     $conexion = $this->Conectar();

        //     $consulta = $conexion->prepare("call actualizarAlumno(:id,:nombre,:apellido,:dni,:idBloque)");

        //     $consulta->bindParam(":id",$m_alumno->id, PDO::PARAM_INT);
        //     $consulta->bindParam(":nombre",$m_alumno->nombre, PDO::PARAM_STR);
        //     $consulta->bindParam(":apellido",$m_alumno->apellido, PDO::PARAM_STR);
        //     $consulta->bindParam(":dni",$m_alumno->dni, PDO::PARAM_STR);
        //     $consulta->bindParam(":idBloque",$m_alumno->idBloque, PDO::PARAM_INT);
            
        //     if($consulta->execute()){
        //         $condicion = true;
        //     }

        //     $conexion = null;

        //     return $condicion;
        // }

        // public function eliminar($id){
        //     $condicion = false;

        //     $conexion = $this->Conectar();

        //     $consulta = $conexion->prepare("call eliminarAlumno(:id)");

        //     $consulta->bindParam(":id",$id, PDO::PARAM_INT);
            
        //     if($consulta->execute()){
        //         $condicion = true;
        //     }

        //     $conexion = null;

        //     return $condicion;
        // }

        // public function buscar($value){
        //     $alumnos = null;

        //     $conexion = $this->Conectar();

        //     $consulta = $conexion->prepare("call buscarAlumno(:value)");
            
        //     $consulta->bindParam(":value", $value);

        //     $consulta->execute();

        //     $alumnos = $consulta->fetchAll(PDO::FETCH_OBJ);
            
        //     $conexion = null;

        //     return $alumnos;
        // }

    }
?>