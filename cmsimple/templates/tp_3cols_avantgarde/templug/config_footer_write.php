<?php 
@session_start();

if (!isset($_SESSION['sn']) || !$_POST)
{
    die('Access Denied');
}

if(!is_writeable('data/config_footer.php'))
{
	die('<p>The file</p><p style="font-family: courier new, monospace; font-weight: 700;">./templates/' . $_SESSION['tp_template'] . '/templug/data/config_footer.php</p><p>is not writeable, please check the writing permissions of the file.</p>');
}
else
{
$datei = fopen('data/config_footer.php', 'w+');
ftruncate($datei, 0);
$inhalt='<?php // utf-8 Marker: äöü 

if (preg_match(\'#templug/data/config_#i\', $_SERVER[\'SCRIPT_NAME\']))
{
	die(\'no direct access\');
}

$footer_background_color = "' . $_POST['footer_background_color'] . '";
$footer_background_image = "' . $_POST['footer_background_image'] . '";
$footer_background_repeat = "' . $_POST['footer_background_repeat'] . '";
$footer_background_position = "' . $_POST['footer_background_position'] . '";
$footer_border_color = "' . $_POST['footer_border_color'] . '";
$footer_border_width = "' . $_POST['footer_border_width'] . '";
$footer_border_style = "' . $_POST['footer_border_style'] . '";
$footer_margin_top = "' . $_POST['footer_margin_top'] . '";
$footer_margin_right = "' . $_POST['footer_margin_right'] . '";
$footer_margin_bottom = "' . $_POST['footer_margin_bottom'] . '";
$footer_margin_left = "' . $_POST['footer_margin_left'] . '";
$footer_padding_top = "' . $_POST['footer_padding_top'] . '";
$footer_padding_right = "' . $_POST['footer_padding_right'] . '";
$footer_padding_bottom = "' . $_POST['footer_padding_bottom'] . '";
$footer_padding_left = "' . $_POST['footer_padding_left'] . '";
$footer_font_family = "' . $_POST['footer_font_family'] . '";
$footer_font_size = "' . $_POST['footer_font_size'] . '";
$footer_line_height = "' . $_POST['footer_line_height'] . '";
$footer_font_color = "' . $_POST['footer_font_color'] . '";
$footer_text_align = "' . $_POST['footer_text_align'] . '";
$footer_headlines_color = "' . $_POST['footer_headlines_color'] . '";
$footer_headlines_font_family = "' . $_POST['footer_headlines_font_family'] . '";
$footer_alink_color = "' . $_POST['footer_alink_color'] . '";
$footer_vlink_color = "' . $_POST['footer_vlink_color'] . '";
$footer_hoverlink_color = "' . $_POST['footer_hoverlink_color'] . '";
$footer_h13_font_size = "' . $_POST['footer_h13_font_size'] . '";
$footer_h4_font_size = "' . $_POST['footer_h4_font_size'] . '";
$footer_h5_font_size = "' . $_POST['footer_h5_font_size'] . '";
$footer_h6_font_size = "' . $_POST['footer_h6_font_size'] . '";
?>';

fwrite($datei, $inhalt);
fclose($datei);
}

include('writecss.php');

?>