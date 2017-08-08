<?php

if (!function_exists('sv') || preg_match('#plugins/fotoboxes/admin.php#i', $_SERVER['SCRIPT_NAME']))
{
	die('no direct access');
}

/*
============================================================
CMSimple Plugin FotoBoxes
============================================================
Version:    FotoBoxes v2.4
Released:   07/2014
Copyright:  Gert Ebersbach - www.ge-webdesign.de
============================================================ 
License:
- GPL3 or higher
- free for noncommercial websites
- fee required for commercial websites
============================================================ 
Credits:
Javascript Image Slider - No jQuery by menucool.com
FlexSlider - flexslider.woothemes.com
============================================================ 
utf-8 check: äöü 
*/

function fotoBoxesSelectbox()
{
	global $plugin_tx, $fotoBoxesGalleryFolders;
	
	$output= '<p><b>FotoBoxes</b></p>';
	$output.= $plugin_tx['fotoboxes']['select_gallery'];
	$output.= '<form method="post" name="fotoBoxesSelectedGallery" action="./?fotoboxes&amp;admin=plugin_main&amp;action=plugin_text&amp;fotoBoxSelected">' . "\n";
	$output.= '<select name="fotoBoxesSelectedGallery" onchange="this.form.submit()" style="border: 2px solid #999; padding: 2px;">' . "\n";
	$output.= '<option style="padding: 0 6px;">' . $plugin_tx['fotoboxes']['select_gallery'] . '</option>' . "\n";
	
	foreach ($fotoBoxesGalleryFolders as $fotoBoxesSelectedGallery)
	{
		if($fotoBoxesSelectedGallery == @$_SESSION['fotoBoxesSelectedGallery'])
		{
			$output.= '<option selected="selected" style="padding: 0 6px;" value="' . $fotoBoxesSelectedGallery . '">' . $fotoBoxesSelectedGallery . '</option>' . "\n";
		}
		else
		{
			$output.= '<option style="padding: 0 6px;" value="' . $fotoBoxesSelectedGallery . '">' . $fotoBoxesSelectedGallery . '</option>' . "\n";
		}
	}
	$output.= '</select>' . "\n";
	$output.= '</form>' . "\n";
	return $output;
}

function fotoBoxesInfo()
{
	global $plugin_tx;
	
	if(@$_SESSION['fotoBoxesSelectedGallery'] != '' && @$_SESSION['fotoBoxesSelectedGallery'] != $plugin_tx['fotoboxes']['select_gallery'])
	{
		$output = '<p style="background: #060; color: #fff; text-align: center; padding: 10px;">' . $plugin_tx['fotoboxes']['active_gallery1'] . '<b> ' . $_SESSION['fotoBoxesSelectedGallery'] . ' </b>' . $plugin_tx['fotoboxes']['active_gallery2'] . '</p>' . "\n";
	}
	
	if(@$_SESSION['fotoBoxesSelectedGallery'] == '' || @$_SESSION['fotoBoxesSelectedGallery'] == $plugin_tx['fotoboxes']['select_gallery'])
	{
		$output = '<p style="background: #900; color: #fff; font-weight: 700; text-align: center; padding: 10px;">' . $plugin_tx['fotoboxes']['text_nogallery'] . '</p>' . "\n";
	}
	return $output;
}

initvar('fotoboxes');
if ($fotoboxes) 
{
	@session_start();
	
	if(!defined('CMSIMPLE_VERSION'))
	{
		$o.= '<p>This plugin requires <b>CMSimple 4.2</b> or higher.</p><p><a href="http://www.cmsimple.org/">CMSimple Download & Updates &raquo;</a></p>';
		return;
	}

	// Plugin  Info
	
	if(defined('XH_ADM'))
	{
		$o.= '<div style="font-size: 15px; font-family: arial, sans-serif; letter-spacing: 0;">
<h4><a href="?fotoboxes">Plugin Info &raquo;</a></h4>
<p style="line-height: 1.6em;"><b>FotoBoxes</b>&nbsp;by&nbsp;<a href="http://www.ge-webdesign.de/cmsimpleplugins/"><u>ge-webdesign.de&nbsp;&raquo;</u></a> &nbsp; 
for&nbsp;<b>CMSimple&nbsp;4.0</b>&nbsp;or&nbsp;higher&nbsp;from&nbsp;<a href="http://www.cmsimple.org/"><u>cmsimple.org&nbsp;&raquo;</u></a></p>
</div>';
	}
	else
	{
		$o.= '<div style="font-size: 15px; font-family: arial, sans-serif; letter-spacing: 0; padding: 0 0 6px 0;">
<b><a href="?fotoboxes">Plugin Info &raquo;</a></b>
</div>
';
	}
	
	// Make CMSimple variables accessible
	global $sn,$sv,$sl,$pth,$plugin;
	
	// Detect the foldername of the plugin.
	$plugin=basename(dirname(__FILE__),"/");

	$admin = isset($_GET['admin']) ? $_GET['admin'] : '';
	$admin .= isset($_POST['admin']) ? $_POST['admin'] : '';
	
	// Parameter "ON"  shows the Plugin Main Tab.
	// Blank "" or "OFF" does not show the Plugin Main Tab.
	$o.=print_plugin_admin('ON');
	
	$o .='<div id="FotoBoxMain">';
	
	// First page when loading the plugin.
	if ($admin == '') 
	{
		$o.='
		<h4>Plugin FotoBoxes</h4>';
		
		$o.= '
		<div style="font-family: arial, sans-serif; font-size: 15px; letter-spacing: 0; border: 4px double; padding: 6px 16px; margin: 2px 0 8px 0;">
		<p style="text-align: center;">This Plugin is made for <a href="http://www.cmsimple.org/"><span style="font-weight: 700; padding: 0 6px; ">CMSimple 4.0 &raquo;</span></a> or higher.</p>
		<p style="text-align: center;">Optimized for <span style="font-weight: 700; padding: 0 6px; ">CMSimple 4.4</span> or higher.</p>
		<p style="text-align: center;">Recommended is the current version of CMSimple from <a href="http://www.cmsimple.org/">cmsimple.org&nbsp;&raquo;</a></p>
		</div>
		';
		
		$o.='
		<ul>
		<li>Version: FotoBoxes v2.4</li>
		<li>Released: 07/2014</li>
		<li>Copyright: Gert Ebersbach</li>
		<li>Internet: <a href="http://www.ge-webdesign.de/cmsimpleplugins/?Eigene_Plugins">www.ge-webdesign.de</a></li>
		</ul>
		<hr />
		<p><b>License Info:</b></p>
		<ul>
		<li>GPL3 or higher</li>
		<li>free for noncommercial websites</li>
		<li>fee required for commercial websites</li>
		</ul>
		<hr />
		<p><b>Credits:</b></p>
		<p>Javascript Image Slider - No jQuery by <a href="http://www.menucool.com/javascript-image-slider">menucool.com</a></p>
		<p>FlexSlider - <a href="http://flexslider.woothemes.com">woothemes.com</a></p>
		';
	}

	if ($admin == 'plugin_main') 
	{
		// activate backend template, if exists
		if(file_exists($pth['folder']['templates'].'__cmsimple_backend__/template.htm'))
		{
			$pth['folder']['template'] = $pth['folder']['templates'].'__cmsimple_backend__/';
			$pth['file']['template'] = $pth['folder']['template'].'template.htm';
			$pth['file']['stylesheet'] = $pth['folder']['template'].'stylesheet.css';
			$pth['folder']['menubuttons'] = $pth['folder']['template'].'menu/';
			$pth['folder']['templateimages'] = $pth['folder']['template'].'images/';
			$cf['meta']['robots'] = 'noindex, nofollow';
		}
		
		if(!is_writable($fotoboxesDataPath))
		{
			$o.= '<p class="cmsimplecore_warning" style="text-align: center;">' . $plugin_tx['fotoboxes']['message_no_datafolder'] . '</p>';
		}
		
		if(isset($_POST['fotoBoxesSelectedGallery']))
		{
			unset($_SESSION['fotoBoxesSelectedGallery']);
			$_SESSION['fotoBoxesSelectedGallery'] = @$_POST['fotoBoxesSelectedGallery'];
			
			if(isset($fotoBoxSelected))
			{
				$o.= fotoBoxesSelectbox();
				$o.= fotoBoxesInfo();
				if(@$_SESSION['fotoBoxesSelectedGallery'] != $plugin_tx['fotoboxes']['select_gallery'])
				{
					$o.= '<p><a href=""><b>' . $plugin_tx['fotoboxes']['message_back'] . '</b></a></p>';
				}
				return;
			}
		}
		
		$o.= fotoBoxesSelectbox();
		$o.= fotoBoxesInfo();
		
		if(@$_REQUEST['fotoboxes_write_data'] == 'done')
		{
			$o.='<p><b>' . $plugin_tx['fotoboxes']['message_updated'] . '</b></p>';
			$o.='<p><a href="' . $sn . '?&fotoboxes&admin=plugin_main&action=plugin_text"><b>' . $plugin_tx['fotoboxes']['message_back'] . '</b></a></p>';

/* 
#####################################
        write file "data.php"
##################################### 
*/

			if(@$_POST['fotoBoxesSelectedGallery'])
			{
				if($handle = @opendir($fotoboxesDataPath . $_SESSION['fotoBoxesSelectedGallery'] . '/'))
				{
					while($fotoboxesImageWriteData = readdir($handle))
					{
						if($fotoboxesImageWriteData != '.' && $fotoboxesImageWriteData != '..' && !strpos($fotoboxesImageWriteData, '.php'))
						{
							$fotoboxesImagesWriteData[] = $fotoboxesImageWriteData;
							natcasesort($fotoboxesImagesWriteData);
						}
					}
				}
				
				if(!is_writeable($fotoboxesDataPath . $_SESSION['fotoBoxesSelectedGallery'] . '/data.php'))
				{
					die('<p>The file</p><p style="font-family: courier new, monospace; font-weight: 700;">' . $fotoboxesDataPath . $_SESSION['fotoBoxesSelectedGallery'] . '/data.php' . '</p><p>is not writeable, please check the writing permissions of the file.</p>');
				}
				else
				{
					// write data to file
					$fotoBoxesDataFile = fopen($fotoboxesDataPath . $_SESSION['fotoBoxesSelectedGallery'] . '/data.php', 'w+');
					ftruncate($fotoBoxesDataFile, 0);
					$fotoBoxesDataContent='<?php // utf-8 Marker: äöü 

if (!function_exists(\'sv\') || preg_match(\'#data.php#i\', $_SERVER[\'SCRIPT_NAME\']))
{
	die(\'no direct access\');
}

$fotoBoxesCaptionOpacity = "' . $_POST['fotoBoxesCaptionOpacity'] . '";
$fotoBoxesCaptionEffect = "' . $_POST['fotoBoxesCaptionEffect'] . '";
$fotoBoxesEffect = "' . $_POST['fotoBoxesEffect'] . '";' . "\n";

if(@$_POST['fotoBoxesEffectRandom'] == 'true' )
{
	$fotoBoxesDataContent.= '$fotoBoxesEffectRandom = "' . $_POST['fotoBoxesEffectRandom'] . '";' . "\n";
}
else
{
	$fotoBoxesDataContent.= '$fotoBoxesEffectRandom = "false";' . "\n";
}

if(@$_POST['fotoBoxesBullets'] == 'visible')
{
	$fotoBoxesDataContent.= '$fotoBoxesBullets = "' . $_POST['fotoBoxesBullets'] . '";' . "\n";
}
else
{
	$fotoBoxesDataContent.= '$fotoBoxesBullets = "hidden";' . "\n";
}

if(@$_POST['fotoBoxesHoverPause'] == 'true' )
{
	$fotoBoxesDataContent.= '$fotoBoxesHoverPause = "' . $_POST['fotoBoxesHoverPause'] . '";' . "\n";
}
else
{
	$fotoBoxesDataContent.= '$fotoBoxesHoverPause = "false";' . "\n";
}

$fotoBoxesDataContent.='$fotoBoxesShowDesc = "' . @$_POST['fotoBoxesShowDesc'] . '";
$fotoBoxesPauseTime = "' . $_POST['fotoBoxesPauseTime'] . '";
$fotoBoxesTransitionTime = "' . $_POST['fotoBoxesTransitionTime'] . '";
$fotoboxesCss = "' . $_POST['fotoboxesCss'] . '";
$fotoBoxesImageBorderWidth = "' . $_POST['fotoBoxesImageBorderWidth'] . '";
$fotoBoxesImageBorderStyle = "' . $_POST['fotoBoxesImageBorderStyle'] . '";
$fotoBoxesImageBorderColor = "' . $_POST['fotoBoxesImageBorderColor'] . '";

// FotoBox "Thumbs"
$fotoBoxesThumbsGalleryName = "' . $_POST['fotoBoxesThumbsGalleryName'] . '";
$fotoBoxesThumbsLightbox = "' . @$_POST['fotoBoxesThumbsLightbox'] . '";
$fotoBoxesThumbsDesc = "' . @$_POST['fotoBoxesThumbsDesc'] . '";
$fotoBoxesThumbsNumberOf = "' . $_POST['fotoBoxesThumbsNumberOf'] . '";
$fotoboxesCssThumbs = "' . $_POST['fotoboxesCssThumbs'] . '";
$fotoBoxesThumbsImageBorderWidth = "' . $_POST['fotoBoxesThumbsImageBorderWidth'] . '";
$fotoBoxesThumbsImageBorderStyle = "' . $_POST['fotoBoxesThumbsImageBorderStyle'] . '";
$fotoBoxesThumbsImageBorderColor = "' . $_POST['fotoBoxesThumbsImageBorderColor'] . '";
$fotoBoxesThumbsThumbsBorderColor = "' . $_POST['fotoBoxesThumbsThumbsBorderColor'] . '";

// images and short descriptions
';

					foreach($fotoboxesImagesWriteData as $fotoboxesImageWriteData)
					{
						$fotoboxesImageArray = explode('.', $fotoboxesImageWriteData);
						array_pop($fotoboxesImageArray);
						$fotoboxesImageWriteData = implode($fotoboxesImageWriteData, $fotoboxesImageArray);
						
						if(get_magic_quotes_gpc() == 0)
						{
							$fotoBoxesDataContent.='$fotoboxes_data["' . $fotoboxesImageWriteData . '"]["caption"]="' . @addslashes($_POST[$fotoboxesImageWriteData]) . '";
		$fotoboxes_data["' . $fotoboxesImageWriteData . '"]["link"]="' . @addslashes($_POST[$fotoboxesImageWriteData . 'link']) . '";
		';
						}
						else
						{
							$fotoBoxesDataContent.='$fotoboxes_data["' . $fotoboxesImageWriteData . '"]["caption"]="' . $_POST[$fotoboxesImageWriteData] . '";
		$fotoboxes_data["' . $fotoboxesImageWriteData . '"]["link"]="' . $_POST[$fotoboxesImageWriteData . 'link'] . '";
		';
						}
					}
					$fotoBoxesDataContent.='?>';
					
					fwrite($fotoBoxesDataFile, $fotoBoxesDataContent);
					fclose($fotoBoxesDataFile);
				}
			}
			return;
		}
		
		// create images array
		if($handle = @opendir($fotoboxesDataPath . $_SESSION['fotoBoxesSelectedGallery'] . '/'))
		{
			while($fotoboxesImage = readdir($handle))
			{
				if(strstr($fotoboxesImage,'.') && $fotoboxesImage != '.' && $fotoboxesImage != '..' && !strpos($fotoboxesImage, '.php'))
				{
					$fotoboxesImages[] = $fotoboxesImage;
					sort($fotoboxesImages);
				}
			}
		}
		
		// include data.php
		if(isset($_SESSION['fotoBoxesSelectedGallery']) && file_exists($fotoboxesDataPath . $_SESSION['fotoBoxesSelectedGallery'] . '/data.php'))
		{
			include($fotoboxesDataPath . $_SESSION['fotoBoxesSelectedGallery'] . '/data.php');
		}
		
		// begin output backend forms
		$o.='<h4>' . $plugin_tx['fotoboxes']['headline_edit_galleries'] . '</h4>' . "\n";
		
		// save button
		if(isset($_SESSION['fotoBoxesSelectedGallery']) && file_exists($fotoboxesDataPath . $_SESSION['fotoBoxesSelectedGallery'] . '/data.php'))
		{
			$o .='<form method="post" action="' . $sn . '?&fotoboxes&admin=plugin_main&action=plugin_text&fotoboxes_write_data=done">' . "\n";
			$o .='<input type="submit" value="' . $plugin_tx['fotoboxes']['save'] . '" />' . "\n";

/* 
#####################################
           FotoBoxSlide
##################################### 
*/
			$o.='<h4>' . $plugin_tx['fotoboxes']['headline_fotoboxes_slideshow'] . '</h4>';
			$o.='<div id="FotoBoxAdminSlide">';
			
			// show bullets?
			$o.='<p>';
			$o.=' <input type="checkbox" name="fotoBoxesBullets" value="visible" ';
			if($fotoBoxesBullets == 'visible')
			{
				$o.='checked="checked"';
			}
			else
			{
				$o.='';
			}
			$o.=' /> <b>' . $plugin_tx['fotoboxes']['basic_slidebox'] . '</b> - ' . $plugin_tx['fotoboxes']['settings_bullets'] . '</p>';
			
			// show description?
			$o.='<p>';
			$o.=' <input type="checkbox" name="fotoBoxesShowDesc" value="true" ';
			if($fotoBoxesShowDesc == 'true')
			{
				$o.='checked="checked"';
			}
			else
			{
				$o.='';
			}
			$o.=' /> <b>' . $plugin_tx['fotoboxes']['basic_slidebox'] . '</b> - ' . $plugin_tx['fotoboxes']['settings_description'] . '</p>';
			
			// hover pause?
			$o.='<p>';
			$o.=' <input type="checkbox" name="fotoBoxesHoverPause" value="true" ';
			if(@$fotoBoxesHoverPause == 'true')
			{
				$o.='checked="checked"';
			}
			else
			{
				$o.='';
			}
			$o.=' /> <b>' . $plugin_tx['fotoboxes']['basic_slidebox'] . '</b> - ' . $plugin_tx['fotoboxes']['settings_hover'] . '</p>';
			
			// random slide effect?
			$o.='<p>';
			$o.=' <input type="checkbox" name="fotoBoxesEffectRandom" value="true" ';
			if($fotoBoxesEffectRandom == 'true')
			{
				$o.='checked="checked"';
			}
			else
			{
				$o.='';
			}
			$o.=' /> <b>' . $plugin_tx['fotoboxes']['basic_slidebox'] . '</b> - ' . $plugin_tx['fotoboxes']['settings_random'] . '</p>';
			
			// slide effect
			$o.='<p><b>' . $plugin_tx['fotoboxes']['basic_slidebox'] . '</b> - ' . $plugin_tx['fotoboxes']['settings_effect'] . '</p>
			<input type="text" class="text" name="fotoBoxesEffect" value="' . $fotoBoxesEffect . '" style="width:96%; font-family: courier new, monospace; border: 2px solid #999; padding: 3px 6px;" />' . "\n";
			
			// interval
			$o.='<p><span style="font-weight: 700; color: #900;">' . $plugin_tx['fotoboxes']['basic_slide_mini'] . '</span> - ' . $plugin_tx['fotoboxes']['settings_pausetime'] . '</p>
			<input type="text" class="text" name="fotoBoxesPauseTime" value="' . $fotoBoxesPauseTime . '" style="width: 144px; font-family: courier new, monospace; border: 2px solid #999; padding: 3px 6px;" />' . "\n";
			
			// transition time
			$o.='<p><span style="font-weight: 700; color: #900;">' . $plugin_tx['fotoboxes']['basic_slide_mini'] . '</span> - ' . $plugin_tx['fotoboxes']['settings_transitiontime'] . '</p>
			<input type="text" class="text" name="fotoBoxesTransitionTime" value="' . $fotoBoxesTransitionTime . '" style="width: 144px; font-family: courier new, monospace; border: 2px solid #999; padding: 3px 6px;" />' . "\n";
			
			// image description effect
			$o.='<p><b>' . $plugin_tx['fotoboxes']['basic_slidebox'] . '</b> - ' . $plugin_tx['fotoboxes']['settings_caption'] . '</p>
			<select name="fotoBoxesCaptionEffect" style="width: 160px; border: 2px solid #999; padding: 2px;">
			<option value="none" style="padding: 0 6px;" ';
			if($fotoBoxesCaptionEffect == 'none')
			{
				$o.='selected="selected"';
			}
			$o.='>' . $plugin_tx['fotoboxes']['selectbox_none'] . '</option>
			<option value="fade" style="padding: 0 6px;" ';
			if($fotoBoxesCaptionEffect == 'fade')
			{
				$o.='selected="selected"';
			}
			$o.='>' . $plugin_tx['fotoboxes']['selectbox_fade'] . '</option>
			<option value="rotate" style="padding: 0 6px;" ';
			if($fotoBoxesCaptionEffect == 'rotate')
			{
				$o.='selected="selected"';
			}
			$o.='>' . $plugin_tx['fotoboxes']['selectbox_rotate'] . '</option>
			</select>
			';
			
			// image description opacity
			$o.='<p><b>' . $plugin_tx['fotoboxes']['basic_slidebox'] . '</b> - ' . $plugin_tx['fotoboxes']['settings_opacity'] . '</p>
			<input type="text" class="text" name="fotoBoxesCaptionOpacity" value="' . $fotoBoxesCaptionOpacity . '" style="width: 144px; font-family: courier new, monospace; border: 2px solid #999; padding: 3px 6px;" />' . "\n";
			
			// css textarea for main container
			$o.='<p><span style="font-weight: 700; color: #900;">' . $plugin_tx['fotoboxes']['basic_slide_mini_flex'] . '</span> - ' . $plugin_tx['fotoboxes']['settings_css'] . '</p>
			<textarea type="text" name="fotoboxesCss" value="' . $fotoboxesCss . '" style="width:96%; height: 140px; font-family: courier new, monospace; border: 2px solid #999; padding: 3px 6px; font-size: 15px;" />' . $fotoboxesCss . '</textarea>' . "\n";
			
			// image border width
			$o.= '<p><b>' . $plugin_tx['fotoboxes']['basic_slidebox'] . '</b> - ' . $plugin_tx['fotoboxes']['settings_image_borderwidth'] . '</p>
			<input type="text" class="text" name="fotoBoxesImageBorderWidth" value="' . $fotoBoxesImageBorderWidth . '" style="width: 144px; font-family: courier new, monospace; border: 2px solid #999; padding: 3px 6px;" />' . "\n";
			
			// image border style
			$o.= '<p><b>' . $plugin_tx['fotoboxes']['basic_slidebox'] . '</b> - ' . $plugin_tx['fotoboxes']['settings_image_borderstyle'] . '</p>
			<select name="fotoBoxesImageBorderStyle" style="width: 160px; border: 2px solid #999; padding: 2px;">
			<option value="solid" style="padding: 0 6px;" ';
			if($fotoBoxesImageBorderStyle == 'solid')
			{
				$o.='selected="selected"';
			}
			$o.='>solid</option>
			<option value="double" style="padding: 0 6px;" ';
			if($fotoBoxesImageBorderStyle == 'double')
			{
				$o.='selected="selected"';
			}
			$o.='>double</option>
			<option value="dashed" style="padding: 0 6px;" ';
			if($fotoBoxesImageBorderStyle == 'dashed')
			{
				$o.='selected="selected"';
			}
			$o.='>dashed</option>
			<option value="dotted" style="padding: 0 6px;" ';
			if($fotoBoxesImageBorderStyle == 'dotted')
			{
				$o.='selected="selected"';
			}
			$o.='>dotted</option>
			</select>
			';
			
			// image border color
			$o.= '<p><b>' . $plugin_tx['fotoboxes']['basic_slidebox'] . '</b> - ' . $plugin_tx['fotoboxes']['settings_image_bordercolor'] . '</p>
			<input type="text" class="text" name="fotoBoxesImageBorderColor" value="' . $fotoBoxesImageBorderColor . '" style="width: 144px; font-family: courier new, monospace; border: 2px solid #999; padding: 3px 6px;" />' . "\n";
			
			$o.='<input type="hidden" name="fotoBoxesSelectedGallery" value="' . $_SESSION['fotoBoxesSelectedGallery'] . '" />' . "\n";
			$o.= '</div>';
			
/* 
#####################################
		   FotoBoxThumbs
##################################### 
*/
			// save button
			$o.='<input type="submit" value="' . $plugin_tx['fotoboxes']['save'] . '" />' . "\n";
			
			$o.= fotoBoxesInfo() . "\n";
			
			$o.='<h4>' . $plugin_tx['fotoboxes']['headline_fotoboxes_thumbs'] . '</h4>';
			$o.='<div id="FotoBoxAdminThumbs">';
			
			// gallery name
			$o.= '<p><b>' . $plugin_tx['fotoboxes']['basic_thumbsbox'] . '</b> - ' . $plugin_tx['fotoboxes']['settings_gallery_name'] . '</p>
			<input type="text" class="text" name="fotoBoxesThumbsGalleryName" value="' . $fotoBoxesThumbsGalleryName . '" style="width: 96%; font-family: courier new, monospace; border: 2px solid #999; padding: 3px 6px;" />
<hr />' . "\n";

			// activate lightbox?
			$o.='<p>';
			$o.=' <input type="checkbox" name="fotoBoxesThumbsLightbox" value="true" ';
			if($fotoBoxesThumbsLightbox == 'true')
			{
				$o.='checked="checked"';
			}
			else
			{
				$o.='';
			}
			$o.=' /> <b>' . $plugin_tx['fotoboxes']['basic_thumbsbox'] . '</b> - ' . $plugin_tx['fotoboxes']['settings_activate_lightbox'] . '</p>';
			
			// show image description?
			$o.='<p>';
			$o.=' <input type="checkbox" name="fotoBoxesThumbsDesc" value="true" ';
			if($fotoBoxesThumbsDesc == 'true')
			{
				$o.='checked="checked"';
			}
			else
			{
				$o.='';
			}
			$o.=' /> <b>' . $plugin_tx['fotoboxes']['basic_thumbsbox'] . '</b> - ' . $plugin_tx['fotoboxes']['settings_show_desc'] . '</p>';
			
			// number of thumbs in one line
			$o.= '<p><b>' . $plugin_tx['fotoboxes']['basic_thumbsbox'] . '</b> - ' . $plugin_tx['fotoboxes']['settings_number_of_thumbs'] . '</p>
			<input type="text" class="text" name="fotoBoxesThumbsNumberOf" value="' . $fotoBoxesThumbsNumberOf . '" style="width: 144px; font-family: courier new, monospace; border: 2px solid #999; padding: 3px 6px;" />
			<hr />' . "\n";
			
			// css textarea for main container
			$o.='<p><b>' . $plugin_tx['fotoboxes']['basic_thumbsbox'] . '</b> - ' . $plugin_tx['fotoboxes']['settings_css'] . '</p>
			<textarea type="text" name="fotoboxesCssThumbs" value="' . $fotoboxesCssThumbs . '" style="width:96%; height: 140px; font-family: courier new, monospace; border: 2px solid #999; padding: 3px 6px; font-size: 15px;" />' . $fotoboxesCssThumbs . '</textarea>
			<hr />' . "\n";
			
			// image border width
			$o.= '<p><b>' . $plugin_tx['fotoboxes']['basic_thumbsbox'] . '</b> - ' . $plugin_tx['fotoboxes']['settings_image_borderwidth'] . '</p>
			<input type="text" class="text" name="fotoBoxesThumbsImageBorderWidth" value="' . $fotoBoxesThumbsImageBorderWidth . '" style="width: 144px; font-family: courier new, monospace; border: 2px solid #999; padding: 3px 6px;" />' . "\n";
			
			// image border style
			$o.= '<p><b>' . $plugin_tx['fotoboxes']['basic_thumbsbox'] . '</b> - ' . $plugin_tx['fotoboxes']['settings_image_borderstyle'] . '</p>
			<select name="fotoBoxesThumbsImageBorderStyle" style="width: 160px; border: 2px solid #999; padding: 2px;">
			<option value="solid" style="padding: 0 6px;" ';
			if($fotoBoxesThumbsImageBorderStyle == 'solid')
			{
				$o.='selected="selected"';
			}
			$o.='>solid</option>
			<option value="double" style="padding: 0 6px;" ';
			if($fotoBoxesThumbsImageBorderStyle == 'double')
			{
				$o.='selected="selected"';
			}
			$o.='>double</option>
			<option value="dashed" style="padding: 0 6px;" ';
			if($fotoBoxesThumbsImageBorderStyle == 'dashed')
			{
				$o.='selected="selected"';
			}
			$o.='>dashed</option>
			</select>
			';
			
			// image border color
			$o.= '<p><b>' . $plugin_tx['fotoboxes']['basic_thumbsbox'] . '</b> - ' . $plugin_tx['fotoboxes']['settings_image_bordercolor'] . '</p>
			<input type="text" class="text" name="fotoBoxesThumbsImageBorderColor" value="' . $fotoBoxesThumbsImageBorderColor . '" style="width: 144px; font-family: courier new, monospace; border: 2px solid #999; padding: 3px 6px;" />
			<hr />' . "\n";
			
			// thumbs border color
			$o.= '<p><b>' . $plugin_tx['fotoboxes']['basic_thumbsbox'] . '</b> - ' . $plugin_tx['fotoboxes']['settings_thumbs_bordercolor'] . '</p>
			<input type="text" class="text" name="fotoBoxesThumbsThumbsBorderColor" value="' . $fotoBoxesThumbsThumbsBorderColor . '" style="width: 144px; font-family: courier new, monospace; border: 2px solid #999; padding: 3px 6px;" />' . "\n";
			$o.= '</div>';
			
/* 
###################################### 
images and short descriptions and link
###################################### 
*/
			// save button
			$o.='<input type="submit" value="' . $plugin_tx['fotoboxes']['save'] . '" />' . "\n";
			
			$o.= fotoBoxesInfo() . "\n";
			
			$o.='<h4>' . $plugin_tx['fotoboxes']['headline_images_desc'] . '</h4>';
			$o.='<p>' . $plugin_tx['fotoboxes']['text_links'] . '</p>' . "\n";
			
			$o.='<table style="width: 100%; margin-bottom: 16px;">';
			
			foreach ($fotoboxesImages as $fotoboxesImage)
			{
				$o.='
<tr>
<td style="width: 150px; min-width: 160px; max-width: 160px; background: #202326; text-align: center; border: 5px solid #ccc; vertical-align: middle;">
<img src="' . $fotoboxesDataPath . $_SESSION['fotoBoxesSelectedGallery'] . '/' . $fotoboxesImage . '" style="width: 140px; border: 1px solid #999; margin: 16px auto;">
</td>';

				$fotoboxesImageArray = explode('.', $fotoboxesImage);
				array_pop($fotoboxesImageArray);
				$fotoboxesImage = implode($fotoboxesImage, $fotoboxesImageArray);

				$o.= "\n" . '<td style="padding: 0 0 24px 12px; vertical-align: top;">' . "\n";
				
				// image description
				$o.='<p>' . $plugin_tx['fotoboxes']['text_description'] . '</p>
<textarea type="text" name="' . $fotoboxesImage . '" style="width: 90%; height: 60px; font-size: 14px; border: 2px solid #999; padding: 6px;" />' . stripslashes(@$fotoboxes_data[$fotoboxesImage]["caption"]) . '</textarea>' . "\n";
				
				// image link
				$o.= '<p><b>' . $plugin_tx['fotoboxes']['basic_slidebox'] . '</b> - ' . $plugin_tx['fotoboxes']['settings_image_link'] . '</p>
<input type="text" class="text" name="' . $fotoboxesImage . 'link" value="' . stripslashes(@$fotoboxes_data[$fotoboxesImage]["link"]) . '" style="width: 90%; font-family: courier new, monospace; border: 2px solid #999; padding: 3px 6px;" />' . "\n";
				$o.='</td>
</tr>
';
			}
			
			$o.='</table>
<input type="submit" value="' . $plugin_tx['fotoboxes']['save'] . '" />' . "\n";
			$o .='</form>' . "\n";
			
			$o.= fotoBoxesInfo() . "\n";
		}
		else
		{
			if(@$_SESSION['fotoBoxesSelectedGallery'] != '' && @$fotoboxesImages)
			{
				$o .=$plugin_tx['fotoboxes']['message_no_data'] . 
'<h4>' . $plugin_tx['fotoboxes']['headline_images'] . '</h4>';
				foreach ($fotoboxesImages as $fotoboxesImage)
				{
					$o.='<img src="' . $fotoboxesDataPath . $_SESSION['fotoBoxesSelectedGallery'] . '/' . $fotoboxesImage . '" style="width: 140px; float: left; margin: 18px 20px 0 0;">';
				}
			}
		}
	}
	$o .='</div>';
	
	
	if ($admin <> 'plugin_main') 
	{
		$hint=array();
		$hint['mode_donotshowvarnames'] = false;
		$o.=plugin_admin_common($action, $admin, $plugin, $hint);
	}
}
?>