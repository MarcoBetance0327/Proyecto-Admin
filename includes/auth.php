<?php

if (!isset($_SESSION['sessionId'])) {
    header("Location:login.php");
}