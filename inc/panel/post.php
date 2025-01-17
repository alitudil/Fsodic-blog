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
$content = $_POST['content'];
$category = $_POST['category'];
$thumb = $_POST['thumbnail'];
$status = $_POST['status'];
if($thumb == 'http://' || $thumb == '')
{
$thumbnail = ''.fsb('url').'/files/no.png';
}
else 
{
$thumbnail = $thumb;
}
$fsodic->query("UPDATE `post` SET `title` = '".mysqli_real_escape_string($fsodic,$title)."', `content` = '".mysqli_real_escape_string($fsodic,$content)."', `category` = '".$category."', `thumbnail` = '".mysqli_real_escape_string($fsodic,$thumbnail)."', `status` = '".$status."' WHERE `idpost` = '".mysqli_real_escape_string($fsodic,$id)."'");
header ('Location: '.fsb('url').'/panel.php?fs=post');
}
$post = $fsodic->query("SELECT * FROM `post` WHERE idpost = '".mysqli_real_escape_string($fsodic,$id)."'")->fetch_array();
$fs_title = 'Kelola Post';
include ('./'.$panel_inc.'/header.php');
echo '
<div id="fs-content">
<h2>'.$fs_title.'</h2>
<div class="fs-main">
<form action="'.fsb('url').'/panel.php?fs=post&amp;act=manage&amp;id='.$id.'" method="POST">
<h4>Judul</h4>
<input type="text" name="title" class="fs-text" value="'.htmlentities($post['title']).'">
<h4>Konten</h4>
<textarea name="content" class="fs-text" rows="50">'.htmlentities($post['content']).'</textarea>
<div class="fs-war">HTML on</div>
<h4>Kategori</h4>
<select name="category" class="fs-select">
<option value="'.$post['category'].'">Tak Diubah</option>';
$cat_sql = $fsodic->query("SELECT * FROM `category` ORDER BY `cshow` DESC, `cname` ASC");

while ($cat = $cat_sql->fetch_array())
{
echo '<option value="'.$cat['idcategory'].'">'.$cat['cname'].'</option>
';
}
echo '
</select>
<h4>Thumbnail</h4>
<input type="text" name="thumbnail" value="'.htmlentities($post['thumbnail']).'" class="fs-text">
<h4>Status</h4>
<select name="status" class="fs-select">
<option value="'.$post['status'].'">Tak Diubah</option>
<option value="1">Terbitkan</option>
<option value="0">Simpan</option>
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
$time = time();
$category = $_POST['category'];
$thumb = $_POST['thumbnail'];
$status = $_POST['status'];
if($thumb == 'http://' ||$thumb == '')
{
$thumbnail = ''.fsb('url').'/files/no.png';
}
else 
{
$thumbnail = $thumb;
}
if($title == '' || $content == '')
{
$not = '<li class="fs-err">Isi atau Judul Kosong</li>';
}
else
{
$fsodic->query("INSERT INTO `post`(`title`, `content`, `category`, `user`, `thumbnail`, `time`, `permalink`, `status`) VALUES('".mysqli_real_escape_string($fsodic,$title)."', '".mysqli_real_escape_string($fsodic,$content)."', '".$category."', '1', '".mysqli_real_escape_string($fsodic,$thumbnail)."', '".$time."', '".$permalink."', '".$status."')");
header ('Location: '.fsb('url').'/panel.php?fs=post&not=successed_post');
}
}
else
{
$not = '';
$content = '';
$title = '';
}
$fs_title = 'Tambah Post';
include ('./'.$panel_inc.'/header.php');
echo '
<div id="fs-content">
<h2>'.$fs_title.'</h2>
'.$not.'
<div class="fs-main">
<form action="'.fsb('url').'/panel.php?fs=post&amp;act=add" method="POST">
<h4>Judul</h4>
<input type="text" name="title" class="fs-text">
<h4>Konten</h4>
<textarea name="content" class="fs-text" rows="40">'.trim(htmlentities($content)).'</textarea>
<div class="fs-war">HTML on</div>
<h4>Kategori</h4>
<select name="category" class="fs-select">
';
$cat_sql = $fsodic->query("SELECT * FROM category ORDER BY cshow DESC, cname ASC");
while ($cat = mysql_fetch_array($cat_sql))
{
echo '<option value="'.$cat['idcategory'].'">'.$cat['cname'].'</option>';
}
echo '
</select>
<h4>Thumbnail</h4>
<input type="text" name="thumbnail" value="http://" class="fs-text">
<h4>Status</h4>
<select name="status" class="fs-select">
<option value="1">Terbitkan</option>
<option value="0">Disimpan</option>
</select>
<div class="fs-sub"><input type="submit" name="add" value="Tambah" class="fs-btn"></div>
</form>
</div>
</div>
';
break;

default:
$fs_title = 'Post';
include ('./'.$panel_inc.'/header.php');
echo '
<div id="fs-content">
<h2>'.$fs_title.'</h2>
<div class="fs-main">
';
$post_sql = $fsodic->query("SELECT * FROM `post` ORDER BY `time` DESC");
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
<div>Tanggal: '.date('d M Y H:i', $post['time']+60*60*fsb('gmt')).'</div>
<div class="fs-act"><a href="'.fsb('url').'/panel.php?fs=post&amp;act=manage&amp;id='.$post['idpost'].'">Kelola</a> <a href="'.fsb('url').'/panel.php?fs=post&amp;act=del&amp;id='.$post['idpost'].'">Hapus</a></div>
</li>
';
}
echo '
<li><a href="'.fsb('url').'/panel.php?fs=post&amp;act=add">Tambah Baru</a></li>
</div>
</div>
';
break;

case 'del':
$id = $_GET['id'];
$fsodic->query("DELETE FROM `post` WHERE `idpost` = '".mysqli_real_escape_string($fsodic,$id)."'");
header('Location: '.fsb('url').'/panel.php?fs=post');
exit;
break;
}
include ('./'.$panel_inc.'/footer.php');
