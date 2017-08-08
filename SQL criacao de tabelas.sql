CREATE TABLE usuario(
	nome VARCHAR(100),
	nascimento VARCHAR(15),
	sexo VARCHAR(10),
	telefone VARCHAR(20),
	email VARCHAR(100),
	senha VARCHAR(100),
	PRIMARY KEY(email)
);

CREATE TABLE carona(
	origem VARCHAR(100),
	destino VARCHAR(100),
	origemgeom GEOMETRY,
	destinogeom GEOMETRY,
	dataviagem DATE,
	horasaida TIME,
	ajudacusto REAL,
	horachegada VARCHAR(100),	
	distancia REAL,
	emailUsuario VARCHAR(100),
	FOREIGN KEY(emailUsuario) REFERENCES usuario(email) ON UPDATE CASCADE ON DELETE CASCADE,
	PRIMARY KEY(emailUsuario, dataviagem, horasaida)
);

CREATE TABLE passagem(
	id SERIAL,
	nome VARCHAR(100),
	geom GEOMETRY,
	emailUsuario VARCHAR(100),
	dataViagem DATE,
	horasaida TIME,
	FOREIGN KEY(emailUsuario) REFERENCES usuario(email),
	PRIMARY KEY(id)
)