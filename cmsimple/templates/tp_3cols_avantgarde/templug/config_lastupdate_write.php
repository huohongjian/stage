<?php 
@session_start();

if (!isset($_SESSION['sn']) || !$_POST)
{
    die('Access Denied');
}

if(!is_writeable('data/config_lastupdate.php'))
{
	die('<p>The file</p><p style="font-family: courier new, monospace; font-weight: 700;">./templates/' . $_SESSION['tp_template'] . '/templug/data/config_lastupdate.php</p><p>is not writeable, please check the writing permissions of the file.</p>');
}
else
{
$datei = fopen('data/config_lastupdate.php', 'w+');
ftruncate($datei, 0);
$inhalt='<?php // utf-8 Marker: äöü 

if (preg_match(\'#templug/data/config_#i\', $_SERVER[\'SCRIPT_NAME\']))
{
	die(\'no direct access\');
}

$lastupdate_background_color = "' . $_POST['lastupdate_background_color'] . '";
$lastupdate_background_image = "' . $_POST['lastupdate_background_image'] . '";
$lastupdate_background_repeat = "' . $_POST['lastupdate_background_repeat'] . '";
$lastupdate_background_position = "' . $_POST['lastupdate_background_position'] . '";
$lastupdate_border_color = "' . $_POST['lastupdate_border_color'] . '";
$lastupdate_border_width = "' . $_POST['lastupdate_border_width'] . '";
$lastupdate_border_style = "' . $_POST['lastupdate_border_style'] . '";

$lastupdate_margin_top = "' . $_POST['lastupdate_margin_top'] . '";
$lastupdate_margin_right = "' . $_POST['lastupdate_margin_right'] . '";
$lastupdate_margin_bottom = "' . $_POST['lastupdate_margin_bottom'] . '";
$lastupdate_margin_left = "' . $_POST['lastupdate_margin_left'] . '";
$lastupdate_padding_top = "' . $_POST['lastupdate_padding_top'] . '";
$lastupdate_padding_right = "' . $_POST['lastupdate_padding_right'] . '";
$lastupdate_padding_bottom = "' . $_POST['lastupdate_padding_bottom'] . '";
$lastupdate_padding_left = "' . $_POST['lastupdate_padding_left'] . '";

$lastupdate_font_family = "' . $_POST['lastupdate_font_family'] . '";
$lastupdate_font_size = "' . $_POST['lastupdate_font_size'] . '";
$lastupdate_line_height = "' . $_POST['lastupdate_line_height'] . '";
$lastupdate_font_color = "' . $_POST['lastupdate_font_color'] . '";
$lastupdate_headlines_color = "' . $_POST['lastupdate_headlines_color'] . '";
$lastupdate_headlines_font_family = "' . $_POST['lastupdate_headlines_font_family'] . '";
$lastupdate_alink_color = "' . $_POST['lastupdate_alink_color'] . '";
$lastupdate_vlink_color = "' . $_POST['lastupdate_vlink_color'] . '";
$lastupdate_hoverlink_color = "' . $_POST['lastupdate_hoverlink_color'] . '";
$lastupdate_h13_font_size = "' . $_POST['lastupdate_h13_font_size'] . '";
$lastupdate_h4_font_size = "' . $_POST['lastupdate_h4_font_size'] . '";
$lastupdate_h5_font_size = "' . $_POST['lastupdate_h5_font_size'] . '";
$lastupdate_h6_font_size = "' . $_POST['lastupdate_h6_font_size'] . '";
?>';

fwrite($datei, $inhalt);
fclose($datei);
}

include('writecss.php');

?>