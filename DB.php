<?php

    //TODO: this needs to be moved to the credentials file
    $dsn = 'mysql:host=localhost;dbname=namecollector';
    $username = 'root';
    $password = '';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        exit();
    }
    
    function submitInfo($studentFirstname, $studentLastname, $university, $instructors) {
        
        $updateCount = 0;
        
        forEach($instructors as $instructor) {
            global $db;
        
            $query = "INSERT INTO namecollector (studentFirstname, studentLastname, ".
                    "university, instructor, whenSubmitted) VALUES (:studentFirstname, ".
                    ":studentLastname, :university, :instructor, :whenSubmitted)";
            $statement=$db->prepare($query);
            $statement->bindValue(':studentFirstname', $studentFirstname);
            $statement->bindValue(':studentLastname', $studentLastname);
            $statement->bindValue(':university', $university);
            $statement->bindValue(':instructor', $instructor);
            $statement->bindValue(':whenSubmitted', date("Y-m-d H:i:s"));

            if ($statement->execute()) {
                $updateCount++;
            }
        }
        
        if ($updateCount === count($instructors) && $updateCount != 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //for outputting the collected data to a .csv
    function getAll() {
        global $db;
        
        $query = 'SELECT * FROM namecollector ORDER BY university';
        $statement=$db->prepare($query);
        $statement->execute();
        return $statement->fetchAll();        
    }
?>