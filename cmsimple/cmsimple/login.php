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

global $pth;

if (preg_match('/login.php/i', $_SERVER['SCRIPT_NAME']))
    die('Access Denied');

require $pth['folder']['cmsimple'] . 'PasswordHash.php'; 
$xh_hasher = new PasswordHash(8, true);

if(isset($cf['security']['type']))
{
	unset($cf['security']['type']);
}

function gc($s) 
{
    if (!isset($_COOKIE)) 
    {
        global $_COOKIE;
        $_COOKIE = $GLOBALS['HTTP_COOKIE_VARS'];
    }
    if (isset($_COOKIE[$s]))
        return $_COOKIE[$s];
}

function logincheck() 
{
    global $cf;
    
    return (gc('passwd') == $cf['security']['password']);
}

function writelog($m) 
{
    global $pth, $e;
	
	$logfileContent = file_get_contents($pth['file']['log']);
	
    if ($fh = @fopen($pth['file']['log'], "w")) 
	{
        fwrite($fh, $m . $logfileContent);
        fclose($fh);
    }
}

function loginforms() 
{
    global $adm, $cf, $print, $hjs, $tx, $onload, $f, $o, $s, $sn, $u;

    if ($f == 'login') 
	{

        $cf['meta']['robots'] = "noindex";
        $onload .= "self.focus();document.login.passwd.focus();";
        $f = $tx['menu']['login'];
        $o .= '<h1>' . $tx['menu']['login'] . '</h1>
<div style="padding: 0 0 24px 0; font-weight: 700;">
' . str_replace(tag('br').tag('br').tag('br').tag('br'),tag('br').tag('br'), str_replace("\r",tag('br'),str_replace("\n",tag('br'),$tx['login']['warning']))) . '
</div>
<div id="cmsimple_loginform">
<form id="login" name="login" action="' . $sn . '?' . $u[$s] . '" method="post">' . "\n"
 . tag('input type="hidden" name="login" value="true"') . "\n"
 . tag('input type="hidden" name="selected" value="' . @$u[$s] . '"') . "\n" . 'User (optional): ' . tag('br')
 . tag('input type="text" name="user" id="user" value=""') . ' ' . "\n" . tag('br') . 'Password: ' . tag('br')
 . tag('input type="password" name="passwd" id="passwd" value=""') . ' ' . "\n" . tag('br') . tag('br')
 . tag('input type="submit" name="submit" id="submit" value="' . $tx['menu']['login'] . '"') . '
</form>
</div>';
        $s = -1;
    }
}

// LOGIN & BACKUP

$adm = (gc('status' . str_replace('.','xc6oMd3Rs689',str_replace('index.php','',$sn))) == 'adm' && logincheck());

if ($login && $passwd == '' && !$adm) 
{
    $login = null;
    $f = 'login';
}

if ($login && !$adm) 
{
    if ($xh_hasher->CheckPassword($passwd, $cf['security']['password']))
    {
		setcookie('status' . str_replace('.','xc6oMd3Rs689',str_replace('index.php','',$sn)), 'adm', 0, CMSIMPLE_ROOT);
		setcookie('status', 'adm', 0, CMSIMPLE_ROOT);
		setcookie('passwd', $cf['security']['password'], 0);
		$adm = true;
		$edit = true;
		writelog(date("Y-m-d H:i:s") . " from " . sv('REMOTE_ADDR') . " logged_in: $sn" . ' - "' . strip_tags($_POST['user']) ."\"\n");
    }
    else
	{
		writelog(date("Y-m-d H:i:s")." from ".sv('REMOTE_ADDR')." login failed: $sn ##### \"" . strip_tags($_POST['user']) . "\" ##### \n");
		shead('401');
	}
} 
else if ($logout && $adm) 
{
    $backupDate = date("Ymd_His");
    $fn = $backupDate . '_content.htm';
    if (@copy($pth['file']['content'], $pth['folder']['content'] . $fn)) 
	{
        $o .= '<p>' . ucfirst($tx['filetype']['backup']) . ' ' . $fn . ' ' . $tx['result']['created'] . '</p>';
        $fl = array();
        $fd = @opendir($pth['folder']['content']);
        while (($p = @readdir($fd)) == true) 
		{
            if (preg_match("/\d{3}\_content.htm/", $p))
                $fl[] = $p;
        }
        if ($fd == true)
            closedir($fd);
        @sort($fl, SORT_STRING);
        $v = count($fl) - $cf['backup']['numberoffiles'];
        for ($i = 0; $i < $v; $i++) 
		{
            if (@unlink($pth['folder']['content'] . '/' . $fl[$i]))
                $o .= '<p>' . ucfirst($tx['filetype']['backup']) . ' ' . $fl[$i] . ' ' . $tx['result']['deleted'] . '</p>';
            else
                e('cntdelete', 'backup', $fl[$i]);
        }
    }
    else
	{
        e('cntsave', 'backup', $fn);
	}

// SAVE function for pagedata.php added

    if (file_exists($pth['folder']['content'] . 'pagedata.php')) 
	{
        $fn = $backupDate . '_pagedata.php';
        if (@copy($pth['file']['pagedata'], $pth['folder']['content'] . $fn)) 
		{
            $o .= '<p>' . ucfirst($tx['filetype']['backup']) . ' ' . $fn . ' ' . $tx['result']['created'] . '</p>';
            $fl = array();
            $fd = @opendir($pth['folder']['content']);
            while (($p = @readdir($fd)) == true) 
			{
                if (preg_match("/\d{3}\_pagedata.php/", $p))
                    $fl[] = $p;
            }
            if ($fd == true)
                closedir($fd);
            @sort($fl, SORT_STRING);
            $v = count($fl) - $cf['backup']['numberoffiles'];
            for ($i = 0; $i < $v; $i++) 
			{
                if (@unlink($pth['folder']['content'] . $fl[$i]))
                    $o .= '<p>' . ucfirst($tx['filetype']['backup']) . ' ' . $fl[$i] . ' ' . $tx['result']['deleted'] . '</p>';
                else
                    e('cntdelete', 'backup', $fl[$i]);
            }
        }
        else
		{
            e('cntsave', 'backup', $fn);
		}
    }

// END save function for pagedata.php


    $adm = false;
	setcookie('status' . str_replace('.','xc6oMd3Rs689',str_replace('index.php','',$sn)), '', 0, CMSIMPLE_ROOT);
	setcookie('status', '', 0, CMSIMPLE_ROOT);
    setcookie('passwd', '', 0);
    $o .= '<p class="cmsimplecore_warning" style="text-align: center; font-weight: 700; padding: 8px;">' . $tx['login']['loggedout'] . '</p>';
}

// SETTING FUNCTIONS AS PERMITTED

if ($adm) 
{
    if ($edit)
        setcookie('mode', 'edit', 0);
    if ($normal)
        setcookie('mode', '', 0);
    if (gc('mode') == 'edit' && !$normal)
        $edit = true;
} 
else 
{
    if (gc('status' . str_replace('.','xc6oMd3Rs689',str_replace('index.php','',$sn))) != '')
        setcookie('status' . str_replace('index.php','',$sn), '', 0);
	if (gc('status') != '')
        setcookie('status', '', 0, CMSIMPLE_ROOT);
    if (gc('passwd') != '')
        setcookie('passwd', '', 0);
    if (gc('mode') == 'edit')
        setcookie('mode', '', 0);
}
?>