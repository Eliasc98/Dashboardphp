<?php
session_start();
session_destroy();
header('Location: /portfolio/AdminDashboard/login.php');
