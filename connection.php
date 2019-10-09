<?php

$connect = mysqli_connect('localhost', 'root', '', 'cruddb');

if(!$connect){
	die('Connection Error');
}