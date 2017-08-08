<?php 
@session_start();

if (!isset($_SESSION['sn']) || !$_POST)
{
    die('Access Denied');
}

if(!is_writeable('data/config_nav.php'))
{
	die('<p>The file</p><p style="font-family: courier new, monospace; font-weight: 700;">./templates/' . $_SESSION['tp_template'] . '/templug/data/config_nav.php</p><p>is not writeable, please check the writing permissions of the file.</p>');
}
else
{
$datei = fopen('data/config_nav.php', 'w+');
ftruncate($datei, 0);
$inhalt='<?php // utf-8 Marker: äöü 

if (preg_match(\'#templug/data/config_#i\', $_SERVER[\'SCRIPT_NAME\']))
{
	die(\'no direct access\');
}

$nav_background_color = "' . $_POST['nav_background_color'] . '";
$nav_background_image = "' . $_POST['nav_background_image'] . '";
$nav_background_repeat = "' . $_POST['nav_background_repeat'] . '";
$nav_background_position = "' . $_POST['nav_background_position'] . '";
$nav_border_color = "' . $_POST['nav_border_color'] . '";
$nav_border_width = "' . $_POST['nav_border_width'] . '";
$nav_border_style = "' . $_POST['nav_border_style'] . '";

$nav_margin_top = "' . $_POST['nav_margin_top'] . '";
$nav_margin_right = "' . $_POST['nav_margin_right'] . '";
$nav_margin_bottom = "' . $_POST['nav_margin_bottom'] . '";
$nav_margin_left = "' . $_POST['nav_margin_left'] . '";
$nav_padding_top = "' . $_POST['nav_padding_top'] . '";
$nav_padding_right = "' . $_POST['nav_padding_right'] . '";
$nav_padding_bottom = "' . $_POST['nav_padding_bottom'] . '";
$nav_padding_left = "' . $_POST['nav_padding_left'] . '";

$nav_font_family = "' . $_POST['nav_font_family'] . '";
$nav_font_size = "' . $_POST['nav_font_size'] . '";
$nav_line_height = "' . $_POST['nav_line_height'] . '";
$nav_font_color = "' . $_POST['nav_font_color'] . '";
$nav_headlines_color = "' . $_POST['nav_headlines_color'] . '";
$nav_headlines_font_family = "' . $_POST['nav_headlines_font_family'] . '";
$nav_alink_color = "' . $_POST['nav_alink_color'] . '";
$nav_vlink_color = "' . $_POST['nav_vlink_color'] . '";
$nav_hoverlink_color = "' . $_POST['nav_hoverlink_color'] . '";
$nav_h13_font_size = "' . $_POST['nav_h13_font_size'] . '";
$nav_h4_font_size = "' . $_POST['nav_h4_font_size'] . '";
$nav_h5_font_size = "' . $_POST['nav_h5_font_size'] . '";
$nav_h6_font_size = "' . $_POST['nav_h6_font_size'] . '";
?>';

fwrite($datei, $inhalt);
fclose($datei);
}
include('writecss.php');

?>