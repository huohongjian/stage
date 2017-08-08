<?php

if (!defined('CMSIMPLE_VERSION') || preg_match('#/plugins/tinymce/admin.php#i', $_SERVER['SCRIPT_NAME']))
{
	die('no direct access');
}

if (!$adm){return;}

initvar('tinymce');

if ($tinymce) 
{
	$plugin = basename(dirname(__FILE__), "/");
	$o .= '<div class="plugineditcaption">TinyMCE for CMSimple</div>
<div class="plugintext">
<hr /><p>' . $tx['message']['plugin_standard1'] . '</p><p>' . $tx['message']['plugin_standard2'] . ' <a href="./?file=config&action=array"><b>' . $tx['filetype']['config'] . '</b></a></p><hr />
<p>Version 1.1</p>
<p>TinyMCE version 3.4.5  &ndash; <a href="http://www.tinymce.com/" target="_blank">tinymce.com</a></p>
<p>Filebrowser integration &ndash; <a href="http://www.zeichenkombinat.de/" target="_blank">zeichenkombinat.de</a></p>
<p>Adapted for CMSimple 4 and higher &ndash; <a href="http://www.ge-webdesign.de/" target="_blank">ge-webdesign.de</a></p>
</div>
';
}
?>