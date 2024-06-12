<?php      
    include('db-conn.php');  
    $username = $_POST['email'];  
    $password = $_POST['password'];  

    $error = "username/password incorrect";

      
        //to prevent from mysqli injection  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($conn, $username);  
        $password = mysqli_real_escape_string($conn, $password);  
      
        $sql = "select * from empcred where email = '$username' and password = '$password'";  
        $result = mysqli_query($conn, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1){  
            header('Location: ../hrms-inner/index.html');  
        }  
        else{  
            $_SESSION["error"] = $error;
    header("location: ../login/login.php");  
        }     
?>  