drop database if exists xrv;
create database xrv;
use xrv;
-- CREANDO TABLA DE USUARIOS --
create table usuarios (
	id_usuario int auto_increment primary key,
    nombre varchar(255) not null,
    apellido varchar(255) not null,
    ciclo varchar(255) not null,
    curso varchar(255) not null,
    email varchar(255) not null UNIQUE,
    contrasena varchar(255) not null
);
-- CREANDO TABLE DE PROFESOR --
create table profesor (
	id_profesor int auto_increment primary key,
    nombre varchar(255) not null,
    email varchar(255) not null UNIQUE
);
-- CREANDO TABLA DE ASIGNATURAS --
create table asignaturas (
	id_asignatura int auto_increment primary key,
    id_profesor int not null,
    asignatura varchar(255) not null,
	foreign key (id_profesor) references profesor(id_profesor) ON DELETE CASCADE ON UPDATE CASCADE
); 
-- CREANDO TABLA DE MATRICULA --
create table matricula (
	id_matricula int auto_increment primary key,
	id_usuario int not null,
    id_asignatura int not null,
    foreign key (id_usuario) references usuarios(id_usuario) ON DELETE CASCADE ON UPDATE CASCADE,
    foreign key (id_asignatura) references asignaturas (id_asignatura) ON DELETE CASCADE ON UPDATE CASCADE
);

-- CREANDO TABLA NOTAS --
create table notas (
	id_notas int auto_increment primary key,
    id_usuario int not null,
    id_asignatura int not null,
    nota double not null,
    foreign key (id_usuario) references usuarios(id_usuario) ON DELETE CASCADE ON UPDATE CASCADE,
    foreign key (id_asignatura) references asignaturas(id_asignatura) ON DELETE CASCADE ON UPDATE CASCADE
);
-- CREANDO TABLA CLASES --
create table clases (
	id_clases int auto_increment primary key,
    id_asignatura int not null,
    aula varchar(255),
    horario varchar(255),
    foreign key (id_asignatura) references asignaturas(id_asignatura) ON DELETE CASCADE ON UPDATE CASCADE
);
create table login (
    id int auto_increment primary key,
    login_usuario VARCHAR (255),
    password VARCHAR (255)
);
-- INSERTAMOS DATOS EN LA TABLA USUARIOS --
insert into usuarios (nombre, apellido, ciclo, curso, email, contrasena) 
values ("Victor Manuel", "De Mendoza", "Desarrollo de Aplicaciones Multiplataforma",
        "2º", "victor@gmail.com", password("1234")),
        ("Rodrigo", "Azuaga Caceres", "Desarrollo de Aplicaciones Multiplataforma",
        "2º", "rodrigo@gmail.com", password("1234")),
        ("Xiomara", "Laos Chipana", "Desarrollo de Aplicaciones Multiplataforma", 
        "2º", "xiomara@gmail.com", password("1234")
);
insert into profesor (nombre, email) 
values ("Vicente Luque", "vicente@gmail.com"),
        ("Kathy Chuquimarca", "kathy@gmail.com"),
        ("Nereida Hernandez", "nereida@gmail.com"),
        ("Francisco Martínez", "francisco@gmail.com"

);
insert into asignaturas (id_profesor, asignatura )
 values (1, "Programacion"),
        (2, "Base de Datos"),
        (3, "Acceso a datos"),
        (4, "Ingles"
);
insert into matricula (id_usuario, id_asignatura )
 values (1, 1),
        (1, 2),
        (2, 2),
        (2, 3),
        (3, 1
);
insert into notas (id_usuario, id_asignatura, nota )
 values (1, 1, 8),
        (1, 2, 6),
        (2, 2, 7),
        (2, 3, 9),
        (3, 1, 8
);
insert into clases (id_asignatura, aula, horario )
 values (1, "L10", "8:30-9:30"),
        (2, "L11", "10:00-11:00"),
        (3, "L12", "12:30-14:30"),
        (4, "L13", "16:00-17:00"
);
insert into login (login_usuario, password)
values ("admin", "admin"
);
insert into clases (id_asignatura, aula, horario )
 values 
        (5, "L15", "10:30-11:30"),
        (6, "L16", "11:30-12:30"),
        (7, "L17", "12:30-13:30"),
        (8, "L18", "15:00-16:00"),
        (9, "L19", "16:00-17:00"),
        (10, "L09", "17:00-18:00"),
        (11, "L08", "17:30-18:30"),
        (12, "L07", "18:30-19:30"),
        (13, "L06", "19:00-20:00"

);
