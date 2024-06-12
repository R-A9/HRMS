

<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Bare - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</head>

<body>

<div class="p-2">
<a href="../hrms-inner/main-page.html" class="btn btn-outline-dark btn-xs" type="submit">Back</a>
</div>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class=" text-dark" style="border-radius: 1rem;">
                        <div class="card-body p-8 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <!-- Form start-->
                                <form action="../functions/hrlogin-function.php" method="post">


                                <h2 class="fw-bold mb-2 pb-5">Atlas IT HR Login</h2>

                                <?php
                                if(isset($_SESSION["error"])){
                                    $error = $_SESSION["error"];
                                    echo "<span>$error</span>";
                                }
                            ?>  


                                <div data-mdb-input-init class="form-outline form-dark mb-4">
                                    <p class="text-start">Email</label>
                                        <input type="email" id="email" name="email" class="form-control form-control-xs" />

                                </div>

                                <div data-mdb-input-init class="form-outline form-white mb-4 pt-3">
                                    <p class="text-start">Password</label>
                                        <input type="password" id="password" name="password"
                                            class="form-control form-control-md" />

                                </div>


                                </p>

                                <button type="submit" class="btn btn-outline-dark btn-lg px-5" type="submit">Login</button>
                                <div class="small text-muted pt-3">Click <a href='login.php'>here</a> for Employee Login</div>
                            </div>
                            </form>

                            <!-- Form end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </body>
    </html>