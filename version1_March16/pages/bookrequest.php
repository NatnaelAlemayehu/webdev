<?php
include '../includes/autoclassloader.inc.php';

if(isset($_POST['visitrequest'])){
    echo '<html>
    <head>
    <body>
    <div>';
    
    $prop = new Property_detail_view();
    $prop -> display_property_detail($_GET['propertyId'], $GET['uidUsers']);     
    
    echo '</div>    
    </body>
    </html>';
    
}else{
    header("Location: signin.php?error=notloggedin");
}

?>