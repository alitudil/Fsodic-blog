<?php
$inc_themes = 'inc/themes/desktop';

$fs = isset($_GET['fs']) ? trim($_GET['fs']) :'';
switch ($fs)
{
default:
include  ('./'.$inc_themes.'/index.php');
break;

case 'post':
include ('./'.$inc_themes.'/post.php');
break;

case 'page':
include ('./'.$inc_themes.'/page.php');
break;

case 'category':
include ('./'.$inc_themes.'/category.php');
break;

case '404':
include ('./'.$inc_themes.'/404.php');
break;
}
