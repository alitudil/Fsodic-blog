<?php
/*
Name: FSB for People
Version: 1.0
Author: Fajar Sodik
Blog: www.fsodic.com
Facebook: www.fb.com/presiden.fajar
*/

$fs_title = 'Halaman Tidak Ada';
include ('./'.$inc_themes.'/header.php');
echo '
<div id="fs-content">

<div class="fs-post 404">

<h1 class="fs-title">'.$fs_title.'</h1>

<div class="fs-post-content"><p>Maaf, Posting yang anda minta tidak ada atau mungkin telah di hapus. Silahkan kembali ke <a href="'.$url.'">Beranda</a>.</p></div>

</div>

</div>
';
include ('./'.$inc_themes.'/footer.php');
?>
