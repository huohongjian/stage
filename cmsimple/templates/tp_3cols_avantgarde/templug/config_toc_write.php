<?php 
@session_start();

if (!isset($_SESSION['sn']) || !$_POST)
{
    die('Access Denied');
}

if(!is_writeable('data/config_toc.php'))
{
	die('<p>The file</p><p style="font-family: courier new, monospace; font-weight: 700;">./templates/' . $_SESSION['tp_template'] . '/templug/data/config_toc.php</p><p>is not writeable, please check the writing permissions of the file.</p>');
}
else
{
$datei = fopen('data/config_toc.php', 'w+');
ftruncate($datei, 0);
$inhalt='<?php // utf-8 Marker: äöü 

if (preg_match(\'#templug/data/config_#i\', $_SERVER[\'SCRIPT_NAME\']))
{
	die(\'no direct access\');
}

$toc_elements_level = "' . $_POST['toc_elements_level'] . '";
$toc_background_color = "' . $_POST['toc_background_color'] . '";
$toc_background_image = "' . $_POST['toc_background_image'] . '";
$toc_background_repeat = "' . $_POST['toc_background_repeat'] . '";
$toc_background_position = "' . $_POST['toc_background_position'] . '";
$toc_border_color = "' . $_POST['toc_border_color'] . '";
$toc_border_width = "' . $_POST['toc_border_width'] . '";
$toc_border_style = "' . $_POST['toc_border_style'] . '";

$toc_margin_top = "' . $_POST['toc_margin_top'] . '";
$toc_margin_right = "' . $_POST['toc_margin_right'] . '";
$toc_margin_bottom = "' . $_POST['toc_margin_bottom'] . '";
$toc_margin_left = "' . $_POST['toc_margin_left'] . '";
$toc_padding_top = "' . $_POST['toc_padding_top'] . '";
$toc_padding_right = "' . $_POST['toc_padding_right'] . '";
$toc_padding_bottom = "' . $_POST['toc_padding_bottom'] . '";
$toc_padding_left = "' . $_POST['toc_padding_left'] . '";

$toc_font_family = "' . $_POST['toc_font_family'] . '";
$toc_font_size = "' . $_POST['toc_font_size'] . '";
$toc_line_height = "' . $_POST['toc_line_height'] . '";
$toc_font_color = "' . $_POST['toc_font_color'] . '";
$toc_headlines_color = "' . $_POST['toc_headlines_color'] . '";
$toc_headlines_font_family = "' . $_POST['toc_headlines_font_family'] . '";
$toc_alink_color = "' . $_POST['toc_alink_color'] . '";
$toc_vlink_color = "' . $_POST['toc_vlink_color'] . '";
$toc_hoverlink_color = "' . $_POST['toc_hoverlink_color'] . '";
$toc_h13_font_size = "' . $_POST['toc_h13_font_size'] . '";
$toc_h4_font_size = "' . $_POST['toc_h4_font_size'] . '";
$toc_h5_font_size = "' . $_POST['toc_h5_font_size'] . '";
$toc_h6_font_size = "' . $_POST['toc_h6_font_size'] . '";
$toc_ml1_border_width = "' . $_POST['toc_ml1_border_width'] . '";
$toc_ml1_border_color = "' . $_POST['toc_ml1_border_color'] . '";
$toc_ml1_background_color = "' . $_POST['toc_ml1_background_color'] . '";
$toc_ml1_font_size = "' . $_POST['toc_ml1_font_size'] . '";
$toc_ml1_font_weight = "' . $_POST['toc_ml1_font_weight'] . '";
$toc_ml1_textalign = "' . $_POST['toc_ml1_textalign'] . '";
$toc_ml2_font_size = "' . $_POST['toc_ml2_font_size'] . '";
$toc_ml3_font_size = "' . $_POST['toc_ml3_font_size'] . '";
?>';

fwrite($datei, $inhalt);
fclose($datei);
}

include('writecss.php');

?>