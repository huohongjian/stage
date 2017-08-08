<?php 
@session_start();

if (!isset($_SESSION['sn']) || !$_POST)
{
    die('Access Denied');
}

if(!is_writeable('data/config_subnav.php'))
{
	die('<p>The file</p><p style="font-family: courier new, monospace; font-weight: 700;">./templates/' . $_SESSION['tp_template'] . '/templug/data/config_subnav.php</p><p>is not writeable, please check the writing permissions of the file.</p>');
}
else
{
$datei = fopen('data/config_subnav.php', 'w+');
ftruncate($datei, 0);
$inhalt='<?php // utf-8 Marker: äöü 

if (preg_match(\'#templug/data/config_#i\', $_SERVER[\'SCRIPT_NAME\']))
{
	die(\'no direct access\');
}

$subnav_elements_level = "' . $_POST['subnav_elements_level'] . '";
$subnav_background_color = "' . $_POST['subnav_background_color'] . '";
$subnav_background_image = "' . $_POST['subnav_background_image'] . '";
$subnav_background_repeat = "' . $_POST['subnav_background_repeat'] . '";
$subnav_background_position = "' . $_POST['subnav_background_position'] . '";
$subnav_border_color = "' . $_POST['subnav_border_color'] . '";
$subnav_border_width = "' . $_POST['subnav_border_width'] . '";
$subnav_border_style = "' . $_POST['subnav_border_style'] . '";

$subnav_margin_top = "' . $_POST['subnav_margin_top'] . '";
$subnav_margin_right = "' . $_POST['subnav_margin_right'] . '";
$subnav_margin_bottom = "' . $_POST['subnav_margin_bottom'] . '";
$subnav_margin_left = "' . $_POST['subnav_margin_left'] . '";
$subnav_padding_top = "' . $_POST['subnav_padding_top'] . '";
$subnav_padding_right = "' . $_POST['subnav_padding_right'] . '";
$subnav_padding_bottom = "' . $_POST['subnav_padding_bottom'] . '";
$subnav_padding_left = "' . $_POST['subnav_padding_left'] . '";

$subnav_font_family = "' . $_POST['subnav_font_family'] . '";
$subnav_font_size = "' . $_POST['subnav_font_size'] . '";
$subnav_line_height = "' . $_POST['subnav_line_height'] . '";
$subnav_font_color = "' . $_POST['subnav_font_color'] . '";
$subnav_headlines_color = "' . $_POST['subnav_headlines_color'] . '";
$subnav_headlines_font_family = "' . $_POST['subnav_headlines_font_family'] . '";
$subnav_alink_color = "' . $_POST['subnav_alink_color'] . '";
$subnav_vlink_color = "' . $_POST['subnav_vlink_color'] . '";
$subnav_hoverlink_color = "' . $_POST['subnav_hoverlink_color'] . '";
$subnav_h13_font_size = "' . $_POST['subnav_h13_font_size'] . '";
$subnav_h4_font_size = "' . $_POST['subnav_h4_font_size'] . '";
$subnav_h5_font_size = "' . $_POST['subnav_h5_font_size'] . '";
$subnav_h6_font_size = "' . $_POST['subnav_h6_font_size'] . '";
?>';

fwrite($datei, $inhalt);
fclose($datei);
}

include('writecss.php');

?>