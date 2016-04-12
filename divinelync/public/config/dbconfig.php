<?php
$config = parse_ini_file('../../config.ini');
$hostname=$config['hostname'];
$username=$config['username'];
$password=$config['password'];
$dbname=$config['dbname'];
$obj = new Database($hostname,$username,$password,$dbname);

?>