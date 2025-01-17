<?php
/*
Name: FSB for People
Version: 1.0
Author: Fajar Sodik
Blog: www.fsodic.com
Facebook: www.fb.com/presiden.fajar
*/


include ('./inc/database.php');

function permalink($fsbme)
{
$link = preg_replace('#([\W]+)#', ' ', $fsbme);
$link = str_replace(' ', '-', trim($link));
$link = strtolower($link);
return $link;
}

function fsb()
{
return 'http://'.$_SERVER['HTTP_HOST'];
}
$head = '<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><title>Pemasangan FSB</title><meta name="viewport" content="width=320" /><meta name="viewport" content="initial-scale=1.0" /><meta name="viewport" content="user-scalable=false" /><meta http-equiv="Cache-Control" content="max-age=1" /><meta name="HandheldFriendly" content="True" /><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><link rel="stylesheet" href="files/panel.css" type="text/css" media="all,handheld"/><head><div id="fs-header"><h1><a href="http://www.fsodic.com">Pemasangan FSB</a></h1></div><body>';
$foot = '<div id="fs-footer">Copyright 2012 - '.date('Y',time()+60*60*8).'<br />FSB by <a href="http://www.fsodic.com">Fajar Sodik</a></div></body></html>';

echo $head;
if(isset($_POST['start']))
{
$now = time();
$fsodic->query("DROP TABLE IF EXISTS `blogroll`;");

$fsodic->query("CREATE TABLE IF NOT EXISTS `blogroll` (
  `idblogroll` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `url` varchar(255) NOT NULL,
  `follow` varchar(8) NOT NULL,
  `status` varchar(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idblogroll`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2;");

$fsodic->query("INSERT INTO `blogroll` (`idblogroll`, `name`, `url`, `follow`, `status`) VALUES(1, 'Fajar Sodik', 'http://www.fsodic.com', 'dofollow', '0');");

$fsodic->query("INSERT INTO `blogroll` (`idblogroll`, `name`, `url`, `follow`, `status`) VALUES
(2, 'BarcaIndonesia.com', 'http://www.barcaindonesia.com', 'dofollow', '1');");

$fsodic->query("DROP TABLE IF EXISTS `category`;");

$fsodic->query("CREATE TABLE IF NOT EXISTS `category` (
  `idcategory` int(10) NOT NULL AUTO_INCREMENT,
  `cname` varchar(50) NOT NULL,
  `clink` varchar(50) NOT NULL,
  `cshow` varchar(2) NOT NULL,
  PRIMARY KEY (`idcategory`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;");

$fsodic->query("INSERT INTO `category` (`idcategory`, `cname`, `clink`, `cshow`) VALUES
(1, 'Lainnya', 'lainnya', '0');");


$fsodic->query("DROP TABLE IF EXISTS `meta`;");

$fsodic->query("CREATE TABLE IF NOT EXISTS `meta` (
  `idmeta` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `content` varchar(255) NOT NULL,
  `status` varchar(2) NOT NULL,
  PRIMARY KEY (`idmeta`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;");

$fsodic->query("INSERT INTO `meta` (`idmeta`, `name`, `content`, `status`) VALUES
(1, 'generator', 'FSodic Blog', '0');");

$fsodic->query("DROP TABLE IF EXISTS `navigation`;");
$fsodic->query("CREATE TABLE IF NOT EXISTS `navigation` (
  `idnavigation` int(10) NOT NULL AUTO_INCREMENT,
  `html` text NOT NULL,
  PRIMARY KEY (`idnavigation`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2;");

$fsodic->query("INSERT INTO `navigation` (`idnavigation`, `html`) VALUES
(1, '<p>Selamat datang, navigasi masih kosong. Silahkan edit di panel anda.</p>');");

$fsodic->query("DROP TABLE IF EXISTS `page`;");

$fsodic->query("CREATE TABLE IF NOT EXISTS `page` (
  `idpage` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `permalink` varchar(50) NOT NULL,
  `status` varchar(2) NOT NULL,
  `pos` varchar(3) NOT NULL,
  PRIMARY KEY (`idpage`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;");

$fsodic->query("INSERT INTO `page` (`idpage`, `title`, `content`, `permalink`, `status`, `pos`) VALUES
(1, 'Tentang', '<p>Selamat datang di <a href=\"http://www.fsodic.com\">FSodic Blog</a>, Engine blog buatan anak Indonesia.</p>\r\n\r\n<p>Kami hadir untuk anda dan mulailah blogging dengan CMS anda.</p>\r\n\r\n<p>Jika anda ingin versi premium, silahkan hubungi kami di 085753061028 atau 081256678595. Facebook kami di <a href=\"http://www.facebook.com/presiden.fajar\">sini</a>.</p>', 'tentang', '1', 'top');");

$fsodic->query("DROP TABLE IF EXISTS `post`;");
$fsodic->query("CREATE TABLE IF NOT EXISTS `post` (
  `idpost` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `category` int(10) NOT NULL,
  `user` int(10) NOT NULL,
  `content` text NOT NULL,
  `permalink` varchar(150) NOT NULL,
  `time` int(10) NOT NULL,
  `total` int(10) NOT NULL,
  `thumbnail` text NOT NULL,
  `status` varchar(2) NOT NULL,
  PRIMARY KEY (`idpost`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;");
$fsodic->query("INSERT INTO `post` (`idpost`, `title`, `category`, `user`, `content`, `permalink`, `time`, `total`, `thumbnail`, `status`) VALUES
(1, 'Halo Kawan', 1, 1, '<p>Selamat datang sahabatku. Terima kasih telah menggunakan Engine FSodic. Engine ini hanya untuk sobat yang ingin belajar membuat cms blog, silahkan dipelajari dan di edit sesuai selera. Script ini bersifat open source yang artinya semua bebas milik anda dan tanpa menghilangkan inisial pembuatnya.</p>', 'halo-kawan', '$now', 0, '/files/no.png', '1');");

$fsodic->query("DROP TABLE IF EXISTS `user`;");
$fsodic->query("CREATE TABLE IF NOT EXISTS `user` (
  `iduser` int(3) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(150) NOT NULL,
  `fullname` varchar(20) NOT NULL,
		`log_session` varchar(32) NOT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;");


$username = trim(permalink($_POST['username']));
$password = trim(strip_tags($_POST['password']));
$fullname = trim(strip_tags($_POST['fullname']));
$email = trim(strip_tags($_POST['email']));
$log_session = md5($username.'-'.$password.'-1');
$fsodic->query("INSERT INTO `user` (`iduser`, `username`, `password`, `email`, `fullname`, `log_session`) VALUES('1', '$username', '$password', '$email', '$fullname', '$log_session.');");

rename('./install.php', 'ce-install.php');
header ('Location: /panel.php');
}
else
{
echo '
<div id="fs-content">
<p>Selamat datang,<br />
Terima kasih telah menggunakan CMS FSB kami. CMS ini kami tujukan untuk proses belajar dan tidak untuk diperjual belikan. CMS ini kami bagikan secara Free di <a href="http://www.fsodic.com/" rel="dofollow">www.fsodic.com</a> dan pastikan sobat mendapatkan file asli dari situs kami.</p>

<p>Kami meminta anda tidak menghapus komentar pada setiap file yang mencantumkan inisial pembuat CMS dan kami juga tidak mengharapkan anda menghapus teks <b>FSB by Fajar Sodik</b> di bagian footer.</p>
<form action ="'.fsb('url').'/install.php" method="POST">
<h4>Nama Pengguna</h4>
<input type="text" name="username" class="fs-text">
<li class="fs-war">Nama pengguna anda hanya diperbolehkan a-z, 0-9 dan tanda "-"</li>
<h4>Kata Sandi</h4>
<input type="text" name="password" class="fs-text">
<h4>Nama Lengkap</h4>
<input type="text" name="fullname" class="fs-text">
<h4>Email</h4>
<input type"text" name="email" class="fs-text">
<div class="fs-sub"><input type="submit" name="start" value="Install" class="fs-btn" /></div>
</form>
';
}
echo $foot;
