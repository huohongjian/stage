<?php // utf-8 Marker: äöü

if (!isset($_SESSION['sn']) || !function_exists('sv') || preg_match('#templug/config_#i', $_SERVER['SCRIPT_NAME']))
{
	die('no direct access');
}

if($admin == 'plugin_main' && $_REQUEST['tp_config'] == 'header')
	{
		include ($pth['folder']['templates'] . $_SESSION['tp_template'] . '/templug/data/config_header.php');
		$o.='<p style="background: #060; color: #fff; text-align: center; border: 1px solid #222; padding: 4px 6px 6px 6px; margin: 20px 0 10px 0;">' . $plugin_tx['templug']['message_selected_template'] . ': <b>' . $_SESSION['tp_template'] . '</b></p>';
		
		$o.='<h5>' . $plugin_tx['templug']['headline_edit_header'] . '</h5>' . 
		'<p><a href="?&templug&admin=plugin_main&action=plugin_text">&laquo; ' . $plugin_tx['templug']['link_back'] . '</a></p>';
		
		$o.='<form method="post" action="' . $pth['folder']['templates'] . $_SESSION['tp_template'] . '/templug/config_header_write.php">';
		$o.='<input type="submit" name="Button" value="' . $plugin_tx['templug']['button_save_settings'] . '"><br />';
		$o.='<table id="tp_edit_area" cellspacing="0" style="font-family: arial, sans-serif; font-size: 15px;">';
		
		
// BACKGROUND
		
		$dir_bgheader=opendir($pth['folder']['templates'] . $_SESSION['tp_template'] . '/images/header');
		
		if(!$dir_bgheader) die($plugin_tx['templug']['error_no_images_folder'] . $dir_bgheader);
		
		$files_bgheader=array();
		while(false!==($file_bgheader=readdir($dir_bgheader)))
		{
			if(preg_match("/\.jpe?g\Z/i", trim($file_bgheader)) || preg_match("/\.png\Z/i", trim($file_bgheader)) || preg_match("/\.gif\Z/i", trim($file_bgheader)))
			{
				$files_bgheader[]=trim($file_bgheader);
			}
		}
		closedir($dir_bgheader);
		sort($files_bgheader);
		
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
		
		// Background image header
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['background_image'] . '</td>
		<td>';
		$o.='<select name="header_background_image" style="width: 160px;">';
		
		foreach ($files_bgheader as $num => $rec)
		{
			if($header_background_image == $rec)
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
		
		
		// background image header repeat
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['background_image_repeat'] . '</td>
		<td><select name="header_background_repeat" style="width: 160px;">
		<option';
		if($header_background_repeat == 'no-repeat') $o.=' selected="selected"';
		$o.='>no-repeat</option>
		<option';
		if($header_background_repeat == 'repeat') $o.=' selected="selected"';
		$o.='>repeat</option>
		<option';
		if($header_background_repeat == 'repeat-x') $o.=' selected="selected"';
		$o.='>repeat-x</option>
		<option';
		if($header_background_repeat == 'repeat-y') $o.=' selected="selected"';
		$o.='>repeat-y</option>
		</select>
		</td>
		</tr>';
		
		
		// background image header position
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['background_image_position'] . '</td>
		<td><select name="header_background_position" style="width: 160px;">
		<option';
		if($header_background_position == 'left top') $o.=' selected="selected"';
		$o.='>left top</option>
		<option';
		if($header_background_position == 'right top') $o.=' selected="selected"';
		$o.='>right top</option>
		<option';
		if($header_background_position == 'center top') $o.=' selected="selected"';
		$o.='>center top</option>
		<option';
		if($header_background_position == 'left') $o.=' selected="selected"';
		$o.='>left</option>
		<option';
		if($header_background_position == 'right') $o.=' selected="selected"';
		$o.='>right</option>
		<option';
		if($header_background_position == 'center') $o.=' selected="selected"';
		$o.='>center</option>
		<option';
		if($header_background_position == 'left bottom') $o.=' selected="selected"';
		$o.='>left bottom</option>
		<option';
		if($header_background_position == 'right bottom') $o.=' selected="selected"';
		$o.='>right bottom</option>
		<option';
		if($header_background_position == 'center bottom') $o.=' selected="selected"';
		$o.='>center bottom</option>
		</select>
		</td>
		</tr>';
		
		
		// background color header
		
		$o.='<tr>
		<td valign="top"><a class="pl_tooltip" href="#"><img src="./plugins/pluginloader/css/help_icon.png" alt=""/><span>' . $plugin_tx['templug']['help_color'] . '</span></a> ' . $plugin_tx['templug']['background_color'] . '</td>
		<td><input type="text" name="header_background_color" value="' . $header_background_color . '" class="color {pickerPosition:\'right\',hash:true,caps:false,adjust:false}"></td>
		</tr>';
		
		
// BORDER
		
		$o.='<tr>
		<td colspan="2">
		<h6>' . $plugin_tx['templug']['headline_border'] . '</h6>
		</td>
		</tr>';
		
		
		// border color
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['border_color'] . '</td>
		<td><input type="text" name="header_border_color" value="' . $header_border_color . '" class="color {pickerPosition:\'right\',hash:true,caps:false,adjust:false}"></td>
		</tr>';
		
		
		// border width
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['border_width'] . '</td>
		<td><input type="text" name="header_border_width" value="' . $header_border_width . '"></td>
		</tr>';
		
		
		// border style
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['border_style'] . '</td>
		<td><select name="header_border_style" style="width: 160px;">
		<option';
		if($header_border_style == 'solid') $o.=' selected="selected"';
		$o.='>solid</option>
		<option';
		if($header_border_style == 'double') $o.=' selected="selected"';
		$o.='>double</option>
		<option';
		if($header_border_style == 'dotted') $o.=' selected="selected"';
		$o.='>dotted</option>
		<option';
		if($header_border_style == 'dashed') $o.=' selected="selected"';
		$o.='>dashed</option>
		<option';
		if($header_border_style == 'groove') $o.=' selected="selected"';
		$o.='>groove</option>
		<option';
		if($header_border_style == 'ridge') $o.=' selected="selected"';
		$o.='>ridge</option>
		<option';
		if($header_border_style == 'inset') $o.=' selected="selected"';
		$o.='>inset</option>
		<option';
		if($header_border_style == 'outset') $o.=' selected="selected"';
		$o.='>outset</option>
		</select>
		</td>
		</tr>';
		
		
// MARGIN
		
		$o.='<tr>
		<td colspan="2">
		<h6>' . $plugin_tx['templug']['headline_margin'] . '</h6>
		</td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['spacings_top_px'] . '</td>
		<td><input type="text" name="header_margin_top" value="' . $header_margin_top . '"></td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['spacings_right_px'] . '</td>
		<td><input type="text" name="header_margin_right" value="' . $header_margin_right . '"></td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['spacings_bottom_px'] . '</td>
		<td><input type="text" name="header_margin_bottom" value="' . $header_margin_bottom . '"></td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['spacings_left_px'] . '</td>
		<td><input type="text" name="header_margin_left" value="' . $header_margin_left . '"></td>
		</tr>';
		
		
// PADDING
		
		$o.='<tr>
		<td colspan="2">
		<h6>' . $plugin_tx['templug']['headline_padding'] . '</h6>
		</td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['spacings_top_px'] . '</td>
		<td><input type="text" name="header_padding_top" value="' . $header_padding_top . '"></td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['spacings_right_px'] . '</td>
		<td><input type="text" name="header_padding_right" value="' . $header_padding_right . '"></td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['spacings_bottom_px'] . '</td>
		<td><input type="text" name="header_padding_bottom" value="' . $header_padding_bottom . '"></td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['spacings_left_px'] . '</td>
		<td><input type="text" name="header_padding_left" value="' . $header_padding_left . '"></td>
		</tr>';
		
		
// FONTS
		
		$o.='<tr>
		<td colspan="2">
		<h6>' . $plugin_tx['templug']['headline_fonts'] . '</h6>
		</td>
		</tr>';
		
		
		// font family
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['font_family'] . '</td>
		<td><select name="header_font_family" style="width: 160px;">
		<option';
		if($header_font_family == 'arial, sans-serif') $o.=' selected="selected"';
		$o.='>arial, sans-serif</option>
		<option';
		if($header_font_family == 'century gothic, verdana, sans-serif') $o.=' selected="selected"';
		$o.='>century gothic, verdana, sans-serif</option>
		<option';
		if($header_font_family == 'courier new, monospace') $o.=' selected="selected"';
		$o.='>courier new, monospace</option>
		<option';
		if($header_font_family == 'georgia, serif') $o.=' selected="selected"';
		$o.='>georgia, serif</option>
		<option';
		if($header_font_family == 'times new roman, serif') $o.=' selected="selected"';
		$o.='>times new roman, serif</option>
		<option';
		if($header_font_family == 'verdana, sans-serif') $o.=' selected="selected"';
		$o.='>verdana, sans-serif</option>
		</select>
		</td>
		</tr>';
		
		
		// font size
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['font_size_px'] . '</td>
		<td><input type="text" name="header_font_size" value="' . $header_font_size . '"></td>
		</tr>';
		
		
		// line height
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['font_line_height_em'] . '</td>
		<td><input type="text" name="header_line_height" value="' . $header_line_height . '"></td>
		</tr>';
		
		
		// font color
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['font_color'] . '</td>
		<td><input type="text" name="header_font_color" value="' . $header_font_color . '" class="color {pickerPosition:\'right\',hash:true,caps:false,adjust:false}"></td>
		</tr>';
		
		
// HEADLINES
		
		$o.='<tr>
		<td colspan="2">
		<h6>' . $plugin_tx['templug']['headline_headlines'] . '</h6>
		</td>
		</tr>';
		
		
		// headlines color
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['headlines_all_colors'] . '</td>
		<td><input type="text" name="header_headlines_color" value="' . $header_headlines_color . '" class="color {pickerPosition:\'right\',hash:true,caps:false,adjust:false}"></td>
		</tr>';
		
		
		// headlines font family
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['headlines_all_font_family'] . '</td>
		<td><select name="header_headlines_font_family" style="width: 160px;">
		<option';
		if($header_headlines_font_family == 'arial, sans-serif') $o.=' selected="selected"';
		$o.='>arial, sans-serif</option>
		<option';
		if($header_headlines_font_family == 'century gothic, verdana, sans-serif') $o.=' selected="selected"';
		$o.='>century gothic, verdana, sans-serif</option>
		<option';
		if($header_headlines_font_family == 'courier new, monospace') $o.=' selected="selected"';
		$o.='>courier new, monospace</option>
		<option';
		if($header_headlines_font_family == 'georgia, serif') $o.=' selected="selected"';
		$o.='>georgia, serif</option>
		<option';
		if($header_headlines_font_family == 'times new roman, serif') $o.=' selected="selected"';
		$o.='>times new roman, serif</option>
		<option';
		if($header_headlines_font_family == 'verdana, sans-serif') $o.=' selected="selected"';
		$o.='>verdana, sans-serif</option>
		</select>
		</td>
		</tr>';
		
		
		// headlines font size
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['headlines_h123_font_size_px'] . '</td>
		<td><input type="text" name="header_h13_font_size" value="' . $header_h13_font_size . '"></td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['headlines_h4_font_size_px'] . '</td>
		<td><input type="text" name="header_h4_font_size" value="' . $header_h4_font_size . '"></td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['headlines_h5_font_size_px'] . '</td>
		<td><input type="text" name="header_h5_font_size" value="' . $header_h5_font_size . '"></td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['headlines_h6_font_size_px'] . '</td>
		<td><input type="text" name="header_h6_font_size" value="' . $header_h6_font_size . '"></td>
		</tr>';
		
		
// LINK COLORS
		
		$o.='<tr>
		<td colspan="2">
		<h6>' . $plugin_tx['templug']['headline_link_colors'] .'</h6>
		</td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['link_colors_link'] . '</td>
		<td><input type="text" name="header_alink_color" value="' . $header_alink_color . '" class="color {pickerPosition:\'right\',hash:true,caps:false,adjust:false}"></td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['link_colors_visited'] . '</td>
		<td><input type="text" name="header_vlink_color" value="' . $header_vlink_color . '" class="color {pickerPosition:\'right\',hash:true,caps:false,adjust:false}"></td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['link_colors_hover'] . '<div id="templug_upload"></div></td>
		<td><input type="text" name="header_hoverlink_color" value="' . $header_hoverlink_color . '" class="color {pickerPosition:\'right\',hash:true,caps:false,adjust:false}"></td>
		</tr>';
		
		$o.='</table>
		<br />';
		$o.='<input type="submit" name="Button" value="' . $plugin_tx['templug']['button_save_settings'] . '">';
		$o.='</form>';
		
		$o.='<p><a href="?&templug&admin=plugin_main&action=plugin_text">&laquo; ' . $plugin_tx['templug']['link_back'] . '</a></p>';
		
//		print_r($_POST);
	}
	
	if($_REQUEST['tp_config'] == 'header')
	{
		include($pth['folder']['plugins'] . 'templug/upload.php');
	}
?>