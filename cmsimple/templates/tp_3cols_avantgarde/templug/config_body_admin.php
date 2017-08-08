<?php // utf-8 Marker: äöü

if (!isset($_SESSION['sn']) || !function_exists('sv') || preg_match('#templug/config_#i', $_SERVER['SCRIPT_NAME']))
{
	die('no direct access');
}

	if($admin == 'plugin_main' && $_REQUEST['tp_config'] == 'body')
	{
		include ($pth['folder']['templates'] . $_SESSION['tp_template'] . '/templug/data/config_body.php');
		$o.='<p style="background: #060; color: #fff; text-align: center; border: 1px solid #222; padding: 4px 6px 6px 6px; margin: 20px 0 10px 0;">' . $plugin_tx['templug']['message_selected_template'] . ': <b>' . $_SESSION['tp_template'] . '</b></p>';
		
		$o.='<h5>' . $plugin_tx['templug']['headline_edit_site_background'] . '</h5>' . 
		'<p><a href="?&templug&admin=plugin_main&action=plugin_text">&laquo; ' . $plugin_tx['templug']['link_back'] . '</a></p>';
		
		$o.='<form method="post" action="' . $pth['folder']['templates'] . $_SESSION['tp_template'] . '/templug/config_body_write.php">';
		$o.='<input type="submit" name="Button" value="' . $plugin_tx['templug']['button_save_settings'] . '">';
		$o.='<table id="tp_edit_area" cellspacing="0" style="font-family: arial, sans-serif; font-size: 15px;">';
		
// Background image body
		
		$dir_bgbody=opendir($pth['folder']['templates'] . $_SESSION['tp_template'] . '/images/body');
		
		if(!$dir_bgbody) die($plugin_tx['templug']['error_no_images_folder'] . $dir_bgbody);
		
		$files_bgbody=array();
		while(false!==($file_bgbody=readdir($dir_bgbody)))
		{
			if(preg_match("/\.jpe?g\Z/i", trim($file_bgbody)) || preg_match("/\.png\Z/i", trim($file_bgbody)) || preg_match("/\.gif\Z/i", trim($file_bgbody)))
			{
				$files_bgbody[]=trim($file_bgbody);
			}
		}
		closedir($dir_bgbody);
		sort($files_bgbody);
		
				$o.='<tr>
		<td colspan="2">
		<a href="#templug_upload"><b>' . $plugin_tx['templug']['background_image_upload'] . ' &raquo;</b></a>
		</td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['background_image'] . '</td>
		<td>';
		$o.='<select name="body_background_image" style="width: 160px;">';
		
		foreach ($files_bgbody as $num => $rec)
		{
			if($body_background_image == $rec)
			{
				$o.='<option selected="selected">' . $rec . '</option>';
			}
			else
			{
				$o.='<option>' . $rec . '</option>';
			}
		}
		
		$o.='</select>
		</td>
		</tr>';
		
		
// Background body scrolling

		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['background_image_scroll'] . '</td>
		<td><select name="body_background_attachment" style="width: 160px;">
		<option';
		if($body_background_attachment == 'fixed') $o.=' selected="selected"';
		$o.='>fixed</option>
		<option';
		if($body_background_attachment == 'scroll') $o.=' selected="selected"';
		$o.='>scroll</option>
		</select>
		</td>
		</tr>';
		
		
// Background body repeat
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['background_image_repeat'] . '</td>
		<td><select name="body_background_repeat" style="width: 160px;">
		<option';
		if($body_background_repeat == 'no-repeat') $o.=' selected="selected"';
		$o.='>no-repeat</option>
		<option';
		if($body_background_repeat == 'repeat') $o.=' selected="selected"';
		$o.='>repeat</option>
		<option';
		if($body_background_repeat == 'repeat-x') $o.=' selected="selected"';
		$o.='>repeat-x</option>
		<option';
		if($body_background_repeat == 'repeat-y') $o.=' selected="selected"';
		$o.='>repeat-y</option>
		</select>
		</td>
		</tr>';
		
		
// Background body position

		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['background_image_position'] . '</td>
		<td><select name="body_background_position" style="width: 160px;">
		<option';
		if($body_background_position == 'left top') $o.=' selected="selected"';
		$o.='>left top</option>
		<option';
		if($body_background_position == 'right top') $o.=' selected="selected"';
		$o.='>right top</option>
		<option';
		if($body_background_position == 'center top') $o.=' selected="selected"';
		$o.='>center top</option>
		
		<option';
		if($body_background_position == 'left') $o.=' selected="selected"';
		$o.='>left</option>
		<option';
		if($body_background_position == 'right') $o.=' selected="selected"';
		$o.='>right</option>
		<option';
		if($body_background_position == 'center') $o.=' selected="selected"';
		$o.='>center</option>
		
		<option';
		if($body_background_position == 'left bottom') $o.=' selected="selected"';
		$o.='>left bottom</option>
		<option';
		if($body_background_position == 'right bottom') $o.=' selected="selected"';
		$o.='>right bottom</option>
		<option';
		if($body_background_position == 'center bottom') $o.=' selected="selected"';
		$o.='>center bottom</option>
		</select>
		</td>
		</tr>';
		
		
// Background body color

		$o.='<tr>
		<td valign="top"><a class="pl_tooltip" href="#"><img src="./plugins/pluginloader/css/help_icon.png" alt=""/><span>' . $plugin_tx['templug']['help_color'] . '</span></a> ' . $plugin_tx['templug']['background_color'] . '<div id="templug_upload"></div></td>
		<td><input type="text" name="body_background_color" value="' . $body_background_color . '" class="color {pickerPosition:\'right\',hash:true,caps:false,adjust:false}"></td>
		</tr>';
		
		$o.='</table>';
		$o.='<input type="submit" name="Button" value="' . $plugin_tx['templug']['button_save_settings'] . '">';
		$o.='</form>';
		
		$o.='<p><a href="?&templug&admin=plugin_main&action=plugin_text">&laquo; ' . $plugin_tx['templug']['link_back'] . '</a></p>';
		
//		print_r($_POST);
	}
	
	if($_REQUEST['tp_config'] == 'body')
	{
		include($pth['folder']['plugins'] . 'templug/upload.php');
	}
?>