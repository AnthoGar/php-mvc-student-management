drop database mi_mvc;
create database mi_mvc;
use mi_mvc;
create table alumnos (
    id int auto_increment primary key,
    nombre varchar(100),
    correo varchar(100)
);
insert into alumnos(nombre, correo)
values ('Edward', 'edward@example.com');
insert into alumnos(nombre, correo)
values ('Renzo', 'renzo@example.com');
insert into alumnos(nombre, correo)
values ('Piero', 'piero@example.com');