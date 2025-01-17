<?php
/*
Name: FSB for People
Version: 1.0
Author: Fajar Sodik
Blog: www.fsodic.com
Facebook: www.fb.com/presiden.fajar
*/

$fs_title = 'Panel Menu';
include ('./'.$panel_inc.'/header.php');
echo '
<div id="fs-content">

<h2>'.$fs_title.'</h2>

<div class="fs-main">

<h3>Tambah</h3>

<li><a href="'.fsb('url').'/panel.php?fs=post&amp;act=add">Posting</a></li>

<li><a href="'.fsb('url').'/panel.php?fs=blogroll&amp;act=add">Blogroll</a></li>

<li><a href="'.fsb('url').'/panel.php?fs=page&amp;act=add">Halaman</a></li>

<h3>Sunting</h3>

<li><a href="'.fsb('url').'/panel.php?fs=post">Posting</a></li>

<li><a href="'.fsb('url').'/panel.php?fs=blogroll">Blogroll</a></li>

<li><a href="'.fsb('url').'/panel.php?fs=page">Halaman</a></li>

<li><a href="'.fsb('url').'/panel.php?fs=category">Kategori</a></li>

<h3>Pengaturan</h3>

<li><a href="'.fsb('url').'/panel.php?fs=theme">CSS</a></li>

<li><a href="'.fsb('url').'/panel.php?fs=navigation">Navigasi</a></li>

<li><a href="'.fsb('url').'/panel.php?fs=profile">Profil</a></li>

<h3>CMS</h3>

<li><a href="http://www.fsodic.com">Official Blog</a></li>

<li><a href="http://www.facebook.com/presiden.fajar">Facebook</a></li>

<li><a href="http://www.twitter.com/fajarsodik10">Twitter</a></li>

<li><a href="'.fsb('url').'/panel.php?fs=logout">Keluar</a></li>

</div>

</div>
';

include ('./'.$panel_inc.'/footer.php');
