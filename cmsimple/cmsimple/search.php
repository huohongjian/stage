<?php // utf8-marker = äöü

/*
================================================== 
This file is a part of CMSimple 4.4.4
Released: 2014-07-21
Project website: www.cmsimple.org
--------------------------------------------------
CMSimple 4.0 and higher uses some code and modules of CMSimple_XH, 
a community driven CMSimple based Project, under GPL3 licence. 
CMSimple_XH project website: www.cmsimple-xh.org
================================================== 
CMSimple COPYRIGHT INFORMATION

© Gert Ebersbach - mail@ge-webdesign.de

CMSimple 3.3 and higher is released under the GPL3 licence. 
You may not remove copyright information from the files. 
Any modifications will fall under the copyleft conditions of GPL3.

GPL 3 Deutsch: http://www.gnu.de/documents/gpl.de.html
GPL 3 English: http://www.gnu.org/licenses/gpl.html

END CMSimple COPYRIGHT INFORMATION
================================================== 
*/

if (preg_match('/search.php/i', $_SERVER['SCRIPT_NAME']))
    die('Access Denied');

if(!function_exists('mb_strtolower')) {
    function mb_strtolower($string, $charset = null) {
        $string = utf8_decode($string);
        $string = strtolower($string);
        $string = utf8_encode($string);
        return $string;
    }
}

$title = $tx['title']['search'];
$ta = array();
if ($search != '') 
{
    $search = mb_strtolower(trim(stsl($search)), 'utf-8');
    $words = explode(' ', $search);

    foreach ($c as $i => $pagexyz) 
	{
        if (!hide($i) || $cf['hidden']['pages_search'] == 'true') 
		{
            $found  = true;
			$pagexyz = evaluate_plugincall($pagexyz, TRUE);
            $pagexyz = mb_strtolower(strip_tags($pagexyz), 'utf-8');
            $pagexyz = html_entity_decode($pagexyz, ENT_QUOTES, 'utf-8');
            foreach ($words as $word) 
			{
                if (strpos($pagexyz, trim($word)) === false) 
				{
                    $found = false;
                    break;
                }
            }
            if (!$found) {continue;}
            $ta[] = $i;
        }
    }
    
    if(count($ta) > 0){
        $cms_searchresults = "\n" .'<ul>';
	
	$words = (implode( ",", $words));
        foreach($ta as $i){
            $cms_searchresults .= "\n\t" . '<li><a href="' . $sn . '?' . $u[$i] . amp() . 'search=' . urlencode($words) .'">' . $h[$i] . '</a></li>';
        }
        $cms_searchresults .= "\n" . '</ul>' . "\n";
    }
}

$o .= '<h1>' . $tx['search']['result'] . '</h1><p>"' . htmlspecialchars($search, ENT_COMPAT, 'UTF-8') . '" ';

if (count($ta) == 0) {
    $o .= $tx['search']['notfound'] . '.</p>';
}
else {
    $o .= $tx['search']['foundin'] . ' ' . count($ta) . ' ';
    if (count($ta) > 1
    )$o .= $tx['search']['pgplural'];
    else
        $o .= $tx['search']['pgsingular'];
    $o .= ':</p>' . $cms_searchresults;
}

?>