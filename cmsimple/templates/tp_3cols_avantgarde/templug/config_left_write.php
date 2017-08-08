<?php 
@session_start();

if (!isset($_SESSION['sn']) || !$_POST)
{
    die('Access Denied');
}

if(!is_writeable('data/config_left.php'))
{
	die('<p>The file</p><p style="font-family: courier new, monospace; font-weight: 700;">./templates/' . $_SESSION['tp_template'] . '/templug/data/config_left.php</p><p>is not writeable, please check the writing permissions of the file.</p>');
}
else
{
$datei = fopen('data/config_left.php', 'w+');
ftruncate($datei, 0);
$inhalt='<?php // utf-8 Marker: äöü 

if (preg_match(\'#templug/data/config_#i\', $_SERVER[\'SCRIPT_NAME\']))
{
	die(\'no direct access\');
}

$left_background_color = "' . $_POST['left_background_color'] . '";
$left_background_image = "' . $_POST['left_background_image'] . '";
$left_background_repeat = "' . $_POST['left_background_repeat'] . '";
$left_background_position = "' . $_POST['left_background_position'] . '";
$left_background_attachment = "' . $_POST['left_background_attachment'] . '";
?>';

fwrite($datei, $inhalt);
fclose($datei);
}

include('writecss.php');

?>