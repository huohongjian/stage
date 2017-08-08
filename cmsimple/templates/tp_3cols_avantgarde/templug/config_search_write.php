<?php 
@session_start();

if (!isset($_SESSION['sn']) || !$_POST)
{
    die('Access Denied');
}

if(!is_writeable('data/config_search.php'))
{
	die('<p>The file</p><p style="font-family: courier new, monospace; font-weight: 700;">./templates/' . $_SESSION['tp_template'] . '/templug/data/config_search.php</p><p>is not writeable, please check the writing permissions of the file.</p>');
}
else
{
$datei = fopen('data/config_search.php', 'w+');
ftruncate($datei, 0);
$inhalt='<?php // utf-8 Marker: äöü 

if (preg_match(\'#templug/data/config_#i\', $_SERVER[\'SCRIPT_NAME\']))
{
	die(\'no direct access\');
}

$search_input_width = "' . $_POST['search_input_width'] . '";
$search_input_background_color = "' . $_POST['search_input_background_color'] . '";
$search_input_color = "' . $_POST['search_input_color'] . '";
$search_input_border_color = "' . $_POST['search_input_border_color'] . '";
$search_input_border_width = "' . $_POST['search_input_border_width'] . '";
$search_input_border_style = "' . $_POST['search_input_border_style'] . '";
$search_submit_background_color = "' . $_POST['search_submit_background_color'] . '";
$search_submit_color = "' . $_POST['search_submit_color'] . '";
$search_submit_border_color = "' . $_POST['search_submit_border_color'] . '";
$search_submit_border_width = "' . $_POST['search_submit_border_width'] . '";
$search_submit_border_style = "' . $_POST['search_submit_border_style'] . '";
?>';

fwrite($datei, $inhalt);
fclose($datei);
}

include('writecss.php');

?>