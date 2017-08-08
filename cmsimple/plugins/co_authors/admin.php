<?php
/*
============================================================
CMSimple Plugin CoAuthors_XH
============================================================
Version:    CoAuthors_XH v1.0
Released:   06/2012
Copyright:  Gert Ebersbach
Internet:   www.ge-webdesign.de/cmsimple/
============================================================ 
utf-8 check: äöü 
*/

initvar('co_authors');
if ($co_authors) 
{
	// Make CMSimple variables accessible
	global $sn,$sv,$sl,$pth;
	
	global $plugin;
	
	// Detect the foldername of the plugin.
	$plugin=basename(dirname(__FILE__),"/");

	$admin = isset($_GET['admin']) ? $_GET['admin'] : '';
	$admin .= isset($_POST['admin']) ? $_POST['admin'] : '';
	
	// Parameter "ON"  shows the Plugin Main Tab.
	// Blank "" or "OFF" does not show the Plugin Main Tab.
	$o.=print_plugin_admin('off');
	
	// First page when loading the plugin.
	if ($admin == '') 
	{
		$o.='
		<h4>Plugin CoAuthors_XH</h4>
		<hr />
		<ul>
		<li>Version: CoAuthors v1.0</li>
		<li>Released: 06/2012</li>
		<li>Copyright: Gert Ebersbach</li>
		<li>Internet: <a href="http://www.ge-webdesign.de/cmsimpleplugins/?Eigene_Plugins">www.ge-webdesign.de</a></li>
		</ul>
		<hr />
		<p><b>No admin options</b></p>
		';
	}

	if ($admin == 'plugin_main') 
	{
		$o.='
		<h4>Plugin CoAuthors/h4>
		<hr />
		<ul>
		<li>Version: CoAuthors_XH v1.0</li>
		<li>Released: 06/2012</li>
		<li>Copyright: Gert Ebersbach</li>
		<li>Internet: <a href="http://www.ge-webdesign.de/cmsimpleplugins/?Eigene_Plugins">www.ge-webdesign.de/cmsimple/</a></li>
		</ul>
		<hr />
		<p><b>No admin options</b></p>
		';
	}

	if ($admin <> 'plugin_main') 
	{
		$hint=array();
		$hint['mode_donotshowvarnames'] = false;
		$o.=plugin_admin_common($action, $admin, $plugin, $hint);
	}
}
?>