<?php 
@session_start();

if (!isset($_SESSION['sn']) || !$_POST)
{
    die('Access Denied');
}

if(!is_writeable('data/config_header.php'))
{
	die('<p>The file</p><p style="font-family: courier new, monospace; font-weight: 700;">./templates/' . $_SESSION['tp_template'] . '/templug/data/config_header.php</p><p>is not writeable, please check the writing permissions of the file.</p>');
}
else
{
$datei = fopen('data/config_header.php', 'w+');
ftruncate($datei, 0);
$inhalt='<?php // utf-8 Marker: äöü 

if (preg_match(\'#templug/data/config_#i\', $_SERVER[\'SCRIPT_NAME\']))
{
	die(\'no direct access\');
}

$header_background_color = "' . $_POST['header_background_color'] . '";
$header_background_image = "' . $_POST['header_background_image'] . '";
$header_background_repeat = "' . $_POST['header_background_repeat'] . '";
$header_background_position = "' . $_POST['header_background_position'] . '";
$header_border_color = "' . $_POST['header_border_color'] . '";
$header_border_width = "' . $_POST['header_border_width'] . '";
$header_border_style = "' . $_POST['header_border_style'] . '";
$header_margin_top = "' . $_POST['header_margin_top'] . '";
$header_margin_right = "' . $_POST['header_margin_right'] . '";
$header_margin_bottom = "' . $_POST['header_margin_bottom'] . '";
$header_margin_left = "' . $_POST['header_margin_left'] . '";
$header_padding_top = "' . $_POST['header_padding_top'] . '";
$header_padding_right = "' . $_POST['header_padding_right'] . '";
$header_padding_bottom = "' . $_POST['header_padding_bottom'] . '";
$header_padding_left = "' . $_POST['header_padding_left'] . '";
$header_font_family = "' . $_POST['header_font_family'] . '";
$header_font_size = "' . $_POST['header_font_size'] . '";
$header_line_height = "' . $_POST['header_line_height'] . '";
$header_font_color = "' . $_POST['header_font_color'] . '";
$header_headlines_color = "' . $_POST['header_headlines_color'] . '";
$header_headlines_font_family = "' . $_POST['header_headlines_font_family'] . '";
$header_alink_color = "' . $_POST['header_alink_color'] . '";
$header_vlink_color = "' . $_POST['header_vlink_color'] . '";
$header_hoverlink_color = "' . $_POST['header_hoverlink_color'] . '";
$header_h13_font_size = "' . $_POST['header_h13_font_size'] . '";
$header_h4_font_size = "' . $_POST['header_h4_font_size'] . '";
$header_h5_font_size = "' . $_POST['header_h5_font_size'] . '";
$header_h6_font_size = "' . $_POST['header_h6_font_size'] . '";
?>';

fwrite($datei, $inhalt);
fclose($datei);
}

include('writecss.php');

?>