<?php

if (!defined('CMSIMPLE_VERSION') || preg_match('#/filebrowser/index.php#i',$_SERVER['SCRIPT_NAME'])) 
{
    die('no direct access');
}

/* utf-8 marker: äöü */
if(!$adm) {return true;}

if(!isset($_SESSION)){session_start();}
 

$temp = trim($sn, "/") . '/';
$xh_fb = new XHFileBrowser();
$xh_fb->setBrowseBase(CMSIMPLE_BASE);
$xh_fb->setBrowserPath($pth['folder']['plugins'] . 'filebrowser/');
$xh_fb->setMaxFileSize('images', $cf['images']['maxsize']);
$xh_fb->setMaxFileSize('downloads', $cf['downloads']['maxsize']);


$_SESSION['fb_browser'] = $xh_fb;
$_SESSION['fb_session'] = session_id();
$_SESSION['fb_sn'] = $sn;
$_SESSION['fb_sl'] = $sl;

?>