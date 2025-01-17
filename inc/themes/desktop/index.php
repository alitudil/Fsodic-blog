<?php
/*
Name: FSB for People
Version: 1.0
Author: Fajar Sodik
Blog: www.fsodic.com
Facebook: www.fb.com/presiden.fajar
*/

$no = isset($_GET['no']) ? trim($_GET['no']) :'1';

$total_post = $fsodic->query("SELECT * FROM `post` WHERE `status` = '1'")->num_rows;

if($no > 1)
{
$start_post = ceil(($no-1)*$limit_post);
$fs_title = 'Halaman '.$no.'';
}
else
{
$start_post = 0;
$fs_title = 'Beranda';
}

include ('./'.$inc_themes.'/header.php');
echo '
<div id="fs-content">
';

$post_sql = $fsodic->query("SELECT * FROM `post` WHERE `status` = '1' AND `time` < '".ceil(time()+1)."' ORDER BY `time` DESC LIMIT $start_post, $limit_post");
if($post_sql->num_rows > 0)
{
while($post = $post_sql->fetch_array())
{
$category = $fsodic->query("SELECT * FROM `category` WHERE `idcategory` = '".$post['category']."'")->fetch_array();
$user = $fsodic->query("SELECT * FROM `user` WHERE `iduser` = '".$post['user']."'")->fetch_array();
echo '
<div class="fs-post">

<div class="fs-post-head">

<h2 class="fs-title"><a href="'.fsb('url').'/'.$post['permalink'].'">'.htmlentities($post['title']).'</a></h2>

<div class="fs-post-date">by '.htmlentities($user['fullname']).' on '.date('d M Y H:i', $post['time']+60*60*fsb('gmt')).'</div>

</div>

<div class="fs-post-content">
<img src="'.$post['thumbnail'].'" width="40px" height="50px" style="float:left; border:2px solid #333; padding:2px; margin:2px" class="thumbnail" alt="Thumbnail" title="Thumbnail" /> '.substr(strip_tags($post['content']),0,150).'....</div>

<div class="fs-post-foot" style="clear:both;">

<div class="fs-read">Pembaca: '.$post['total'].'</div>

</div>

</div>
';
}
}
else
{
echo '
<div class="fs-post">

<div class="fs-post-head">

<h2 class="fs-title">Posting Tidak Ada</h2>

</div>

<div class="fs-post-content"><p>Maaf, tidak ada posting!</p></div>

</div>
';
}

$banyak_halaman = ceil($total_post / $limit_post);
if($banyak_halaman > 1)
{
echo '
<div id="fs-pagination">
';
for ($i = 1; $i <= $banyak_halaman; $i++)
{
if($no !=$i)
{
echo '
<a href="'.$url.'/no/'.$i.'">'.$i.'</a>
';
}
else
{
echo '
<span>'.$i.'</span>
';
}
}
echo '
</div>
';
}
echo '
</div>
';
include ('./'.$inc_themes.'/footer.php');
?>
