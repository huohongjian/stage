<?php // utf-8 Marker: äöü

if (!isset($_SESSION['sn']) || !function_exists('sv') || preg_match('#templug/config_#i', $_SERVER['SCRIPT_NAME']))
{
	die('no direct access');
}

	if($admin == 'plugin_main' && $_REQUEST['tp_config'] == 'basic')
	{
		include ($pth['folder']['templates'] . $_SESSION['tp_template'] . '/templug/data/config_basic.php');
		$o.='<p style="background: #060; color: #fff; text-align: center; border: 1px solid #222; padding: 4px 6px 6px 6px; margin: 20px 0 10px 0;">' . $plugin_tx['templug']['message_selected_template'] . ': <b>' . $_SESSION['tp_template'] . '</b></p>';
		
		$o.='<h5>' . $plugin_tx['templug']['headline_edit_basic_settings'] . '</h5>' . 
		'<p><a href="?&templug&admin=plugin_main&action=plugin_text">&laquo; ' . $plugin_tx['templug']['link_back'] . '</a></p>';
		
		$o.='<form method="post" action="' . $pth['folder']['templates'] . $_SESSION['tp_template'] . '/templug/config_basic_write.php">';
		$o.='<input type="submit" name="Button" value="' . $plugin_tx['templug']['button_save_settings'] . '">';
		$o.='<table id="tp_edit_area" cellspacing="0" style="font-family: arial, sans-serif; font-size: 15px;">';
		$o.='<tr><td colspan="2"><hr /></td></tr>';
		
		
// site_title
		
		$o.='<tr>
		<td style="height: 30px;">' . $plugin_tx['templug']['show_site_title'] . '</td>
		<td>
		<input type="radio" name="basic_show_site_title" value="true" ';
		if($basic_show_site_title == 'true')
		{
			$o.='checked="checked"';
		}
		$o.='> ' . $plugin_tx['templug']['radiobutton_true'] . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		<input type="radio" name="basic_show_site_title" value="false" ';
		
		if($basic_show_site_title == 'false')
		{
			$o.='checked="checked"';
		}
		$o.='> ' . $plugin_tx['templug']['radiobutton_false'] . '
		</td>
		</tr>';
		
		
// Locator
		
		$o.='<tr>
		<td style="height: 30px;">' . $plugin_tx['templug']['show_locator'] . '</td>
		<td>
		<input type="radio" name="basic_show_locator" value="true" ';
		if($basic_show_locator == 'true')
		{
			$o.='checked="checked"';
		}
		$o.='> ' . $plugin_tx['templug']['radiobutton_true'] . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		<input type="radio" name="basic_show_locator" value="false" ';
		
		if($basic_show_locator == 'false')
		{
			$o.='checked="checked"';
		}
		$o.='> ' . $plugin_tx['templug']['radiobutton_false'] . '
		</td>
		</tr>';
		
		
// Searchbox
		
		$o.='<tr>
		<td style="height: 30px;">' . $plugin_tx['templug']['show_search'] . '</td>
		<td>
		<input type="radio" name="basic_show_search" value="true" ';
		if($basic_show_search == 'true')
		{
			$o.='checked="checked"';
		}
		$o.='> ' . $plugin_tx['templug']['radiobutton_true'] . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		<input type="radio" name="basic_show_search" value="false" ';
		
		if($basic_show_search == 'false')
		{
			$o.='checked="checked"';
		}
		$o.='> ' . $plugin_tx['templug']['radiobutton_false'] . '
		</td>
		</tr>';
		
		$o.='<tr><td colspan="2"><hr /></td></tr>';
		
// Printlink
		
		$o.='<tr>
		<td style="height: 30px;">' . $plugin_tx['templug']['show_printlink'] . '</td>
		<td>
		<input type="radio" name="basic_show_printlink" value="true" ';
		if($basic_show_printlink == 'true')
		{
			$o.='checked="checked"';
		}
		$o.='> ' . $plugin_tx['templug']['radiobutton_true'] . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		<input type="radio" name="basic_show_printlink" value="false" ';
		
		if($basic_show_printlink == 'false')
		{
			$o.='checked="checked"';
		}
		$o.='> ' . $plugin_tx['templug']['radiobutton_false'] . '
		</td>
		</tr>';
		
		
// Sitemaplink
		
		$o.='<tr>
		<td style="height: 30px;">' . $plugin_tx['templug']['show_sitemaplink'] . '</td>
		<td>
		<input type="radio" name="basic_show_sitemaplink" value="true" ';
		if($basic_show_sitemaplink == 'true')
		{
			$o.='checked="checked"';
		}
		$o.='> ' . $plugin_tx['templug']['radiobutton_true'] . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		<input type="radio" name="basic_show_sitemaplink" value="false" ';
		
		if($basic_show_sitemaplink == 'false')
		{
			$o.='checked="checked"';
		}
		$o.='> ' . $plugin_tx['templug']['radiobutton_false'] . '
		</td>
		</tr>';	
		
		
// Subnav
		
		$o.='<tr>
		<td style="height: 30px;">' . $plugin_tx['templug']['show_subnav'] . '</td>
		<td>
		<input type="radio" name="basic_show_subnav" value="true" ';
		if($basic_show_subnav == 'true')
		{
			$o.='checked="checked"';
		}
		$o.='> ' . $plugin_tx['templug']['radiobutton_true'] . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		<input type="radio" name="basic_show_subnav" value="false" ';
		
		if($basic_show_subnav == 'false')
		{
			$o.='checked="checked"';
		}
		$o.='> ' . $plugin_tx['templug']['radiobutton_false'] . '
		</td>
		</tr>';
		
		
// Last Update
		
		$o.='<tr>
		<td style="height: 30px;">' . $plugin_tx['templug']['show_lastupdate'] . '</td>
		<td>
		<input type="radio" name="basic_show_lastupdate" value="true" ';
		if($basic_show_lastupdate == 'true')
		{
			$o.='checked="checked"';
		}
		$o.='> ' . $plugin_tx['templug']['radiobutton_true'] . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		<input type="radio" name="basic_show_lastupdate" value="false" ';
		
		if($basic_show_lastupdate == 'false')
		{
			$o.='checked="checked"';
		}
		$o.='> ' . $plugin_tx['templug']['radiobutton_false'] . '
		</td>
		</tr>';
		
		$o.='<tr><td colspan="2"><hr /></td></tr>';
		
		
// Submenu
		
		$o.='<tr>
		<td style="height: 30px;">' . $plugin_tx['templug']['show_submenu'] . '</td>
		<td>
		<input type="radio" name="basic_show_submenu" value="true" ';
		if($basic_show_submenu == 'true')
		{
			$o.='checked="checked"';
		}
		$o.='> ' . $plugin_tx['templug']['radiobutton_true'] . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		<input type="radio" name="basic_show_submenu" value="false" ';
		
		if($basic_show_submenu == 'false')
		{
			$o.='checked="checked"';
		}
		$o.='> ' . $plugin_tx['templug']['radiobutton_false'] . '
		</td>
		</tr>';
		
		
// prev/top/next
		
		$o.='<tr>
		<td style="height: 30px;">' . $plugin_tx['templug']['show_pagenav'] . '</td>
		<td>
		<input type="radio" name="basic_show_pagenav" value="true" ';
		if($basic_show_pagenav == 'true')
		{
			$o.='checked="checked"';
		}
		$o.='> ' . $plugin_tx['templug']['radiobutton_true'] . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		<input type="radio" name="basic_show_pagenav" value="false" ';
		
		if($basic_show_pagenav == 'false')
		{
			$o.='checked="checked"';
		}
		$o.='> ' . $plugin_tx['templug']['radiobutton_false'] . '
		</td>
		</tr>';
		
		$o.='<tr><td colspan="2"><hr /></td></tr>';
		
		
// Newsboxes
		
		$o.='<tr>
		<td style="height: 30px;">' . $plugin_tx['templug']['show_newsbox01'] . '</td>
		<td>
		<input type="radio" name="basic_show_newsbox01" value="true" ';
		if($basic_show_newsbox01 == 'true')
		{
			$o.='checked="checked"';
		}
		$o.='> ' . $plugin_tx['templug']['radiobutton_true'] . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		<input type="radio" name="basic_show_newsbox01" value="false" ';
		
		if($basic_show_newsbox01 == 'false')
		{
			$o.='checked="checked"';
		}
		$o.='> ' . $plugin_tx['templug']['radiobutton_false'] . '
		</td>
		</tr>';
		
		$o.='<tr>
		<td style="height: 30px;">' . $plugin_tx['templug']['show_newsbox02'] . '</td>
		<td>
		<input type="radio" name="basic_show_newsbox02" value="true" ';
		if($basic_show_newsbox02 == 'true')
		{
			$o.='checked="checked"';
		}
		$o.='> ' . $plugin_tx['templug']['radiobutton_true'] . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		<input type="radio" name="basic_show_newsbox02" value="false" ';
		
		if($basic_show_newsbox02 == 'false')
		{
			$o.='checked="checked"';
		}
		$o.='> ' . $plugin_tx['templug']['radiobutton_false'] . '
		</td>
		</tr>';
		
		$o.='<tr>
		<td style="height: 30px;">' . $plugin_tx['templug']['show_newsbox03'] . '</td>
		<td>
		<input type="radio" name="basic_show_newsbox03" value="true" ';
		if($basic_show_newsbox03 == 'true')
		{
			$o.='checked="checked"';
		}
		$o.='> ' . $plugin_tx['templug']['radiobutton_true'] . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		<input type="radio" name="basic_show_newsbox03" value="false" ';
		
		if($basic_show_newsbox03 == 'false')
		{
			$o.='checked="checked"';
		}
		$o.='> ' . $plugin_tx['templug']['radiobutton_false'] . '
		</td>
		</tr>';
		
		$o.='<tr><td colspan="2"><hr /></td></tr>';
		
		
// Login Link
		
		$o.='<tr>
		<td style="height: 30px;">' . $plugin_tx['templug']['show_loginlink'] . '</td>
		<td>
		<input type="radio" name="basic_show_login" value="true" ';
		if($basic_show_login == 'true')
		{
			$o.='checked="checked"';
		}
		$o.='> ' . $plugin_tx['templug']['radiobutton_true'] . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		<input type="radio" name="basic_show_login" value="false" ';
		
		if($basic_show_login == 'false')
		{
			$o.='checked="checked"';
		}
		$o.='> ' . $plugin_tx['templug']['radiobutton_false'] . '
		</td>
		</tr>';
		
		$o.='<tr><td colspan="2"><hr /></td></tr>';
		
		$o.='</table>';
		$o.='<input type="submit" name="Button" value="' . $plugin_tx['templug']['button_save_settings'] . '">';
		$o.='</form>';
		
		$o.='<p><a href="?&templug&admin=plugin_main&action=plugin_text">&laquo; ' . $plugin_tx['templug']['link_back'] . '</a></p>';
		
//		print_r($_POST);
	}
	?>