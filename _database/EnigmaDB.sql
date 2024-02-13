drop table if exists Recensione;
drop table if exists Orari_Apertura;
drop table if exists Prenota;
drop table if exists RoomTranslated;
drop table if exists Room;
drop table if exists Utente;

create table Utente (
	Username varchar(32) primary key,
	Email varchar(256) not null,
	Password varchar(128) not null,
	Nome varchar(32) not null,
	Cognome varchar(32) not null,
    Telefono varchar(10) not null,
    Data_di_Nascita date not null,
    Admin boolean not null
);

create table Room (
	ID int primary key,
	Nome varchar(128) not null,
	Prezzo decimal(5, 2) not null,
    Durata int not null,
    Difficolta int not null,
    Descrizione varchar(512) not null
);

create table RoomTranslated (
    ID int primary key,
    Nome varchar(128) not null,
    Descrizione varchar(512) not null,
    foreign key (ID) references Room(ID)
);

create table Prenota (
    ID integer AUTO_INCREMENT primary key,
    Data_Prenotazione date not null,
    Ora_Prenotazione time not null,
    Username varchar(32) not null,
    ID_Room integer not null,
    foreign key (Username) references Utente(Username),
    foreign key (ID_Room) references Room(ID)
);

create table Orari_Apertura (
    ID integer AUTO_INCREMENT primary key,
    Giorno varchar(16) not null,
    Ora_Apertura time not null,
    Ora_Chiusura time not null,
    ID_Room integer not null,
    foreign key (ID_Room) references Room(ID)
);

create table Recensione (
    ID integer AUTO_INCREMENT primary key,
    Testo varchar(1024) not null,
    Voto decimal(1,1) not null,
    Username varchar(32) not null,
    ID_Room integer not null,
    foreign key (Username) references Utente(Username),
    foreign key (ID_Room) references Room(ID),
    check (Voto >= 0 and Voto <= 5)
);

-- Creazione manuale di utenti per test
INSERT INTO Utente (Username, Email, Password, Nome, Cognome, Telefono, Data_di_Nascita, Admin)
VALUES ('admin', 'admin@admin.com', 'admin', 'admin', 'admin', '1234567890', '1970-01-01', true),
       ('user', 'user@user.com', 'user', 'user', 'user', '1234567891', '1970-01-01', false);

-- Creazione delle stanze
INSERT INTO Room (ID, Nome, Prezzo, Durata, Difficolta, Descrizione)
VALUES (1, 'Cripta arcana', 1, 60, 3, 'Esplora una cripta alla ricerca di un potente artefatto, sarai in grado di evitare le trappole e ottenerlo?'),
       (2, 'Sabotaggio sul treno', 1, 60, 2, 'Un semplice viaggio in treno si dimostra di gran lunga più movimentato dopo un incidente, c''è il sospetto di un sabotaggio, investiga la scena e tenta di riparare il treno'),
       (3, 'Riavvio del reattore', 1, 60, 1, 'Bloccati nello spazio con solo l''energia di emergenza: è necesario rimettere in modo il reattore quanto prima possibile, esiste un manuale technico con le procedure richieste ma la situazione è tutt''altro che risolta');

INSERT INTO RoomTranslated (ID, Nome, Descrizione)
VALUES (1, 'Cripta arcana', 'You have entered a dungeon in search of a powerful magical artifact, will you be able to avoid the traps and acquire it?'),
       (2, 'Sabotaggio sul treno', 'A simple train ride proved to be far more eventful after an accident, potentially a sabotage, investigate the scene and try to repair the train'),
       (3, 'Riavvio del reattore', 'Stranded in the emptiness of space with only emergency power: you have to restart the main reactor as quickly as possible, there is a technical manual with procedures but the task is not trivial');