CREATE DATABASE Consultorio;
USE Consultorio;

CREATE TABLE Administrador (
	ID_Administrador				Integer NOT NULL AUTO_INCREMENT,

	#DATOS GENERALES
	Nombre 							VarChar(128) NOT NULL,
	Apellido_paterno 				VarChar(128) NOT NULL,
	Apellido_materno	 			VarChar(128) NULL,
	Domicilio 						Varchar(256) NOT NULL,
	
	#INICIO
	Telefono 						Varchar(256) NOT NULL,
	Password 						Varchar(256) NOT NULL,
	Correo 							Varchar(256) NOT NULL,
	Intento 						bigint NULL DEFAULT 0,
	Tiempo 							Datetime NULL,

	#CONSTRAINTS
	CONSTRAINT PK_ID_Administrador PRIMARY KEY (ID_Administrador),
	CONSTRAINT UQ_ID_Administrador UNIQUE (ID_Administrador)
);

CREATE TABLE Secretaria (
	ID_Secretaria 					Integer NOT NULL AUTO_INCREMENT,

	#DATOS GENERALES
	Nombre 							VarChar(128) NOT NULL,
	Apellido_paterno 				VarChar(128) NOT NULL,
	Apellido_materno	 			VarChar(128) NULL,
	Domicilio 						Varchar(256) NOT NULL,

	#INICIO
	Telefono 						Varchar(256) NOT NULL,
	Password 						Varchar(256) NOT NULL,
	Correo 							Varchar(256) NOT NULL,
	Intento 						bigint NULL DEFAULT 0,
	Tiempo 							Datetime NULL,

	#CONSTRAINTS
	CONSTRAINT PK_ID_Secretaria PRIMARY KEY (ID_Secretaria),
	CONSTRAINT UQ_ID_Secretaria UNIQUE (ID_Secretaria)
);

CREATE TABLE Medico (
	ID_Medico 						Integer NOT NULL AUTO_INCREMENT,

	#DATOS GENERALES
	Nombre 							VarChar(128) NOT NULL,
	Apellido_paterno 				VarChar(128) NOT NULL,
	Apellido_materno	 			VarChar(128) NULL,
	Domicilio 						Varchar(256) NOT NULL,
	Especialidad 					Varchar(256) NOT NULL,
	Correo 							VarChar(128) NOT NULL,
	Cedula_Profesional				Varchar(64) NOT NULL,
	Cedula_Especialidad				Varchar(64) NOT NULL,
	Intento 						bigint NULL DEFAULT 0,
	Tiempo 							Datetime NULL,

	#INICIO	
	Telefono 						Varchar(256) NOT NULL,
	Password						Varchar(256) NOT NULL,

	#CONSTRAINTS
	CONSTRAINT PK_ID_Medico PRIMARY KEY (ID_Medico),
	CONSTRAINT UQ_ID_Medico UNIQUE (ID_Medico)
);

CREATE TABLE Horario (
	ID_Horario						Integer NOT NULL AUTO_INCREMENT,
	ID_Medico 						Integer NOT NULL,

	#DATOS GENERALES
	Dia 							Varchar(16) NOT NULL,
	Hora_Entrada					Time 		NOT NULL,
	Hora_Salida						Time 		NOT NULL,

	#CONSTRAINTS
	CONSTRAINT PK_ID_Horario PRIMARY KEY (ID_Horario),
	CONSTRAINT UQ_ID_Horario UNIQUE (ID_Horario),
	CONSTRAINT FK_ID_Medico_Horario FOREIGN KEY (ID_Medico) REFERENCES Medico (ID_Medico)

);

CREATE TABLE Cita (
	ID_Cita 						Integer NOT NULL AUTO_INCREMENT,
	ID_Medico 						Integer NOT NULL,

	#DATOS GENERALES
	Nombre 							VarChar(128) NOT NULL,
	Apellido_paterno 				VarChar(128) NOT NULL,
	Apellido_materno 				VarChar(128) NULL,
	Fecha 							Date NOT NULL,
	Hora 							Time NOT NULL,
	Descripcion						Varchar(512) NULL,

	#CONSTRAINTS
	CONSTRAINT PK_ID_Cita PRIMARY KEY (ID_Cita),
	CONSTRAINT UQ_ID_Cita UNIQUE (ID_Cita),
	CONSTRAINT FK_ID_Medico_Cita FOREIGN KEY (ID_Medico) REFERENCES Medico (ID_Medico)
);

CREATE TABLE Tutor ( 
	ID_Tutor 						Integer NOT NULL  AUTO_INCREMENT,

	#DATOS GENERALES
	Nombre 							VarChar(128) NOT NULL,
	Apellido_paterno 				VarChar(128) NOT NULL,
	Apellido_materno 				VarChar(128) NULL,
	Telefono 						char(16) NULL,
	Correo 							VarChar(128) NULL,
	Domicilio 						VarChar(256) NULL,

	#CONSTRAINTS
    CONSTRAINT PK_ID_Tutor PRIMARY KEY (ID_Tutor),
    CONSTRAINT UQ_ID_Tutor UNIQUE (ID_Tutor)
);

CREATE TABLE Vacuna (
	ID_Vacuna 						Integer NOT NULL AUTO_INCREMENT,

	#DATOS GENERALES
	Nombre 							Varchar(256) NOT NULL,
	Endermadad						Varchar(256) NOT NULL,
	Dosis							SmallInt NOT NULL	check (Dosis >= 1),
	Edad_Recomendada				TinyInt NOT NULL	check (Edad_Recomendada >= 1),

	#CONSTRAINTS
	CONSTRAINT PK_ID_Vacuna PRIMARY KEY (ID_Vacuna),
	CONSTRAINT UQ_ID_Vacuna UNIQUE (ID_Vacuna)
);

CREATE TABLE Paciente (
	ID_Paciente 					Integer NOT NULL AUTO_INCREMENT,

	#DATOS GENERALES
	Nombre 							VarChar(128) NOT NULL,
	Apellido_paterno 				VarChar(128) NOT NULL,
	Apellido_materno 				VarChar(128) NULL,
	Fecha_nacimiento			 	Date NOT NULL,
	Alergias 						Varchar(512) NULL,

	#CONSTRAINTS
	CONSTRAINT PK_ID_Paciente PRIMARY KEY (ID_Paciente),
	CONSTRAINT UQ_ID_Paciente UNIQUE (ID_Paciente)
);

CREATE TABLE Medico_Paciente (
	ID_Medico 						Integer	NOT NULL,
	ID_Paciente 					Integer NOT NULL,

	#CONSTRAINTS
	CONSTRAINT FK_ID_Medico_Paciente FOREIGN KEY (ID_Medico) REFERENCES Medico (ID_Medico),
	CONSTRAINT FK_ID_Paciente_Medico FOREIGN KEY (ID_Paciente) REFERENCES Paciente (ID_Paciente)
);

CREATE TABLE Antecedentes_Perinatales(
	ID_Antecedentes_Perinatales		Integer NOT NULL AUTO_INCREMENT,
	ID_Paciente 					Integer NOT NULL,

	#DATOS GENERALES
	Peso 							Decimal(4, 2) NULL check (Peso > 0),
	Talla 							Decimal(4, 1) NULL check (Talla > 0),
	Edad_gestacional 				SmallInt NULL check (Edad_gestacional >= 30 and Edad_gestacional <= 41),
	Apgar 							SmallInt NULL check (Apgar >= 0 and Apgar <= 10),
	Silverman_Andersen 				SmallInt NULL check (Silverman_Andersen >= 0 and Silverman_Andersen <= 10),
	Via_Nacimiento 					VarChar(32)	NULL check ( Via_Nacimiento in ('Parto', 'Cesárea')),
	Tipo_Anestesia 					VarChar(32)	NULL check ( Tipo_Anestesia in ('Bloqueo peridural','Anestesia general', 'Ninguna') ),
	Complicaciones 					Varchar(256) NULL,
	Lugar_Nacimiento 				Varchar(256) NULL,
	Nombre_Hospital 				Varchar(256) NULL,	

	#CONSTRAINTS
	CONSTRAINT PK_ID_Antecedentes_Perinatales PRIMARY KEY (ID_Antecedentes_Perinatales),
	CONSTRAINT UQ_ID_Antecedentes_Perinatales UNIQUE (ID_Antecedentes_Perinatales),
	CONSTRAINT FK_ID_Paciente_Antecedentes_Perinatales FOREIGN KEY (ID_Paciente) REFERENCES Paciente (ID_Paciente),
	CONSTRAINT UQ_ID_Paciente_Antecedentes_Perinatales UNIQUE (ID_Paciente)
);

CREATE TABLE Paciente_Tutor (
	ID_Paciente 					Integer NOT NULL,
	ID_Tutor 						Integer NOT NULL,
	
	#CONSTRAINTS
	CONSTRAINT FK_ID_Paciente_Tutor FOREIGN KEY (ID_Paciente) REFERENCES Paciente(ID_Paciente),
	CONSTRAINT FK_ID_Tutor_Paciente FOREIGN KEY (ID_Tutor) REFERENCES Tutor(ID_Tutor)
);

CREATE TABLE Vacuna_Paciente (
	ID_Vacuna 						Integer NOT NULL,
	ID_Paciente 					Integer NOT NULL,
	Fecha 							Date NOT NULL,

	#CONSTRAINTS
	CONSTRAINT FK_ID_Catalogo_Vacuna_Paciente FOREIGN KEY (ID_Vacuna) REFERENCES Vacuna(ID_Vacuna),
	CONSTRAINT FK_ID_Paciente_Vacuna FOREIGN KEY (ID_Paciente) REFERENCES Paciente(ID_Paciente)
);

CREATE TABLE Consulta (
	ID_Consulta 					Integer NOT NULL AUTO_INCREMENT,
	ID_Paciente 					Integer NOT NULL,

	#DATOS GENERALES
	Fecha 							Date NOT NULL,
	Sintomas 						Varchar(512) NOT NULL,

	#ALIMENTACION
	Leche_Formula 					Varchar (16) NULL,
	Formula 						Varchar (256) NULL,
	Alimentacion_Horario 			Varchar (512) NULL,

	#EXPLORACION FISICA
	Peso 							Decimal (4, 1) NOT NULL		check (peso > 0),
	Talla							Decimal (4, 1) NOT NULL		check (talla >0),
	Temperatura 					Decimal (3, 1) NOT NULL		check (Temperatura > 0),
	Freq_Cardiaca 					SmallInt NOT NULL 			check (Freq_Cardiaca > 0),
	Freq_Respiratoria 				SmallInt NOT NULL			check (Freq_Respiratoria > 0),
	Perimetro_cefalico 				Decimal (4, 1) NOT NULL		check (Perimetro_cefalico > 0),
	Segmento_Superior 				Decimal (4, 1) NOT NULL		check (Segmento_Superior > 0),
	Segmento_Inferior 				Decimal (4, 1) NOT NULL		check (Segmento_Inferior > 0),

	#INFORMACION FINAL
	Estudios 						Varchar (512) NULL,
	Diagnostico  					Varchar (512) NULL,
	Referencias_Espacialidad  		Varchar (512) NULL,


	#CONSTRAINTS
	CONSTRAINT PK_ID_Consulta PRIMARY KEY (ID_Consulta),
	CONSTRAINT UQ_ID_Consulta UNIQUE (ID_Consulta),
	CONSTRAINT FK_ID_Paciente_Consulta FOREIGN KEY (ID_Paciente) REFERENCES Paciente (ID_Paciente)
);


CREATE TABLE Medicamento (
	ID_Medicamento 					Integer NOT NULL AUTO_INCREMENT,

	#DATOS GENERALES
	Nombre 							Varchar(512) NOT NULL,
	Presentacion					Varchar(512) NULL,
	Principio_Activo				Varchar(1024) NULL,
	Via_Administracion				Varchar(64) NULL,
	#PENDIENTE

	#CONSTRAINTSmedicamentoPrincipio_Activo
	CONSTRAINT PK_ID_Medicamento PRIMARY KEY (ID_Medicamento),
	CONSTRAINT UQ_ID_Medicamento UNIQUE (ID_Medicamento)
);

CREATE TABLE Antecedentes_Patologicos (
	ID_Antecedentes_Patologicos 	Integer NOT NULL AUTO_INCREMENT,
	ID_Paciente 					Integer NOT NULL,

	#DATOS GENERALES
	Padecimiento 					Varchar(256) NOT NULL,
	Duracion 						Varchar(64) NOT NULL,
	Tratamiento 					Varchar(256) NOT NULL,
	Fecha 							Date NOT NULL,
	Descripcion						Varchar(512) NULL,

	#CONSTRAINTS
	CONSTRAINT PK_ID_Antecedentes_Patologicos PRIMARY KEY (ID_Antecedentes_Patologicos),
	CONSTRAINT UQ_ID_Antecedentes_Patologicos UNIQUE (ID_Antecedentes_Patologicos),
	CONSTRAINT FK_ID_Paciente_Antecedentes_Patologicos FOREIGN KEY (ID_Paciente) REFERENCES Paciente (ID_Paciente)
);

CREATE TABLE Tratamiento (
	ID_Tratamiento 					Integer NOT NULL AUTO_INCREMENT,
	ID_Consulta 					Integer NULL,

	#DATOS GENERALES
	ID_Medicamento 					Integer NULL,
	Dosis 							SmallInt NULL check (Dosis >=1),
	Alternativo						Varchar (2561) NULL,
	Horario 						Varchar(256) NOT NULL,
	Tiempo_Duracion 				Varchar (256) NOT NULL,
	Descripcion						Varchar(512) NULL,

	#CONSTRAINTS
	CONSTRAINT PK_ID_Tratamiento PRIMARY KEY (ID_Tratamiento),
	CONSTRAINT UQ_ID_Tratamiento UNIQUE (ID_Tratamiento),
	CONSTRAINT FK_ID_Medicamento_Tratamiento FOREIGN KEY (ID_Medicamento) REFERENCES Medicamento(ID_Medicamento),
	CONSTRAINT FK_ID_Consulta_Tratamiento FOREIGN KEY (ID_Consulta) REFERENCES Consulta (ID_Consulta)
);


INSERT INTO `Administrador`(`Nombre`, `Apellido_paterno`, `Apellido_materno`, `Domicilio`, `Telefono`, `Password`, `Correo`) VALUES ("Karen","Jiménez","Zavala","Calle José Cecilio Ortega Mz. 16 Lt. 3 col. Las peñas, Iztapalapa CDMX C.P. 09750", "5591622838","$2y$10$0EIXsbv76GkG/uulYIElVeH8NxPBosOVWNl2EPkfxx6aNOfBExMou","karen@micorreo.com");