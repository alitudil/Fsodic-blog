<?php
/*
Name: FSB for People
Version: 1.0
Author: Fajar Sodik
Blog: www.fsodic.com
Facebook: www.fb.com/presiden.fajar
*/
if(file_exists('./inc/blog.php'))
{
include ('./inc/blog.php');
}
else
{
header ('Location: /install.php');
}
?>
