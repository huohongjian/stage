<?php 
@session_start();

if (!isset($_SESSION['sn']) || !$_POST)
{
    die('Access Denied');
}

if(!is_writeable('data/config_center.php'))
{
	die('<p>The file</p><p style="font-family: courier new, monospace; font-weight: 700;">./templates/' . $_SESSION['tp_template'] . '/templug/data/config_center.php</p><p>is not writeable, please check the writing permissions of the file.</p>');
}
else
{
$datei = fopen('data/config_center.php', 'w+');
ftruncate($datei, 0);
$inhalt='<?php // utf-8 Marker: äöü 

if (preg_match(\'#templug/data/config_#i\', $_SERVER[\'SCRIPT_NAME\']))
{
	die(\'no direct access\');
}

$center_background_color = "' . $_POST['center_background_color'] . '";
$center_background_image = "' . $_POST['center_background_image'] . '";
$center_background_repeat = "' . $_POST['center_background_repeat'] . '";
$center_background_position = "' . $_POST['center_background_position'] . '";
$center_background_attachment = "' . $_POST['center_background_attachment'] . '";
?>';

fwrite($datei, $inhalt);
fclose($datei);
}

include('writecss.php');

?>