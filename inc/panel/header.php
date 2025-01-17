<?php
/*
Name: FSB for People
Version: 1.0
Author: Fajar Sodik
Blog: www.fsodic.com
Facebook: www.fb.com/presiden.fajar
*/

echo '<!DOCTYPE html>

<head>

<title>'.$fs_title.' | '.fsb('name').'</title>

<meta name="HandheldFriendly" content="true" />

<link rel="stylesheet" type="text/css" href="'.fsb('url').'/files/panel.css" media="all,handheld">

</head>

<body>

<div id="fs-header">

<h1><a href="'.fsb('url').'/panel.php">'.fsb('name').'</a></h1>

<div id="fs-navigation">
';
if(isset($_SESSION['iduser']))
{
$notif_from_us = '<li class="fs-war">Untuk mendapatkan layanan maksimal, silahkan membeli produk asli di <a href="http://www.fsodic.com">www.fsodic.com</a></li>';
echo '
<span><a href="'.fsb('url').'/panel.php">Panel</a></span>

<span><a href="'.fsb('url').'/panel.php?fs=post&amp;act=add">Post</a></span>

<span><a href="'.fsb('url').'/panel.php?fs=page&amp;act=add">Halaman</a></span>
';
}
else
{
$notif_from_us = '';
echo '
<span><a href="'.fsb('url').'/">Lihat Blog</a></span>

<span><a href="'.fsb('url').'/panel.php">Masuk</a></span>
';
}
echo '
</div>
'.$notif_from_us.'
</div>
';
