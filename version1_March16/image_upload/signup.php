<?php

if (isset($_POST['SubmitSignup'])){   

include_once 'dbh.php';

$first = $_POST['first'];
$last = $_POST['last'];
$uid = $_POST['uname'];
$pwd = $_POST['pwd'];
$sql = "INSERT INTO user(firstname, lastname, username, pwd) 
VALUES ('$first', '$last', '$uid', '$pwd')";
mysqli_query($conn, $sql);
$sql = "SELECT * FROM user WHERE username='$uid' AND firstname='$first'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)){
        $userid = $row['id'];
        $sql = "INSERT INTO profileimg (userid, img_status) 
        VALUES ('$userid', 1)";
        mysqli_query($conn, $sql);
        header("Location: index.php");
        
    }
}else{
    echo "error";
}
}else{
    echo "can't be here";
}