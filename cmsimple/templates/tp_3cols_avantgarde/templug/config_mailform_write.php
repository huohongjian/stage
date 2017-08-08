<?php 
@session_start();

if (!isset($_SESSION['sn']) || !$_POST)
{
    die('Access Denied');
}

if(!is_writeable('data/config_mailform.php'))
{
	die('<p>The file</p><p style="font-family: courier new, monospace; font-weight: 700;">./templates/' . $_SESSION['tp_template'] . '/templug/data/config_mailform.php</p><p>is not writeable, please check the writing permissions of the file.</p>');
}
else
{
$datei = fopen('data/config_mailform.php', 'w+');
ftruncate($datei, 0);
$inhalt='<?php // utf-8 Marker: äöü 

if (preg_match(\'#templug/data/config_#i\', $_SERVER[\'SCRIPT_NAME\']))
{
	die(\'no direct access\');
}

$mailform_input_width = "' . $_POST['mailform_input_width'] . '";
$mailform_input_background_color = "' . $_POST['mailform_input_background_color'] . '";
$mailform_input_color = "' . $_POST['mailform_input_color'] . '";
$mailform_input_border_color = "' . $_POST['mailform_input_border_color'] . '";
$mailform_input_border_width = "' . $_POST['mailform_input_border_width'] . '";
$mailform_input_border_style = "' . $_POST['mailform_input_border_style'] . '";
$mailform_submit_background_color = "' . $_POST['mailform_submit_background_color'] . '";
$mailform_submit_color = "' . $_POST['mailform_submit_color'] . '";
$mailform_submit_border_color = "' . $_POST['mailform_submit_border_color'] . '";
$mailform_submit_border_width = "' . $_POST['mailform_submit_border_width'] . '";
$mailform_submit_border_style = "' . $_POST['mailform_submit_border_style'] . '";
?>';

fwrite($datei, $inhalt);
fclose($datei);
}

include('writecss.php');

?>