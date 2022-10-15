-- Creacion de la base de datos
create database CRUD;

-- Indicar que se usará la base de datos creada
use CRUD;

-- Creacion de tablas
create table if not exists tb_rol(
	codigo int primary key auto_increment not null,
    rol varchar(50) not null
);

create table if not exists tb_usuario(
	codigo int primary key auto_increment not null,
    nombre varchar(100) not null,
    apellido varchar(100) not null,
    celular varchar(15) not null,
    correo varchar(100) not null,
    codRol int,
    foreign key(codRol) references tb_rol(codigo) 
    on update cascade on delete cascade
);

-- Procedimientos Almacenados
/* ROL */
-- Listar
delimiter %%
create procedure sp_listarRol()
begin
	select * from tb_rol;
end %%

-- Insertar
delimiter %%
create procedure sp_insertarRol(
	in _rol varchar(50)
)
begin
	insert into tb_rol(rol) values(_rol);
end %%

-- Actualizar
delimiter %%
create procedure sp_actualizarRol(
	in _codigo int,
	in _rol varchar(50)
)
begin
	update tb_rol set rol = _rol where codigo = _codigo;
end %%

-- Eliminar
delimiter %%
create procedure sp_eliminarRol(
	in _codigo int
)
begin
	delete from tb_rol where codigo = _codigo;
end %%

call sp_listarRol();
call sp_insertarRol('Administrador');
call sp_insertarRol('Usuario');

/* USUARIO */
-- Listar
delimiter %%
create procedure sp_listarUsuario()
begin
	select tbu.codigo 'codigo', tbu.nombre 'nombre', 
           tbu.apellido 'apellido', tbu.celular 'celular', 
           tbu.correo 'correo', tbr.rol 'rol' 
           from tb_usuario tbu inner join tb_rol tbr on(tbu.codRol=tbr.codigo) order by tbu.codigo asc;
end %%

-- Insertar
delimiter %%
create procedure sp_insertarUsuario(
    in _nombre varchar(100),
    in _apellido varchar(100),
    in _celular varchar(15),
    in _correo varchar(100),
    in _codRol int
)
begin
	insert into tb_usuario(nombre,apellido,celular,correo,codRol) 
    values(_nombre,_apellido,_celular,_correo,_codRol);
end %%

-- Actualizar
delimiter %%
create procedure sp_actualizarUsuario(
	in _codigo int,
    in _nombre varchar(100),
    in _apellido varchar(100),
    in _celular varchar(15),
    in _correo varchar(100),
    in _codRol int
)
begin
	update tb_usuario set nombre = _nombre,
						  apellido = _apellido,
                          celular = _celular,
                          correo = _correo,
                          codRol = _codRol
                          where codigo = _codigo;
end %%

-- Eliminar
delimiter %%
create procedure sp_eliminarUsuario(
	in _codigo int
)
begin
	delete from tb_usuario where codigo = _codigo;
end %%

-- Buscar por codigo
delimiter %%
create procedure sp_buscarUsuarioPorCodigo(
	in _codigo int
)
begin
	select * from tb_usuario where codigo = _codigo;
end %%

call sp_listarUsuario();
call sp_insertarUsuario('Jhordan','Alarcon','925507105','jhoralar2002@gmail.com',1);
select * from tb_rol;