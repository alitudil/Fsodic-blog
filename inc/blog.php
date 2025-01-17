<?php
include ('./inc/fajarsodik.php');

if(isset($_GET['panel']))
{
include ('./inc/panel/config.php');
}
else
{
include ('./inc/themes/config.php');
}