## Database

Il database è composto da 4 tabelle principali:
- Utente
- Room
- Prenota
- Recensione

### Utente

```sql
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
```

Dove `Admin` è un booleano che indica se l'utente è un amministratore o meno.

### Room

```sql
create table Room (
    ID int primary key,
    Nome varchar(128) not null,
    Prezzo decimal(5, 2) not null,
    Durata int not null,
    Numero_Partecipanti_Minimo int not null,
    Numero_Partecipanti_Massimo int not null,
    Difficolta int not null,
    Descrizione varchar(512) not null
);
```

`Room` contiene tutte le informazioni che verrano mostrate nella homepage. <br>
`Durata` è un intero che indica la durata della stanza in minuti. <br>
`Difficolta` è un intero che indica la difficoltà della stanza, da 1 a 3 con:
- 1: Facile
- 2: Media
- 3: Difficile

Siccome `Room` contiene tutte le informazioni che verrano mostrate nella homepage, è necessario l'utilizzo di una tabella contenente tutte le informazioni tradotte in inglese, per questo è presente `RoomTranlated`:

```sql
create table RoomTranslated (
    ID int primary key,
    Nome varchar(128) not null,
    Descrizione varchar(512) not null,
    foreign key (ID) references Room(ID)
);
```

### Prenota

```sql
create table Prenota (
    ID integer primary key AUTO_INCREMENT,
    Data_Prenotazione date not null,
    Ora_Prenotazione time not null,
    Username varchar(32) not null,
    ID_Room integer not null,
    foreign key (Username) references Utente(Username),
    foreign key (ID_Room) references Room(ID)
);
```

Il calcolo degli slot prenotabili avviene andando a controllare le prenotazioni già effettuate e confrontandole con la durata della stanza. Il calcolo viene limitato con gli orari di apertura e chiusura delle stanze, che sono memorizzate in `Orari_Apertura`:

```sql
create table Orari_Apertura (
    ID integer primary key AUTO_INCREMENT,
    Giorno int not null,
    Ora_Apertura time not null,
    Ora_Chiusura time not null,
    ID_Room int not null,
    foreign key (ID_Room) references Room(ID),
    check (Giorno >= 0 and Giorno <= 6)
);
```

### Recensione

```sql
create table Recensione (
    ID integer primary key AUTO_INCREMENT,
    Testo varchar(1024) not null,
    Voto decimal(1,1) not null,
    Username varchar(32) not null,
    ID_Room integer not null,
    foreign key (Username) references Utente(Username),
    foreign key (ID_Room) references Room(ID),
    check (Voto >= 0 and Voto <= 5)
);
```

## Account di Testing

Per testare l'applicazione è possibile utilizzare i seguenti account:

- Username: `admin`, Password: `admin`
- Username: `user`, Password: `user`