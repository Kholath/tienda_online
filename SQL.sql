-- Creación base de datos y usuario.
create database tienda;
create user tiendaonline identified by 'tiendaonline';
use tienda;
grant all on tienda.* to tiendaonline;

--Creación tabla cliente e insercción de datos
create table Cliente (
	usuario VARCHAR(50) PRIMARY KEY,
	password VARCHAR(50)
);
insert into Cliente (usuario, password) values ('pepeviyu', 'pepeviyu');
insert into Cliente (usuario, password) values ('bhemmingway1', 'k2ay4qRJKTQl');
insert into Cliente (usuario, password) values ('bdishmon2', 's1GCLEiuW');
insert into Cliente (usuario, password) values ('gfoddy3', '4v9ZAR');
insert into Cliente (usuario, password) values ('mclemitt4', 'HdtoUf5bO');
insert into Cliente (usuario, password) values ('scullnean5', 'AJFVW9Ql3lW');
insert into Cliente (usuario, password) values ('aarrighetti6', 'PqwW6n0l');
insert into Cliente (usuario, password) values ('syurivtsev7', 'soEm6gu');
insert into Cliente (usuario, password) values ('skellart8', 'd3pXXd4AGb2');
insert into Cliente (usuario, password) values ('fkarolowski9', 'oB3FDA');

--Creación tabla productos e insercción de datos
create table Productos (
	id INT PRIMARY KEY,
	cantidad INT,
	precio DECIMAL(4,2)
);
insert into Productos (id, cantidad, precio) values (1, 5, 68.12);
insert into Productos (id, cantidad, precio) values (2, 3, 50.94);
insert into Productos (id, cantidad, precio) values (3, 4, 7.45);
insert into Productos (id, cantidad, precio) values (4, 15, 57.99);
insert into Productos (id, cantidad, precio) values (5, 10, 16.83);
insert into Productos (id, cantidad, precio) values (6, 2, 40.78);
insert into Productos (id, cantidad, precio) values (7, 5, 60.67);
insert into Productos (id, cantidad, precio) values (8, 1, 56.84);
insert into Productos (id, cantidad, precio) values (9, 3, 61.41);
insert into Productos (id, cantidad, precio) values (10, 9, 19.95);

--Creación tabla pedido
CREATE TABLE pedido(
    id INT PRIMARY KEY,
    total DECIMAL(4,2),
    usuario VARCHAR(50),
    FOREIGN KEY (usuario) REFERENCES cliente(usuario)
);

--Creación tabla contiene
CREATE TABLE contiene(
	idProducto INT,
    idPedido INT,
    cantidad INT,
    FOREIGN KEY (idProducto) REFERENCES productos(id),
    FOREIGN KEY (idPedido) REFERENCES pedido(id),
    PRIMARY KEY(idProducto, idPedido)
);