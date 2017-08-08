<?php // utf-8 Marker: äöü

if (!isset($_SESSION['sn']) || !function_exists('sv') || preg_match('#templug/config_#i', $_SERVER['SCRIPT_NAME']))
{
	die('no direct access');
}

	if($admin == 'plugin_main' && $_REQUEST['tp_config'] == 'footer')
	{
		include ($pth['folder']['templates'] . $_SESSION['tp_template'] . '/templug/data/config_footer.php');
		$o.='<p style="background: #060; color: #fff; text-align: center; border: 1px solid #222; padding: 4px 6px 6px 6px; margin: 20px 0 10px 0;">' . $plugin_tx['templug']['message_selected_template'] . ': <b>' . $_SESSION['tp_template'] . '</b></p>';
		
		$o.='<h5>' . $plugin_tx['templug']['headline_edit_footer'] . '</h5>' . 
		'<p><a href="?&templug&admin=plugin_main&action=plugin_text">&laquo; ' . $plugin_tx['templug']['link_back'] . '</a></p>';
		
		$o.='<form method="post" action="' . $pth['folder']['templates'] . $_SESSION['tp_template'] . '/templug/config_footer_write.php">';
		$o.='<input type="submit" name="Button" value="' . $plugin_tx['templug']['button_save_settings'] . '">';
		$o.='<table id="tp_edit_area" cellspacing="0" style="font-family: arial, sans-serif; font-size: 15px;">';
		
		
// BACKGROUND
		
		$dir_bgfooter=opendir($pth['folder']['templates'] . $_SESSION['tp_template'] . '/images/footer');
		
		if(!$dir_bgfooter) die($plugin_tx['templug']['error_no_images_folder'] . $dir_bgfooter);
		
		$files_bgfooter=array();
		while(false!==($file_bgfooter=readdir($dir_bgfooter)))
		{
			if(preg_match("/\.jpe?g\Z/i", trim($file_bgfooter)) || preg_match("/\.png\Z/i", trim($file_bgfooter)) || preg_match("/\.gif\Z/i", trim($file_bgfooter)))
			{
				$files_bgfooter[]=trim($file_bgfooter);
			}
		}
		closedir($dir_bgfooter);
		sort($files_bgfooter);
		
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
		
		// Background image footer
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['background_image'] . '</td>
		<td>';
		$o.='<select name="footer_background_image" style="width: 160px;">';
		
		foreach ($files_bgfooter as $num => $rec)
		{
			if($footer_background_image == $rec)
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
		
		
		// background image footer repeat
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['background_image_repeat'] . '</td>
		<td><select name="footer_background_repeat" style="width: 160px;">
		<option';
		if($footer_background_repeat == 'no-repeat') $o.=' selected="selected"';
		$o.='>no-repeat</option>
		<option';
		if($footer_background_repeat == 'repeat') $o.=' selected="selected"';
		$o.='>repeat</option>
		<option';
		if($footer_background_repeat == 'repeat-x') $o.=' selected="selected"';
		$o.='>repeat-x</option>
		<option';
		if($footer_background_repeat == 'repeat-y') $o.=' selected="selected"';
		$o.='>repeat-y</option>
		</select>
		</td>
		</tr>';
		
		
		// background image footer position
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['background_image_position'] . '</td>
		<td><select name="footer_background_position" style="width: 160px;">
		<option';
		if($footer_background_position == 'left top') $o.=' selected="selected"';
		$o.='>left top</option>
		<option';
		if($footer_background_position == 'right top') $o.=' selected="selected"';
		$o.='>right top</option>
		<option';
		if($footer_background_position == 'center top') $o.=' selected="selected"';
		$o.='>center top</option>
		<option';
		if($footer_background_position == 'left') $o.=' selected="selected"';
		$o.='>left</option>
		<option';
		if($footer_background_position == 'right') $o.=' selected="selected"';
		$o.='>right</option>
		<option';
		if($footer_background_position == 'center') $o.=' selected="selected"';
		$o.='>center</option>
		<option';
		if($footer_background_position == 'left bottom') $o.=' selected="selected"';
		$o.='>left bottom</option>
		<option';
		if($footer_background_position == 'right bottom') $o.=' selected="selected"';
		$o.='>right bottom</option>
		<option';
		if($footer_background_position == 'center bottom') $o.=' selected="selected"';
		$o.='>center bottom</option>
		</select>
		</td>
		</tr>';
		
		
		// background color footer
		
		$o.='<tr>
		<td valign="top"><a class="pl_tooltip" href="#"><img src="./plugins/pluginloader/css/help_icon.png" alt=""/><span>' . $plugin_tx['templug']['help_color'] . '</span></a> ' . $plugin_tx['templug']['background_color'] . '</td>
		<td><input type="text" name="footer_background_color" value="' . $footer_background_color . '" class="color {pickerPosition:\'right\',hash:true,caps:false,adjust:false}"></td>
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
		<td><input type="text" name="footer_border_color" value="' . $footer_border_color . '" class="color {pickerPosition:\'right\',hash:true,caps:false,adjust:false}"></td>
		</tr>';
		
		
		// border width
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['border_width'] . '</td>
		<td><input type="text" name="footer_border_width" value="' . $footer_border_width . '"></td>
		</tr>';
		
		
		// border style
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['border_style'] . '</td>
		<td><select name="footer_border_style" style="width: 160px;">
		<option';
		if($footer_border_style == 'solid') $o.=' selected="selected"';
		$o.='>solid</option>
		<option';
		if($footer_border_style == 'double') $o.=' selected="selected"';
		$o.='>double</option>
		<option';
		if($footer_border_style == 'dotted') $o.=' selected="selected"';
		$o.='>dotted</option>
		<option';
		if($footer_border_style == 'dashed') $o.=' selected="selected"';
		$o.='>dashed</option>
		<option';
		if($footer_border_style == 'groove') $o.=' selected="selected"';
		$o.='>groove</option>
		<option';
		if($footer_border_style == 'ridge') $o.=' selected="selected"';
		$o.='>ridge</option>
		<option';
		if($footer_border_style == 'inset') $o.=' selected="selected"';
		$o.='>inset</option>
		<option';
		if($footer_border_style == 'outset') $o.=' selected="selected"';
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
		<td><input type="text" name="footer_margin_top" value="' . $footer_margin_top . '"></td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['spacings_right_px'] . '</td>
		<td><input type="text" name="footer_margin_right" value="' . $footer_margin_right . '"></td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['spacings_bottom_px'] . '</td>
		<td><input type="text" name="footer_margin_bottom" value="' . $footer_margin_bottom . '"></td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['spacings_left_px'] . '</td>
		<td><input type="text" name="footer_margin_left" value="' . $footer_margin_left . '"></td>
		</tr>';
		
		
// PADDING
		
		$o.='<tr>
		<td colspan="2">
		<h6>' . $plugin_tx['templug']['headline_padding'] . '</h6>
		</td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['spacings_top_px'] . '</td>
		<td><input type="text" name="footer_padding_top" value="' . $footer_padding_top . '"></td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['spacings_right_px'] . '</td>
		<td><input type="text" name="footer_padding_right" value="' . $footer_padding_right . '"></td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['spacings_bottom_px'] . '</td>
		<td><input type="text" name="footer_padding_bottom" value="' . $footer_padding_bottom . '"></td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['spacings_left_px'] . '</td>
		<td><input type="text" name="footer_padding_left" value="' . $footer_padding_left . '"></td>
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
		<td><select name="footer_font_family" style="width: 160px;">
		<option';
		if($footer_font_family == 'arial, sans-serif') $o.=' selected="selected"';
		$o.='>arial, sans-serif</option>
		<option';
		if($footer_font_family == 'century gothic, verdana, sans-serif') $o.=' selected="selected"';
		$o.='>century gothic, verdana, sans-serif</option>
		<option';
		if($footer_font_family == 'courier new, monospace') $o.=' selected="selected"';
		$o.='>courier new, monospace</option>
		<option';
		if($footer_font_family == 'georgia, serif') $o.=' selected="selected"';
		$o.='>georgia, serif</option>
		<option';
		if($footer_font_family == 'times new roman, serif') $o.=' selected="selected"';
		$o.='>times new roman, serif</option>
		<option';
		if($footer_font_family == 'verdana, sans-serif') $o.=' selected="selected"';
		$o.='>verdana, sans-serif</option>
		</select>
		</td>
		</tr>';
		
		
		// font size
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['font_size_px'] . '</td>
		<td><input type="text" name="footer_font_size" value="' . $footer_font_size . '"></td>
		</tr>';
		
		
		// line height
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['font_line_height_em'] . '</td>
		<td><input type="text" name="footer_line_height" value="' . $footer_line_height . '"></td>
		</tr>';
		
		
		// font color
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['font_color'] . '</td>
		<td><input type="text" name="footer_font_color" value="' . $footer_font_color . '" class="color {pickerPosition:\'right\',hash:true,caps:false,adjust:false}"></td>
		</tr>';
		
		
		// text align
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['font_text_align'] . '</td>
		<td><select name="footer_text_align" style="width: 160px;">
		<option';
		if($footer_text_align == 'left') $o.=' selected="selected"';
		$o.='>left</option>
		<option';
		if($footer_text_align == 'center') $o.=' selected="selected"';
		$o.='>center</option>
		<option';
		if($footer_text_align == 'right') $o.=' selected="selected"';
		$o.='>right</option>
		</select>
		</td>
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
		<td><input type="text" name="footer_headlines_color" value="' . $footer_headlines_color . '" class="color {pickerPosition:\'right\',hash:true,caps:false,adjust:false}"></td>
		</tr>';
		
		
		// headlines font family
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['headlines_all_font_family'] . '</td>
		<td><select name="footer_headlines_font_family" style="width: 160px;">
		<option';
		if($footer_headlines_font_family == 'arial, sans-serif') $o.=' selected="selected"';
		$o.='>arial, sans-serif</option>
		<option';
		if($footer_headlines_font_family == 'century gothic, verdana, sans-serif') $o.=' selected="selected"';
		$o.='>century gothic, verdana, sans-serif</option>
		<option';
		if($footer_headlines_font_family == 'courier new, monospace') $o.=' selected="selected"';
		$o.='>courier new, monospace</option>
		<option';
		if($footer_headlines_font_family == 'georgia, serif') $o.=' selected="selected"';
		$o.='>georgia, serif</option>
		<option';
		if($footer_headlines_font_family == 'times new roman, serif') $o.=' selected="selected"';
		$o.='>times new roman, serif</option>
		<option';
		if($footer_headlines_font_family == 'verdana, sans-serif') $o.=' selected="selected"';
		$o.='>verdana, sans-serif</option>
		</select>
		</td>
		</tr>';
		
		
		// headlines font size
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['headlines_h123_font_size_px'] . '</td>
		<td><input type="text" name="footer_h13_font_size" value="' . $footer_h13_font_size . '"></td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['headlines_h4_font_size_px'] . '</td>
		<td><input type="text" name="footer_h4_font_size" value="' . $footer_h4_font_size . '"></td>
		</tr>';
		
				$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['headlines_h5_font_size_px'] . '</td>
		<td><input type="text" name="footer_h5_font_size" value="' . $footer_h5_font_size . '"></td>
		</tr>';
		
				$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['headlines_h6_font_size_px'] . '</td>
		<td><input type="text" name="footer_h6_font_size" value="' . $footer_h6_font_size . '"></td>
		</tr>';
		
		
// LINK COLORS
		
		$o.='<tr>
		<td colspan="2">
		<h6>' . $plugin_tx['templug']['headline_link_colors'] .'</h6>
		</td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['link_colors_link'] . '</td>
		<td><input type="text" name="footer_alink_color" value="' . $footer_alink_color . '" class="color {pickerPosition:\'right\',hash:true,caps:false,adjust:false}"></td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['link_colors_visited'] . '</td>
		<td><input type="text" name="footer_vlink_color" value="' . $footer_vlink_color . '" class="color {pickerPosition:\'right\',hash:true,caps:false,adjust:false}"></td>
		</tr>';
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['link_colors_hover'] . '<div id="templug_upload"></div></td>
		<td><input type="text" name="footer_hoverlink_color" value="' . $footer_hoverlink_color . '" class="color {pickerPosition:\'right\',hash:true,caps:false,adjust:false}"></td>
		</tr>';
		
		$o.='</table>
		<br />';
		$o.='<input type="submit" name="Button" value="' . $plugin_tx['templug']['button_save_settings'] . '">';
		$o.='</form>';
		
		$o.='<p><a href="?&templug&admin=plugin_main&action=plugin_text">&laquo; ' . $plugin_tx['templug']['link_back'] . '</a></p>';
		
//		print_r($_POST);
	}
	
	if($_REQUEST['tp_config'] == 'footer')
	{
		include($pth['folder']['plugins'] . 'templug/upload.php');
	}
?>