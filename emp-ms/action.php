<?php

session_start();

include '../functions/db-conn.php';
        // servername => localhost
        // username => root
        // password => empty
        // database name => staff
        
        // Check connection
        if($conn === false){
            die("ERROR: Could not connect. " 
                . mysqli_connect_error());
        }
        
        // Taking all 5 values from the form data(input)
        $sdate =  $_REQUEST['sdate'];
        $edate = $_REQUEST['edate'];
        $reason =  $_REQUEST['reason'];
        $empid = $_SESSION['uid'];
        $status = 'pending';
        

        $sql = "INSERT INTO leaveapp VALUES ('id', '$sdate', '$edate','$reason', '$status', '$empid')";
        
        if(mysqli_query($conn, $sql)){
        header('Location: leave.php');
        } else{
            echo "ERROR: Hush! Sorry $sql. " 
                . mysqli_error($conn);
        }
        
        // Close connection
        mysqli_close($conn);
        ?>