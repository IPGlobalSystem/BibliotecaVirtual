create table categoria(
id int auto_increment,
nombre varchar(50) not null,
constraint PK_Categoria primary key (id),
constraint UQ_Categoria  unique (nombre)
);

 