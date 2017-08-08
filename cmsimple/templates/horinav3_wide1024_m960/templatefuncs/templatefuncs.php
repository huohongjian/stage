<?php // utf-8 marker: äöü 

if (!function_exists('sv') || preg_match('#templatefuncs/templatefuncs.php#i', $_SERVER['SCRIPT_NAME']))
{
	die('no direct access');
}

/*
============================================================
Template Addon "TemplateFuncs"
Version 1.1
Released 09/2013
Copyright: Gert Ebersbach - www.ge-webdesign.de
============================================================ 
*/


##################################################
// functions
##################################################

// NEWSBOXES function

function tf_newsboxes($tf_nb_name, $tf_nb_low, $tf_nb_high, $tf_nb_type = NULL)
{
	if($tf_nb_type == 'random')
	{
		return newsbox($tf_nb_name . mt_rand($tf_nb_low, $tf_nb_high));
	}
	else
	{
		if(!isset($_SESSION))
		{
			session_start();
		}
		
		if(!$_SESSION[$tf_nb_name . 'tf_newsboxes_ordered'] || $_SESSION[$tf_nb_name . 'tf_newsboxes_ordered'] < $tf_nb_low || $_SESSION[$tf_nb_name . 'tf_newsboxes_ordered'] > $tf_nb_high)
		{
			$_SESSION[$tf_nb_name . 'tf_newsboxes_ordered'] = $tf_nb_low - 1;
		}
		
		$_SESSION[$tf_nb_name . 'tf_newsboxes_ordered'] < $tf_nb_high ? $_SESSION[$tf_nb_name . 'tf_newsboxes_ordered'] ++ : $_SESSION[$tf_nb_name . 'tf_newsboxes_ordered'] = $tf_nb_low;
		
		return newsbox($tf_nb_name . $_SESSION[$tf_nb_name . 'tf_newsboxes_ordered']);
	}
}


// IMAGES function

function tf_images($tf_img_folder, $tf_img_type = NULL)
{
	global $pth;
	
	$tf_img_high = 0;
	
	// define images path
	$tf_images_path = $pth['folder']['template'] . 'templatefuncs/' . $tf_img_folder . '/';

	// create images array
	if($tf_imagesFolderHandle = @opendir($tf_images_path))
	{
		while($tf_imagesFile = readdir($tf_imagesFolderHandle))
		{
			if($tf_imagesFile != '.' && $tf_imagesFile != '..' && $tf_imagesFile != 'index.html')
			{
				$tf_imagesFilesArray[] = $tf_imagesFile;
				sort($tf_imagesFilesArray);
			}
		}
		closedir($tf_imagesFolderHandle);
	}
	$tf_img_high = count($tf_imagesFilesArray);
	$tf_img_low = 1;
	
	if($tf_img_type == 'random')
	{
		return $pth['folder']['template'] . 'templatefuncs/' . $tf_img_folder . '/' . $tf_imagesFilesArray[mt_rand($tf_img_low, $tf_img_high) - 1];
	}
	else
	{
		if(!isset($_SESSION))
		{
			session_start();
		}
		
		if(!$_SESSION['tf_images_' . $tf_img_folder] || $_SESSION['tf_images_' . $tf_img_folder] < $tf_img_low || $_SESSION['tf_images_' . $tf_img_folder] > $tf_img_high)
		{
			$_SESSION['tf_images_' . $tf_img_folder] = 0;
		}
		
		$_SESSION['tf_images_' . $tf_img_folder] < $tf_img_high ? $_SESSION['tf_images_' . $tf_img_folder] ++ : $_SESSION['tf_images_' . $tf_img_folder] = $tf_img_low;
		
		return $pth['folder']['template'] . 'templatefuncs/' . $tf_img_folder . '/' . $tf_imagesFilesArray[$_SESSION['tf_images_' . $tf_img_folder] - 1];
	}
}

// SPECIAL LINKS function

// tf_homelink
function tf_homelink($file_icon)
{
	global $pth, $tx;

	echo '<a href="./">' . 
	tag('img src="' . $pth['folder']['template'] . 'templatefuncs/icons/' . $file_icon . '" class="tf_homelink_icon" title="' . $tx['locator']['home'] . '" alt="' . $tx['locator']['home'] . '"') . "\n" . 
	'</a>';
}

// tf_printlink
function tf_printlink($file_icon = '') 
{
    global $f, $search, $file, $sn, $tx, $pth;
    $t = amp().'print';
    $title = $tx['menu']['print'];

    if ($f == 'search')
        $t .= amp() . 'function=search' . amp() . 'search=' . htmlspecialchars(stsl($search));
    else if ($f == 'file')
        $t .= amp() . 'file=' . $file;
    else if ($f != '' && $f != 'save')
        $t .= amp() . $f;
    else if (sv('QUERY_STRING') != '')
        $t = htmlspecialchars(sv('QUERY_STRING'), ENT_QUOTES, "UTF-8") . $t;
	
	$link = '';

    if ($file_icon != '') 
	{
        $link = tag('img src="' . $pth['folder']['template'] . 'templatefuncs/icons/' . $file_icon . '" class="tf_printlink_icon" title="' . $title . '" alt="' . $title . '"');
    }
    else 
	{ 
		$link .= $title; 
	}

    return '<a href="'.$sn.'?'.$t.'">' . $link . '</a>';
} 

// tf_mailformlink
function tf_mailformlink($file_icon)
{
	global $cf, $pth, $tx;
	
	if($cf['mailform']['email'] != '')
	{
		echo '<a href="./?&amp;mailform">
' . tag('img src="' . $pth['folder']['template'] . 'templatefuncs/icons/' . $file_icon . '" class="tf_mailformlink_icon" title="' . $tx['menu']['mailform'] . '" alt="' . $tx['menu']['mailform'] . '"') . '
</a>' . "\n";
	}
}

// tf_sitemaplink
function tf_sitemaplink($file_icon)
{
	global $pth, $tx;

	echo '<a href="./?&amp;sitemap">' . 
	tag('img src="' . $pth['folder']['template'] . 'templatefuncs/icons/' . $file_icon . '" class="tf_sitemaplink_icon" title="' . $tx['menu']['sitemap'] . '" alt="' . $tx['menu']['sitemap'] . '"') . "\n" . 
	'</a>';
}

// tf_previouspage
function tf_previouspage($file_icon) 
{
	global $pth, $tx, $s, $cl, $tx, $adm;
	for ($i = $s - 1; $i > -1; $i--)
		if (!hide($i))
		{
			return a($i, '') . tag('img src="' . $pth['folder']['template'] . 'templatefuncs/icons/' . $file_icon . '" class="tf_prev_icon" title="' . $tx['navigator']['previous'] . '" alt="' . $tx['navigator']['previous'] . '"') . '</a>';
		}
}

// tf_nextpage
function tf_nextpage($file_icon) 
{
	global $pth, $tx, $s, $cl, $tx, $adm;
	for ($i = $s + 1; $i < $cl; $i++)
		if (!hide($i))
		{
			return a($i, '') . tag('img src="' . $pth['folder']['template'] . 'templatefuncs/icons/' . $file_icon . '" class="tf_next_icon" title="' . $tx['navigator']['next'] . '" alt="' . $tx['navigator']['next'] . '"') . '</a>';
		}
}

// tf_top
function tf_top($file_icon) 
{
	global $pth, $tx, $adm;
		return '<a href="#TOP">' . tag('img src="' . $pth['folder']['template'] . 'templatefuncs/icons/' . $file_icon . '" class="tf_top_icon" title="' . $tx['navigator']['top'] . '" alt="' . $tx['navigator']['top'] . '"') . '</a>';
}


// OPEN MENU function

function openMenu($start = NULL, $end = NULL)
{
	global $cl, $s, $l, $cf;
	if (isset($start)) 
	{
		if (!isset($end))
		{
			$end = $start;
		}
	}
	else
	{
		$start = 1;
	}
	
	if (!isset($end))
	{
		$end = $cf['menu']['levels'];
	}
	
	$openTocArray = array();
	
	if ($s > -1) 
	{
		for ($i = $s; $i > -1; $i--) 
		{
			if ($l[$i] >= $start && $l[$i] <= $end)
			{
				if (!hide($i) || ($i == $s && $cf['hidden']['pages_toc'] == 'true'))
				{
					$openTocArray[] = $i;
				}
			}
		}
		@sort($openTocArray);
	}
	
	for ($i = $s + 1; $i < $cl; $i++) 
	{
		if ($l[$i] >= $start && $l[$i] <= $end)
		{
			if (!hide($i))
			{
				$openTocArray[] = $i;
			}
		}
	}
	
	return li($openTocArray, $start);
}

?>