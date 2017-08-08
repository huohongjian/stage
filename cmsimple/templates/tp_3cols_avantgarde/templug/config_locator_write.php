<?php 
@session_start();

if (!isset($_SESSION['sn']) || !$_POST)
{
    die('Access Denied');
}

if(!is_writeable('data/config_locator.php'))
{
	die('<p>The file</p><p style="font-family: courier new, monospace; font-weight: 700;">./templates/' . $_SESSION['tp_template'] . '/templug/data/config_locator.php</p><p>is not writeable, please check the writing permissions of the file.</p>');
}
else
{
$datei = fopen('data/config_locator.php', 'w+');
ftruncate($datei, 0);
$inhalt='<?php // utf-8 Marker: äöü 

if (preg_match(\'#templug/data/config_#i\', $_SERVER[\'SCRIPT_NAME\']))
{
	die(\'no direct access\');
}

$locator_background_color = "' . $_POST['locator_background_color'] . '";
$locator_background_image = "' . $_POST['locator_background_image'] . '";
$locator_background_repeat = "' . $_POST['locator_background_repeat'] . '";
$locator_background_position = "' . $_POST['locator_background_position'] . '";
$locator_border_color = "' . $_POST['locator_border_color'] . '";
$locator_border_width = "' . $_POST['locator_border_width'] . '";
$locator_border_style = "' . $_POST['locator_border_style'] . '";
$locator_margin_top = "' . $_POST['locator_margin_top'] . '";
$locator_margin_right = "' . $_POST['locator_margin_right'] . '";
$locator_margin_bottom = "' . $_POST['locator_margin_bottom'] . '";
$locator_margin_left = "' . $_POST['locator_margin_left'] . '";
$locator_padding_top = "' . $_POST['locator_padding_top'] . '";
$locator_padding_right = "' . $_POST['locator_padding_right'] . '";
$locator_padding_bottom = "' . $_POST['locator_padding_bottom'] . '";
$locator_padding_left = "' . $_POST['locator_padding_left'] . '";
$locator_font_family = "' . $_POST['locator_font_family'] . '";
$locator_font_size = "' . $_POST['locator_font_size'] . '";
$locator_line_height = "' . $_POST['locator_line_height'] . '";
$locator_font_color = "' . $_POST['locator_font_color'] . '";
$locator_alink_color = "' . $_POST['locator_alink_color'] . '";
$locator_vlink_color = "' . $_POST['locator_vlink_color'] . '";
$locator_hoverlink_color = "' . $_POST['locator_hoverlink_color'] . '";
?>';

fwrite($datei, $inhalt);
fclose($datei);
}

include('writecss.php');

?>