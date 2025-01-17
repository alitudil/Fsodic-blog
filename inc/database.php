<?php
/*
Name: FSB for People
Version: 1.0
Author: Fajar Sodik
Blog: www.fsodic.com
Facebook: www.fb.com/presiden.fajar
*/

$fs_host = 'fsb.me'; //Host SQL
$fs_user = 'root'; //User SQL
$fs_pass = ''; //Sandi SQL
$fs_db = 'prefsb'; //Nama Database

$fsodic = new mysqli($fs_host,$fs_user,$fs_pass,$fs_db);

if(mysqli_errno($fsodic))
{
return 'Go to <a href="http://www.fsodic.com">www.fsodic.com</a>';
}