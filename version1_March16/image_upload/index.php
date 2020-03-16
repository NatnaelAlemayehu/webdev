<?php
session_start();
include_once 'dbh.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    $sql = "SELECT * FROM user";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){
        while ($row = mysqli_fetch_assoc($result)){
            $id = $row['id'] ;
            $sqlImg = "SELECT * FROM profileimg WHERE userid ={$id}";
            $resultImg = mysqli_query($conn, $sqlImg); 
            while($rowImg = mysqli_fetch_assoc($resultImg)){
               echo "<div>"; 
               if($rowImg['img_status']==0){
                    $filename = "uploads/profile".$id."*";
                    $fileinfo = glob($filename);
                    $fileext = explode(".", $fileinfo[0]);
                    $fileactualext = $fileext[1];
                    echo "<img src='uploads/profile".$id.".".$fileactualext."?".mt_rand()."'>";
               }else{
                   echo "<img src='uploads/profiledefault.png' width='100px' height='100px'>";
               }
               echo $row['username'];
               echo "</div>";
            }    
        }
    }else{
        echo "There are no users yet!";
    }
    if (isset($_SESSION['id'])){
        if($_SESSION['id'] == 1){
            echo "you are logged in as user #1";
        }
        echo "<form action='upload.php' method='POST' enctype='multipart/form-data'>
        <input type='file' name='file'>
        <button type='Submit' name='submit'>UPLOAD</button>
    </form>";
    }else{
        echo "You are not logged in";
        echo "<form action='signup.php' method='POST'>            
            <input type='text' name='first' placeholder = 'First name'>
            <input type='text' name='last' placeholder = 'Last name'>
            <input type='text' name='uname' placeholder = 'Username'> 
            <input type='password' name='pwd' placeholder = 'Password'>                      
            <button type='Submit' name='SubmitSignup'>Signup</button>
        </form>";
    }
    ?>


    <p>Login as user!</p>
    <form action="login.php" method="POST">
        <button type="Submit" name="submitLogin">Login</button>
    </form>
    <p>Logout as user!</p>
    <form action="logout.php" method="POST">
        <button type="Submit" name="submitLogout">Logout</button>
    </form>
</body>

</html>