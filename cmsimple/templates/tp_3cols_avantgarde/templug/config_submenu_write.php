<?php 
@session_start();

if (!isset($_SESSION['sn']) || !$_POST)
{
    die('Access Denied');
}

if(!is_writeable('data/config_submenu.php'))
{
	die('<p>The file</p><p style="font-family: courier new, monospace; font-weight: 700;">./templates/' . $_SESSION['tp_template'] . '/templug/data/config_submenu.php</p><p>is not writeable, please check the writing permissions of the file.</p>');
}
else
{
$datei = fopen('data/config_submenu.php', 'w+');
ftruncate($datei, 0);
$inhalt='<?php // utf-8 Marker: äöü 

if (preg_match(\'#templug/data/config_#i\', $_SERVER[\'SCRIPT_NAME\']))
{
	die(\'no direct access\');
}

$submenu_background_color = "' . $_POST['submenu_background_color'] . '";
$submenu_background_image = "' . $_POST['submenu_background_image'] . '";
$submenu_background_repeat = "' . $_POST['submenu_background_repeat'] . '";
$submenu_background_position = "' . $_POST['submenu_background_position'] . '";
$submenu_border_color = "' . $_POST['submenu_border_color'] . '";
$submenu_border_width = "' . $_POST['submenu_border_width'] . '";
$submenu_border_style = "' . $_POST['submenu_border_style'] . '";

$submenu_margin_top = "' . $_POST['submenu_margin_top'] . '";
$submenu_margin_right = "' . $_POST['submenu_margin_right'] . '";
$submenu_margin_bottom = "' . $_POST['submenu_margin_bottom'] . '";
$submenu_margin_left = "' . $_POST['submenu_margin_left'] . '";
$submenu_padding_top = "' . $_POST['submenu_padding_top'] . '";
$submenu_padding_right = "' . $_POST['submenu_padding_right'] . '";
$submenu_padding_bottom = "' . $_POST['submenu_padding_bottom'] . '";
$submenu_padding_left = "' . $_POST['submenu_padding_left'] . '";

$submenu_font_family = "' . $_POST['submenu_font_family'] . '";
$submenu_font_size = "' . $_POST['submenu_font_size'] . '";
$submenu_line_height = "' . $_POST['submenu_line_height'] . '";
$submenu_font_color = "' . $_POST['submenu_font_color'] . '";
$submenu_headlines_color = "' . $_POST['submenu_headlines_color'] . '";
$submenu_headlines_font_family = "' . $_POST['submenu_headlines_font_family'] . '";
$submenu_alink_color = "' . $_POST['submenu_alink_color'] . '";
$submenu_vlink_color = "' . $_POST['submenu_vlink_color'] . '";
$submenu_hoverlink_color = "' . $_POST['submenu_hoverlink_color'] . '";
$submenu_h13_font_size = "' . $_POST['submenu_h13_font_size'] . '";
$submenu_h4_font_size = "' . $_POST['submenu_h4_font_size'] . '";
$submenu_h5_font_size = "' . $_POST['submenu_h5_font_size'] . '";
$submenu_h6_font_size = "' . $_POST['submenu_h6_font_size'] . '";
?>';

fwrite($datei, $inhalt);
fclose($datei);
}

include('writecss.php');

?>