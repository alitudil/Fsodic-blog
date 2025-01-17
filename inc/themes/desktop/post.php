<?php
/*
Name: FSB for People
Version: 1.0
Author: Fajar Sodik
Blog: www.fsodic.com
Facebook: www.fb.com/presiden.fajar
*/

$id = isset($_GET['id']) ? trim($_GET['id']) :'halo-sahabat';

$post_check = $fsodic->query("SELECT * FROM `post` WHERE `permalink` = '".mysqli_real_escape_string($fsodic,$id)."' AND `status` = '1' AND `time` < '".ceil(time()+1)."'");
if($post_check->num_rows == 0)
{
$fs_title = 'Post Tidak Ada';
include ('./'.$inc_themes.'/header.php');
echo '
<div id="fs-content">

<div class="fs-post 404">

<div class="fs-post-head">

<h1 class="fs-title">'.$fs_title.'</h1>

</div>

<div class="fs- 
post-content"><p>Maaf, Posting yang anda minta tidak ada atau mungkin telah di hapus. Silahkan hubungi kami di <a href="'.fsb('url').'/page/tentang">sini</a> atau kembali ke <a  
href="'.fsb('url').'">Beranda</a>.</p></div>

</div>

</div>
';
include('./'.$inc_themes.'/footer.php');
}
else
{
$post = $post_check->fetch_array();
$user = $fsodic->query("SELECT * FROM `user` WHERE `iduser` = '".$post['user']."'")->fetch_array();
$cat = $fsodic->query("SELECT * FROM `category` WHERE `idcategory` = '".$post['category']."'")->fetch_array();

$desc_content = substr(trim(strip_tags($post['content'])),0,150);

$fs_title = htmlentities($post['title']);
include ('./'.$inc_themes.'/header.php');
echo '
<div  
id="fs-content">

<div class="fs-post single">

<div class="fs-post-head">

<h1 class="fs-title">'.htmlentities($post['title']).'</h1>

<h2 class="fs-post-category">Kategori: <a href="'.fsb('url').'/category/'.$cat['clink'].'/1">'.htmlentities($cat['cname']).'</a></h2>

<div class="fs-post-date">On '.date('d M Y H:i', $post['time']+3600*fsb('gmt')).'</div>

</div>

<div class="fs-post-content">'.trim(stripslashes($post['content'])).'</div>

<div class="fs-post-foot">

<div class="fs-post-writer">Penulis: '.htmlentities($user['fullname']).'</div>

<div class="fs-post-read">Dibaca: '.$post['total'].'</div>

<div class="fs-share">Bagikan: <a href="http://www.facebook.com/sharer.php?u='.rawurlencode(fsb('url').'/'.$post['permalink']).'">Facebook</a>
<a href="http://www.twitter.com/home?status='.rawurlencode(fsb('url').'/'.$post['permalink']).'">Twitter</a></div>

</div>

</div>

</div>
';

include ('./'.$inc_themes.'/footer.php');

$fsodic->query("UPDATE `post` SET `total` = '".ceil($post['total']+1)."' WHERE `idpost` = '".$post['idpost']."'");
}
?>
