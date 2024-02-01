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
	giorno data not null,
	orario time not null,
	username varchar(32) not null,
	id_room integer not null,
	foreign key (username) references Utente(username),
	foreign key (id_room) references Room(codice)
);

create table SlotPrenotabili(
	id integer not null primary key,
	giorno data not null,
	orario time not null,
	room integer,
	disponibilita boolean,
	foreign key (room) references Room(codice)
)