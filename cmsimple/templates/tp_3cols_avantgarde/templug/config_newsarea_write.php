<?php 
@session_start();

if (!isset($_SESSION['sn']) || !$_POST)
{
    die('Access Denied');
}

if(!is_writeable('data/config_newsarea.php'))
{
	die('<p>The file</p><p style="font-family: courier new, monospace; font-weight: 700;">./templates/' . $_SESSION['tp_template'] . '/templug/data/config_newsarea.php</p><p>is not writeable, please check the writing permissions of the file.</p>');
}
else
{
$datei = fopen('data/config_newsarea.php', 'w+');
ftruncate($datei, 0);
$inhalt='<?php // utf-8 Marker: äöü 

if (preg_match(\'#templug/data/config_#i\', $_SERVER[\'SCRIPT_NAME\']))
{
	die(\'no direct access\');
}

$newsarea_background_color = "' . $_POST['newsarea_background_color'] . '";
$newsarea_background_image = "' . $_POST['newsarea_background_image'] . '";
$newsarea_background_repeat = "' . $_POST['newsarea_background_repeat'] . '";
$newsarea_background_position = "' . $_POST['newsarea_background_position'] . '";
$newsarea_border_color = "' . $_POST['newsarea_border_color'] . '";
$newsarea_border_width = "' . $_POST['newsarea_border_width'] . '";
$newsarea_border_style = "' . $_POST['newsarea_border_style'] . '";

$newsarea_margin_top = "' . $_POST['newsarea_margin_top'] . '";
$newsarea_margin_right = "' . $_POST['newsarea_margin_right'] . '";
$newsarea_margin_bottom = "' . $_POST['newsarea_margin_bottom'] . '";
$newsarea_margin_left = "' . $_POST['newsarea_margin_left'] . '";
$newsarea_padding_top = "' . $_POST['newsarea_padding_top'] . '";
$newsarea_padding_right = "' . $_POST['newsarea_padding_right'] . '";
$newsarea_padding_bottom = "' . $_POST['newsarea_padding_bottom'] . '";
$newsarea_padding_left = "' . $_POST['newsarea_padding_left'] . '";

$newsarea_font_family = "' . $_POST['newsarea_font_family'] . '";
$newsarea_font_size = "' . $_POST['newsarea_font_size'] . '";
$newsarea_line_height = "' . $_POST['newsarea_line_height'] . '";
$newsarea_font_color = "' . $_POST['newsarea_font_color'] . '";
$newsarea_headlines_color = "' . $_POST['newsarea_headlines_color'] . '";
$newsarea_headlines_font_family = "' . $_POST['newsarea_headlines_font_family'] . '";
$newsarea_alink_color = "' . $_POST['newsarea_alink_color'] . '";
$newsarea_vlink_color = "' . $_POST['newsarea_vlink_color'] . '";
$newsarea_hoverlink_color = "' . $_POST['newsarea_hoverlink_color'] . '";
$newsarea_h13_font_size = "' . $_POST['newsarea_h13_font_size'] . '";
$newsarea_h4_font_size = "' . $_POST['newsarea_h4_font_size'] . '";
$newsarea_h5_font_size = "' . $_POST['newsarea_h5_font_size'] . '";
$newsarea_h6_font_size = "' . $_POST['newsarea_h6_font_size'] . '";
?>';

fwrite($datei, $inhalt);
fclose($datei);
}

include('writecss.php');

?>