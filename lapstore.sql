CREATE DATABASE lapstore;
CREATE TABLE op_persona (--personas
	dni INTEGER PRIMARY KEY,
	nombres VARCHAR (100),
	papellido VARCHAR (100),
	sapellido VARCHAR (100),
	fecha_nacimiento DATE,
	sexo CHAR,
	direccion VARCHAR (100),
	ciudad VARCHAR (100),
	complemento VARCHAR (100)
);

CREATE TABLE op_telefono_persona (
	dni_p INTEGER PRIMARY KEY,
	numero INTEGER
);

CREATE TABLE op_cliente (
	dni_p INTEGER PRIMARY KEY
);

CREATE TABLE op_cuenta(
	correo_c VARCHAR(100) PRIMARY KEY,
	nombres_c VARCHAR(100),
	apellidos_c VARCHAR(100),
	contrasenha VARCHAR(100),
	dni_c VARCHAR(100)
);

CREATE TABLE op_empleado (
	codigo_id INTEGER PRIMARY KEY,
	dni_p INTEGER,
	salario NUMERIC(10,2),
	hora_entrada TIME,
	hora_salida TIME
);

CREATE TABLE op_vendedor (
	codigo_e INTEGER PRIMARY KEY,
	dni_p INTEGER
);

CREATE TABLE op_administrador (
	codigo_e INTEGER PRIMARY KEY,
	dni_p INTEGER,
	correo_a VARCHAR(100),
	contrasenha VARCHAR(100)
);

CREATE TABLE op_guardia (
	codigo_e INTEGER PRIMARY KEY,
	dni_p INTEGER
);

CREATE TABLE op_tienda (--tienda
	codigo VARCHAR(50) PRIMARY KEY,
	nombre VARCHAR(100),
	ciudad VARCHAR(100),
	departamento VARCHAR(100),
	calle VARCHAR(100),
	numero INTEGER,
	complemento VARCHAR(100),
	codigo_admin INTEGER
);

CREATE TABLE op_camara_seguridad (
	numero INTEGER PRIMARY KEY,
	codigo_t VARCHAR(50)
);

CREATE TABLE op_productos (
	codigo_id INTEGER PRIMARY KEY,
	codigo_v INTEGER,
	codigo_t VARCHAR(50),
	precio NUMERIC(10,2),
	cantidad INTEGER
);

CREATE TABLE op_laptops (
	modelo VARCHAR(50) PRIMARY KEY,
	codigo_p INTEGER,
	disco_duro VARCHAR(50),
	pantalla NUMERIC(5,2),
	procesador VARCHAR(50),
	SO VARCHAR(50),
	peso NUMERIC(5,2),
	RAM INTEGER,
	tarjeta_grafica VARCHAR(50)
);

CREATE TABLE op_auriculares (
	codigo_p INTEGER PRIMARY KEY,
	modelo VARCHAR(50)
);

CREATE TABLE op_parlantes (
	codigo_p INTEGER PRIMARY KEY,
	modelo VARCHAR(50)
);

CREATE TABLE prod_vendidos (
	codigo_p INTEGER PRIMARY KEY,
	codigo_v INTEGER,
	codigo_t VARCHAR(50),
	cantidad INTEGER
);

/*Agregando claves foráneas en las tablas*/
ALTER TABLE op_administrador ADD FOREIGN KEY (codigo_e) REFERENCES op_empleado (codigo_id);
ALTER TABLE op_telefono_persona ADD FOREIGN KEY (dni_p) REFERENCES op_persona (dni);
ALTER TABLE op_cliente ADD FOREIGN KEY (dni_p) REFERENCES op_persona (dni);
ALTER TABLE op_empleado ADD FOREIGN KEY (dni_p) REFERENCES op_persona (dni);
ALTER TABLE op_vendedor ADD FOREIGN KEY (codigo_e) REFERENCES op_empleado (codigo_id);
ALTER TABLE op_guardia ADD FOREIGN KEY (codigo_e) REFERENCES op_empleado (codigo_id);
ALTER TABLE op_cuenta ADD FOREIGN KEY (dni_c) REFERENCES op_cliente (dni_p);
ALTER TABLE op_administrador ADD FOREIGN KEY (dni_p) REFERENCES op_persona (dni);
ALTER TABLE op_vendedor ADD FOREIGN KEY (dni_p) REFERENCES op_persona (dni);
ALTER TABLE op_guardia ADD FOREIGN KEY (dni_p) REFERENCES op_persona (dni);

ALTER TABLE op_tienda ADD FOREIGN KEY (codigo_admin) REFERENCES op_administrador (codigo_e);
ALTER TABLE op_camara_seguridad ADD FOREIGN KEY (codigo_t) REFERENCES op_tienda (codigo);
ALTER TABLE op_productos ADD FOREIGN KEY (codigo_v) REFERENCES op_vendedor (codigo_e);
ALTER TABLE op_productos ADD FOREIGN KEY (codigo_t) REFERENCES op_tienda (codigo);
ALTER TABLE op_laptops ADD FOREIGN KEY (codigo_p) REFERENCES op_productos (codigo_id);
ALTER TABLE op_auriculares ADD FOREIGN KEY (codigo_p) REFERENCES op_productos (codigo_id);
ALTER TABLE op_parlantes ADD FOREIGN KEY (codigo_p) REFERENCES op_productos (codigo_id);
ALTER TABLE prod_vendidos ADD FOREIGN KEY (codigo_p) REFERENCES op_productos (codigo_id);

/*funciones*/
CREATE OR REPLACE FUNCTION nueva_persona
(dn INTEGER, nomb VARCHAR(100), papel VARCHAR(100), sapel VARCHAR(100), f_naci date, sex CHAR, dir VARCHAR(100),
 ciud VARCHAR(100), complem VARCHAR(100))
 RETURNS TEXT AS $$
 	DECLARE
		respuesta TEXT;
	BEGIN
		INSERT INTO op_persona VALUES (dn, nomb, papel, sapel, f_naci, sex, dir, ciud, complem);
		RETURN 'Se registró correctamente.';
	EXCEPTION
	WHEN unique_violation THEN
		RETURN 'El DNI ingresado ya existe.';
	WHEN OTHERS THEN
		RETURN 'Ha ocurrido un error interno.';
	END;
$$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION mostrar_personas ()
	RETURNS TABLE ("DNI" INTEGER, "Nombre(s)" VARCHAR(100), 
				"Primer Apellido" VARCHAR(100), "Segundo Apellido" VARCHAR(100),
				"Fecha de Nacimiento" date, "Sexo" CHAR, "Dirección" VARCHAR(100), 
				"Ciudad" VARCHAR(100), "Complemento" VARCHAR(100))
AS $$
BEGIN
	RETURN QUERY SELECT pe.dni, pe.nombres, pe.papellido, pe.sapellido, pe.fecha_nacimiento,
						pe.sexo, pe.direccion, pe.ciudad, pe.complemento
	FROM op_persona pe
	ORDER BY pe.papellido;
END; $$
LANGUAGE plpgsql;



CREATE OR REPLACE FUNCTION nuevo_cliente(dnip INTEGER)
RETURNS TEXT AS $$
	DECLARE
		respuesta TEXT;
	BEGIN
		INSERT INTO op_cliente VALUES (dnip);
		RETURN 'Se registró correctamente.';
	EXCEPTION
	WHEN unique_violation THEN
		RETURN 'El DNI ingresado no está registrado.';
	WHEN OTHERS THEN
		RETURN 'Ha ocurrido un error interno.';
	END;
$$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION mostrar_cl ()
	RETURNS TABLE ("DNI" INTEGER, "E-Mail" VARCHAR(100))
AS $$
BEGIN
	RETURN QUERY SELECT cl.dni_p, cu.correo_c
	FROM op_cliente cl
	INNER JOIN op_persona pe ON cl.dni_p = pe.dni
	INNER JOIN op_cuenta cu ON cl.dni_p = cu.dni_c;
END; $$
LANGUAGE plpgsql;



CREATE OR REPLACE FUNCTION nueva_cuenta
(cor VARCHAR(100), nombs VARCHAR(100), apels VARCHAR(100), contr VARCHAR(100), dnip INTEGER)
RETURNS TEXT AS $$
	DECLARE
		respuesta TEXT;
	BEGIN
		INSERT INTO op_cuenta VALUES (cor, nombs, apels, contr, dnip);
		RETURN 'Se registró correctamente.';
	EXCEPTION
	WHEN unique_violation THEN
		RETURN 'Ese correo ya existe. Ingrese otro.';
	WHEN OTHERS THEN
		RETURN 'Ha ocurrido un error interno.';
	END;
$$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION mostrar_cuentas ()
	RETURNS TABLE ("E-Mail" VARCHAR(100), "Nombre(s)" VARCHAR(100), "Apellido(s)" VARCHAR(100), 
				   "Contraseña" VARCHAR(100), "DNI" INTEGER)
AS $$
BEGIN
	RETURN QUERY SELECT cu.correo_c, cu.nombres_c, cu.apellidos_c, cu.contrasenha, cl.dni_p
	FROM op_cuenta cu
	INNER JOIN op_cliente cl ON cu.dni_c = cl.dni_p
	ORDER BY cu.correo_c;
END; $$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION nuevo_producto
(cod INTEGER, prec numeric(10,2), stk INTEGER, imag bytea)
 RETURNS TEXT AS $$
 	DECLARE
		respuesta TEXT;
	BEGIN
		INSERT INTO op_productos VALUES (cod, prec, stk, imag);
		RETURN 'Se registró correctamente.';
	EXCEPTION
	WHEN unique_violation THEN
		RETURN 'El código ingresado ya existe.';
	WHEN OTHERS THEN
		RETURN 'Ha ocurrido un error interno.';
	END;
$$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION mostrar_productos ()
	RETURNS TABLE ("Código" INTEGER, "Precio" numeric(10,2), "Cantidad" INTEGER, "Imagen" VARCHAR(100))
AS $$
BEGIN
	RETURN QUERY SELECT pr.codigo_id, pr.precio, pr.cantidad, pr.imagen
	FROM op_productos pr
	ORDER BY pr.codigo_id;
END; $$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION nueva_laptop
(cod INTEGER, disc VARCHAR(50), pant numeric(10,2), proc VARCHAR(50), sist VARCHAR(50), pes numeric(5,2),
rm INTEGER, tarj VARCHAR(50), model VARCHAR(50))
 RETURNS TEXT AS $$
 	DECLARE
		respuesta TEXT;
	BEGIN
		INSERT INTO op_laptops VALUES (cod, disc, pant, proc, sist, pes, rm, tarj, model);
		RETURN 'Se registró correctamente.';
	EXCEPTION
	WHEN unique_violation THEN
		RETURN 'El código ingresado ya existe.';
	WHEN OTHERS THEN
		RETURN 'Ha ocurrido un error interno.';
	END;
$$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION mostrar_laptops ()
	RETURNS TABLE ("Código" INTEGER, "Disco Duro" VARCHAR(50), "Pantalla (pulgadas)" numeric(10,2),
				   "Procesador" VARCHAR(50), "SO" VARCHAR(50), "Peso" numeric(5,2), "RAM" INTEGER, 
				   "Tarjeta Gráfica" VARCHAR(50), "Modelo" VARCHAR(50))
AS $$
BEGIN
	RETURN QUERY SELECT pr.codigo_id, la.disco_duro, la.pantalla, la.procesador,
							la.so, la.peso, la.ram, la.tarjeta_grafica, la.modelo
	FROM op_laptops la
	INNER JOIN op_productos pr ON la.codigo_p = pr.codigo_id
	ORDER BY la.modelo;
END; $$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION mostrar_laptops2 ()
	RETURNS TABLE ("Código" INTEGER, "Disco Duro" VARCHAR(50), "Pantalla (pulgadas)" numeric(10,2),
				   "Procesador" VARCHAR(50), "SO" VARCHAR(50), "Peso" numeric(5,2), "RAM" INTEGER, 
				   "Tarjeta Gráfica" VARCHAR(50), "Modelo" VARCHAR(50))
AS $$
BEGIN
	RETURN QUERY SELECT pr.codigo_id, la.disco_duro, la.pantalla, la.procesador,
							la.so, la.peso, la.ram, la.tarjeta_grafica, la.modelo
	FROM op_laptops la
	INNER JOIN op_productos pr ON la.codigo_p = pr.codigo_id
	ORDER BY la.ram;
END; $$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION mostrar_laptops3 ()
	RETURNS TABLE ("Código" INTEGER, "Disco Duro" VARCHAR(50), "Pantalla (pulgadas)" numeric(10,2),
				   "Procesador" VARCHAR(50), "SO" VARCHAR(50), "Precio" numeric(10,2), "RAM" INTEGER, 
				   "Tarjeta Gráfica" VARCHAR(50), "Modelo" VARCHAR(50))
AS $$
BEGIN
	RETURN QUERY SELECT pr.codigo_id, la.disco_duro, la.pantalla, la.procesador,
							la.so, pr.precio, la.ram, la.tarjeta_grafica, la.modelo
	FROM op_laptops la
	INNER JOIN op_productos pr ON la.codigo_p = pr.codigo_id
	ORDER BY pr.precio;
END; $$
LANGUAGE plpgsql;