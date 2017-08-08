<?php

if (!function_exists('sv') || preg_match('#/plugins/fotoboxes/index.php#i', $_SERVER['SCRIPT_NAME']))
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

$plugin='fotoboxes';

global $co_author_folder;

$hjs .='<script src="' . $pth['folder']['plugins'] . $plugin . '/source/js-image-slider.js" type="text/javascript"></script>' . "\n";

// DEFINE DATA PATH

if(is_writable($plugin_cf['fotoboxes']['data_filepath']))
{
	$fotoboxesDataPath = $plugin_cf['fotoboxes']['data_filepath'];
}
else
{
	$fotoboxesDataPath = str_replace('./', $pth['folder']['base'], $plugin_cf['fotoboxes']['data_filepath']);
}


// CREATE GALLERIES ARRAY

if($fotoBoxesFoldersHandle = @opendir($fotoboxesDataPath))
{
	while($fotoBoxesGalleryFolder = readdir($fotoBoxesFoldersHandle))
	{
		if($fotoBoxesGalleryFolder != '.' && $fotoBoxesGalleryFolder != '..' && !strpos($fotoBoxesGalleryFolder, '.php'))
		{
			$fotoBoxesGalleryFolders[] = $fotoBoxesGalleryFolder;
			natcasesort($fotoBoxesGalleryFolders);
		}
	}
}

// ADD STYLING TO HEADER

$hjs.='<style type="text/css">' . "\n";

foreach($fotoBoxesGalleryFolders as $fotoBoxesStyle)
{
	if(file_exists($fotoboxesDataPath . $fotoBoxesStyle . '/data.php'))
	{
		include($fotoboxesDataPath . $fotoBoxesStyle . '/data.php');
		$hjs.='#FotoBoxSlide' . $fotoBoxesStyle . ' div.navBulletsWrapper {visibility: ' . @$fotoBoxesBullets . ';}' . "\n";
	}
}
$hjs.='</style>' . "\n";



/* 
#####################################
      FUNCTION "FOTOBOX SLIDE"
##################################### 
*/

function FotoBoxSlide($fotoboxes_gallery, $fotoboxes_width, $fotoboxes_height)
{
global $hjs, $plugin_cf, $pth, $fotoboxes_data, $fotoboxesDataPath, $co_author_folder;

if(!defined('CMSIMPLE_VERSION'))
{
	return '<p>This plugin requires <b>CMSimple 4.2</b> or higher.</p><p><a href="http://www.cmsimple.org/">CMSimple Download & Updates &raquo;</a></p>';
}

// for CoAuthors

if (isset($co_author_folder) && is_dir($pth['folder']['base'] . $co_author_folder . str_replace('./', '', $plugin_cf['fotoboxes']['data_filepath']) . $fotoboxes_gallery))
{
	$fotoboxesDataPath = $pth['folder']['base'] . $co_author_folder . str_replace('./', '', $plugin_cf['fotoboxes']['data_filepath']);
}
else
{
	if(is_writable($plugin_cf['fotoboxes']['data_filepath']))
	{
		$fotoboxesDataPath = $plugin_cf['fotoboxes']['data_filepath'];
	}
	else
	{
		$fotoboxesDataPath = str_replace('./', $pth['folder']['base'], $plugin_cf['fotoboxes']['data_filepath']);
	}
}

// create images array

if($fotoBoxesFilesHandle = @opendir($fotoboxesDataPath . $fotoboxes_gallery . '/'))
{
	while($fotoBoxesFile = readdir($fotoBoxesFilesHandle))
	{
		if(strstr($fotoBoxesFile,'.') && $fotoBoxesFile != '.' && $fotoBoxesFile != '..' && !strpos($fotoBoxesFile, '.php') && !strstr($fotoBoxesFile, 'aaa_bg'))
		{
			$fotoBoxesFiles[] = $fotoBoxesFile;
			sort($fotoBoxesFiles);
		}
	}
}  

// include data.php

if(file_exists($fotoboxesDataPath . $fotoboxes_gallery . '/data.php'))
{
	include($fotoboxesDataPath . $fotoboxes_gallery . '/data.php');
}

// include JS depending of existing data.php

if(file_exists($fotoboxesDataPath . $fotoboxes_gallery . '/data.php'))
{
	$fotoboxes_output ='
<script type="text/javascript">
//<![CDATA[
var sliderOptionsFotoBoxSlide' . $fotoboxes_gallery . '=
{
	sliderId: "FotoBoxSlide' . $fotoboxes_gallery . '",
	effect: "' . $fotoBoxesEffect . '",
	effectRandom: ' . $fotoBoxesEffectRandom . ',
	pauseTime: ' . $fotoBoxesPauseTime . ',
	transitionTime: ' . $fotoBoxesTransitionTime . ',
	slices: 12,
	boxes: 8,
	hoverPause: ' . $fotoBoxesHoverPause . ',
	autoAdvance: true,
	captionOpacity: ' . $fotoBoxesCaptionOpacity . ',
	captionEffect: "' . $fotoBoxesCaptionEffect . '",
	thumbnailsWrapperId: "thumbs",
	m: false,
	license: "mylicense"
};

var imageSliderFotoBoxSlide' . $fotoboxes_gallery . '=new mcImgSlider(sliderOptionsFotoBoxSlide' . $fotoboxes_gallery . ');
//]]>
</script>';
}
else
{
	$fotoboxes_output ='
<script type="text/javascript">
//<![CDATA[
var sliderOptionsFotoBoxSlide' . $fotoboxes_gallery . '=
{
	sliderId: "FotoBoxSlide' . $fotoboxes_gallery . '",
	effect: "13",
	effectRandom: false,
	pauseTime: 3000,
	transitionTime: 900,
	slices: 12,
	boxes: 8,
	hoverPause: true,
	autoAdvance: true,
	captionOpacity: 0.6,
	captionEffect: "fade",
	thumbnailsWrapperId: "thumbs",
	m: false,
	license: "mylicense"
};

var imageSliderFotoBoxSlide' . $fotoboxes_gallery . '=new mcImgSlider(sliderOptionsFotoBoxSlide' . $fotoboxes_gallery . ');
//]]>
</script>';
}

// content output

if(isset($fotoboxesCss))
{
	$fotoboxes_output .="\n" . '<div class="fotoboxes_container" style="width: ' . ($fotoboxes_width + (2 * $fotoBoxesImageBorderWidth)) . 'px; ' . $fotoboxesCss . '">' . "\n";
}
else
{
	$fotoboxes_output .="\n" . '<div class="fotoboxes_container" style="width: ' . ($fotoboxes_width + (2 * @$fotoBoxesImageBorderWidth)) . 'px; border: 0;">' . "\n";
}

$fotoboxes_output .='<div style="border: ' . @$fotoBoxesImageBorderWidth . 'px ' . @$fotoBoxesImageBorderStyle . ' ' . @$fotoBoxesImageBorderColor . ';">' . "\n";

$fotoboxes_output .='<div id="FotoBoxSlide' . $fotoboxes_gallery . '" style="width: ' . $fotoboxes_width . 'px; height: ' . $fotoboxes_height . 'px; background: url(loading.gif) no-repeat 50% 50%; position:relative; margin:0 auto;">' . "\n";

// create files array without file ending for image descriptions
foreach ($fotoBoxesFiles as $value)
{
	$fotoBoxesFileArray = explode('.', $value);
	$fotoBoxesImageCaption = str_replace('.' . array_pop($fotoBoxesFileArray), '',  $value);
	
	// link for image?
	if($fotoboxes_data[$fotoBoxesImageCaption]["link"] != '')
	{
		$fotoboxes_output.= '<a href="http://' . str_replace('http://', '', $fotoboxes_data[$fotoBoxesImageCaption]["link"]) . '">';
	}
	
	// show image description?
	if(@$fotoBoxesShowDesc == 'true')
	{
		$fotoboxes_output.=tag('img src="' . $fotoboxesDataPath . $fotoboxes_gallery . '/' . $value . '" alt="' . str_replace('"', '\'', stripslashes(@$fotoboxes_data[@$fotoBoxesImageCaption]['caption'])) . '"') . "\n";
	}
	else
	{
		$fotoboxes_output.=tag('img src="' . $fotoboxesDataPath . $fotoboxes_gallery . '/' . $value . '" alt=""') . "\n";
	}
	
	// link for image?
	if($fotoboxes_data[$fotoBoxesImageCaption]["link"] != '')
	{
		$fotoboxes_output.= '</a>';
	}
}

$fotoboxes_output .='</div>
</div>
</div>
<noscript>
<div style="text-align: center; font-weight: 700;">!!! JavaScript disabled !!!</div>
</noscript>
';

// END content output

	return $fotoboxes_output;
}



/* 
#####################################
     FUNCTION "FOTOBOX THUMBS"
##################################### 
*/

function FotoBoxThumbs($fotoboxes_gallery, $fotoboxes_width)
{
global $hjs, $plugin_cf, $pth, $sn, $su, $fotoboxes_data, $fotoboxesDataPath, $fotoboxesPic, $co_author_folder;

if(!defined('CMSIMPLE_VERSION'))
{
	return '<p>This plugin requires <b>CMSimple 4.2</b> or higher.</p><p><a href="http://www.cmsimple.org/">CMSimple Download & Updates &raquo;</a></p>';
}

// for CoAuthors

if (isset($co_author_folder) && is_dir($pth['folder']['base'] . $co_author_folder . str_replace('./', '', $plugin_cf['fotoboxes']['data_filepath']) . $fotoboxes_gallery))
{
	$fotoboxesDataPath = $pth['folder']['base'] . $co_author_folder . str_replace('./', '', $plugin_cf['fotoboxes']['data_filepath']);
}
else
{
	if(is_writable($plugin_cf['fotoboxes']['data_filepath']))
	{
		$fotoboxesDataPath = $plugin_cf['fotoboxes']['data_filepath'];
	}
	else
	{
		$fotoboxesDataPath = str_replace('./', $pth['folder']['base'], $plugin_cf['fotoboxes']['data_filepath']);
	}
}

// create images array

if($fotoBoxesFilesHandle = @opendir($fotoboxesDataPath . $fotoboxes_gallery . '/'))
{
	while($fotoBoxesFile = readdir($fotoBoxesFilesHandle))
	{
		if(strstr($fotoBoxesFile,'.') && $fotoBoxesFile != '.' && $fotoBoxesFile != '..' && !strpos($fotoBoxesFile, '.php') && !strstr($fotoBoxesFile, 'aaa_bg'))
		{
			$fotoBoxesFiles[] = $fotoBoxesFile;
			sort($fotoBoxesFiles);
		}
	}
} 

// include data.php

if(file_exists($fotoboxesDataPath . $fotoboxes_gallery . '/data.php'))
{
	include($fotoboxesDataPath . $fotoboxes_gallery . '/data.php');
}

// Main Container

$fotoboxes_gallery_output = "\n" . '<div id="FotoBoxThumbs' . $fotoboxes_gallery . '" style="width: ' . ($fotoboxes_width + (2 * $fotoBoxesThumbsImageBorderWidth)) . 'px; text-align: center; ' . $fotoboxesCssThumbs . '">';

// Main Image

$fotoBoxesRequestArray = explode('.', @$_REQUEST['fotoboxesPic']);
$fotoBoxesRequestDesc = '.' . array_pop($fotoBoxesRequestArray);

if(isset($_REQUEST['fotoboxesPic']) && strpos($_SERVER['QUERY_STRING'], $fotoboxes_gallery))
{
	// activate lightbox depending the settings
	if($fotoBoxesThumbsLightbox == 'true')
	{
		$fotoboxes_gallery_output.='
<a class="shutter" title="' . strip_tags(@$fotoboxes_data[str_replace($fotoBoxesRequestDesc, '', $_REQUEST['fotoboxesPic'])]['caption']) . '" href="' . $fotoboxesDataPath . $fotoboxes_gallery . '/' . $_REQUEST['fotoboxesPic'] . '">';
	}
	$fotoboxes_gallery_output.= "\n" . tag('img src="' . $fotoboxesDataPath . $fotoboxes_gallery . '/' . $_REQUEST['fotoboxesPic'] . '" style="width: ' . $fotoboxes_width . 'px; border: ' . $fotoBoxesThumbsImageBorderWidth . 'px ' . $fotoBoxesThumbsImageBorderStyle . ' ' . $fotoBoxesThumbsImageBorderColor . ';" alt="FotoBoxes"');
	if($fotoBoxesThumbsLightbox == 'true')
	{
		$fotoboxes_gallery_output.= "\n" . '</a>';
	}
}
else
{
	if($fotoBoxesThumbsLightbox == 'true')
	{
		$fotoboxes_gallery_output.='
<a class="shutter" title="' . @$fotoBoxesThumbsGalleryName . '" href="' . $fotoboxesDataPath . $fotoboxes_gallery . '/' . $fotoBoxesFiles[0] . '">';
	}
	$fotoboxes_gallery_output.= "\n" . tag('img src="' . $fotoboxesDataPath . $fotoboxes_gallery . '/' . $fotoBoxesFiles[0] . '" style="width: ' . $fotoboxes_width . 'px; border: ' . $fotoBoxesThumbsImageBorderWidth . 'px ' . $fotoBoxesThumbsImageBorderStyle . ' ' . $fotoBoxesThumbsImageBorderColor . ';" alt="FotoBoxes"');
	if($fotoBoxesThumbsLightbox == 'true')
	{
		$fotoboxes_gallery_output.= "\n" . '</a>';
	}
}

// Image description
$fbShortImageDesc = str_replace("\r\n",tag('br'),stripslashes(@$fotoboxes_data[str_replace($fotoBoxesRequestDesc, '', $_REQUEST['fotoboxesPic'])]['caption']));
$fbShortImageDesc = str_replace("\n\r",tag('br'),$fbShortImageDesc);
$fbShortImageDesc = str_replace("\n",tag('br'),$fbShortImageDesc);
$fbShortImageDesc = str_replace("\r",tag('br'),$fbShortImageDesc);
$fbShortImageDesc = strip_tags($fbShortImageDesc,'<b><br><a>');

if(isset($_REQUEST['fotoboxesPic']) && $fbShortImageDesc == '')
{
	$fbShortImageDesc = $_REQUEST['fotoboxesPic'];
}

if(@$fotoBoxesThumbsDesc == 'true')
{
	if(isset($_REQUEST['fotoboxesPic']) && strpos($_SERVER['QUERY_STRING'], $fotoboxes_gallery))
	{
	$fotoboxes_gallery_output.= "\n" . '<div class="fbThumbsShortDesc">' . 
	$fbShortImageDesc . '</div>';
	}
	else
	{
	$fotoboxes_gallery_output.= "\n" . '<div class="fbThumbsShortDesc">' . 
	@$fotoBoxesThumbsGalleryName . '</div>';
	}
}

//Thumbs
$fotoboxes_gallery_output.= "\n" . '<div id="FotoBoxThumbsThumbs' . $fotoboxes_gallery . '" style="width: ' . ($fotoboxes_width + 1) . 'px; padding: 0; margin: 0 auto;">' . "\n";

foreach($fotoBoxesFiles as $fotoBoxesFile)
{
	$fotoboxes_gallery_output.= '<a href="?' . $su . '&amp;fotoboxesGallery=' . $fotoboxes_gallery . '&amp;fotoboxesPic=' . $fotoBoxesFile . '#FotoBoxThumbs' . $fotoboxes_gallery . '">';
	$fotoboxes_gallery_output.= tag('img src="' . $fotoboxesDataPath . $fotoboxes_gallery . '/' . $fotoBoxesFile . '" style="width: ' . (($fotoboxes_width * (1 / $fotoBoxesThumbsNumberOf)) - 6) . 'px; float: left; border: 1px solid ' . $fotoBoxesThumbsThumbsBorderColor . '; margin: 2px;" alt=""');
$fotoboxes_gallery_output.='</a>
';
}

$fotoboxes_gallery_output.= '</div>' . "\n";

$fotoboxes_gallery_output.= '<div style="clear: both;"></div>
</div>
';

return $fotoboxes_gallery_output;
}



/* 
#####################################
     FUNCTION "FOTOBOX THUMBS JS"
##################################### 
*/

function FotoBoxThumbsJS($fotoboxes_gallery, $fotoboxes_width)
{
global $hjs, $plugin_cf, $pth, $sn, $su, $fotoboxes_data, $fotoboxesDataPath, $fotoboxesPic, $co_author_folder;

if(!defined('CMSIMPLE_VERSION'))
{
	return '<p>This plugin requires <b>CMSimple 4.2</b> or higher.</p><p><a href="http://www.cmsimple.org/">CMSimple Download & Updates &raquo;</a></p>';
}

// for CoAuthors

if (isset($co_author_folder) && is_dir($pth['folder']['base'] . $co_author_folder . str_replace('./', '', $plugin_cf['fotoboxes']['data_filepath']) . $fotoboxes_gallery))
{
	$fotoboxesDataPath = $pth['folder']['base'] . $co_author_folder . str_replace('./', '', $plugin_cf['fotoboxes']['data_filepath']);
}
else
{
	if(is_writable($plugin_cf['fotoboxes']['data_filepath']))
	{
		$fotoboxesDataPath = $plugin_cf['fotoboxes']['data_filepath'];
	}
	else
	{
		$fotoboxesDataPath = str_replace('./', $pth['folder']['base'], $plugin_cf['fotoboxes']['data_filepath']);
	}
}

// create images array

if($fotoBoxesFilesHandle = @opendir($fotoboxesDataPath . $fotoboxes_gallery . '/'))
{
	while($fotoBoxesFile = readdir($fotoBoxesFilesHandle))
	{
		if(strstr($fotoBoxesFile,'.') && $fotoBoxesFile != '.' && $fotoBoxesFile != '..' && !strpos($fotoBoxesFile, '.php') && !strstr($fotoBoxesFile, 'aaa_bg'))
		{
			$fotoBoxesFiles[] = $fotoBoxesFile;
			sort($fotoBoxesFiles);
		}
	}
} 

// include data.php

if(file_exists($fotoboxesDataPath . $fotoboxes_gallery . '/data.php'))
{
	include($fotoboxesDataPath . $fotoboxes_gallery . '/data.php');
}

// Main Container

$fotoboxes_gallery_output = "\n" . '<div id="FotoBoxThumbsJS' . $fotoboxes_gallery . '" style="width: ' . ($fotoboxes_width + (2 * $fotoBoxesThumbsImageBorderWidth)) . 'px; text-align: center; ' . $fotoboxesCssThumbs . '">';

// Main Image

$fotoBoxesRequestArray = explode('.', @$_REQUEST['fotoboxesPic']);
$fotoBoxesRequestDesc = '.' . array_pop($fotoBoxesRequestArray);

if(isset($_REQUEST['fotoboxesPic']) && strpos($_SERVER['QUERY_STRING'], $fotoboxes_gallery))
{
	$fotoboxes_gallery_output.= "\n" . tag('img id="FotoBoxThumbsJS' . $fotoboxes_gallery . 'MainImage" src="' . $fotoboxesDataPath . $fotoboxes_gallery . '/' . $_REQUEST['fotoboxesPic'] . '" style="width: ' . $fotoboxes_width . 'px; border: ' . $fotoBoxesThumbsImageBorderWidth . 'px ' . $fotoBoxesThumbsImageBorderStyle . ' ' . $fotoBoxesThumbsImageBorderColor . ';" alt="FotoBoxes"');
}
else
{
	$fotoboxes_gallery_output.= "\n" . tag('img id="FotoBoxThumbsJS' . $fotoboxes_gallery . 'MainImage" src="' . $fotoboxesDataPath . $fotoboxes_gallery . '/' . $fotoBoxesFiles[0] . '" style="width: ' . $fotoboxes_width . 'px; border: ' . $fotoBoxesThumbsImageBorderWidth . 'px ' . $fotoBoxesThumbsImageBorderStyle . ' ' . $fotoBoxesThumbsImageBorderColor . ';" alt="FotoBoxes"');
}

// Gallery name
if(@$fotoBoxesThumbsDesc == 'true')
{
	$fotoboxes_gallery_output.= "\n" . '<p style="text-align: center; padding: 0; margin: 6px 0 12px 0;">' . 
	@$fotoBoxesThumbsGalleryName . '</p>';
}

//Thumbs
$fotoboxes_gallery_output.= "\n" . '<div id="FotoBoxThumbsJSThumbs' . $fotoboxes_gallery . '" style="width: ' . ($fotoboxes_width + 1) . 'px; padding: 0; margin: 0 auto;">' . "\n";

foreach($fotoBoxesFiles as $fotoBoxesFile)
{
	$fotoboxes_gallery_output.= '<a href="?' . $su . '&amp;fotoboxesGallery=' . $fotoboxes_gallery . '&amp;fotoboxesPic=' . $fotoBoxesFile . '#' . $fotoboxes_gallery . 'Thumbs">
';
	$fotoboxes_gallery_output.= tag('img onclick="document.getElementById(\'FotoBoxThumbsJS' . $fotoboxes_gallery . 'MainImage\').src = \'' . $fotoboxesDataPath . $fotoboxes_gallery . '/' . $fotoBoxesFile . '\'; return false" src="' . $fotoboxesDataPath . $fotoboxes_gallery . '/' . $fotoBoxesFile . '" style="width: ' . (($fotoboxes_width * (1 / $fotoBoxesThumbsNumberOf)) - 6) . 'px; float: left; border: 1px solid ' . $fotoBoxesThumbsThumbsBorderColor . '; margin: 2px;" alt=""');
	
$fotoboxes_gallery_output.='
</a>
';
}

$fotoboxes_gallery_output.= '</div>' . "\n";

$fotoboxes_gallery_output.= '<div style="clear: both;"></div>
</div>
';

return $fotoboxes_gallery_output;
}



/* 
#####################################
       FOTOBOX FlexSlider
##################################### 
*/

// fade
$hjs.= '
<script type="text/javascript">
$(window).load(function() {
$(\'.fade\').flexslider({
slideshowSpeed: ' . $plugin_cf['fotoboxes']['flexslider_slideshow_speed'] . ',
animationSpeed: ' . $plugin_cf['fotoboxes']['flexslider_animation_speed'] . ', 
animation: "fade",
pauseOnAction: false,
pauseOnHover: ' . $plugin_cf['fotoboxes']['flexslider_pauseOnHover'] . ',' . "\n";

if($plugin_cf['fotoboxes']['flexslider_arrow_nav'] == 'true')
{
	$hjs.= 'directionNav: true,' . "\n";
}
else
{
	$hjs.= 'directionNav: false,' . "\n";
}

if($plugin_cf['fotoboxes']['flexslider_bullit_nav'] == 'true')
{
	$hjs.= 'controlNav: true,' . "\n";
}
else
{
	$hjs.= 'controlNav: false,' . "\n";
}

$hjs.= 'direction: "horizontal",
reverse: false,
prevText: "",
nextText: ""
});
});
</script>

';

// slide
$hjs.= '
<script type="text/javascript">
$(window).load(function() {
$(\'.slide\').flexslider({
slideshowSpeed: ' . $plugin_cf['fotoboxes']['flexslider_slideshow_speed'] . ',
animationSpeed: ' . $plugin_cf['fotoboxes']['flexslider_animation_speed'] . ', 
animation: "slide",
pauseOnAction: false,
pauseOnHover: ' . $plugin_cf['fotoboxes']['flexslider_pauseOnHover'] . ',' . "\n";

if($plugin_cf['fotoboxes']['flexslider_arrow_nav'] == 'true')
{
	$hjs.= 'directionNav: true,' . "\n";
}
else
{
	$hjs.= 'directionNav: false,' . "\n";
}

if($plugin_cf['fotoboxes']['flexslider_bullit_nav'] == 'true')
{
	$hjs.= 'controlNav: true,' . "\n";
}
else
{
	$hjs.= 'controlNav: false,' . "\n";
}

$hjs.= 'direction: "horizontal",
reverse: false,
prevText: "",
nextText: ""
});
});
</script>

';

include_once($pth['folder']['plugins'].'jquery/jquery.inc.php');
include_jQuery();
include_jQueryPlugin('flexslider-min', $pth['folder']['plugins'].'fotoboxes/source/jquery.flexslider-min.js');

function FotoBoxFS($fs_folder, $fs_maxwidth='640px',$fs_effect='fade',$fs_description='')
{
	global $plugin_cf,$plugin_tx,$hjs,$pth,$fotoboxesDataPath,$fotoboxes_data;
	
	if(!defined('CMSIMPLE_VERSION'))
	{
		return '<p>This plugin requires <b>CMSimple 4.2</b> or higher.</p><p><a href="http://www.cmsimple.org/">CMSimple Download & Updates &raquo;</a></p>';
	}
	
	// for CoAuthors

	if (isset($co_author_folder) && is_dir($pth['folder']['base'] . $co_author_folder . str_replace('./', '', $plugin_cf['fotoboxes']['data_filepath']) . $fs_folder))
	{
		$fotoboxesDataPath = $pth['folder']['base'] . $co_author_folder . str_replace('./', '', $plugin_cf['fotoboxes']['data_filepath']);
	}
	else
	{
		if(is_writable($plugin_cf['fotoboxes']['data_filepath']))
		{
			$fotoboxesDataPath = $plugin_cf['fotoboxes']['data_filepath'];
		}
		else
		{
			$fotoboxesDataPath = str_replace('./', $pth['folder']['base'], $plugin_cf['fotoboxes']['data_filepath']);
		}
	}
	
	$fs_images = '';

	// include data.php

	if(file_exists($fotoboxesDataPath . $fs_folder . '/data.php'))
	{
		include($fotoboxesDataPath . $fs_folder . '/data.php');
	}
	
	// create images array

	if($fsFilesHandle = @opendir($fotoboxesDataPath . $fs_folder . '/'))
	{
		while($fsFile = readdir($fsFilesHandle))
		{
			if(strstr($fsFile,'.') && $fsFile != '.' && $fsFile != '..' && !strpos($fsFile, '.php') && !strstr($fsFile, 'aaa_bg'))
			{
				$fsFiles[] = $fsFile;
				sort($fsFiles);
			}
		}
	}

	foreach ($fsFiles as $fsFile) 
	{
		$fsFileArray = explode('.', $fsFile);
		$fsFileEnding = array_pop($fsFileArray);
		$fsFileName = implode($fsFileArray);
		
		$fsFileCaption = $fotoboxes_data[$fsFileName]["caption"];
		$fsFileLink = $fotoboxes_data[$fsFileName]["link"];
		
		$fs_images.= "\n<li>";
		
		if($fsFileLink != '') 
		{
			$fs_images.='<a href="http://' . $fsFileLink . '">';
		}
		
		$fs_images.= tag('img src="./userfiles/plugins/fotoboxes/' . $fs_folder . '/' . $fsFile . '" alt=""');
		
		if($fotoboxes_data[str_replace('.jpg','',$fsFile)]["link"]) 
		{
			$fs_images.='</a>';
		}
		
		if($fs_description == 'title')
		{
			$fs_images.= '<p class="flex-caption">' . $fsFileCaption . '</p>';
		}
		$fs_images.= '</li>';
	}
	
	
	
	if($fs_effect == 'fade')
	{
		$fs_output = '
<table class="fotoBoxesFS">
  <tr>
    <td>
<div class="fade" style="max-width: ' . $fs_maxwidth . '; ' . $fotoboxesCss . '">
<ul class="slides">' . $fs_images . '
</ul>
</div>
    </td>
  </tr>
</table>
';
	}
	else
	{
		$fs_output = '
<div class="fotoBoxesFS">
<div class="slide" style="max-width: ' . $fs_maxwidth . '; ' . $fotoboxesCss . '">
<ul class="slides">' . $fs_images . '
</ul>
</div>
</div>
';
	}

	return $fs_output;
}



/* 
#####################################
         MiniSliderControl
##################################### 
*/
function FotoBoxMS($gallery,$maxWidth='640px',$ms_effect='fade',$ms_imagelink='')
{
	global $plugin_cf,$plugin_tx,$hjs,$pth,$fotoboxesDataPath,$fotoboxes_data;
	
	if(!defined('CMSIMPLE_VERSION'))
	{
		return '<p>This plugin requires <b>CMSimple 4.2</b> or higher.</p><p><a href="http://www.cmsimple.org/">CMSimple Download & Updates &raquo;</a></p>';
	}
	
	// for CoAuthors

	if (isset($co_author_folder) && is_dir($pth['folder']['base'] . $co_author_folder . str_replace('./', '', $plugin_cf['fotoboxes']['data_filepath']) . $gallery))
	{
		$fotoboxesDataPath = $pth['folder']['base'] . $co_author_folder . str_replace('./', '', $plugin_cf['fotoboxes']['data_filepath']);
	}
	else
	{
		if(is_writable($plugin_cf['fotoboxes']['data_filepath']))
		{
			$fotoboxesDataPath = $plugin_cf['fotoboxes']['data_filepath'];
		}
		else
		{
			$fotoboxesDataPath = str_replace('./', $pth['folder']['base'], $plugin_cf['fotoboxes']['data_filepath']);
		}
	}
	
	// include data.php
	
	if(file_exists($fotoboxesDataPath . $gallery . '/data.php'))
	{
		include($fotoboxesDataPath . $gallery . '/data.php');
	}

	// create images array

	if($miniSliderFilesHandle = @opendir($fotoboxesDataPath . $gallery . '/'))
	{
		while($miniSliderFile = readdir($miniSliderFilesHandle))
		{
			if(strstr($miniSliderFile,'.') && $miniSliderFile != '.' && $miniSliderFile != '..' && !strpos($miniSliderFile, '.php') && !strstr($miniSliderFile, 'aaa_bg'))
			{
				$miniSliderFiles[] = $miniSliderFile;
				sort($miniSliderFiles);
			}
		}
	}

	$miniSliderOutput = '
<div class="miniSliderContainer" style="min-width: 160px; max-width: ' . $maxWidth . '">
<div class="miniSliderContainerInner" style="' . $fotoboxesCss . '">
<div class="miniSliderSlideshow_' . $gallery . ' miniSliderSlideshow">

<p class="controls">';

	if(file_exists($fotoboxesDataPath . $gallery . '/buttons/start.gif'))
	{
		$miniSliderOutput.= "\n" . 
		tag('img src="'. $fotoboxesDataPath . $gallery . '/buttons/prev.gif" class="prev_' . $gallery . '" alt=""') . "\n" . 
		tag('img src="'. $fotoboxesDataPath . $gallery . '/buttons/start.gif" class="start_' . $gallery . '" alt=""') . "\n" . 
		tag('img src="'. $fotoboxesDataPath . $gallery . '/buttons/stop.gif" class="stop_' . $gallery . '" alt=""') . "\n" . 
		tag('img src="'. $fotoboxesDataPath . $gallery . '/buttons/next.gif" class="next_' . $gallery . '" alt=""') . "\n";
	}
	else
	{
		$miniSliderOutput.= "\n" . 
		tag('img src="' . $pth['folder']['base'] . 'plugins/fotoboxes/buttons/prev.gif" class="prev_' . $gallery . '" alt=""') . "\n" . 
		tag('img src="' . $pth['folder']['base'] . 'plugins/fotoboxes/buttons/start.gif" class="start_' . $gallery . '" alt=""') . "\n" . 
		tag('img src="' . $pth['folder']['base'] . 'plugins/fotoboxes/buttons/stop.gif" class="stop_' . $gallery . '" alt=""') . "\n" . 
		tag('img src="' . $pth['folder']['base'] . 'plugins/fotoboxes/buttons/next.gif" class="next_' . $gallery . '" alt=""') . "\n";
	}


$miniSliderOutput.= '</p>

<p class="background_' . $gallery . ' background">' . "\n";

	if($ms_imagelink == 'imagelink')
	{
		$miniSliderOutput.= '<a href="' . $fotoboxesDataPath . $gallery . '/aaa_bg.jpg" class="shutterset_' . $gallery . '">';
	} 
	
	$miniSliderOutput.=tag('img src="' . $fotoboxesDataPath . $gallery . '/aaa_bg.jpg" alt=""');

	if($ms_imagelink == 'imagelink')
	{
		$miniSliderOutput.= '</a>
';
	} 

	$miniSliderOutput.='<span class="spacer">&nbsp;</span>
<span class="desc_' . $gallery . ' desc">' . count($miniSliderFiles) . ' ' . $plugin_tx['fotoboxes']['minislider_images'] . '</span>
<span class="count_' . $gallery . ' count">' . $plugin_tx['fotoboxes']['minislider_gallery_images'] . '</span>
</p>
';

	foreach ($miniSliderFiles as $key => $value)
	{
		if(function_exists('str_ireplace'))
		{
			$msFileCaption = $fotoboxes_data[str_ireplace('.jpg','',$value)]["caption"];
			if($fotoboxes_data[str_ireplace('.jpg','',$value)]["caption"] == '')
			{
				$msFileCaption = $value;
			}
		}
		else
		{
			$msFileCaption = $fotoboxes_data[str_replace('.jpg','',$value)]["caption"];
			if($fotoboxes_data[str_replace('.jpg','',$value)]["caption"] == '')
			{
				$msFileCaption = $value;
			}
		}
		
		if(!strstr($value,'aaa_bg'))
		{
			if($ms_effect == 'fade')
			{
				$miniSliderOutput.= '
<div class="item_' . $gallery . '" style="position: absolute; opacity: 0; transition: ' . $fotoBoxesTransitionTime . 'ms opacity ease-in-out;">
';
			}
			else
			{
				$miniSliderOutput.= '
<div class="item_' . $gallery . '" style="position: absolute; margin: 0 -300% 0 300%; transition: ' . $fotoBoxesTransitionTime . 'ms margin ease-in-out;">
';
			}

			if($ms_imagelink == 'imagelink')
			{
				$miniSliderOutput.= '<a href="' . $fotoboxesDataPath . $gallery . '/' . $value . '" class="shutterset_' . $gallery . '">';
			}

			$miniSliderOutput.= tag('img src="' . $fotoboxesDataPath . $gallery . '/' . $value . '" alt=""');

			if($ms_imagelink == 'imagelink')
			{
				$miniSliderOutput.= '</a>';
			}

			$miniSliderOutput.= '
<p class="spacer">&nbsp;</p>
<p class="description">' . $msFileCaption . '</p>
<p class="description">' . $plugin_tx['fotoboxes']['minislider_image'] . 
' ' . ($key + 1) . '/' . count($miniSliderFiles) . '</p>
</div>
';
		}
	}

$miniSliderOutput.= '
</div>
</div>
';

	if($ms_effect == 'fade')
	{
		$miniSliderOutput.= '
<script type="text/javascript">
(
	function(document)
	{
		$items_' . $gallery . ' = document.querySelectorAll(".miniSliderSlideshow_' . $gallery . ' div"), // a collection of all of the slides, caching for performance
		numItems_' . $gallery . ' = $items_' . $gallery . '.length; // total number of slides
		var counter_' . $gallery . ' = numItems_' . $gallery . '*100-1; // to keep track of current slide

		// this function manages the slides, defines the active image and changes its CSS properties 
		
		var showCurrent_' . $gallery . ' = function()
		{
			var itemToShow_' . $gallery . ' = Math.abs(counter_' . $gallery . '%numItems_' . $gallery . ');

			// manipulate CSS properties
			[].forEach.call($items_' . $gallery . ', function(el) {el.style.position = "absolute"; el.style.opacity = "0";});
			$items_' . $gallery . '[itemToShow_' . $gallery . '].style.position = "relative"; 
			$items_' . $gallery . '[itemToShow_' . $gallery . '].style.opacity = "1";
		};
		
		document.querySelector(".stop_' . $gallery . '").style.display = "none"; 
		
		document.querySelector(".miniSliderSlideshow_' . $gallery . '").style.position = "relative";
		document.querySelector(".miniSliderSlideshow_' . $gallery . '").style.display = "block";
		document.querySelector(".miniSliderSlideshow_' . $gallery . '").style.overflow = "hidden";
		
		document.querySelector(".background_' . $gallery . '").style.position = "relative";

		// click events for prev, next, start and stop buttons 
		
		document.querySelector(".prev_' . $gallery . '").addEventListener
		(
			"click", function() 
			{
				document.querySelector(".count_' . $gallery . '").style.display = "none"; 
				document.querySelector(".desc_' . $gallery . '").style.display = "none"; 
				document.querySelector(".background_' . $gallery . '").style.display = "none"; 
				document.querySelector(".stop_' . $gallery . '").style.display = "none"; 
				document.querySelector(".start_' . $gallery . '").style.display = "inline"; 
				counter_' . $gallery . '--; 
				showCurrent_' . $gallery . '();
				window.clearInterval(slideshow_' . $gallery . ');
			}, false
		);
		
		document.querySelector(".next_' . $gallery . '").addEventListener
		(
			"click", function() 
			{
				document.querySelector(".count_' . $gallery . '").style.display = "none"; 
				document.querySelector(".desc_' . $gallery . '").style.display = "none"; 
				document.querySelector(".background_' . $gallery . '").style.display = "none"; 
				document.querySelector(".stop_' . $gallery . '").style.display = "none"; 
				document.querySelector(".start_' . $gallery . '").style.display = "inline"; 
				counter_' . $gallery . '++; 
				showCurrent_' . $gallery . '();
				window.clearInterval(slideshow_' . $gallery . ');
			}, false
		);
		
		document.querySelector(".start_' . $gallery . '").addEventListener
		("click", function() 
			{
				document.querySelector(".count_' . $gallery . '").style.display = "none"; 
				document.querySelector(".desc_' . $gallery . '").style.display = "none"; 
				document.querySelector(".background_' . $gallery . '").style.display = "none"; 
				document.querySelector(".start_' . $gallery . '").style.display = "none"; 
				document.querySelector(".stop_' . $gallery . '").style.display = "inline"; 
				counter_' . $gallery . '++; 
				showCurrent_' . $gallery . '(); 
				slideshow_' . $gallery . ' = window.setInterval(function() {counter_' . $gallery . '++; showCurrent_' . $gallery . '();}, ' . $fotoBoxesPauseTime . ');
			}, false
		);

		document.querySelector(".stop_' . $gallery . '").addEventListener
		(
			"click", function() 
			{
				document.querySelector(".count_' . $gallery . '").style.display = "none"; 
				document.querySelector(".desc_' . $gallery . '").style.display = "none"; 
				document.querySelector(".background_' . $gallery . '").style.display = "none"; 
				document.querySelector(".stop_' . $gallery . '").style.display = "none"; 
				document.querySelector(".start_' . $gallery . '").style.display = "inline"; 
				window.clearInterval(slideshow_' . $gallery . ');
			}, false
		);
	}
)

(document); 
</script>
';
	}

	if($ms_effect == 'slide')
	{
		$miniSliderOutput.= '
<script type="text/javascript">
(
	function(document)
	{
		$items_' . $gallery . ' = document.querySelectorAll(".miniSliderSlideshow_' . $gallery . ' div"), // a collection of all of the slides, caching for performance
		numItems_' . $gallery . ' = $items_' . $gallery . '.length; // total number of slides
		var counter_' . $gallery . ' = numItems_' . $gallery . '*100-1; // to keep track of current slide

		// this function manages the slides, defines the active image and changes its CSS properties 

		var showCurrent_' . $gallery . ' = function()
		{
			var itemToShow_' . $gallery . ' = Math.abs(counter_' . $gallery . '%numItems_' . $gallery . ');

			// manipulate CSS properties
			[].forEach.call($items_' . $gallery . ', function(el) {el.style.position = "absolute"; el.style.margin = "0 -300% 0 300%";});
			$items_' . $gallery . '[itemToShow_' . $gallery . '].style.position = "relative"; 
			$items_' . $gallery . '[itemToShow_' . $gallery . '].style.margin = "0";
		};
		
		document.querySelector(".stop_' . $gallery . '").style.display = "none"; 
		
		document.querySelector(".miniSliderSlideshow_' . $gallery . '").style.position = "relative";
		document.querySelector(".miniSliderSlideshow_' . $gallery . '").style.display = "block";
		document.querySelector(".miniSliderSlideshow_' . $gallery . '").style.overflow = "hidden";
		
		document.querySelector(".background_' . $gallery . '").style.position = "relative";

		// click events for prev, next, start and stop buttons

		document.querySelector(".prev_' . $gallery . '").addEventListener
		("click", function() 
			{
				document.querySelector(".count_' . $gallery . '").style.display = "none"; 
				document.querySelector(".desc_' . $gallery . '").style.display = "none"; 
				document.querySelector(".background_' . $gallery . '").style.position = "absolute";
				document.querySelector(".stop_' . $gallery . '").style.display = "none"; 
				document.querySelector(".start_' . $gallery . '").style.display = "inline"; 
				counter_' . $gallery . '--; 
				showCurrent_' . $gallery . '(); 
				window.clearInterval(slideshow_' . $gallery . ');
			}, false
		);

		document.querySelector(".start_' . $gallery . '").addEventListener
		("click", function() 
			{

				document.querySelector(".count_' . $gallery . '").style.display = "none"; 
				document.querySelector(".desc_' . $gallery . '").style.display = "none"; 
				document.querySelector(".background_' . $gallery . '").style.position = "absolute"; 
				document.querySelector(".stop_' . $gallery . '").style.display = "inline"; 
				document.querySelector(".start_' . $gallery . '").style.display = "none"; 
				counter_' . $gallery . '++; 
				showCurrent_' . $gallery . '(); 
				slideshow_' . $gallery . ' = window.setInterval(function() {counter_' . $gallery . '++; showCurrent_' . $gallery . '();}, ' . $fotoBoxesPauseTime . ');
			}, false
		);

		document.querySelector(".stop_' . $gallery . '").addEventListener
		(
			"click", function() 
			{
				
				document.querySelector(".count_' . $gallery . '").style.display = "none"; document.querySelector(".desc_' . $gallery . '").style.display = "none"; 
				document.querySelector(".background_' . $gallery . '").style.position = "absolute"; 
				document.querySelector(".stop_' . $gallery . '").style.display = "none"; 
				document.querySelector(".start_' . $gallery . '").style.display = "inline"; 
				window.clearInterval(slideshow_' . $gallery . '); 
			}, false
		);

		document.querySelector(".next_' . $gallery . '").addEventListener
		("click", function() 
			{
				document.querySelector(".count_' . $gallery . '").style.display = "none"; 
				document.querySelector(".desc_' . $gallery . '").style.display = "none"; 
				document.querySelector(".background_' . $gallery . '").style.position = "absolute";
				document.querySelector(".stop_' . $gallery . '").style.display = "none"; 
				document.querySelector(".start_' . $gallery . '").style.display = "inline"; 
				counter_' . $gallery . '++; 
				showCurrent_' . $gallery . '(); 
				window.clearInterval(slideshow_' . $gallery . ');
			}, false
		);
	}
)

(document);
</script>';
	}

$miniSliderOutput.='
<p style="padding: 10px 10px; text-align: right; font-size: 12px;"><a href="http://www.ge-webdesign.de/plugindemo/?Plugin_Demo_Seiten___FotoBoxes___Demo_MiniSlider">responsive miniSlider</a></p>
</div>
';

	return $miniSliderOutput;
}



/* 
######################################
           MiniSliderAuto
###################################### 
*/
function FotoBoxMSA($gallery,$maxWidth='640px',$msa_effect='fade',$desc='',$count='')
{
	global $plugin_cf,$plugin_tx,$hjs,$pth,$fotoboxesDataPath,$fotoboxes_data;
	
	if(!defined('CMSIMPLE_VERSION'))
	{
		return '<p>This plugin requires <b>CMSimple 4.2</b> or higher.</p><p><a href="http://www.cmsimple.org/">CMSimple Download & Updates &raquo;</a></p>';
	}
	
	// for CoAuthors

	if (isset($co_author_folder) && is_dir($pth['folder']['base'] . $co_author_folder . str_replace('./', '', $plugin_cf['fotoboxes']['data_filepath']) . $gallery))
	{
		$fotoboxesDataPath = $pth['folder']['base'] . $co_author_folder . str_replace('./', '', $plugin_cf['fotoboxes']['data_filepath']);
	}
	else
	{
		if(is_writable($plugin_cf['fotoboxes']['data_filepath']))
		{
			$fotoboxesDataPath = $plugin_cf['fotoboxes']['data_filepath'];
		}
		else
		{
			$fotoboxesDataPath = str_replace('./', $pth['folder']['base'], $plugin_cf['fotoboxes']['data_filepath']);
		}
	}
	
	// include data.php
	
	if(file_exists($fotoboxesDataPath . $gallery . '/data.php'))
	{
		include($fotoboxesDataPath . $gallery . '/data.php');
	}

	// create images array

	if($miniSliderFilesHandle = @opendir($fotoboxesDataPath . $gallery . '/'))
	{
		while($miniSliderFile = readdir($miniSliderFilesHandle))
		{
			if(strstr($miniSliderFile,'.') && $miniSliderFile != '.' && $miniSliderFile != '..' && !strpos($miniSliderFile, '.php') && !strstr($miniSliderFile, 'aaa_bg'))
			{
				$miniSliderFiles[] = $miniSliderFile;
				sort($miniSliderFiles);
			}
		}
	}

	$miniSliderOutput = '
<div class="miniSliderContainer" style="min-width: 160px; max-width: ' . $maxWidth . '">
<div class="miniSliderContainerInner" style="' . $fotoboxesCss . '">
<div class="miniSliderSlideshow_' . $gallery . ' miniSliderSlideshow">
';

	$miniSliderOutput.= '
<p class="background_' . $gallery . ' background">' . "\n" . 
tag('img src="' . $fotoboxesDataPath . $gallery . '/aaa_bg.jpg" alt=""') . '
<span class="spacer">&nbsp;</span>
<span class="desc_' . $gallery . ' desc"></span>
<span class="count_' . $gallery . ' count">' . $plugin_tx['fotoboxes']['minislider_gallery_images'] . '</span>
</p>
';

	foreach ($miniSliderFiles as $key => $value)
	{
		if(function_exists('str_ireplace'))
		{
			$msFileCaption = $fotoboxes_data[str_ireplace('.jpg','',$value)]["caption"];
			if($fotoboxes_data[str_ireplace('.jpg','',$value)]["caption"] == '')
			{
				$msFileCaption = $value;
			}
			
			$msFileLink = $fotoboxes_data[str_ireplace('.jpg','',$value)]["link"];
		}
		else
		{
			$msFileCaption = $fotoboxes_data[str_replace('.jpg','',$value)]["caption"];
			if($fotoboxes_data[str_replace('.jpg','',$value)]["caption"] == '')
			{
				$msFileCaption = $value;
			}
			
			$msFileLink = $fotoboxes_data[str_replace('.jpg','',$value)]["link"];
		}
		
		if(!strstr($value,'aaa_bg'))
		{
			if($msa_effect == 'fade')
			{
				$miniSliderOutput.= '
<div class="item_' . $gallery . '" style="position: absolute; opacity: 0; transition: ' . $fotoBoxesTransitionTime . 'ms opacity ease-in-out;">
';
			}
			else
			{
				$miniSliderOutput.= '
<div class="item_' . $gallery . '" style="position: absolute; margin: 0 -300% 0 300%; transition: ' . $fotoBoxesTransitionTime . 'ms margin ease-in-out;">
';
			}

			// Images

			$miniSliderOutput.= tag('img src="' . $fotoboxesDataPath . $gallery . '/' . $value . '" alt=""') . "\n";

			// description and counter
			
			if($desc == 'title' || $count == 'count')
			{
				$miniSliderOutput.= '<p class="spacer">&nbsp;</p>
';
			}
			
			if($desc == 'title')
			{
				$miniSliderOutput.= '<p class="description">' . $msFileCaption . '</p>
';
			}

			if($count == 'count')
			{
				$miniSliderOutput.= '<p class="description">' . $plugin_tx['fotoboxes']['minislider_image'] . 
' ' . ($key + 1) . '/' . count($miniSliderFiles) . '</p>
';
			}

			$miniSliderOutput.= '</div>
';
		}
	}

$miniSliderOutput.= '
</div>
</div>
</div>
';


	if($msa_effect == 'fade')
	{
		$miniSliderOutput.= '
<script type="text/javascript">
(
	function(document)
	{
		$items_' . $gallery . ' = document.querySelectorAll(".miniSliderSlideshow_' . $gallery . ' div"), // a collection of all of the slides, caching for performance
		numItems_' . $gallery . ' = $items_' . $gallery . '.length; // total number of slides
		var counter_' . $gallery . ' = numItems_' . $gallery . '*100-1; // to keep track of current slide

		// this function manages the slides, defines the active image and changes its CSS properties 
		
		var showCurrent_' . $gallery . ' = function()
		{
			var itemToShow_' . $gallery . ' = Math.abs(counter_' . $gallery . '%numItems_' . $gallery . ');

			// manipulate CSS properties
			[].forEach.call($items_' . $gallery . ', function(el) {el.style.position = "absolute"; el.style.opacity = "0";});
			$items_' . $gallery . '[itemToShow_' . $gallery . '].style.position = "relative"; 
			$items_' . $gallery . '[itemToShow_' . $gallery . '].style.opacity = "1";
		};
		
		document.querySelector(".miniSliderSlideshow_' . $gallery . '").style.position = "relative";
		document.querySelector(".miniSliderSlideshow_' . $gallery . '").style.display = "block";
		document.querySelector(".miniSliderSlideshow_' . $gallery . '").style.overflow = "hidden";

		document.querySelector(".background_' . $gallery . '").style.display = "none"; 
		counter_' . $gallery . '++; 
		showCurrent_' . $gallery . '(); 
		slideshow_' . $gallery . ' = window.setInterval(function() {counter_' . $gallery . '++; showCurrent_' . $gallery . '();}, ' . $fotoBoxesPauseTime . ');
		
		//stop and start slideshow by mouseover and mouseout

		document.querySelector(".miniSliderSlideshow_' . $gallery . '").addEventListener
		("mouseover", function() 
			{
				window.clearInterval(slideshow_' . $gallery . ');
			}, false
		);
		
		document.querySelector(".miniSliderSlideshow_' . $gallery . '").addEventListener
		("mouseout", function() 
			{
				slideshow_' . $gallery . ' = window.setInterval(function() {counter_' . $gallery . '++; showCurrent_' . $gallery . '();}, ' . $fotoBoxesPauseTime . ');
			}, false
		);
		
		document.querySelector(".miniSliderSlideshow_' . $gallery . '").addEventListener
		("click", function() 
			{
				counter_' . $gallery . '++; 
				showCurrent_' . $gallery . '(); 
			}, false
		);
	}
)

(document); 
</script>
';
	}


	if($msa_effect == 'slide')
	{
		$miniSliderOutput.= '
<script type="text/javascript">
(
	function(document)
	{
		$items_' . $gallery . ' = document.querySelectorAll(".miniSliderSlideshow_' . $gallery . ' div"), // a collection of all of the slides, caching for performance
		numItems_' . $gallery . ' = $items_' . $gallery . '.length; // total number of slides
		var counter_' . $gallery . ' = numItems_' . $gallery . '*100-1; // to keep track of current slide

		// this function manages the slides, defines the active image and changes its CSS properties 

		var showCurrent_' . $gallery . ' = function()
		{
			var itemToShow_' . $gallery . ' = Math.abs(counter_' . $gallery . '%numItems_' . $gallery . ');

			// manipulate CSS properties
			[].forEach.call($items_' . $gallery . ', function(el) {el.style.position = "absolute"; el.style.margin = "0 -300% 0 300%";});
			$items_' . $gallery . '[itemToShow_' . $gallery . '].style.position = "relative"; 
			$items_' . $gallery . '[itemToShow_' . $gallery . '].style.margin = "0";
		};
		
		
		document.querySelector(".miniSliderSlideshow_' . $gallery . '").style.position = "relative";
		document.querySelector(".miniSliderSlideshow_' . $gallery . '").style.display = "block";
		document.querySelector(".miniSliderSlideshow_' . $gallery . '").style.overflow = "hidden";

		document.querySelector(".count_' . $gallery . '").style.display = "none"; 
		document.querySelector(".desc_' . $gallery . '").style.display = "none"; 
		document.querySelector(".background_' . $gallery . '").style.position = "absolute"; 
		counter_' . $gallery . '++; 
		showCurrent_' . $gallery . '(); 
		slideshow_' . $gallery . ' = window.setInterval(function() {counter_' . $gallery . '++; showCurrent_' . $gallery . '();}, ' . $fotoBoxesPauseTime . ');

		//stop and start slideshow by mouseover and mouseout

		document.querySelector(".miniSliderSlideshow_' . $gallery . '").addEventListener
		("mouseover", function() 
			{
				window.clearInterval(slideshow_' . $gallery . ');
			}, false
		);
		
		document.querySelector(".miniSliderSlideshow_' . $gallery . '").addEventListener
		("mouseout", function() 
			{
				slideshow_' . $gallery . ' = window.setInterval(function() {counter_' . $gallery . '++; showCurrent_' . $gallery . '();}, ' . $fotoBoxesPauseTime . ');
			}, false
		);
		
		document.querySelector(".miniSliderSlideshow_' . $gallery . '").addEventListener
		("click", function() 
			{
				counter_' . $gallery . '++; 
				showCurrent_' . $gallery . '(); 
			}, false
		);
	}
)

(document);
</script>';
	}

	return $miniSliderOutput;
}

?>