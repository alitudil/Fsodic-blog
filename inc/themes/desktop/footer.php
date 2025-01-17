<?php
/*
Name: FSB for People
Version: 1.0
Author: Fajar Sodik
Blog: www.fsodic.com
Facebook: www.fb.com/presiden.fajar
*/

echo '
<div id="fs-sidebar">

<div class="fs-navigation">

<h3>Navigasi</h3>
';
$navigation_sql = $fsodic->query("SELECT * FROM `navigation` ORDER BY idnavigation");
if($navigation_sql->num_rows > 0)
{
while ($nav = $navigation_sql->fetch_array())
{
echo '
<li>'.$nav['html'].'</li>
';
}
}
echo '
</div>

<div class="fs-category">

<h3>Kategori</h3>
';
$category_sql = $fsodic->query("SELECT * FROM `category` ORDER BY `cshow` DESC, `cname` ASC");
if($category_sql->num_rows > 0)
{
while ($cat = $category_sql->fetch_array())
{
echo '
<li><a href="'.fsb('url').'/category/'.$cat['clink'].'/1">'.htmlentities($cat['cname']).'</a></li>
';
}
}
echo '
</div>

<div class="fs-blogroll">

<h3>Blogroll</h3>
';
$br_sql = $fsodic->query("SELECT * FROM `blogroll` ORDER BY `name` ASC");
if($br_sql->num_rows > 0)
{
while($br = $br_sql->fetch_array())
{
echo '
<li><a href="'.$br['url'].'" rel="'.$br['follow'].'">'.htmlentities($br['name']).'</a></li>
';
}
}
echo '
</div>

</div>

<div id="fs-footer">

<div class="fs-footing">Copyright &copy; '.gmdate('Y', time() +3600*fsb('gmt')).' <a href="'.fsb('url').'">'.fsb('name').'</a><br />FSB By <a href="http://www.fsodic.com">Fajar Sodik</a></div>
';
$page_sql = $fsodic->query("SELECT * FROM `page` WHERE `pos` = 'btm' AND `status` = '1'");
if($page_sql->num_rows > 0)
{
echo '
<div id="fs-page-btm">
';
while($page = $page_sql->fetch_array())
{
echo '
<span><a href="'.fsb('url').'/page/'.$page['permalink'].'">'.htmlentities($page['title']).'</a></span>
';
}
echo '
</div>
';
}
echo '
</div>

</body>

</html>';
