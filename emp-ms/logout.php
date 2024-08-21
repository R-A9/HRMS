<?php
session_unset();
session_destroy();
header("location:../hrms-inner/main-page.html");
?>