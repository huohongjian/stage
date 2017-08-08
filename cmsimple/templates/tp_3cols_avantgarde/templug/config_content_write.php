<?php 
@session_start();

if (!isset($_SESSION['sn']) || !$_POST)
{
    die('Access Denied');
}

if(!is_writeable('data/config_content.php'))
{
	die('<p>The file</p><p style="font-family: courier new, monospace; font-weight: 700;">./templates/' . $_SESSION['tp_template'] . '/templug/data/config_content.php</p><p>is not writeable, please check the writing permissions of the file.</p>');
}
else
{
$datei = fopen('data/config_content.php', 'w+');
ftruncate($datei, 0);
$inhalt='<?php // utf-8 Marker: äöü 

if (preg_match(\'#templug/data/config_#i\', $_SERVER[\'SCRIPT_NAME\']))
{
	die(\'no direct access\');
}

$content_background_color = "' . $_POST['content_background_color'] . '";
$content_background_image = "' . $_POST['content_background_image'] . '";
$content_background_repeat = "' . $_POST['content_background_repeat'] . '";
$content_background_position = "' . $_POST['content_background_position'] . '";
$content_border_color = "' . $_POST['content_border_color'] . '";
$content_border_width = "' . $_POST['content_border_width'] . '";
$content_border_style = "' . $_POST['content_border_style'] . '";

$content_margin_top = "' . $_POST['content_margin_top'] . '";
$content_margin_right = "' . $_POST['content_margin_right'] . '";
$content_margin_bottom = "' . $_POST['content_margin_bottom'] . '";
$content_margin_left = "' . $_POST['content_margin_left'] . '";
$content_padding_top = "' . $_POST['content_padding_top'] . '";
$content_padding_right = "' . $_POST['content_padding_right'] . '";
$content_padding_bottom = "' . $_POST['content_padding_bottom'] . '";
$content_padding_left = "' . $_POST['content_padding_left'] . '";

$content_font_family = "' . $_POST['content_font_family'] . '";
$content_font_size = "' . $_POST['content_font_size'] . '";
$content_line_height = "' . $_POST['content_line_height'] . '";
$content_font_color = "' . $_POST['content_font_color'] . '";
$content_headlines_color = "' . $_POST['content_headlines_color'] . '";
$content_headlines_font_family = "' . $_POST['content_headlines_font_family'] . '";
$content_alink_color = "' . $_POST['content_alink_color'] . '";
$content_vlink_color = "' . $_POST['content_vlink_color'] . '";
$content_hoverlink_color = "' . $_POST['content_hoverlink_color'] . '";
$content_h13_font_size = "' . $_POST['content_h13_font_size'] . '";
$content_h4_font_size = "' . $_POST['content_h4_font_size'] . '";
$content_h5_font_size = "' . $_POST['content_h5_font_size'] . '";
$content_h6_font_size = "' . $_POST['content_h6_font_size'] . '";
?>';

fwrite($datei, $inhalt);
fclose($datei);
}

include('writecss.php');

?>