<?php 
@session_start();

if (!isset($_SESSION['sn']) || !$_POST)
{
    die('Access Denied');
}

if(!is_writeable('data/config_main.php'))
{
	die('<p>The file</p><p style="font-family: courier new, monospace; font-weight: 700;">./templates/' . $_SESSION['tp_template'] . '/templug/data/config_main.php</p><p>is not writeable, please check the writing permissions of the file.</p>');
}
else
{
$datei = fopen('data/config_main.php', 'w+');
ftruncate($datei, 0);
$inhalt='<?php // utf-8 Marker: äöü 

if (preg_match(\'#templug/data/config_#i\', $_SERVER[\'SCRIPT_NAME\']))
{
	die(\'no direct access\');
}

$main_width = "' . $_POST['main_width'] . '";
$main_background_color = "' . $_POST['main_background_color'] . '";
$main_background_image = "' . $_POST['main_background_image'] . '";
$main_background_repeat = "' . $_POST['main_background_repeat'] . '";
$main_background_position = "' . $_POST['main_background_position'] . '";
$main_border_color = "' . $_POST['main_border_color'] . '";
$main_border_width = "' . $_POST['main_border_width'] . '";
$main_border_style = "' . $_POST['main_border_style'] . '";
$main_margin_top = "' . $_POST['main_margin_top'] . '";
$main_margin_right = "' . $_POST['main_margin_right'] . '";
$main_margin_bottom = "' . $_POST['main_margin_bottom'] . '";
$main_margin_left = "' . $_POST['main_margin_left'] . '";
$main_padding_top = "' . $_POST['main_padding_top'] . '";
$main_padding_right = "' . $_POST['main_padding_right'] . '";
$main_padding_bottom = "' . $_POST['main_padding_bottom'] . '";
$main_padding_left = "' . $_POST['main_padding_left'] . '";
?>';

fwrite($datei, $inhalt);
fclose($datei);
}

include('writecss.php');

?>