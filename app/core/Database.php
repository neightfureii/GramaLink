<?php

Trait Database {
    private function connect() {
        try {
            $string = "mysql:hostname=" . DBHOST . ";dbname=" . DBNAME;
            $con = new PDO($string, DBUSER, DBPASS);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // important
            return $con;
        } catch (PDOException $e) {
            error_log("Connection error: " . $e->getMessage());
            return false;
        }
    }

    public function query($query, $data = []) {

    try{

        $con = $this->connect();
        if(!$con) return false;
        $stm = $con->prepare($query);

        $check = $stm->execute($data);
        if(!$check){
            return false;
        }
        $queryType = strtolower(explode(' ', trim($query))[0]);
        if ($queryType === 'select') {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            return (is_array($result) && count($result)) ? $result : [];
        } else {
            // for insert, update, delete return the statement to check rowCount
            return $stm;
        }
       

       
    }catch(PDOException $e){
        error_log("Query error: " . $e->getMessage() . "| SQL: " . $query);
        return false;
    }
    }

    public function get_row($query, $data = []) {
        $con = $this->connect();
        $stm = $con->prepare($query);

        $check = $stm->execute($data);
        if ($check) {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            if(is_array($result) && count($result)) {
                return $result[0];
            }
        }

        return false;
    }
}

