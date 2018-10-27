UPDATE cuenta SET contrasena='91kl7IdbMJYifDXQvUy4VQ==' WHERE cedula='11';
SELECT * FROM cuenta, empleado WHERE cuenta.cedula = empleado.cedula;

show tables;
SELECT * FROM cargo;
INSERT INTO cargo VALUES (1, 'Administrador', 1);
INSERT INTO cargo VALUES (2, 'Coordinador',2);
INSERT INTO cargo VALUES (3, 'Líder de proceso',3);
INSERT INTO cargo VALUES (4, 'Usuario de consulta',4);

SELECT * FROM seccional;
INSERT INTO seccional VALUES(1,'Bogotá','Colombia','Bogotá','Cll 68B No 7','Alex Tintor',1);
INSERT INTO seccional VALUES(2,'Cali','Colombia','Valle del Cauca','Cr 67C No 25','Angie Osorio',2);
INSERT INTO seccional VALUES(3,'Tunja','Colombia','Boyacá','Cr 14 C No 98','Sebastián Lopez',3);
INSERT INTO seccional VALUES(4,'Villavicencio','Colombia','Meta','Cll 29A No 4','Valeria Niño',2);

SELECT * FROM empleado;
INSERT INTO empleado VALUES(1017119865,'Valeria', 'Niño', 'valenñ@gmail.com',2014785,'Cll 29C No8',3203748125,'f',4,3);
INSERT INTO empleado VALUES(1112819845,'Marcus', 'León ','mrln@hotmail.com',1451463,'Cll 14E No 4',3143698741,'m',1,2);
INSERT INTO empleado VALUES(1817112815,'Jesús', 'de Nazaret', 'yisuscraist@unilibre.edu.co',6661478,'Cr 100D No 1', 3154982514,'m',2,1);
INSERT INTO empleado VALUES(1015479865,'María','Laguna','mala@gmail.com',7815478,'Cr 58E No 14',3104785463,'f',3,4);

SELECT * FROM cuenta;
INSERT INTO cuenta VALUES ('UbcFeuR35Wcuy+vusRINTg==','Activo',1017119865);
INSERT INTO cuenta VALUES ('UbcFeuR35Wcuy+vusRINTg==','Activo',1112819845);
INSERT INTO cuenta VALUES ('UbcFeuR35Wcuy+vusRINTg==','Activo',1817112815);
INSERT INTO cuenta VALUES ('UbcFeuR35Wcuy+vusRINTg==','Activo',1015479865);

SELECT * FROM documento;
INSERT INTO documento VALUES (1,'Santa biblia', 'Guía', '05/03/14','05/03/25','05/05/24');
INSERT INTO documento VALUES (2,'Acuerdo V5.1','Acuerdo','10/07/14','10/08/06','11/01/30');
INSERT INTO documento VALUES (3,'Acuerdo V5.1','Acuerdo','12/09/15','12/08/06','12/09/30');
INSERT INTO documento VALUES (4,'Acuerdo V5.1','Acuerdo','18/02/28','18/03/01','18/03/03');

SELECT * FROM macroproceso;
INSERT INTO macroproceso VALUES(1,'a');
INSERT INTO macroproceso VALUES(2,'b');
INSERT INTO macroproceso VALUES(3,'c');
INSERT INTO macroproceso VALUES(4,'d');

SELECT * FROM proceso;
SELECT * FROM registro;
SELECT * FROM registro_de_procesos;