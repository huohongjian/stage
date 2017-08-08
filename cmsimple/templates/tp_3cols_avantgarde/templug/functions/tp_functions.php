<?php // utf-8 marker: äöü

if (!function_exists('sv') || preg_match('#templug/functions/tp_functions.php#i', $_SERVER['SCRIPT_NAME']))
{
	die('no direct access');
}

$dir_choose_tpid=opendir($pth['folder']['template'] . '/images');
$dirs_tpids=array();
while(false!==($dir_tpids=readdir($dir_choose_tpid)))
{
	if(!strpos($dir_tpids, '.') && $dir_tpids != '..' && $dir_tpids != '.')
	{
		$dirs_tpids[]=trim($dir_tpids);
	}
}
closedir($dir_choose_tpid);

function templug_site_title()
{
global $basic_show_site_title;
if($basic_show_site_title == "true")
	{
echo sitename();
	}
}

function templug_search()
{
global $basic_show_search;
if($basic_show_search == "true")
	{
echo '
<div id="tp_search">
' . searchbox() . 
'</div>';
	}
}

function templug_locator()
{
	global $tx, $basic_show_locator;
	if($basic_show_locator == "true")
	{
	echo (
'<div id="tp_locator">
<div id="tp_locatorin"><b>
' . $tx['locator']['text'] . ' &nbsp;</b>' . locator() . 
'
<div style="clear: both;"></div>
</div>
<div style="clear: both;"></div>
</div>
');
	}
}

function templug_sitemaplink()
{
	global $basic_show_sitemaplink;
	if($basic_show_sitemaplink == "true")
	{
		echo sitemaplink();
	}
}

function templug_printlink()
{
	global $basic_show_printlink;
	if($basic_show_printlink == "true")
	{
		echo printlink();
	}
}

function templug_subnav()
{
	global $basic_show_subnav;
	if(strpos(file_get_contents('./content/content.htm'), 'Subnav</h1>')  && $basic_show_subnav == "true")
	{
		echo (
'<div id="tp_subnav">
<div id="tp_subnavin">' . 
newsbox('Subnav') . 
'<div style="clear: both;"></div>
</div>
<div style="clear: both;"></div>
</div>
');
	}
}

function templug_lastupdate()
{
	global $basic_show_lastupdate;
	if($basic_show_lastupdate == "true")
	{
		echo (
'<div id="tp_lastupdate">
<div id="tp_lastupdatein">
' . lastupdate() . '
<div style="clear: both;"></div>
</div>
<div style="clear: both;"></div>
</div>
');
	}
}

function templug_submenu()
{
	global $basic_show_submenu;
	if($basic_show_submenu == "true")
	{
		echo (
'<div id="tp_submenu">
<div id="tp_submenuin">
' . submenu() . 
'<div style="clear: both;"></div>
</div>
<div style="clear: both;"></div>
</div>
');
	}
}

function templug_pagenav()
{
	global $basic_show_pagenav;
	if($basic_show_pagenav == "true")
	{
	echo (
'<div id="tp_pagenav">
<div id="tp_pagenavin">
<span>' . previouspage() . '</span>|
<span>' . top() . '</span>|
<span>' . nextpage() . '</span>
<div style="clear: both;"></div>
</div>
<div style="clear: both;"></div>
</div>
');
	}
}

function templug_newsarea_open()
{
	global $basic_show_newsarea;
	if($basic_show_newsarea == "true")
	{
	echo (
'<div id="tp_newsarea">
<div id="tp_newsareain">
');
	}
}

function templug_newsboxes()
{
	global $basic_show_newsboxes;
	if($basic_show_newsboxes == "true")
	{
		if(strpos(file_get_contents('./content/content.htm'), 'News01</h1>'))
		{
			echo '
<div class="tp_newsbox">
<div class="tp_newsboxin">' . 
newsbox('News01') . 
'<div style="clear: both;"></div>
</div>
<div style="clear: both;"></div>
</div>
';
		}

		if(strpos(file_get_contents('./content/content.htm'), 'News02</h1>'))
		{
			echo '
<div class="tp_newsbox">
<div class="tp_newsboxin">' . 
newsbox('News02') . 
'<div style="clear: both;"></div>
</div>
<div style="clear: both;"></div>
</div>
';
		}

		if(strpos(file_get_contents('./content/content.htm'), 'News03</h1>'))
		{
			echo '
<div class="tp_newsbox">
<div class="tp_newsboxin">' . 
newsbox('News03') . 
'<div style="clear: both;"></div>
</div>
<div style="clear: both;"></div>
</div>
';
		}
	}
}

function templug_newsbox01()
{
	global $basic_show_newsbox01;
	if($basic_show_newsbox01 == "true")
	{
		echo '
<div class="tp_newsbox">
<div class="tp_newsboxin">' . 
newsbox('News01') . 
'<div style="clear: both;"></div>
</div>
<div style="clear: both;"></div>
</div>
';
	}
}

function templug_newsbox02()
{
	global $basic_show_newsbox02;
	if($basic_show_newsbox02 == "true")
	{
		echo '
<div class="tp_newsbox">
<div class="tp_newsboxin">' . 
newsbox('News02') . 
'<div style="clear: both;"></div>
</div>
<div style="clear: both;"></div>
</div>
';
	}
}

function templug_newsbox03()
{
	global $basic_show_newsbox03;
	if($basic_show_newsbox03 == "true")
	{
		echo '
<div class="tp_newsbox">
<div class="tp_newsboxin">' . 
newsbox('News03') . 
'<div style="clear: both;"></div>
</div>
<div style="clear: both;"></div>
</div>
';
	}
}

function templug_newsarea_close()
{
	global $basic_show_newsarea;
	if($basic_show_newsarea == "true")
	{
	echo ('
<div style="clear: both;"></div>
</div>
<div style="clear: both;"></div>
</div>
');
	}
}

function templug_validlinks()
{
	global $adm, $edit;
	echo 'Powered by <a href="http://www.cmsimple.org/">CMSimple</a> | 
Designed by <a href="http://www.ge-webdesign.de/templug/">TemPlug</a>
';

	if($adm && !$edit)
	{
		echo ' | 
<a href="http://validator.w3.org/check?uri=referer">html5</a> | 
<a href="http://jigsaw.w3.org/css-validator/check/referer">css</a>';
	}
}

function templug_loginlink()
{
	global $basic_show_login;
	if($basic_show_login == "true")
	{
		echo (' | ' . loginlink() . "\n");
	}
}

?>