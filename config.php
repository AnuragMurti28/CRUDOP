<?php
/*database configuration file
user root
password blank 
*/

define('DB_SERVER','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','login');


// try connecting to database
$conn = mysqli_connect('DB_SERVER','DB_USERNAME','DB_PASSWORD','DB_NAME');

//check connection
if($conn == false){
    dir('Error: Cannot connect');
}




?>