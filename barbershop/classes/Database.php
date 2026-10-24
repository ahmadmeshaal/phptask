
<?php

class Dbh
{
    protected function connect()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "barbershop";

        try {
            $conn = new PDO(
                "mysql:host=$servername;dbname=$dbname;charset=utf8mb4",
                $username,
                $password
            );

            $conn->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            return $conn;

        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new RuntimeException("Database connection failed.");
        }
    }
}
