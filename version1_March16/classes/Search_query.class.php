<?php
class Searchquery extends Database
{
    private $data;
    public function __construct($postdata)
    {
        $this->data = $postdata;
    }
    public function register()
    {
        $this->getpostdata();
    }
    private function getpostdata()
    {
        $location = $this->data['location'];
        $type = $this->data['type'];
        $price = $this->data['price']; 
        if (empty($location) && empty($type) && empty($price)){
            header("Location: ../pages/index2.php?error='emptyvalues'");
        }      
        elseif (!empty($location) && empty($type) && empty($price)){
            $this->querybylocation();
            
        }elseif(empty($location) && !empty($type) && empty($price)){
            $this->querybytype();
            
        }elseif(empty($location) && empty($type) && !empty($price)){
            $this->querybyprice();
            
        }elseif(!empty($location) && !empty($type) && empty($price)){
            $this->querybytypeandlocation();
            
        }elseif(empty($location) && !empty($type) && !empty($price)){
            $this->querybytypeandprice();
            
        }elseif(!empty($location) && empty($type) && !empty($price)){
            $this->querybylocationandprice();
            
        }elseif(!empty($location) && !empty($type) && !empty($price)){
            $this->querybyall();
        }        
    }
 

    private function querybylocation($location = "", $type = "", $price = "", $name = ""){
        $sql = "SELECT * FROM users WHERE uidUsers = ? AND emailUsers = ?";
        $conn = $this->connect();
        $stmt = mysqli_stmt_init($conn);
        // $stmt = $this->connect()->prepare($sql);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 'ss', $name, $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while ($data = $result->fetch_array(MYSQLI_BOTH)){
                echo $this->card($data["imgsrc"], $data["userId"], $data["propertyId"]);  
            }
        } else {
            echo "shit";
        }      
    }


    private function querybytype(){}
    private function querybyprice(){}
    private function querybytypeandlocation(){}
    private function querybytypeandprice(){}
    private function querybylocationandprice(){}
    private function querybyall(){}

    
    private function queryallproperties(){
        $sql = "SELECT * FROM property";
        $conn = $this->connect();
        $result = $conn->query($sql);
        if ($result->num_rows == 0) {
            echo "No records founds";
        } else {
            echo '<table class="table">' . '<tr>' . '<th>uidUsers</th>' . '<th>emailUsers</th>' . '<th>pwdUsers</th>' . '</tr>';
            while ($data = $result->fetch_array(MYSQLI_BOTH)) {                
                echo $this->card($data["imgsrc"], $data["userId"], $data["propertyId"]);               
            }
        }
    }


    private function card($imagesource, $userid, $propertyid)
    {
        return '<form action="" method="post" action="visit_request.php?ID=' . $propertyid . '&uidUsers=' . $userid . '">
                <div class="col-lg-6 col-xl-3 card">
                    <img class="card-img-top" src="' . $imagesource . '" alt="Card image cap">
                     <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text"></p>
                    <button name="visitrequest" type="submit" class="btn btn-primary">Book Visit Request</a>
                    </div>
                    </div>
            </form>';
    }

    
}