create database nixs;
use nixs;

create table usuarios (
id_usuario int auto_increment primary key,
usuario varchar(30),
contraseña varchar(30)
);
select * from usuarios;