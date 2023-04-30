CREATE TABLE regiones (
  id INT NOT NULL AUTO_INCREMENT,
  nombre_region VARCHAR(50),
  PRIMARY KEY (id)
);

CREATE TABLE comunas (
  id INT NOT NULL AUTO_INCREMENT,
  nombre_comuna VARCHAR(50),
  region_id INT,
  PRIMARY KEY (id),
  FOREIGN KEY (region_id) REFERENCES regiones(Id)
);

CREATE TABLE candidatos (
  id INT NOT NULL AUTO_INCREMENT,
  nombre_candidato VARCHAR(50),
  PRIMARY KEY (id)
);

CREATE TABLE votos (
  id INT NOT NULL AUTO_INCREMENT,
  nombre_votante VARCHAR(50),
  alias_votante VARCHAR(50),
  rut_votante VARCHAR(50),
  email_votante VARCHAR(50),
  region_id INT,
  comuna_id INT,
  candidato_id INT,
  motivo VARCHAR(50),
  PRIMARY KEY (id),
  FOREIGN KEY (region_id) REFERENCES regiones(id),
  FOREIGN KEY (comuna_id) REFERENCES comunas(id),
  FOREIGN KEY (candidato_id) REFERENCES candidatos(id)
);

INSERT INTO regiones (id, nombre_region) VALUES
(1, 'Arica y Parinacota'),
(2, 'Tarapacá'),
(3, 'Antofagasta'),
(4, 'Atacama'),
(5, 'Coquimbo'),
(6, 'Valparaíso'),
(7, 'Metropolitana de Santiago'),
(8, 'Libertador General Bernardo O''Higgins'),
(9, 'Maule'),
(10, 'Ñuble'),
(11, 'Biobío'),
(12, 'La Araucanía'),
(13, 'Los Ríos'),
(14, 'Los Lagos'),
(15, 'Aysén del General Carlos Ibáñez del Campo'),
(16, 'Magallanes y de la Antártica Chilena');

INSERT INTO comunas (nombre_comuna, region_id)
VALUES
  ('Arica', 1),
  ('Camarones', 1),
  ('Putre', 1),
  ('Iquique', 2),
  ('Alto Hospicio', 2),
  ('Pozo Almonte', 2),
  ('Antofagasta', 3),
  ('Mejillones', 3),
  ('Taltal', 3),
  ('Copiapó', 4),
  ('Vallenar', 4),
  ('Chañaral', 4),
  ('La Serena', 5),
  ('Coquimbo', 5),
  ('Ovalle', 5),
  ('Valparaíso', 6),
  ('Viña del Mar', 6),
  ('Quilpué', 6),
  ('Rancagua', 7),
  ('Machalí', 7),
  ('San Fernando', 7),
  ('Talca', 8),
  ('Curicó', 8),
  ('Linares', 8),
  ('Concepción', 9),
  ('Talcahuano', 9),
  ('Chillán', 9),
  ('Temuco', 10),
  ('Villarrica', 10),
  ('Angol', 10),
  ('Valdivia', 11),
  ('La Unión', 11),
  ('Los Lagos', 11),
  ('Puerto Montt', 12),
  ('Osorno', 12),
  ('Castro', 12),
  ('Coyhaique', 13),
  ('Aysén', 13),
  ('Chile Chico', 13),
  ('Punta Arenas', 14),
  ('Puerto Natales', 14),
  ('Porvenir', 14),
  ('Cabo de Hornos', 15),
  ('Antártica', 15),
  ('Tierra del Fuego', 15);

INSERT INTO candidatos (nombre_candidato) VALUES
('Juan Perez'),
('Maria Garcia'),
('Pedro Rodriguez'),
('Ana Hernandez');
