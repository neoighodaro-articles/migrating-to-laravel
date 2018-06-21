<?php
 $host = 'localhost';
 $dbname= 'vanilla';
 $user   = 'root';
 $pwd    = 'root';

 try{
   $pdo = new PDO('mysql:host='. $host. ';dbname='. $dbname, $user, $pwd);
 }