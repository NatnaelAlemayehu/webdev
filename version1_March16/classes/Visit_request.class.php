<?php

class Visit_request extends Database{
    private $data;
    public function __construct($postdata){
        $this -> data = $postdata; 
    }

    public function book_visit_request(){
        $this -> visit_request();
    }
    
    private function visit_request(){
        $property_id = $this -> data['property_id'];
        $date_of_visit = $this -> data['date_of_visit'];
        $phone_number = $this -> data['phone_number'];
        $location = $this -> data['location'];
        
        $this -> book_request($property_id, $date_of_visit, $phone_number, $location);
        }
    
    private function book_request(){

        $sql = "INSERT INTO visitRequest (accountId, propertyId, dateofVisit, phoneNumber, userlocation)
                VALUES (?, ?, ?, ?, ?)";
        $conn = $this->connect();
        $stmt = mysqli_stmt_init($conn);
        // $stmt = $this->connect()->prepare($sql);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 'ssssss', $f_name, $l_name, $email, $phone, $location, $pass);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $userId = $row['userId'];
                header("Location: ../pages/bookrequest.php?booking=successful");
            }
        } else {
            header("Location: ../pages/bookrequest.php?registration=failed");
        }       
    }
}