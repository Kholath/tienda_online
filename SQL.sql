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
	precio DECIMAL(6,2),
	descripcion VARCHAR(50)
);
insert into Productos (id, cantidad, precio, descripcion) values (1, 5, 8.19, 'Dont Starve.');
insert into Productos (id, cantidad, precio, descripcion) values (2, 3, 29.99, 'The Witcher 3: Wild Hunt.');
insert into Productos (id, cantidad, precio, descripcion) values (3, 4, 59.99, 'Death Stranding.');
insert into Productos (id, cantidad, precio, descripcion) values (4, 15, 49.90, 'Pokémon Escudo.');
insert into Productos (id, cantidad, precio, descripcion) values (5, 10, 39.90, 'Halo: The Master Chief collection.');
insert into Productos (id, cantidad, precio, descripcion) values (6, 2, 9.99, 'Black Desert Online: Remastered.');
insert into Productos (id, cantidad, precio, descripcion) values (7, 5, 22.99, 'Darkest Dungeon.');
insert into Productos (id, cantidad, precio, descripcion) values (8, 1, 19.99, 'Life is Strange.');
insert into Productos (id, cantidad, precio, descripcion) values (9, 3, 18.99, 'This War of Mine.');
insert into Productos (id, cantidad, precio, descripcion) values (10, 9, 44.99, 'Planet Zoo.');

--Creación tabla pedido
CREATE TABLE pedido(
    id INT PRIMARY KEY,
    total DECIMAL(6,2),
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