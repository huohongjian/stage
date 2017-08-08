<?php // utf-8 marker: äöü

if (!isset($_SESSION['sn']) || !function_exists('sv') || preg_match('#templug/admin_templates.php#i', $_SERVER['SCRIPT_NAME']))
{
	die('no direct access');
}

if(TEMPLUG_BUILT < 2012011901)
{
	$o.='<p class="cmsimplecore_warning" style="text-align: center; font-weight: 700;">!!! Please update your TemPlug_XH Plugin !!!</p>
' . tag('hr');
}

if(@$_SESSION['tp_template'])
{
// link "basic settings"
	
	$o.='<h5>' . $plugin_tx['templug']['headline_mainmenu_basic'] . '</h5>' . "\n" . 
	'<p><a href="?&templug&admin=plugin_main&action=plugin_text&tp_config=basic">' . $plugin_tx['templug']['edit_basics'] . ' &raquo;</a></p>' . "\n";
	$o.=tag('hr') . "\n";
	
	
// menu "edit site areas"
	
	$o.='<h5>' . $plugin_tx['templug']['headline_mainmenu_site'] . '</h5>' . "\n";
	$o.='<p><a href="?&templug&admin=plugin_main&action=plugin_text&tp_config=body">' . $plugin_tx['templug']['edit_site_background'] . ' &raquo;</a></p>' . "\n";
	
	// left site area
	if(strpos(file_get_contents($pth['folder']['templates'] . $_SESSION['tp_template'] . '/template.htm'), 'id="tp_left"'))
	{
		$o.='<p><a href="?&templug&admin=plugin_main&action=plugin_text&tp_config=left">' . $plugin_tx['templug']['edit_left_background'] . ' &raquo;</a></p>' . "\n";
	}
	
	// center site area
	if(strpos(file_get_contents($pth['folder']['templates'] . $_SESSION['tp_template'] . '/template.htm'), 'id="tp_center"'))
	{
		$o.='<p><a href="?&templug&admin=plugin_main&action=plugin_text&tp_config=center">' . $plugin_tx['templug']['edit_center_background'] . ' &raquo;</a></p>' . "\n";
	}
	
	// right site area
	if(strpos(file_get_contents($pth['folder']['templates'] . $_SESSION['tp_template'] . '/template.htm'), 'id="tp_right"'))
	{
		$o.='<p><a href="?&templug&admin=plugin_main&action=plugin_text&tp_config=right">' . $plugin_tx['templug']['edit_right_background'] . ' &raquo;</a></p>' . "\n";
	}
	
	// header
	if(strpos(file_get_contents($pth['folder']['templates'] . $_SESSION['tp_template'] . '/template.htm'), 'id="tp_header"'))
	{
		$o.='<p><a href="?&templug&admin=plugin_main&action=plugin_text&tp_config=header">' . $plugin_tx['templug']['edit_header'] . ' &raquo;</a></p>' . "\n";
	}
	
	// main container
	if(strpos(file_get_contents($pth['folder']['templates'] . $_SESSION['tp_template'] . '/template.htm'), 'id="tp_main"'))
	{
		$o.='<p><a href="?&templug&admin=plugin_main&action=plugin_text&tp_config=main">' . $plugin_tx['templug']['edit_main_container'] . ' &raquo;</a></p>' . "\n";
	}
	
	// top navigation
	if(strpos(file_get_contents($pth['folder']['templates'] . $_SESSION['tp_template'] . '/template.htm'), 'id="tp_topnav"') && $basic_show_topnav == "true")
	{
		$o.='<p><a href="?&templug&admin=plugin_main&action=plugin_text&tp_config=topnav">' . $plugin_tx['templug']['edit_topnav'] . ' &raquo;</a></p>' . "\n";
	}
	
	// locator
	if(strpos(file_get_contents($pth['folder']['templates'] . $_SESSION['tp_template'] . '/template.htm'), 'templug_locator()') && $basic_show_locator == "true")
	{
		$o.='<p><a href="?&templug&admin=plugin_main&action=plugin_text&tp_config=locator">' . $plugin_tx['templug']['edit_locator'] . ' &raquo;</a></p>' . "\n";
	}
	
	// sidebar navigation area
	if(strpos(file_get_contents($pth['folder']['templates'] . $_SESSION['tp_template'] . '/template.htm'), 'id="tp_nav"'))
	{
		$o.='<p><a href="?&templug&admin=plugin_main&action=plugin_text&tp_config=nav">' . $plugin_tx['templug']['edit_nav_area'] . ' &raquo;</a></p>' . "\n";
	}
	
	// edit menu (toc)
	if(strpos(file_get_contents($pth['folder']['templates'] . $_SESSION['tp_template'] . '/template.htm'), 'id="tp_toc"'))
	{
		$o.='<p>&nbsp;&nbsp;&nbsp; <a href="?&templug&admin=plugin_main&action=plugin_text&tp_config=toc">' . $plugin_tx['templug']['edit_toc_area'] . ' &raquo;</a></p>' . "\n";
	}
	
	// subnav area
	if(strpos(file_get_contents($pth['folder']['templates'] . $_SESSION['tp_template'] . '/template.htm'), 'templug_subnav()') && $basic_show_subnav == "true" && strpos(file_get_contents('./content/content.htm'), 'Subnav</h1>'))
	{
		$o.='<p>&nbsp;&nbsp;&nbsp; <a href="?&templug&admin=plugin_main&action=plugin_text&tp_config=subnav">' . $plugin_tx['templug']['edit_subnav_area'] . ' &raquo;</a></p>' . "\n";
	}
	
	// content
	if(strpos(file_get_contents($pth['folder']['templates'] . $_SESSION['tp_template'] . '/template.htm'), 'id="tp_content"'))
	{
		$o.='<p><a href="?&templug&admin=plugin_main&action=plugin_text&tp_config=content">' . $plugin_tx['templug']['edit_content_area'] . ' &raquo;</a></p>' . "\n";
	}
	
	// submenu
	if(strpos(file_get_contents($pth['folder']['templates'] . $_SESSION['tp_template'] . '/template.htm'), 'templug_submenu()') && $basic_show_submenu == "true")
	{
		$o.='<p>&nbsp;&nbsp;&nbsp; <a href="?&templug&admin=plugin_main&action=plugin_text&tp_config=submenu">' . $plugin_tx['templug']['edit_submenu_area'] . ' &raquo;</a></p>' . "\n";
	}
	
	// prev / top / next
	if(strpos(file_get_contents($pth['folder']['templates'] . $_SESSION['tp_template'] . '/template.htm'), 'templug_pagenav()') && $basic_show_pagenav == "true")
	{
		$o.='<p>&nbsp;&nbsp;&nbsp; <a href="?&templug&admin=plugin_main&action=plugin_text&tp_config=pagenav">' . $plugin_tx['templug']['edit_pagenav_area'] . ' &raquo;</a></p>' . "\n";
	}
	
	// newsarea
	if(strpos(file_get_contents($pth['folder']['templates'] . $_SESSION['tp_template'] . '/template.htm'), 'templug_newsarea_open()') && $basic_show_newsarea == "true" && strpos(file_get_contents('./content/content.htm'), '<h1>News'))
	{
		$o.='<p><a href="?&templug&admin=plugin_main&action=plugin_text&tp_config=newsarea">' . $plugin_tx['templug']['edit_news_area'] . ' &raquo;</a></p>' . "\n";
	}
	
	// newsboxes
	if(strpos(file_get_contents($pth['folder']['templates'] . $_SESSION['tp_template'] . '/template.htm'), 'templug_newsbox') && ($basic_show_newsbox01 == "true" || $basic_show_newsbox02 == "true"|| $basic_show_newsbox03 == "true"))
	{
		$o.='<p><a href="?&templug&admin=plugin_main&action=plugin_text&tp_config=newsbox">' . $plugin_tx['templug']['edit_news_boxes'] . ' &raquo;</a></p>' . "\n";
	}
	
	// footer
	if(strpos(file_get_contents($pth['folder']['templates'] . $_SESSION['tp_template'] . '/template.htm'), 'id="tp_footer"'))
	{
		$o.='<p><a href="?&templug&admin=plugin_main&action=plugin_text&tp_config=footer">' . $plugin_tx['templug']['edit_footer'] . ' &raquo;</a></p>' . "\n";
	}
	
	// searchbox
	if(strpos(file_get_contents($pth['folder']['templates'] . $_SESSION['tp_template'] . '/template.htm'), 'templug_search()') && $basic_show_search == "true")
	{
		$o.='<p><a href="?&templug&admin=plugin_main&action=plugin_text&tp_config=search">' . $plugin_tx['templug']['edit_search'] . ' &raquo;</a></p>' . "\n";
	}
	
	// mailform
	if($txc['mailform']['email'] != '')
	{
		$o.='<p><a href="?&templug&admin=plugin_main&action=plugin_text&tp_config=mailform">' . $plugin_tx['templug']['edit_mailform'] . ' &raquo;</a></p>' . "\n";
	}
	
	// last update
	if(strpos(file_get_contents($pth['folder']['templates'] . $_SESSION['tp_template'] . '/template.htm'), 'templug_lastupdate()') && $basic_show_lastupdate == "true")
	{
		$o.='<p><a href="?&templug&admin=plugin_main&action=plugin_text&tp_config=lastupdate">' . $plugin_tx['templug']['edit_lastupdate'] . ' &raquo;</a></p>' . "\n";
	}
	
	if(@$_SESSION['reload'] == 'true')
	{
		$_SESSION['reload'] = 'false';
		$o.='<script type="text/javascript">window.location.reload();</script>' . "\n";
	}
}
?>