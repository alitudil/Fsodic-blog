<?php
/*
Name: FSB for People
Version: 1.0
Author: Fajar Sodik
Blog: www.fsodic.com
Facebook: www.fb.com/presiden.fajar
*/

echo '<!DOCTYPE html>

<html>

<head>

<title>'.$fs_title.' | '.fsb('name').'</title>

<link rel="stylesheet" type="text/css" href="'.fsb('url').'/files/desktop.css" media="all" />
';

$meta_sql = $fsodic->query("SELECT * FROM `meta` ORDER BY `idmeta` ASC");
if($meta_sql->num_rows > 0)
{
while ($meta = $meta_sql->fetch_array())
{
echo '
<meta name="'.$meta['name'].'" content="'.htmlentities($meta['content']).'" />
';
}
}

if (isset($_GET['fs']))
{
if($_GET['fs'] == 'post' || $_GET['fs'] == 'page')
{
$desc = $desc_content;
$h1 = 'div';
$h2 = 'div';
}
else
{
$desc = fsb('description');
$h1 = 'h1';
$h2 = 'h2';
}
}
else
{
$desc = fsb('description');
$h1 = 'h1';
$h2 = 'h2';
}

echo '
<meta name="description" content="'.$desc.'" />

<meta name="keywords" content="'.fsb('keywords').'" />

</head>

<body>

<div id="fs-header">

<'.$h1.' class="fs-heading"><a href="'.fsb('url').'">'.fsb('name').'</a></'.$h1.'>

<'.$h2.' class="fs-description">'.fsb('description').'</'.$h2.'>

</div>

<div id="fs-page">

<span><a href="'.fsb('url').'">Beranda</a></span>
';
$page_sql = $fsodic->query("SELECT * FROM `page` WHERE `pos` = 'top' and `status` = '1'");
if($page_sql->num_rows > 0)
{
while($page = $page_sql->fetch_array())
{
echo '
<span><a href="'.fsb('url').'/page/'.$page['permalink'].'">'.htmlentities($page['title']).'</a></span>
';
}
}
echo '
</div>
';
?>
