<?php 
@session_start();

if (!isset($_SESSION['sn']) || !$_POST)
{
    die('Access Denied');
}

if(!is_writeable('data/config_newsbox.php'))
{
	die('<p>The file</p><p style="font-family: courier new, monospace; font-weight: 700;">./templates/' . $_SESSION['tp_template'] . '/templug/data/config_newsbox.php</p><p>is not writeable, please check the writing permissions of the file.</p>');
}
else
{
$datei = fopen('data/config_newsbox.php', 'w+');
ftruncate($datei, 0);
$inhalt='<?php // utf-8 Marker: äöü 

if (preg_match(\'#templug/data/config_#i\', $_SERVER[\'SCRIPT_NAME\']))
{
	die(\'no direct access\');
}

$newsbox_background_color = "' . $_POST['newsbox_background_color'] . '";
$newsbox_background_image = "' . $_POST['newsbox_background_image'] . '";
$newsbox_background_repeat = "' . $_POST['newsbox_background_repeat'] . '";
$newsbox_background_position = "' . $_POST['newsbox_background_position'] . '";
$newsbox_border_color = "' . $_POST['newsbox_border_color'] . '";
$newsbox_border_width = "' . $_POST['newsbox_border_width'] . '";
$newsbox_border_style = "' . $_POST['newsbox_border_style'] . '";

$newsbox_margin_top = "' . $_POST['newsbox_margin_top'] . '";
$newsbox_margin_right = "' . $_POST['newsbox_margin_right'] . '";
$newsbox_margin_bottom = "' . $_POST['newsbox_margin_bottom'] . '";
$newsbox_margin_left = "' . $_POST['newsbox_margin_left'] . '";
$newsbox_padding_top = "' . $_POST['newsbox_padding_top'] . '";
$newsbox_padding_right = "' . $_POST['newsbox_padding_right'] . '";
$newsbox_padding_bottom = "' . $_POST['newsbox_padding_bottom'] . '";
$newsbox_padding_left = "' . $_POST['newsbox_padding_left'] . '";

$newsbox_font_family = "' . $_POST['newsbox_font_family'] . '";
$newsbox_font_size = "' . $_POST['newsbox_font_size'] . '";
$newsbox_line_height = "' . $_POST['newsbox_line_height'] . '";
$newsbox_font_color = "' . $_POST['newsbox_font_color'] . '";
$newsbox_headlines_color = "' . $_POST['newsbox_headlines_color'] . '";
$newsbox_headlines_font_family = "' . $_POST['newsbox_headlines_font_family'] . '";
$newsbox_alink_color = "' . $_POST['newsbox_alink_color'] . '";
$newsbox_vlink_color = "' . $_POST['newsbox_vlink_color'] . '";
$newsbox_hoverlink_color = "' . $_POST['newsbox_hoverlink_color'] . '";
$newsbox_h13_font_size = "' . $_POST['newsbox_h13_font_size'] . '";
$newsbox_h4_font_size = "' . $_POST['newsbox_h4_font_size'] . '";
$newsbox_h5_font_size = "' . $_POST['newsbox_h5_font_size'] . '";
$newsbox_h6_font_size = "' . $_POST['newsbox_h6_font_size'] . '";
?>';

fwrite($datei, $inhalt);
fclose($datei);
}

include('writecss.php');

?>