<?php
/*
    On deployment de-comment the const and the connect() function
    Also put in comments the now in use connect() function
*/

class Connection
{
    //const HOST = "localhost";
    //const USERNAME = "okoniecz";
    //const PASS = "Shop7iengoochoo3";
    //const DATABASE = "okoniecz";
    //const CHARSET = 'utf8mb4';

    public $conn = null;

    public function __construct()
    {
        $this->connect();
    }

    /*
    public function connect(): bool {
        $dsn = "mysql:host=". self::HOST . ";dbname=" . self::DATABASE . ";charset=" . self::CHARSET;

        try {
            $this->conn = new PDO($dsn, self::USERNAME, self::PASS);
            // $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return true;
        } catch(PDOException $e) {
            return false;
        }
    }
    */

    public function connect(): bool {
        try {
            $this->conn = new PDO('sqlite:' . __DIR__ . '/testingDB.sqlite');

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return true;
        } catch(PDOException $e) {
            return false;
        }
    }

    public function closeConnection(): void {
        $this->conn = null;
    }

    public function checkIfUserExists($username): ?string {
        $conn = $this->conn;

        $query = 'SELECT Username FROM Utente where Username=? OR Email=?';

        $preparedQuery = $conn->prepare($query);
        $preparedQuery->bindValue(1, $username);
        $preparedQuery->bindValue(2, $username);
        $preparedQuery->execute();

        $exist = $preparedQuery->fetchAll();

        $preparedQuery->closeCursor();

        if (!$exist) return null;

        return $exist[0]["Username"];
    }

    public function checkLogin($username, $password): bool {
        $conn = $this->conn;

        $query = 'SELECT Password FROM Utente WHERE Username=?';

        $preparedQuery = $conn->prepare($query);
        $preparedQuery->bindValue(1, $username);
        $preparedQuery->execute();

        $pass_res = $preparedQuery->fetchColumn();

        $preparedQuery->closeCursor();

        if (password_verify($password, $pass_res)) return true;
        else return false;
    }

    public function registerNewUser($username, $email, $password, $name, $surname, $phone_number, $birth_date) {
        $conn = $this->conn;

        $query = 'INSERT INTO Utente (Username, Email, Password, Nome, Cognome, Telefono, Data_di_Nascita, Admin) VALUES(?,?,?,?,?,?,?,?)';

        $preparedQuery = $conn->prepare($query);

        $preparedQuery->bindValue(1, $username);
        $preparedQuery->bindValue(2, $email);
        $preparedQuery->bindValue(3, $password);
        $preparedQuery->bindValue(4, $name);
        $preparedQuery->bindValue(5, $surname);
        $preparedQuery->bindValue(6, $phone_number);
        $preparedQuery->bindValue(7, $birth_date);
        $preparedQuery->bindValue(8, 0);

        $res = $preparedQuery->execute();

        $preparedQuery->closeCursor();

        return $res;
    }

    public function isUserAdmin($username): bool {
        $conn = $this->conn;

        $query = 'SELECT Admin FROM Utente WHERE Username=?';

        $preparedQuery = $conn->prepare($query);
        $preparedQuery->bindValue(1, $username);
        $preparedQuery->execute();

        $type = $preparedQuery->fetchColumn();

        $preparedQuery->closeCursor();

        if ($type == 1) return true;
        else return false;
    }

    public function getRooms() {
        $conn = $this->conn;

        $query = 'SELECT * FROM Room';

        $preparedQuery = $conn->prepare($query);
        $preparedQuery->execute();

        $res = $preparedQuery->fetchAll();

        $preparedQuery->closeCursor();

        return $res;
    }

    public function getRoomsEnglish() {
        $conn = $this->conn;

        $query = 'SELECT * FROM RoomTranslated';

        $preparedQuery = $conn->prepare($query);
        $preparedQuery->execute();

        $res = $preparedQuery->fetchAll();

        $preparedQuery->closeCursor();

        return $res;
    }

    public function createBooking($date, $time, $username, $id_room) {
        $conn = $this->conn;

        $query = 'INSERT INTO Prenota (Data_Prenotazione, Ora_Prenotazione, Username, ID_Room) VALUES (?,?,?,?)';

        $preparedQuery = $conn->prepare($query);
        $preparedQuery->bindValue(1, $date);
        $preparedQuery->bindValue(2, $time);
        $preparedQuery->bindValue(3, $username);
        $preparedQuery->bindValue(4, $id_room);
        $res = $preparedQuery->execute();

        $preparedQuery->closeCursor();

        return $res;
    }

    public function getRoomDuration($id_room) {
        $conn = $this->conn;

        $query = 'SELECT Durata FROM Room WHERE ID=?';

        $preparedQuery = $conn->prepare($query);
        $preparedQuery->bindValue(1, $id_room);
        $preparedQuery->execute();

        $res = $preparedQuery->fetchColumn();

        $preparedQuery->closeCursor();

        return $res;
    }

    public function getRoomHours($id_room, $week_day) {
        $conn = $this->conn;

        $query = 'SELECT Ora_Apertura, Ora_Chiusura FROM Orari_Apertura WHERE ID_Room=? AND Giorno=?';

        $preparedQuery = $conn->prepare($query);
        $preparedQuery->bindValue(1, $id_room);
        $preparedQuery->bindValue(2, $week_day);
        $preparedQuery->execute();

        $res = $preparedQuery->fetchAll();

        $preparedQuery->closeCursor();

        return $res[0];
    }

    public function getBookedSlots($date, $id_room) {
        $conn = $this->conn;

        $query = 'SELECT Ora_Prenotazione FROM Prenota WHERE Data_Prenotazione=? AND ID_Room=?';

        $preparedQuery = $conn->prepare($query);
        $preparedQuery->bindValue(1, $date);
        $preparedQuery->bindValue(2, $id_room);
        $preparedQuery->execute();

        $res = $preparedQuery->fetchAll();

        $preparedQuery->closeCursor();

        return $res;
    }

    public function getNextBookingsByUser($user) {
        $conn = $this->conn;

        $query = 'SELECT Data_Prenotazione, Ora_Prenotazione, ID_Room FROM Prenota WHERE Username=? AND (Data_Prenotazione>? OR (Data_Prenotazione=? AND Ora_Prenotazione>=?)) ORDER BY Data_Prenotazione, Ora_Prenotazione';

        $current_time = date('H:i:s');

        $preparedQuery = $conn->prepare($query);
        $preparedQuery->bindValue(1, $user);
        $preparedQuery->bindValue(2, date('Y-m-d'));
        $preparedQuery->bindValue(3, date('Y-m-d'));
        $preparedQuery->bindValue(4, date('H:i:s', strtotime($current_time) + 3600));
        $preparedQuery->execute();

        $res = $preparedQuery->fetchAll();

        $preparedQuery->closeCursor();

        return $res;
    }

    public function getPastBookingsByUser($user) {
        $conn = $this->conn;

        $query = 'SELECT Data_Prenotazione, Ora_Prenotazione, ID_Room FROM Prenota WHERE Username=? AND (Data_Prenotazione<? OR (Data_Prenotazione=? AND Ora_Prenotazione<?)) ORDER BY Data_Prenotazione, Ora_Prenotazione';

        $current_time = date('H:i:s');

        $preparedQuery = $conn->prepare($query);
        $preparedQuery->bindValue(1, $user);
        $preparedQuery->bindValue(2, date('Y-m-d'));
        $preparedQuery->bindValue(3, date('Y-m-d'));
        $preparedQuery->bindValue(4, date('H:i:s', strtotime($current_time) + 3600));
        $preparedQuery->execute();

        $res = $preparedQuery->fetchAll();

        $preparedQuery->closeCursor();

        return $res;
    }

    public function getBookingId($date, $time, $user, $room_id) {
        $conn = $this->conn;

        $query = 'SELECT ID FROM Prenota WHERE Data_Prenotazione=? AND Ora_Prenotazione=? AND Username=? AND ID_Room=?';

        $preparedQuery = $conn->prepare($query);
        $preparedQuery->bindValue(1, $date);
        $preparedQuery->bindValue(2, $time);
        $preparedQuery->bindValue(3, $user);
        $preparedQuery->bindValue(4, $room_id);
        $preparedQuery->execute();

        $res = $preparedQuery->fetchColumn();

        $preparedQuery->closeCursor();

        return $res;
    }

    public function getBookingInfo($booking_id) {
        $conn = $this->conn;

        $query = 'SELECT Data_Prenotazione, Ora_Prenotazione, Username, ID_Room FROM Prenota WHERE ID=?';

        $preparedQuery = $conn->prepare($query);
        $preparedQuery->bindValue(1, $booking_id);
        $preparedQuery->execute();

        $res = $preparedQuery->fetchAll();

        $preparedQuery->closeCursor();

        return $res[0];
    }

    public function editBooking($booking_id, $date, $time) {
        $conn = $this->conn;

        $query = 'UPDATE Prenota SET Data_Prenotazione=?, Ora_Prenotazione=? WHERE ID=?';

        $preparedQuery = $conn->prepare($query);
        $preparedQuery->bindValue(1, $date);
        $preparedQuery->bindValue(2, $time);
        $preparedQuery->bindValue(3, $booking_id);
        $res = $preparedQuery->execute();

        $preparedQuery->closeCursor();

        return $res;
    }

    public function deleteBooking($booking_id) {
        $conn = $this->conn;

        $query = 'DELETE FROM Prenota WHERE ID=?';

        $preparedQuery = $conn->prepare($query);
        $preparedQuery->bindValue(1, $booking_id);
        $res = $preparedQuery->execute();

        $preparedQuery->closeCursor();

        return $res;
    }

    public function deleteBookingWithInfo($date, $time_slot, $room_id, $username)
    {
    public function deleteBookingWithInfo($date, $time_slot, $room_id, $username) {
        $conn = $this->conn;

        $query = 'DELETE FROM Prenota WHERE Data_Prenotazione=? AND Ora_Prenotazione=? AND ID_Room=? AND Username=?';

        $preparedQuery = $conn->prepare($query);
        $preparedQuery->bindValue(1, $date);
        $preparedQuery->bindValue(2, $time_slot);
        $preparedQuery->bindValue(3, $room_id);
        $preparedQuery->bindValue(4, $username);
        $res = $preparedQuery->execute();

        $preparedQuery->closeCursor();

        return $res;
    }

    public function getPossibleRoomsForReview($username) {
        $conn = $this->conn;

        $query = 'SELECT ID_Room FROM Prenota WHERE Username=? AND (Data_Prenotazione<? OR (Data_Prenotazione=? AND Ora_Prenotazione<?))';

        $current_time = date('H:i:s');

        $preparedQuery = $conn->prepare($query);
        $preparedQuery->bindValue(1, $username);
        $preparedQuery->bindValue(2, date('Y-m-d'));
        $preparedQuery->bindValue(3, date('Y-m-d'));
        $preparedQuery->bindValue(4, date('H:i:s', strtotime($current_time) + 3600));
        $preparedQuery->execute();

        $res = $preparedQuery->fetchAll();

        $preparedQuery->closeCursor();

        return $res;
    }

    public function getUserReviews($username): array {
        $conn = $this->conn;

        $query = 'SELECT ID, ID_Room, Voto, Testo FROM Recensione WHERE Username=?';

        $preparedQuery = $conn->prepare($query);
        $preparedQuery->bindValue(1, $username);
        $preparedQuery->execute();

        $res = $preparedQuery->fetchAll();

        $preparedQuery->closeCursor();

        return $res;
    }

    public function createReview($username, $room_id, $review, $rating) {
        $conn = $this->conn;

        $query = 'INSERT INTO Recensione (Username, ID_Room, Voto, Testo) VALUES (?,?,?,?)';

        $preparedQuery = $conn->prepare($query);
        $preparedQuery->bindValue(1, $username);
        $preparedQuery->bindValue(2, $room_id);
        $preparedQuery->bindValue(3, $rating);
        $preparedQuery->bindValue(4, $review);
        $res = $preparedQuery->execute();

        $preparedQuery->closeCursor();

        return $res;
    }

    public function getReviewById($id) {
        $conn = $this->conn;

        $query = 'SELECT Username, ID_Room, Voto, Testo FROM Recensione WHERE ID=?';

        $preparedQuery = $conn->prepare($query);
        $preparedQuery->bindValue(1, $id);
        $preparedQuery->execute();

        $res = $preparedQuery->fetchAll();

        $preparedQuery->closeCursor();

        return $res[0];
    }

    public function editReview($id, $text, $rating) {
        $conn = $this->conn;

        $query = 'UPDATE Recensione SET Voto=?, Testo=? WHERE ID=?';

        $preparedQuery = $conn->prepare($query);
        $preparedQuery->bindValue(1, $rating);
        $preparedQuery->bindValue(2, $text);
        $preparedQuery->bindValue(3, $id);
        $res = $preparedQuery->execute();

        $preparedQuery->closeCursor();

        return $res;
    }

    public function deleteReview($id) {
        $conn = $this->conn;

        $query = 'DELETE FROM Recensione WHERE ID=?';

        $preparedQuery = $conn->prepare($query);
        $preparedQuery->bindValue(1, $id);
        $res = $preparedQuery->execute();

        $preparedQuery->closeCursor();

        return $res;
    }
}