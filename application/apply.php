<?php
session_start();

include "../functions/db-conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $flname = $_POST['flname'];
    $email = $_POST['email'];
    $contno = $_POST['contno'];
    $date = $_POST['date'];
    $role = $_POST['role'];
    $status = "pending";

    $stmt = $conn->prepare("INSERT INTO applications (flname, email, date, role, contno, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $flname, $email, $date, $role, $contno, $status);

    if ($stmt->execute()) {
        echo "New record created successfully";
        header("Location: submitted.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Bare - Start Bootstrap Template</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar border-bottom border-dark">
        <div class="container-fluid">
            <a class="navbar-brand" style='color:black;' href="main-page.html">
                <img src="../images/atlas2.png" alt="" width="60" height="60" class="d-inline-block align-text-center">
                Atlas IT Solutions
            </a>
            <form class="d-flex">
                <a class="btn" style='background-color: #D9D9D9;' href='../hrms-inner/main-page.html'>Back</a>
            </form>
        </div>
    </nav>

    <section class='pt-5'>
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-9">
                    <h1 class="text-dark mb-4">Atlas IT Solutions Application Form</h1>
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body">
                            <form action="apply.php" method="post" enctype="multipart/form-data">
                                <div class="row align-items-center pt-4 pb-3">
                                    <div class="col-md-3 ps-5">
                                        <h6 class="mb-0">Full name</h6>
                                    </div>
                                    <div class="col-md-9 pe-5">
                                        <input type="text" name="flname" class="form-control form-control-lg" placeholder="Lastname, Firstname MI." required />
                                    </div>
                                </div>
                                <hr class="mx-n3">
                                <div class="row align-items-center py-3">
                                    <div class="col-md-3 ps-5">
                                        <h6 class="mb-0">Email address</h6>
                                    </div>
                                    <div class="col-md-9 pe-5">
                                        <input type="email" name="email" class="form-control form-control-lg" placeholder="example@example.com" required />
                                    </div>
                                </div>
                                <hr>
                                <div class="row align-items-center py-3">
                                    <div class="col-md-3 ps-5">
                                        <h6 class="mb-0">Contact Number</h6>
                                    </div>
                                    <div class="col-md-9 pe-5">
                                        <input type="text" name="contno" class="form-control form-control-lg" placeholder="+(Country Code)" required />
                                    </div>
                                </div>
                                <hr class="mx-n3">
                                <div class="row align-items-center py-3">
                                    <div class="col-md-3 ps-5">
                                        <h6 class="mb-0">Available Date</h6>
                                    </div>
                                    <div class="col-md-9 pe-5">
                                        <input type="date" name='date' class="form-control form-control-lg" required />
                                    </div>
                                </div>
                                <hr class="mx-n3">
                                <div class="row align-items-center py-3">
                                    <div class="col-md-3 ps-5">
                                        <h6 class="mb-0">Role you're applying for</h6>
                                    </div>
                                    <div class="col-md-9 pe-5">
                                        <input type="text" name="role" class="form-control form-control-lg" placeholder="Role" required />
                                    </div>
                                </div>
                                <hr class="mx-n3">
                                <div class="px-5 py-4">
                                    <center><input type="submit" name="resume" value="Submit" style='font-weight: 600; font-size: 20pt;' class="btn btn-primary"></center>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>