create table Utente (
	username varchar(32) primary key,
	email varchar(100) not null,
	passwor varchar(50) not null,
	nome varchar(32) not null,
	cognome varchar(32) not null
);

create table Room (
	codice integer primary key,
	nome varchar(32) not null,
	prezzo decimal(5, 2) not null,
	disponibilita boolean not null
);

create table Prenota (
	data_ date not null,
	orario time not null,
	username varchar(32) not null,
	id_room integer not null,
	foreign key (username) references Utente(username),
	foreign key (id_room) references Room(codice)
);
