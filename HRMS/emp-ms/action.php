<?php


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
        $reason =  $_POST['reason'];
        $empid = 6710;
        $status = 'pending';
        
        // Performing insert query execution
        // here our table name is college
        $sql = "INSERT INTO leaveapp VALUES ('$sdate', 
            '$edate','$reason','$status','$empid')";
        
        if(mysqli_query($conn, $sql)){
           header['Location: leave.php'];
        } else{
            echo "ERROR: Hush! Sorry $sql. " 
                . mysqli_error($conn);
        }
        
        // Close connection
        mysqli_close($conn);
        ?>