<?php
/*
Name: FSB for People
Version: 1.0
Author: Fajar Sodik
Blog: www.fsodic.com
Facebook: www.fb.com/presiden.fajar
*/

$act = isset($_GET['act']) ? trim($_GET['act']) :'';
switch($act)
{
case 'manage':
$id = $_GET['id'];
if(isset($_POST['save']))
{
$title = $_POST['title'];
$permalink = permalink($title);
$content = $_POST['content'];
$status = $_POST['status'];
$pos = $_POST['pos'];
$fsodic->query("UPDATE `page` SET `title` = '".mysql_real_escape_string($title)."', `content` = '".mysql_real_escape_string($content)."', `status` = '$status', `permalink` = '$permalink', `pos` = '$pos' WHERE `idpage` = '$id'");
header ('Location: '.fsb('url').'/panel.php?fs=page');
}
$post = $fsodic->query("SELECT * FROM `page` WHERE `idpage` = '$id'")->fetch_array();
$fs_title = 'Kelola Halaman';
include ('./'.$panel_inc.'/header.php');
echo '
<div id="fs-content">
<h2>'.$fs_title.'</h2>
<div class="fs-main">
<form action="'.fsb('url').'/panel.php?fs=page&amp;act=manage&amp;id='.$id.'" method="POST">
<h4>Judul</h4>
<input type="text" name="title" class="fs-text" value="'.$post['title'].'">
<div class="fs-war">Jangan gunakan tanda kurung "()"</div>
<h4>Konten</h4>
<textarea name="content" class="fs-text" rows="50">'.$post['content'].'</textarea>
<div class="fs-war">HTML on</div>
<h4>Status</h4>
<select name="status" class="fs-select">
<option value="'.$post['status'].'">Tak Diubah</option>
<option value="1">Terbitkan</option>
<option value="0">Simpan</option>
</select>
<h4>Posisi</h4>
<select name="pos" class="fs-select">
<option value="'.$post['pos'].'">Tak Diubah</option>
<option value="top">Atas</option>
<option value="btm">Bawah</option>
</select>
<div class="fs-sub"><input type="submit" name="save" value="Simpan" class="fs-btn"></div>
</form>
</div>
</div>';
break;

case 'add':
if(isset($_POST['add']))
{
$title = $_POST['title'];
$content = $_POST['content'];
$permalink = permalink($title);
$status = $_POST['status'];
$pos = $_POST['pos'];
$fsodic->query("INSERT INTO `page`(`title`, `content`, `permalink`, `status`, `pos`) VALUES('".mysql_real_escape_string($title)."', '".mysql_real_escape_string($content)."', '$permalink', '$status', '$pos')");
header ('Location: '.fsb('url').'/panel.php?fs=page');
}
$fs_title = 'Tambah Halaman';
include ('./'.$panel_inc.'/header.php');
echo '
<div id="fs-content">
<h2>'.$fs_title.'</h2>
<div class="fs-main">
<form action="'.fsb('url').'/panel.php?fs=page&amp;act=add" method="POST">
<h4>Judul</h4>
<input type="text" name="title" class="fs-text">
<h4>Konten</h4>
<textarea name="content" class="fs-text" rows="40"></textarea>
<div class="fs-war">HTML on</div>
<h4>Status</h4>
<select name="status" class="fs-select">
<option value="1">Terbitkan</option>
<option value="0">Disimpan</option>
</select>
<h4>Posisi</h4>
<select name="pos" class="fs-select">
<option value="top">Atas</option>
<option value="btm">Bawah</option>
</select>
<div class="fs-sub"><input type="submit" name="add" value="Tambah" class="fs-btn"></div>
</form>
</div>
</div>
';
break;

default:
$fs_title = 'Halaman';
include ('./'.$panel_inc.'/header.php');
echo '
<div id="fs-content">
<h2>'.$fs_title.'</h2>
<div class="fs-main">
';
$post_sql = $fsodic->query("SELECT * FROM `page` ORDER BY `title` ASC");
while($post = $post_sql->fetch_array())
{
if($post['status'] == '1') {
$stat = 'Diterbitkan';
}
else {
$stat = 'Disimpan';
}
echo '
<li>
<h4>'.$post['title'].' ('.$stat.')</h4>
<div class="fs-act"><a href="'.fsb('url').'/panel.php?fs=page&amp;act=manage&amp;id='.$post['idpage'].'">Kelola</a> <a href="'.fsb('url').'/panel.php?fs=page&amp;act=del&amp;id='.$post['idpage'].'">Hapus</a></div>
</li>
';
}
echo '
<li><a href="'.fsb('url').'/panel.php?fs=page&amp;act=add">Tambah Baru</a></li>
</div>
</div>
';
break;

case 'del':
$id = $_GET['id'];
$fsodic->query("DELETE FROM `page` WHERE `idpage` = '$id'");
header('Location: '.fsb('url').'/panel.php?fs=page');
break;
}
include ('./'.$panel_inc.'/footer.php');
