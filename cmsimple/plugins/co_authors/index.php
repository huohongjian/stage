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

/* EVALUATION FUNCTIONS FOR PLUGINS / SCRIPTING */

function evaluate_cmsimple_scripting_authors($__text_authors, $__compat_authors = TRUE) 
{
	global $output;
	foreach ($GLOBALS as $__name_authors => $__dummy_authors) 
	{
		global $$__name_authors;
	}
    
    $__scope_before_authors = NULL; // just that it exists
    $__scripts_authors = array();
    preg_match_all('~'.$cf['scripting']['regexp'].'~is', $__text_authors, $__scripts_authors);
    if (count($__scripts_authors[1]) > 0) 
	{
		$output = preg_replace('~'.$cf['scripting']['regexp'].'~is', '', $__text_authors);
		if ($__compat_authors) 
		{
			$__scripts_authors[1] = array_reverse($__scripts_authors[1]);
		}
        foreach ($__scripts_authors[1] as $__script_authors) 
		{
			if ($__script_authors !== 'hide' && $__script_authors !== 'remove') 
			{
				$__script_authors = preg_replace(array("'&(quot|#34);'i", "'&(amp|#38);'i", "'&(apos|#39);'i", "'&(lt|#60);'i", "'&(gt|#62);'i", "'&(nbsp|#160);'i"), array("\"", "&", "'", "<", ">", " "), $__script_authors);
				$__scope_before_authors = array_keys(get_defined_vars());
				eval($__script_authors);
				$__scope_after_authors = array_keys(get_defined_vars());
				$__diff_authors = array_diff($__scope_after_authors, $__scope_before_authors);
				foreach ($__diff_authors as $__var_authors) 
				{
					$GLOBALS[$__var_authors] = $$__var_authors;
				}
					if ($__compat_authors) 
				{
				break;
				}
			}
		}
		$eval_script_output = $output; 
		$output = '';
		return $eval_script_output;
	}
	return $__text_authors;
}

function evaluate_plugincall_authors($__text_authors) 
{
	global $u;
	
	$error = '<span style="color:#5b0000; font-size:14px;">{{CALL TO:<span style="color:#c10000;">{{%1}}</span> FAILED}}</span>'; //use this for debugging of failed plugin-calls
	$pl_regex = '"{{{RGX:CALL(.*?)}}}"is'; //general CALL-RegEx (Placeholder: "RGX:CALL")
	$pl_calls = array(
	'PLUGIN:' => 'return {{%1}}',
	'HOME:' => 'return trim(\'<a href="?' . $u[0] . '" title="' . urldecode('{{%1}}') . '">' . urldecode('{{%1}}') . '</a>\');',
	'HOME' => 'return trim(\'<a href="?' . $u[0] . '" title="' . urldecode($u[0]) . '">' . urldecode($u[0]) . '</a>\');'
	);
	$fd_calls = array();
	foreach ($pl_calls AS $regex => $call) 
	{
		preg_match_all(str_replace("RGX:CALL", $regex, $pl_regex), $__text_authors, $fd_calls[$regex]); //catch all PL-CALLS
		foreach ($fd_calls[$regex][0] AS $call_nr => $replace) 
		{
			$call = str_replace("{{%1}}", $fd_calls[$regex][1][$call_nr], $pl_calls[$regex]);
			$fnct_call = preg_replace('"(?:(?:return)\s)*(.*?)\(.*?\);"is', '$1', $call);
			$fnct = function_exists($fnct_call) ? TRUE : FALSE; //without object-calls; functions-only!!
			if ($fnct) 
			{
				preg_match_all("/\\$([a-z_0-9]*)/i", $call, $matches);
				foreach ($matches[1] as $var) 
				{
					global $$var;
				}
			}
			$__text_authors = str_replace($replace,
			($fnct
			? eval(str_replace('{{%1}}', $fd_calls[$regex][1][$call_nr], $pl_calls[$regex]))
			: str_replace('{{%1}}', $regex . $fd_calls[$regex][1][$call_nr], $error)),
			$__text_authors); //replace PL-CALLS (String only!!)
		}
	}
	return $__text_authors;
}

function evaluate_scripting_authors($text, $compat = TRUE) 
{
	return evaluate_cmsimple_scripting_authors(evaluate_plugincall_authors($text), $compat);
}

/* END EVALUATION FUNCTIONS FOR PLUGINS / SCRIPTING */



function co_authors($co_author_folder, $co_author_page)
{
	global $pth;
	
	$GLOBALS['co_author_folder'] = $co_author_folder; global $co_author_folder;
//	echo 'von co_author: ' . $co_author_folder . $co_author_page . '<br>'; // for development only
	
	$co_author_doc = '';
//	$co_author_doc.= '<p class="cmsimplecore_warning" style="clear: both; font-family: arial, sans-serif; font-size: 12px; text-align: center;">Die folgenden Inhalte wurden extern mit CMSimpleCoAutors erstellt und mit dem Plugin CoAuthors_XH in diese Website eingebunden:</p>';
	$co_author_doc.= file_get_contents($pth['folder']['base'].$co_author_folder.'userfiles/co_author/' . $co_author_page . '.txt');
	$co_author_doc = preg_replace('~<h1>(.*)</h1>~', '', $co_author_doc);
	
	$co_author_doc = evaluate_scripting_authors($co_author_doc);

	return($co_author_doc);
}

?>