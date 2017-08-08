<?php 
@session_start();

if (!isset($_SESSION['sn']) || !$_POST)
{
    die('Access Denied');
}

if(!is_writeable('data/config_pagenav.php'))
{
	die('<p>The file</p><p style="font-family: courier new, monospace; font-weight: 700;">./templates/' . $_SESSION['tp_template'] . '/templug/data/config_pagenav.php</p><p>is not writeable, please check the writing permissions of the file.</p>');
}
else
{
$datei = fopen('data/config_pagenav.php', 'w+');
ftruncate($datei, 0);
$inhalt='<?php // utf-8 Marker: äöü 

if (preg_match(\'#templug/data/config_#i\', $_SERVER[\'SCRIPT_NAME\']))
{
	die(\'no direct access\');
}

$pagenav_background_color = "' . $_POST['pagenav_background_color'] . '";
$pagenav_background_image = "' . $_POST['pagenav_background_image'] . '";
$pagenav_background_repeat = "' . $_POST['pagenav_background_repeat'] . '";
$pagenav_background_position = "' . $_POST['pagenav_background_position'] . '";
$pagenav_border_color = "' . $_POST['pagenav_border_color'] . '";
$pagenav_border_width = "' . $_POST['pagenav_border_width'] . '";
$pagenav_border_style = "' . $_POST['pagenav_border_style'] . '";

$pagenav_margin_top = "' . $_POST['pagenav_margin_top'] . '";
$pagenav_margin_right = "' . $_POST['pagenav_margin_right'] . '";
$pagenav_margin_bottom = "' . $_POST['pagenav_margin_bottom'] . '";
$pagenav_margin_left = "' . $_POST['pagenav_margin_left'] . '";
$pagenav_padding_top = "' . $_POST['pagenav_padding_top'] . '";
$pagenav_padding_right = "' . $_POST['pagenav_padding_right'] . '";
$pagenav_padding_bottom = "' . $_POST['pagenav_padding_bottom'] . '";
$pagenav_padding_left = "' . $_POST['pagenav_padding_left'] . '";

$pagenav_font_family = "' . $_POST['pagenav_font_family'] . '";
$pagenav_font_size = "' . $_POST['pagenav_font_size'] . '";
$pagenav_line_height = "' . $_POST['pagenav_line_height'] . '";
$pagenav_font_color = "' . $_POST['pagenav_font_color'] . '";
$pagenav_text_align = "' . $_POST['pagenav_text_align'] . '";
$pagenav_headlines_color = "' . $_POST['pagenav_headlines_color'] . '";
$pagenav_headlines_font_family = "' . $_POST['pagenav_headlines_font_family'] . '";
$pagenav_alink_color = "' . $_POST['pagenav_alink_color'] . '";
$pagenav_vlink_color = "' . $_POST['pagenav_vlink_color'] . '";
$pagenav_hoverlink_color = "' . $_POST['pagenav_hoverlink_color'] . '";
$pagenav_h13_font_size = "' . $_POST['pagenav_h13_font_size'] . '";
$pagenav_h4_font_size = "' . $_POST['pagenav_h4_font_size'] . '";
$pagenav_h5_font_size = "' . $_POST['pagenav_h5_font_size'] . '";
$pagenav_h6_font_size = "' . $_POST['pagenav_h6_font_size'] . '";
?>';

fwrite($datei, $inhalt);
fclose($datei);
}

include('writecss.php');

?>