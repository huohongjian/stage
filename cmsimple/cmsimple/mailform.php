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

 
/* 
History:
2012-02-18  GE removed inline css to core.css, added outer div with id for better styling by template
2011-08-30  captcha on/off + change in error messages by svasti, code improvement by cmb
2010-06-12  Bob for XH 1.2 : Mail header subject localized
2009-09-18  GE for CMSimple_XH
2008-11-19  JB for 32SE added captcha, senders phone and name
*/

if (preg_match('/mailform.php/i',$_SERVER['SCRIPT_NAME']))die('Access Denied');

$o.= "\n" . '<div id="cmsimple_mailform">' .  "\n";
$o.= newsbox('CMSimpleMFC1');
$title = $tx['title'][$f];
$o .= '<h1>' . $title . '</h1>' . "\n";
$o.= newsbox('CMSimpleMFC2');
initvar('sendername');
initvar('senderphone');
initvar('sender');
initvar('getlast');
initvar('cap');
initvar('mailform');

$t = '';

if ($action == 'send')
{
	$msg = ($tx['mailform']['sendername'] . ": "
	. stsl($sendername) . "\n"
	. $tx['mailform']['senderphone'] . ": "
	. stsl($senderphone) . "\n\n" . stsl($mailform));

	if ($getlast != $cap && trim($cf['mailform']['captcha']) == 'true')
	{
		$e .= '<li>' . $tx['mailform']['captchafalse'] . '</li>';
	}
	if ($mailform == '')
	{
		$e .= '<li>' . $tx['mailform']['mustwritemessage'] . '</li>';
	}
	if (!(preg_match('!^[^@]+@[^@|^\s]+$!', $sender)))
	{
		$e .= '<li>' . $tx['mailform']['notaccepted'] . '</li>';
	}
	if (!$e && !(@mail_utf8($cf['mailform']['email'], $tx['menu']['mailform'] . ' ' . sv('SERVER_NAME'), $msg, "From: " . stsl($sender) . "\r\n" . "X-Remote: " . sv('REMOTE_ADDR') . "\r\n")))
	{
		$e .= '<li>' . $tx['mailform']['notsend'] . '</li>' . "\n";
	}
	else
	{
		$t = '<p>' . $tx['mailform']['send'] . '</p>' . "\n";
	}
}

if ($t == '' || $e != '')
{
// JB+ add captcha
	srand((double)microtime()*1000000);
	$random=rand(10000,99999);

	$o .= '<form action="'.$sn.'" method="post">' . "\n";

	$o .= tag('input type="hidden" name="function" value="mailform"') . "\n";

	if (trim($cf['mailform']['captcha']) == 'true')
	{
		$o .= tag('input type="hidden" name="getlast" value="'.$random.'"') . "\n";
	}
	$o .= tag('input type="hidden" name="action" value="send"') . "\n";

// fields before textarea 
	$o .= '<div>' . "\n" . $tx['mailform']['sendername'].': ' . tag('br') . "\n"
	.  tag('input type="text" class="text" size="35" name="sendername" value="'
	.  htmlspecialchars(stsl($sendername), ENT_COMPAT, 'UTF-8').'"') . "\n"
	.  '</div>' . "\n"
	.  '<div>' . "\n" . $tx['mailform']['senderphone'].': ' . tag('br') . "\n"
	.  tag('input type="text" class="text" size="35" name="senderphone" value="'
	.  htmlspecialchars(stsl($senderphone), ENT_COMPAT, 'UTF-8').'"') . "\n"
	. '</div>' . "\n"
	.  '<div>' . "\n" .  $tx['mailform']['sender'].': ' . tag('br') . "\n"
	.  tag('input type="text" class="text" size="35" name="sender" value="'
	.  htmlspecialchars(stsl($sender), ENT_COMPAT, 'UTF-8').'"') . "\n"
	. '</div>' . "\n" . tag('br') . "\n";

// textarea
	$o .= '<textarea rows="12" cols="40" name="mailform">' . "\n";
	if ($mailform != 'true') $o .= htmlspecialchars(stsl($mailform), ENT_COMPAT, 'UTF-8') . "\n";
	$o .= '</textarea>' . "\n";

// captcha
    if (trim($cf['mailform']['captcha']) == 'true')
	{
		$o .= '<p>' .  $tx['mailform']['captcha'] . '</p>' . "\n"
		. tag('input type="text" name="cap" class="captchainput"') . "\n"
		.  '<span class="captcha_code">' . "\n"
		.  $random . '</span>' . "\n";
    }

// sendbutton
	$o .= '<div style="clear: both;">' . "\n"
	.  tag('input type="submit" class="submit" value="'
	.  $tx['mailform']['sendbutton'] . '"') . "\n" . '</div>' . "\n";
	$o .= '</form>' . "\n";
}
else $o .= $t;

$o.= newsbox('CMSimpleMFC3');
$o.= '</div>' . "\n";

function mail_utf8($to, $subject = '(No Subject)', $message = '', $header = '')
{
	$header_ = 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/plain; charset=UTF-8' . "\r\n";
	if(mail($to, '=?UTF-8?B?'.base64_encode($subject).'?=', $message, $header_ . $header))
	{
		return true;
	}
	return false;
}
?>