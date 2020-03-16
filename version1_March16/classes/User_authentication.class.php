<?php 
class User_authentication extends Database{
    private $data;   
    public function __construct($postData)
    {
        $this->data = $postData;
    }

    private function validate_user(){
        $email = $this->data['email'];
        $password = $this->data['password'];
        $repeat_password = $this -> data['repeat-password'];
        
        $this->authenticate($email, $password);
    }

    private function authenticate($user_email, $user_password){
        $sql = "SELECT * FROM users WHERE email = ?";
        $conn = $this->connect(); 
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $conn)) {
            header("Location: ../pages/login.php?error=usertaken");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, 's', $user_email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)){
                $pwdCheck = password_verify($user_password, $row['user_password']);
                if($pwdCheck == false){
                    header("Location: ../pages/login.php?error=wrongpwd");
                    exit(); 
                }else if($pwdCheck == true){
                    session_start();
                    $_SESSION['userId'] = $row['userId'];                   
                    header("Location: ../user_dashboard.php?login=success");
                    exit(); 
                }
            } else {
                header("Location: ../signin.php?error=noresultfound");
                exit();
            }         
        }
    }
}