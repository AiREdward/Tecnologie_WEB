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
    admin boolean not null
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

create table SlotPrenotabili (
    id integer primary key,
    orario time not null,
    codice_room integer not null,
    disponibilita boolean
);

-- Creazione di utenti per testing

INSERT INTO Utente (username, email, password, nome, cognome, telefono, nascita, admin)
VALUES ('admin', 'admin@admin.com', 'admin', 'admin', 'admin', '1234567890', '1970-01-01', true),
       ('user', 'user@user.com', 'user', 'user', 'user', '1234567891', '1970-01-01', false);

-- Creazione delle stanze

INSERT INTO Room (codice, nome, prezzo)
VALUES ('1', 'Cripta arcana', '1'),
       ('2', 'Sabotaggio sul treno', '1'),
       ('3', 'Riavvio del reattore', '1');