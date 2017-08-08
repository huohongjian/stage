<?php // utf-8 Marker: äöü

if (!isset($_SESSION['sn']) || !function_exists('sv') || preg_match('#templug/config_#i', $_SERVER['SCRIPT_NAME']))
{
	die('no direct access');
}

if($admin == 'plugin_main' && $_REQUEST['tp_config'] == 'main')
	{
		include ($pth['folder']['templates'] . $_SESSION['tp_template'] . '/templug/data/config_main.php');
		$o.='<p style="background: #060; color: #fff; text-align: center; border: 1px solid #222; padding: 4px 6px 6px 6px; margin: 20px 0 10px 0;">' . $plugin_tx['templug']['message_selected_template'] . ': <b>' . $_SESSION['tp_template'] . '</b></p>';
		
		$o.='<h5>' . $plugin_tx['templug']['headline_edit_main_container'] . '</h5>' . 
		'<p><a href="?&templug&admin=plugin_main&action=plugin_text">&laquo; ' . $plugin_tx['templug']['link_back'] . '</a></p>';
		
		$o.='<form method="post" action="' . $pth['folder']['templates'] . $_SESSION['tp_template'] . '/templug/config_main_write.php">';
		$o.='<input type="submit" name="Button" value="' . $plugin_tx['templug']['button_save_settings'] . '"><br />
		<br />
		<table id="tp_edit_area" cellspacing="0" style="font-family: arial, sans-serif; font-size: 15px;">';
		
		
// BACKGROUND
		
		// create background images array
		
		$dir_bgmain=opendir($pth['folder']['templates'] . $_SESSION['tp_template'] . '/images/main');
		
		if(!$dir_bgmain) die($plugin_tx['templug']['error_no_images_folder'] . $dir_bgmain);
		
		$files_bgmain=array();
		while(false!==($file_bgmain=readdir($dir_bgmain)))
		{
			if(preg_match("/\.jpe?g\Z/i", trim($file_bgmain)) || preg_match("/\.png\Z/i", trim($file_bgmain)) || preg_match("/\.gif\Z/i", trim($file_bgmain)))
			{
				$files_bgmain[]=trim($file_bgmain);
			}
		}
		closedir($dir_bgmain);
		sort($files_bgmain);
		
		// main area width
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['elements_width_px'] . '</td>
		<td><input type="text" name="main_width" value="' . $main_width . '"></td>
		</tr>';
		
		$o.='<tr>
		<td colspan="2">
		<h6>' . $plugin_tx['templug']['headline_background'] . '</h6>
		</td>
		</tr>';
		
		$o.='<tr>
		<td colspan="2">
		<a href="#templug_upload"><b>' . $plugin_tx['templug']['background_image_upload'] . ' &raquo;</b></a>
		</td>
		</tr>';
		
		// Background image
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['background_image'] . '</td>
		<td>';
		$o.='<select name="main_background_image" style="width: 160px;">';
		
		foreach ($files_bgmain as $num => $rec)
		{
			if($main_background_image == $rec)
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
		
		// Background image repeat
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['background_image_repeat'] . '</td>
		<td><select name="main_background_repeat" style="width: 160px;">
		<option';
		if($main_background_repeat == 'no-repeat') $o.=' selected="selected"';
		$o.='>no-repeat</option>
		<option';
		if($main_background_repeat == 'repeat') $o.=' selected="selected"';
		$o.='>repeat</option>
		<option';
		if($main_background_repeat == 'repeat-x') $o.=' selected="selected"';
		$o.='>repeat-x</option>
		<option';
		if($main_background_repeat == 'repeat-y') $o.=' selected="selected"';
		$o.='>repeat-y</option>
		</select>
		</td>
		</tr>';
		
		// Background image position
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['background_image_position'] . '</td>
		<td><select name="main_background_position" style="width: 160px;">
		<option';
		if($main_background_position == 'left top') $o.=' selected="selected"';
		$o.='>left top</option>
		<option';
		if($main_background_position == 'right top') $o.=' selected="selected"';
		$o.='>right top</option>
		<option';
		if($main_background_position == 'center top') $o.=' selected="selected"';
		$o.='>center top</option>
		<option';
		if($main_background_position == 'left') $o.=' selected="selected"';
		$o.='>left</option>
		<option';
		if($main_background_position == 'right') $o.=' selected="selected"';
		$o.='>right</option>
		<option';
		if($main_background_position == 'center') $o.=' selected="selected"';
		$o.='>center</option>
		<option';
		if($main_background_position == 'left bottom') $o.=' selected="selected"';
		$o.='>left bottom</option>
		<option';
		if($main_background_position == 'right bottom') $o.=' selected="selected"';
		$o.='>right bottom</option>
		<option';
		if($main_background_position == 'center bottom') $o.=' selected="selected"';
		$o.='>center bottom</option>
		</select>
		</td>
		</tr>';
		
		// Background color
		
		$o.='<tr>
		<td valign="top"><a class="pl_tooltip" href="#"><img src="./plugins/pluginloader/css/help_icon.png" alt=""/><span>' . $plugin_tx['templug']['help_color'] . '</span></a> ' . $plugin_tx['templug']['background_color'] . '</td>
		<td><input type="text" name="main_background_color" value="' . $main_background_color . '" class="color {pickerPosition:\'right\',hash:true,caps:false,adjust:false}"></td>
		</tr>';
		
		
// BORDERS
		
		$o.='<tr>
		<td colspan="2">
		<h6>' . $plugin_tx['templug']['headline_border'] . '</h6>
		</td>
		</tr>';
		
		// Border Color
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['border_color'] . '</td>
		<td><input type="text" name="main_border_color" value="' . $main_border_color . '" class="color {pickerPosition:\'right\',hash:true,caps:false,adjust:false}"></td>
		</tr>';
		
		// Border width
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['border_width'] . '</td>
		<td><input type="text" name="main_border_width" value="' . $main_border_width . '"></td>
		</tr>';
		
		// Border style
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['border_style'] . '</td>
		<td><select name="main_border_style" style="width: 160px;">
		<option';
		if($main_border_style == 'solid') $o.=' selected="selected"';
		$o.='>solid</option>
		<option';
		if($main_border_style == 'double') $o.=' selected="selected"';
		$o.='>double</option>
		<option';
		if($main_border_style == 'dotted') $o.=' selected="selected"';
		$o.='>dotted</option>
		<option';
		if($main_border_style == 'dashed') $o.=' selected="selected"';
		$o.='>dashed</option>
		<option';
		if($main_border_style == 'groove') $o.=' selected="selected"';
		$o.='>groove</option>
		<option';
		if($main_border_style == 'ridge') $o.=' selected="selected"';
		$o.='>ridge</option>
		<option';
		if($main_border_style == 'inset') $o.=' selected="selected"';
		$o.='>inset</option>
		<option';
		if($main_border_style == 'outset') $o.=' selected="selected"';
		$o.='>outset</option>
		</select>
		</td>
		</tr>';
		
		
// MARGINS
		
		$o.='<tr>
		<td colspan="2">
		<h6>' . $plugin_tx['templug']['headline_margin'] . '</h6>
		</td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['spacings_top_px'] . '</td>
		<td><input type="text" name="main_margin_top" value="' . $main_margin_top . '"></td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['spacings_right_px'] . '</td>
		<td><input type="text" name="main_margin_right" value="' . $main_margin_right . '"></td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['spacings_bottom_px'] . '</td>
		<td><input type="text" name="main_margin_bottom" value="' . $main_margin_bottom . '"></td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['spacings_left_px'] . '</td>
		<td><input type="text" name="main_margin_left" value="' . $main_margin_left . '"></td>
		</tr>';
		
		
// PADDINGS
		
		$o.='<tr>
		<td colspan="2">
		<h6>' . $plugin_tx['templug']['headline_padding'] . '</h6>
		</td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['spacings_top_px'] . '</td>
		<td><input type="text" name="main_padding_top" value="' . $main_padding_top . '"></td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['spacings_right_px'] . '</td>
		<td><input type="text" name="main_padding_right" value="' . $main_padding_right . '"></td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['spacings_bottom_px'] . '</td>
		<td><input type="text" name="main_padding_bottom" value="' . $main_padding_bottom . '"></td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['spacings_left_px'] . '<div id="templug_upload"></div></td>
		<td><input type="text" name="main_padding_left" value="' . $main_padding_left . '"></td>
		</tr>';
		
		$o.='</table>
		<br />';
		$o.='<input type="submit" name="Button" value="' . $plugin_tx['templug']['button_save_settings'] . '">';
		$o.='</form>';
		
		$o.='<p><a href="?&templug&admin=plugin_main&action=plugin_text">&laquo; ' . $plugin_tx['templug']['link_back'] . '</a></p>';
		
//		print_r($_POST);
	}
	
	if($_REQUEST['tp_config'] == 'main')
	{
		include($pth['folder']['plugins'] . 'templug/upload.php');
	}
?>