<?php
/*
Name: FSB for People
Version: 1.0
Author: Fajar Sodik
Blog: www.fsodic.com
Facebook: www.fb.com/presiden.fajar
*/


$id = isset($_GET['id']) ? trim($_GET['id']) :'halo-sahabat';

$post_check = $fsodic->query("SELECT * FROM `page` WHERE `permalink` = '".mysqli_real_escape_string($fsodic,$id)."' AND `status` = '1'");
if($post_check->num_rows == 0)
{
$fs_title = 'Halaman Tidak Ada';
include ('./'.$inc_themes.'/header.php');
echo '
<div id="fs-content">

<div class="fs-post 404">

<div class=fs-post-head">

<h1 class="fs-title">'.$fs_title.'</h1>

<div class="fs-post-content"><p>Maaf, Halaman yang anda minta tidak ada atau mungkin telah di hapus. Hubungi kami di <a href="'.fsb('url').'/page/tentang">sini</a> atau kembali ke <a href="'.fsb('url').'">Beranda</a>.</p></div>

</div>

</div>
';
}
else
{
$post = $post_check->fetch_array();
$desc_content = substr(trim(strip_tags($post['content'])),0,150);

$fs_title = $post['title'];
include ('./'.$inc_themes.'/header.php');
echo '
<div id="fs-content">

<div class="fs-post single">

<div class="fs-post-head">

<h1 class="fs-title">'.$post['title'].'</h1>

</div>

<div class="fs-post-content">'.trim(stripslashes($post['content'])).'</div>

<div class="fs-post-foot">

<div class="fs-share">Bagikan: <a href="http://www.facebook.com/sharer.php?u='.rawurlencode(fsb('url').'/page/'.$post['permalink']).'">Facebook</a> <a href="http://www.twitter.com/home?status='.rawurlencode(fsb('url').'/page/'.$post['permalink']).'">Twitter</a></div>

</div>

</div>

</div>
';
}
include ('./'.$inc_themes.'/footer.php');
