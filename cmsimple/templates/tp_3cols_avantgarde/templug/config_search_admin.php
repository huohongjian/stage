<?php // utf-8 Marker: äöü

if (!isset($_SESSION['sn']) || !function_exists('sv') || preg_match('#templug/config_#i', $_SERVER['SCRIPT_NAME']))
{
	die('no direct access');
}

	if($admin == 'plugin_main' && $_REQUEST['tp_config'] == 'search')
	{
		include ($pth['folder']['templates'] . $_SESSION['tp_template'] . '/templug/data/config_search.php');
		$o.='<p style="background: #060; color: #fff; text-align: center; border: 1px solid #222; padding: 4px 6px 6px 6px; margin: 20px 0 10px 0;">' . $plugin_tx['templug']['message_selected_template'] . ': <b>' . $_SESSION['tp_template'] . '</b></p>';
		
		$o.='<h5>' . $plugin_tx['templug']['headline_edit_search'] . '</h5>' . 
		'<p><a href="?&templug&admin=plugin_main&action=plugin_text">&laquo; ' . $plugin_tx['templug']['link_back'] . '</a></p>';
		
		$o.='<form method="post" action="' . $pth['folder']['templates'] . $_SESSION['tp_template'] . '/templug/config_search_write.php">';
		$o.='<input type="submit" name="Button" value="' . $plugin_tx['templug']['button_save_settings'] . '">';
		$o.='<table id="tp_edit_area" cellspacing="0" style="font-family: arial, sans-serif; font-size: 15px;">';
		
		
// SEARCH INPUT FIELD
		
		$o.='<tr>
		<td colspan="2">
		<h6>' . $plugin_tx['templug']['headline_input_field'] . '</h6>
		</td>
		</tr>';
		
		
		// search input field width
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['elements_width_px'] . '</td>
		<td><input type="text" name="search_input_width" value="' . $search_input_width . '"></td>
		</tr>';
		
		
		// search input field background color
		
		$o.='<tr>
		<td valign="top"><a class="pl_tooltip" href="#"><img src="./plugins/pluginloader/css/help_icon.png" alt=""/><span>' . $plugin_tx['templug']['help_color'] . '</span></a> ' . $plugin_tx['templug']['background_color'] . '</td>
		<td><input type="text" name="search_input_background_color" value="' . $search_input_background_color . '" class="color {pickerPosition:\'right\',hash:true,caps:false,adjust:false}"></td>
		</tr>';
		
		
		// search input field font color
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['font_color'] . '</td>
		<td><input type="text" name="search_input_color" value="' . $search_input_color . '" class="color {pickerPosition:\'right\',hash:true,caps:false,adjust:false}"></td>
		</tr>';
		
		
		// search input field border color
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['border_color'] . '</td>
		<td><input type="text" name="search_input_border_color" value="' . $search_input_border_color . '" class="color {pickerPosition:\'right\',hash:true,caps:false,adjust:false}"></td>
		</tr>';
		
		
		// search input field border width
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['border_width'] . '</td>
		<td><input type="text" name="search_input_border_width" value="' . $search_input_border_width . '"></td>
		</tr>';
		
		
		// search input field border style
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['border_style'] . '</td>
		<td><select name="search_input_border_style" style="width: 160px;">
		<option';
		if($search_input_border_style == 'solid') $o.=' selected="selected"';
		$o.='>solid</option>
		<option';
		if($search_input_border_style == 'double') $o.=' selected="selected"';
		$o.='>double</option>
		<option';
		if($search_input_border_style == 'dotted') $o.=' selected="selected"';
		$o.='>dotted</option>
		<option';
		if($search_input_border_style == 'dashed') $o.=' selected="selected"';
		$o.='>dashed</option>
		<option';
		if($search_input_border_style == 'groove') $o.=' selected="selected"';
		$o.='>groove</option>
		<option';
		if($search_input_border_style == 'ridge') $o.=' selected="selected"';
		$o.='>ridge</option>
		<option';
		if($search_input_border_style == 'inset') $o.=' selected="selected"';
		$o.='>inset</option>
		<option';
		if($search_input_border_style == 'outset') $o.=' selected="selected"';
		$o.='>outset</option>
		</select>
		</td>
		</tr>';
		
		
// SEARCH SUBMIT BUTTON
		
		$o.='<tr>
		<td colspan="2">
		<h6>' . $plugin_tx['templug']['headline_submit_button'] . '</h6>
		</td>
		</tr>';
		
		
		// background color submit button
		
		$o.='<tr>
		<td valign="top"><a class="pl_tooltip" href="#"><img src="./plugins/pluginloader/css/help_icon.png" alt=""/><span>' . $plugin_tx['templug']['help_color'] . '</span></a> ' . $plugin_tx['templug']['background_color'] . '</td>
		<td><input type="text" name="search_submit_background_color" value="' . $search_submit_background_color . '" class="color {pickerPosition:\'right\',hash:true,caps:false,adjust:false}"></td>
		</tr>';
		
		
		// font color submit button
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['font_color'] . '</td>
		<td><input type="text" name="search_submit_color" value="' . $search_submit_color . '" class="color {pickerPosition:\'right\',hash:true,caps:false,adjust:false}"></td>
		</tr>';
		
		
		// border color submit button
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['border_color'] . '</td>
		<td><input type="text" name="search_submit_border_color" value="' . $search_submit_border_color . '" class="color {pickerPosition:\'right\',hash:true,caps:false,adjust:false}"></td>
		</tr>';
		
		
		// border width submit button
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['border_width'] . '</td>
		<td><input type="text" name="search_submit_border_width" value="' . $search_submit_border_width . '"></td>
		</tr>';
		
		
		// border style submit button
		
		$o.='<tr>
		<td valign="top">' . $plugin_tx['templug']['border_style'] . '</td>
		<td><select name="search_submit_border_style" style="width: 160px;">
		<option';
		if($search_submit_border_style == 'solid') $o.=' selected="selected"';
		$o.='>solid</option>
		<option';
		if($search_submit_border_style == 'double') $o.=' selected="selected"';
		$o.='>double</option>
		<option';
		if($search_submit_border_style == 'dotted') $o.=' selected="selected"';
		$o.='>dotted</option>
		<option';
		if($search_submit_border_style == 'dashed') $o.=' selected="selected"';
		$o.='>dashed</option>
		<option';
		if($search_submit_border_style == 'groove') $o.=' selected="selected"';
		$o.='>groove</option>
		<option';
		if($search_submit_border_style == 'ridge') $o.=' selected="selected"';
		$o.='>ridge</option>
		<option';
		if($search_submit_border_style == 'inset') $o.=' selected="selected"';
		$o.='>inset</option>
		<option';
		if($search_submit_border_style == 'outset') $o.=' selected="selected"';
		$o.='>outset</option>
		</select>
		</td>
		</tr>';
		
		$o.='</table>
		<br />';
		$o.='<input type="submit" name="Button" value="' . $plugin_tx['templug']['button_save_settings'] . '">';
		$o.='</form>';
		
		$o.='<p><a href="?&templug&admin=plugin_main&action=plugin_text">&laquo; ' . $plugin_tx['templug']['link_back'] . '</a></p>';
		
//		print_r($_POST);
	}

?>