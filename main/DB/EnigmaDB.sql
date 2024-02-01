create table Utente (
	username varchar(32) primary key,
	email varchar(100) not null,
	password varchar(50) not null,
	nome varchar(32) not null,
	cognome varchar(32) not null,
	nascita  date not null,
	telefono varchar(20) not null
);

create table Room (
	codice integer primary key,
	nome varchar(32) not null,
	prezzo decimal(5, 2) not null
);

create table Prenota (
	id_prenotazione integer AUTO_INCREMENT primary key,
	giorno date not null,
	orario time not null,
	username varchar(32) not null,
	id_room integer not null,
	foreign key (username) references Utente(username),
	foreign key (id_room) references Room(codice)
);

create table SlotPrenotabili(
	id integer not null primary key,
	orario time not null,
	room integer,
	disponibilita boolean
);


INSERT INTO `room` (`codice`, `nome`, `prezzo`)
VALUES ('1', 'Cripta arcana', '1'),
	   ('2', 'Sabotaggio sul treno', '1'),
       ('3', 'Riavvio del reattore', '1');

INSERT INTO `slotprenotabili` (`id`, `orario`, `room`, `disponibilita`) 
VALUES ('1', '10:32:00', '2', '1'), 
       ('2', '17:22:00', '3', '1'), 
       ('3', '12:22:00', '2', '1');