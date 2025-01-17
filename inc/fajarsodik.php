<?php
/*
Name: FSB for People
Version: 1.0
Author: Fajar Sodik
Blog: www.fsodic.com
Facebook: www.fb.com/presiden.fajar
*/

session_start();

include ('./inc/database.php');

/*
https://github.com/serbanghita/Mobile-Detect
*/

class mobile_detect {
    
    protected $accept;
    protected $userAgent;
    
    protected $isMobile     = false;
    protected $isAndroid    = null;
    protected $isBlackberry = null;
    protected $isOpera      = null;
    protected $isPalm       = null;
    protected $isWindows    = null;    protected $isIphone    = null;
    protected $isGeneric    = null;

    protected $devices = array(
        "android"       => "android",
        "blackberry"    => "blackberry",
        "iphone"        => "(iphone|ipod)",
        "opera"         => "opera mini",
        "palm"          => "(avantgo|blazer|elaine|hiptop|palm|plucker|xiino)",
        "windows"       => "windows ce; (iemobile|ppc|smartphone)",
        "generic"       => "(kindle|mobile|mmp|midp|o2|pda|pocket|psp|symbian|smartphone|treo|up.browser|up.link|vodafone|wap)"
    );


    public function __construct() {
        $this->userAgent = $_SERVER['HTTP_USER_AGENT'];
        $this->accept    = $_SERVER['HTTP_ACCEPT'];

        if (isset($_SERVER['HTTP_X_WAP_PROFILE'])|| isset($_SERVER['HTTP_PROFILE'])) {
            $this->isMobile = true;
        } elseif (strpos($this->accept,'text/vnd.wap.wml') > 0 || strpos($this->accept,'application/vnd.wap.xhtml+xml') > 0) {
            $this->isMobile = true;
        } else {
            foreach ($this->devices as $device => $regexp) {
                if ($this->isDevice($device)) {
                    $this->isMobile = true;
                }
            }
        }
    }


    /**
     * Overloads isAndroid() | isBlackberry() | isOpera() | isPalm() | isWindows() | isGeneric() through isDevice()
     *
     * @param string $name
     * @param array $arguments
     * @return bool
     */
    public function __call($name, $arguments) {
        $device = substr($name, 2);
        if ($name == "is" . ucfirst($device)) {
            return $this->isDevice($device);
        } else {
            trigger_error("Method $name not defined", E_USER_ERROR);
        }
    }


    /**
     * Returns true if any type of mobile device detected, including special ones
     * @return bool
     */
    public function isMobile() {
        return $this->isMobile;
    }


    protected function isDevice($device) {
        $var    = "is" . ucfirst($device);
        $return = $this->$var === null ? (bool) preg_match("/" . $this->devices[$device] . "/i", $this->userAgent) : $this->$var;

        if ($device != 'generic' && $return == true) {
            $this->isGeneric = false;
        }

        return $return;
    }
}
$detect = new mobile_detect();


function fsb($fsbme)
{
global $detect;

if($fsbme == 'name')
{
return 'FSBlog';
}
else if($fsbme == 'url')
{
return 'http://www.fsb.me';
}
else if($fsbme == 'description')
{
return 'Free CMS';
}
else if($fsbme == 'keywords')
{
return 'CMS GRatis,PHP,MYSQLi,FSodic.com,Fajar Sodik';
}
else if($fsbme == 'gmt')
{
return '8';
}
else if($fsbme == 'theme')
{
if($detect->isMobile())
{
return 'mobile';
}
else
{
return 'desktop';
}
}
else if($fsbme == 'post')
{
return '10';
}
else
{
return '';
}
}

function permalink($fsbme)
{
$link = preg_replace('#([\W]+)#', ' ', $fsbme);
$link = str_replace(' ', '-', trim($link));
$link = strtolower($link);
return $link;
}

if($fsodic->query("SELECT * FROM `user`")->num_rows > 0)
{
if(isset($_COOKIE['_fsb_']) && $fsodic->query("SELECT * FROM `user` WHERE `log_session` = '".mysqli_real_escape_string($fsodic,$_COOKIE['_fsb_'])."'")->num_rows == 1)
{
$userlog = $fsodic->query("SELECT * FROM `user` WHERE `log_session` = '".mysqli_real_escape_string($fsodic,$_COOKIE['_fsb_'])."'")->fetch_array();
$_SESSION['iduser'] = $userlog['iduser'];
}
else if(isset($_SESSION['iduser']))
{
session_destroy();
session_unset();
setcookie('_fsb_', '', time()-3600, '/', $_SERVER['HTTP_HOST']);
}
}

$limit_post = fsb('post');