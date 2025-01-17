<?php
/*
Name: FSB for People
Version: 1.0
Author: Fajar Sodik
Blog: www.fsodic.com
Facebook: www.fb.com/presiden.fajar
*/

$panel_inc = 'inc/panel';

if(!empty($userlog['iduser']))
{
$fs = isset($_GET['fs']) ? trim($_GET['fs']) :'';
switch($fs)
{
default:
include ('./'.$panel_inc.'/index.php');
break;

case 'logout':
setcookie('_fsb_', '', time()-2, '/', $_SERVER['HTTP_HOST']);
session_unset();
session_destroy();
header ('Location: '.fsb('url').'/panel.php?');
break;

case 'post':
include ('./'.$panel_inc.'/post.php');
break;

case 'page':
include ('./'.$panel_inc.'/page.php');
break;

case 'category':
include ('./'.$panel_inc.'/category.php');
break;

case 'blogroll':
include ('./'.$panel_inc.'/blogroll.php');
break;

case 'navigation':
include ('./'.$panel_inc.'/navigation.php');
break;

case 'profile':
include ('./'.$panel_inc.'/profile.php');
break;

case 'theme':
include ('./'.$panel_inc.'/theme.php');
break;
}
}
else
{
if(isset($_POST['login']))
{
$log = $_POST['log'];
$pw = md5($_POST['password']);

$user = $fsodic->query("SELECT * FROM `user` WHERE `email` = '".mysqli_real_escape_string($fsodic,$log)."' OR `username` = '".mysqli_real_escape_string($fsodic,log)."'");
if($user->num_rows == 0)
{
$not = '<li class="fs-err">Email atau Nama Pengguna tidak ada</li>';
}
else
{
$match = $user->fetch_array();
$pw2 = md5($match['password']);

if($pw == $pw2)
{
setcookie('_fsb_', $match['log_session'], time()+3600*24*30, '/', $_SERVER['HTTP_HOST']);

header ('Location: '.fsb('url').'/panel.php?l');
}
else
{
$not = '<li class="fs-err">Kata Sandi tidak cocok dengan Email atau Nama Pengguna</li>';
}
}
}
else
{
$not ='';
}
$fs_title = 'Masuk';
include ('./'.$panel_inc.'/header.php');
echo '
<div id="fs-content">
<h2>'.$fs_title.'</h2>
<div class="fs-main">
'.$not.'
<form action="'.fsb('url').'/panel.php" method="POST">

<h4>Email atau Nama Pengguna</h4>

<input type="text" name="log" class="fs-text">

<h4>Kata Sandi</h4>

<input type="password" name="password" class="fs-text">

<div class="fs-sub"><input type="submit" name="login" value="Masuk" class="fs-btn"></div>

</form>

</div>

</div>
';

include ('./'.$panel_inc.'/footer.php');
}
