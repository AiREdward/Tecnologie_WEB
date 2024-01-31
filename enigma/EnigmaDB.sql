drop table if exists SlotPrenotabili;
drop table if exists Prenota;
drop table if exists Room;
drop table if exists Utente;

create table Utente (
	username varchar(32) primary key,
	email varchar(100) not null,
	password varchar(50) not null,
	nome varchar(32) not null,
	cognome varchar(32) not null,
    telefono varchar(10) not null,
    nascita date not null,
    usertype varchar(32) not null
);

create table Room (
	codice integer primary key,
	nome varchar(32) not null,
	prezzo decimal(5, 2) not null,
	disponibilita boolean not null
);

create table Prenota (
	id_prenotazione integer not null,
	data_ date not null,
	orario time not null,
	username varchar(32) not null,
	id_room integer not null,
	foreign key (username) references Utente(username),
	foreign key (id_room) references Room(codice),
	foreign key (username) references SlotPrenotabili(orario)
);

create table SlotPrenotabili(
    id integer not null,
    orario time not null
);
