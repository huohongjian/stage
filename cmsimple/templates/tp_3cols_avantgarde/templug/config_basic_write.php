<?php 
@session_start();

if (!isset($_SESSION['sn']) || !$_POST)
{
    die('Access Denied');
}

if(!is_writeable('data/config_basic.php'))
{
	die('<p>The file</p><p style="font-family: courier new, monospace; font-weight: 700;">./templates/' . $_SESSION['tp_template'] . '/templug/data/config_basic.php</p><p>is not writeable, please check the writing permissions of the file.</p>');
}
else
{
$datei = fopen('data/config_basic.php', 'w+');
ftruncate($datei, 0);
$inhalt='<?php // utf-8 Marker: äöü 

if (preg_match(\'#templug/data/config_#i\', $_SERVER[\'SCRIPT_NAME\']))
{
	die(\'no direct access\');
}

$basic_show_site_title = "' . $_POST['basic_show_site_title'] . '";
$basic_show_locator = "' . $_POST['basic_show_locator'] . '";
$basic_show_search = "' . $_POST['basic_show_search'] . '";
$basic_show_printlink = "' . $_POST['basic_show_printlink'] . '";
$basic_show_sitemaplink = "' . $_POST['basic_show_sitemaplink'] . '";
$basic_show_subnav = "' . $_POST['basic_show_subnav'] . '";
$basic_show_lastupdate = "' . $_POST['basic_show_lastupdate'] . '";
$basic_show_submenu = "' . $_POST['basic_show_submenu'] . '";
$basic_show_pagenav = "' . $_POST['basic_show_pagenav'] . '";
$basic_show_newsbox01 = "' . $_POST['basic_show_newsbox01'] . '";
$basic_show_newsbox02 = "' . $_POST['basic_show_newsbox02'] . '";
$basic_show_newsbox03 = "' . $_POST['basic_show_newsbox03'] . '";
$basic_show_login = "' . $_POST['basic_show_login'] . '";
?>';

fwrite($datei, $inhalt);
fclose($datei);
header('Location: ' . $_SESSION['sn'] . '?&templug&admin=plugin_main&action=plugin_text');
}
?>