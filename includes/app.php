<?php 
   
    require 'funciones.php';
    require 'conn.php';
    require __DIR__ . '/../vendor/autoload.php';

    $db = mysqli_connect('localhost','root','root','sita');
    $db->set_charset('utf8');

    use App\ActiveRecord;

    ActiveRecord::setDB($db);

?>