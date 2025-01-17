<?php
/*
Name: FSB for People
Version: 1.0
Author: Fajar Sodik
Blog: www.fsodic.com
Facebook: www.fb.com/presiden.fajar
*/

$act = isset($_GET['act']) ? trim($_GET['act']) :'';
switch ($act)
{
default:
if(isset($_POST['save']))
{
$content = $_POST['content'];
file_put_contents('./files/style.css', $content);
header ('Location: '.fsb('url').'/panel.php?fs=theme');
}
$fs_title = 'Kelola CSS';
include ('./'.$panel_inc.'/header.php');
echo '
<div id="fs-content">
<h2>'.$fs_title.'</h2>
<div class="fs-main">
<form action="'.fsb('url').'/panel.php?fs=theme" method="POST">
<h4>Konten</h4>
<textarea name="content" class="fs-text" rows="50">'.htmlentities(file_get_contents('./files/style.css')).'</textarea>
<div class="fs-sub"><input type="submit" name="save" value="Simpan" class="fs-btn"></div>
</form>
</div>
</div>
';
break;
}
include ('./'.$panel_inc.'/footer.php');
