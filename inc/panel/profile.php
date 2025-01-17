<?php
/*
Name: FSB for People
Version: 1.0
Author: Fajar Sodik
Blog: www.fsodic.com
Facebook: www.fb.com/presiden.fajar
*/

$my = mysql_fetch_array($fsodic->query("SELECT * FROM user WHERE iduser = '1'"));
$act = isset($_GET['act']) ? trim($_GET['act']) :'';
switch ($act)
{
default:
if(isset($_POST['save']))
{
$fullname =  trim(strip_tags($_POST['fullname']));
$email = trim(strip_tags($_POST['email']));
$username = trim(permalink($_POST['username']));
$new_pw = trim(strip_tags($_POST['new_pw']));
$password = trim(strip_tags($_POST['password']));
if($new_pw == '0')
{
$fsodic->query("UPDATE user SET fullname = '$fullname', username = '$username', email = '$email' WHERE iduser = '1'");
}
else
{
$fsodic->query("UPDATE user SET password = '$password', fullname = '$fullname', username = '$username', email = '$email' WHERE iduser = '1'");
}
header ('Location: '.fsb('url').'/panel.php?fs=profile');
}
else
{
$not = '';
}
$fs_title = 'Profile';
include ('./'.$panel_inc.'/header.php');
echo '
<div id="fs-content">
<h2>'.$fs_title.'</h2>
'.$not.'
<div class="fs-main">
<form action="'.fsb('url').'/panel.php?fs=profile" method="POST">
<h4>Nama Lengkap</h4>
<input type="text" name="fullname" value="'.$my['fullname'].'" class="fs-text">
<h4>Email</h4>
<input type="text" name="email" value="'.$my['email'].'" class="fs-text">
<h4>Nama Pengguna</h4>
<input type="text" name="username" value="'.$my['username'].'" class="fs-text">
<h4>Kata Sandi Baru?</h4>
<select name="new_pw" class="fs-select">
<option value="0">Tidak</option>
<option value="1">Ya</option>
</select>
<h4>Masukan Kata Sandi Baru</h4>
<input type="text" name="password" value="" class="fs-text">
<div class="fs-sub"><input type="submit" name="save" value="Simpan" class="fs-btn"></div>
</form>
</div>
</div>
';
break;
}
include ('./'.$panel_inc.'/footer.php');