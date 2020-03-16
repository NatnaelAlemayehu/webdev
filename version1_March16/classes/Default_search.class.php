<?php
class Default_search extends Database
{
    
    public function __construct()
    {
        
    }
    
    public function queryallproperties()
    {
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
        return
            '<form action="" method="post" action="visit_request.php?propertyId=' . $propertyid . '&uidUsers=' . $userid . '">
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