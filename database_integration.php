<?php

    $conn = mysqli_connect("localhost" , "root" , "" , "walletapp");
    if(!$conn)
    {
        echo "Server has not been connected Because of the error-----> ". mysqli_error($conn);
    }
   

?>