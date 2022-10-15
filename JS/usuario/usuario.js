$(document).ready(function(){
            
    // Añadir
    $("#btnAgregar").click(function(){
        $("#txtID").attr("value", "");
        $("#txtNombre").attr("value", "");
        $("#txtApellido").attr("value", "");
        $("#txtCelular").attr("value", "");
        $("#txtCorreo").attr("value", "");

        $("#alert-validacion-formulario").removeClass("d-block");
        $("#alert-validacion-formulario").addClass("d-none");

        // $("#formularioModal").trigger("reset");
        $("#btnGuardarModal").val("Agregar");
        $("#tituloModal").text("Agregar usuario");
        $("#rbtadmin").attr("checked",false);
        $("#rbtuser").attr("checked",false);
        $("#modalDialogo").modal("show");
    })  

    // Agregar / Actualizar
    $("#btnGuardarModal").click(function(e){
        e.preventDefault();
        // console.log($("#formularioModal").serialize());
        var usuario = $("#formularioModal").serialize() + "&p=" + $(this).attr("value");

        $.ajax({
            url: 'http://localhost/CRUD/pages/controlador/usuarioControlador.php',
            type: 'POST',
            data: usuario
        }).done(function(rpta){
            if(rpta > 0){
               $("#formularioModal").trigger("reset");
                $("#table-tbody-usuario").load("http://localhost/CRUD/pages/vistas/usuario/listarUsuario.php");
                $("#modalDialogo").modal("hide");
            }

            if(rpta == 'empty'){
                $("#alert-validacion-formulario").removeClass("d-none");
                $("#alert-validacion-formulario").addClass("d-block")
                $("#validacion-formulario").text("Completa todos los campos");
                console.log(rpta);
            }
            
        })
    })

    // Ver Usuario
    $(".btnModalVerUsuario").click(function(){
        let usuario = $(this).closest(".row-table-usuarios").children(".row-usuario").text();
        let celular = $(this).closest(".row-table-usuarios").children(".row-celular").text();
        let correo = $(this).closest(".row-table-usuarios").children(".row-correo").text();
        let rol = $(this).closest(".row-table-usuarios").children(".row-rol").text();

        $("#modalVerUsuario").modal("show");

        $("#modalVerBody").html(`
            <div class="text-center my-3">
                <p class="h4">${usuario}</p>
                <span class="h5 ${rol == 'Administrador' ? 'text-primary' : 'text-danger'}">${rol}</span>
            </div>
            <div class="mx-5">
                <i class="fa-regular fa-envelope"></i> ${correo} <br>
                <i class="fa-solid fa-phone"></i> ${celular}
            </div>
        `);
    })

    // Editar
    $(".btnEditar").click(function(){

        let codigo = $(this).closest(".row-table-usuarios").children(".row-codigo").text();
        let usuario = $(this).closest(".row-table-usuarios").children(".row-usuario").text();
        let celular = $(this).closest(".row-table-usuarios").children(".row-celular").text();
        let correo = $(this).closest(".row-table-usuarios").children(".row-correo").text();
        let rol = $(this).closest(".row-table-usuarios").children(".row-rol").text();

        $("#modalDialogo").modal("show");

        $("#tituloModal").text("Editar usuario");

        var datos = "idEditar=" + $(this).closest(".row-table-usuarios").children(".row-codigo").text();

        $.ajax({
            url: 'http://localhost/CRUD/pages/controlador/usuarioControlador.php',
            type: 'POST',
            data: datos
        }).done(function(rpta){
            let json = JSON.parse(rpta);

            $("#txtID").attr("value", json["codigo"]);
            $("#txtNombre").attr("value", json["nombre"]);
            $("#txtApellido").attr("value", json["apellido"]);
            $("#txtCelular").attr("value", json["celular"]);
            $("#txtCorreo").attr("value", json["correo"]);
            if(json["codRol"] == 1){
                $('#rbtadmin').attr("checked",true);
            }else if(json["codRol"] == 2){
                $('#rbtuser').attr("checked",true);
            }

            $("#btnGuardarModal").val("Actualizar");

            $("#formularioModal").trigger("reset");
            $("#table-tbody-usuario").load("http://localhost/CRUD/pages/vistas/usuario/listarUsuario.php");
            $("#modalDialogo").modal("hide");

        })
    })

    $(".btnEliminarUsuario").click(function () {
        let usuario = $(this).closest(".row-table-usuarios").children(".row-usuario").text();
        let codigo = $(this).closest(".row-table-usuarios").children(".row-codigo").text();
        var datos = "idEliminar=" + codigo;
        $("#modalEliminarUsuario").modal("show");
        $("#span-usuario").text(usuario);

        $("#btnModalEliminarUsuarioID").click(function(){

            $.ajax({
                url: 'http://localhost/CRUD/pages/controlador/usuarioControlador.php',
                type: 'POST',
                data: datos
            }).done(function(rpta){
                if(rpta){
                    location.href = "http://localhost/CRUD/";
                }
                console.log(rpta);
            })
        })
    })
})