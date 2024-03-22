# TODO

In questo file sono specificate le cose da finire.

### Pagine Stanze

Ogni stanza ha bisogno di una pagina dedicata, dove viene descritto in più dettaglio la stanza. <br>
Alla fine di questa pagina verranno visualizzate le recensioni create dagli utenti.

### Pagina Admin

Aggiunta di gestione stanze (e prenotazioni?).

### Database

Per la parte del database è necessario modificare il file *DBConnection.php* siccome attualmente gli altri file usano il file di test *DBConnectionTest.php* con connessione a un database sqlite. <br>
Per fare questo basta ricreare le funzioni del file di test in quello definitivo con le istruzioni per MariaDB. <br>
Va anche rimosso il namespace: `use Test\Connection;`

### Codice HTML

Le pagine (quelle nuove soprattutto) hanno principalmente tag generali e richiedono di essere controllate e sostituite con tag più specifici se è necessario.

### CSS

Ovviamente manca la modifica del CSS.