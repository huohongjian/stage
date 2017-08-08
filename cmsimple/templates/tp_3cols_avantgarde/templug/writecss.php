<?php // utf-8 Marker: äöü;
@session_start();

if (!isset($_SESSION['sn']) || !$_POST)
{
    die('Access Denied');
}

if(!is_writeable('../stylesheet.css'))
{
	die('<p>The file</p><p style="font-family: courier new, monospace; font-weight: 700;">./templates/' . $_SESSION['tp_template'] . '/stylesheet.css</p><p>is not writeable, please check the writing permissions of the file.</p>');
}
else
{

$dir_choose_tpid=opendir('../images');
$dirs_tpids=array();
while(false!==($dir_tpids=readdir($dir_choose_tpid)))
{
	if(!strpos($dir_tpids, '.') && $dir_tpids != '..' && $dir_tpids != '.')
	{
		$dirs_tpids[]=trim($dir_tpids);
	}
}
closedir($dir_choose_tpid);

foreach ($dirs_tpids as $tp_num => $tp_rec)
{
	include('data/config_' . $tp_rec . '.php');
}

$cssdatei = fopen('../stylesheet.css', 'w+');
ftruncate($cssdatei, 0);
$cssinhalt='/* RESET BROWSERSTYLE */

* {padding: 0; margin: 0;}


/* VORDEFINIERTE KLASSEN FUER BILDER / PREDEFINED CLASSES FOR IMAGES */

img.tp_left {
float: left; 
margin: 0 20px 10px 0;
}

img.tp_right {
float: right; 
margin: 0 0 10px 20px;
}

img.tp_center {
margin: 10px auto;
}

img.tp_border {
border: 1px solid #999;
}

img.tp_noborder {
border: 0;
}

.tp_box01 {
background: #eeeeee; 
border: 3px solid #789; 
padding: 8px 16px; 
margin: 12px 0;
}


/* GLOBAL */

h1, h2, h3 {
font-family: verdana, sans-serif; 
color: #333; 
font-size: 20px; 
line-height: 1.2em; 
font-weight: 100; 
letter-spacing: 1px; 
padding: 0 0 6px 0; 
margin: 10px 0 20px 0;
}

h4 {
font-family: verdana, sans-serif; 
color: #333; 
font-size: 18px; 
line-height: 1.4em; 
font-weight: 100; 
letter-spacing: 1px; 
margin: 15px 0 10px 0;
}

h5 {
font-family: verdana, sans-serif; 
color: #333; 
font-size: 17px; 
line-height: 1.4em; 
font-weight: 100; 
letter-spacing: 1px; 
margin: 15px 0 10px 0;
}

h6 {
font-family: verdana, sans-serif; 
color: #333; 
font-size: 16px; 
line-height: 1.4em; 
font-weight: 100; 
letter-spacing: 1px; 
margin: 15px 0 10px 0;
}

p {
margin: 10px 0;
}

ol {
margin: 6px 0;
}

ol li {
line-height: 1.0em; 
border: 0; 
padding: 3px 0; 
margin: 0 0 0 22px;
}

ul {
list-style-image: url(images/inhlist.gif); 
margin: 6px 0;
}

ul li {
line-height: 1.2em; 
border: 0; 
padding: 3px 0; 
margin: 0 0 0 17px;
}

hr {
height: 1px; 
clear: both; 
color: #999; 
background-color: #999; 
border: 0;
}

blockquote {
padding: 2px 0 2px 20px; 
border-left: 3px solid #999;
}


/* BODY UND SEITE / BODY AND PAGE */

#tp_body {
text-align: left;
}

#TOP {
font-size: 0px; 
line-height: 10px;
}


/* MAIN */

#tp_main {
text-align: left; 
margin: 0;
}


/* LOCATOR / LOCATOR */

#tp_locator {}


/* SIDEBAR NAVIGATION */

#tp_nav {
width: 20%;
float: left; 
}

#tp_nav li {
list-style-type: none; 
list-style-image: none;
}


/* TOC (menu) area */

#tp_nav ul.menulevel1 {
border: 0; 
padding: 6px 0 0 0; 
margin: 0;
}

#tp_nav ul.menulevel1 li {
padding: 9px 0 6px 0; 
margin: 3px 0;
}

#tp_nav ul ul.menulevel2 {
border: 0; 
padding: 8px 0 4px 0; 
margin: 0;
}

#tp_nav ul ul.menulevel2 li {
font-weight: 300; 
border: 0; 
padding: 2px 0 6px 1px;
margin: 0;
}

#tp_nav ul ul ul.menulevel3 {
margin: 5px 0 5px 0;
}

#tp_nav ul ul ul.menulevel3 li {
font-weight: 300; 
border: 0; 
padding: 4px 0 4px 16px; 
margin: 0;
}

#tp_nav ul.subnav {
list-style-type: none; 
text-align: left; 
padding: 20px 10px 0 0; 
margin: 0;
}

#tp_nav ul.subnav li {
padding: 3px 0; 
margin: 0;
}

.langmenu {
color: #333; 
margin: 0 0 16px 0;
}

#tp_nav hr {
height: 1px; 
clear: both; 
color: #666; 
background-color: #666; 
border: 0; 
margin: 0 0 9px 0;
}


/* Subnav area */

div#tp_subnav {
float: right; 
width: 100%; 
text-align: left; 
border: 0; 
padding: 0; 
margin: 0;
}

div#tp_subnav {
list-style-type: none; 
text-align: left;
}

div#tp_subnav ul {
list-style-type: none; 
text-align: left; 
padding: 0 10px 10px 0; 
margin: 0;
}

div#tp_subnav li {
font-size: 14px; 
padding: 3px 0; 
margin: 0;
}


/* INHALT / CONTENT */

#tp_content {
float: left; 
width: 54.8%; 
border: 0;
margin: 0;
}

/* langmenu */

img.flag {
margin-left: 16px;
}

#tp_contentin li {
background: none;
}


/* KOPF / HEADER */

#tp_header {
border: 0;
}


/* SEITENNAVIGATION / PAGE NAVIGATION */

#tp_pagenavin span {
padding: 0 6px 0 2px;
}


/* NEWSBOXEN / NEWSBOXES */

#tp_newsarea {
width: 25%; 
float: right;
text-align: left;
border: 0;
}

div.tp_newsbox {}

div.tp_newsboxin ul {
list-style-type: none; 
list-style-image: none; 
padding: 6px 0 12px 0;
}

div.tp_newsboxin li {
list-style-type: none; 
list-style-image: none; 
line-height: 1.2em; 
padding: 1px 5px; 
margin: 2px 0;
}


/* FUSSLINKS / FOOTER LINKS */

#tp_footer {
border: 0;
}


/* LINKFORMATIERUNG / LINKS */

a:link {
text-decoration: none;
}

a:visited {
text-decoration: none;
}

a:hover, a:active, a:focus {
text-decoration: none;
}


/* SONSTIGES / THE REST */

.submit {
margin: 1px;
}

#passwd {
border: 1px solid #999;
}

.file {
border: 1px solid #999;
}

p.code {
background: #eed; 
font-family: courier new, serif; 
border: 1px solid #997; 
padding: 10px 16px;
}

.scroll {
background: #eec; 
border: 1px solid #997; 
padding: 10px; 
overflow: scroll;
}

.retrieve {
background: #ffffff; 
background-image: none; 
border: 0;
}

table.edit {
background: #eee; 
font-size: 14px; 
line-height: 1.2em; 
border: 3px solid #c60; 
margin: 1px 0;
}

table.edit td {
text-align: center; 
border: 0; 
padding: 8px 12px;
}

table.edit a:link {
color: #258!important; 
text-decoration: none;
}

table.edit a:visited {
color: #258!important; 
text-decoration: none;
}

table.edit a:hover, table.edit a:active, table.edit a:focus {
color: #c60!important; 
text-decoration: none;
}

textarea {
width: 90%; 
background: #f6f6f6; 
font-family: arial, sans-serif; 
border: 1px solid #999; 
padding: 10px; 
margin: 0 0 10px 0;
}

.hinweis {
line-height: 1.2em; 
padding: 2px 10px;
}


/* 
============================================================
VON TemPlug_XH ERZEUGTES CSS
Bitte nicht ändern, wenn Sie das Plugin TemPlug_XH benutzen!
============================================================
CSS CREATED BY TemPlug_XH
Please do not change, if you use the plugin TemPlug_XH!
============================================================
*/

body {
background-color: ' . $content_background_color . '; 
font-family: ' . $content_font_family . '; 
font-size: ' . $content_font_size . 'px; 
line-height: ' . $content_line_height . 'em; 
color: ' . $content_font_color . ';
padding: 0;
margin: 0;
border: 0;
}

#tp_body {
background-color: ' . $body_background_color . ';
background-image: url(images/body/' . $body_background_image . ');
background-repeat: ' . $body_background_repeat . ';
background-position: ' . $body_background_position . ';
background-attachment: ' . $body_background_attachment . ';
}

#tp_main {
width: ' . $main_width . 'px;
margin: 0 auto;
}

#tp_mainin {
background-color: ' . $main_background_color . ';
background-image: url(images/main/' . $main_background_image . ');
background-repeat: ' . $main_background_repeat . ';
background-position: ' . $main_background_position . ';
border: ' . $main_border_width . 'px ' . $main_border_style . ' ' . $main_border_color . ';
margin: ' . $main_margin_top . 'px ' . $main_margin_right . 'px ' . $main_margin_bottom . 'px ' . $main_margin_left . 'px;
padding: ' . $main_padding_top . 'px ' . $main_padding_right . 'px ' . $main_padding_bottom . 'px ' . $main_padding_left . 'px;
}

#tp_contentin {
background-color: ' . $content_background_color . ';
background-image: url(images/content/' . $content_background_image . ');
background-repeat: ' . $content_background_repeat . ';
background-position: ' . $content_background_position . ';
border: ' . $content_border_width . 'px ' . $content_border_style . ' ' . $content_border_color . ';
font-family: ' . $content_font_family . ';
font-size: ' . $content_font_size . 'px;
line-height: ' . $content_line_height . 'em;
color: ' . $content_font_color . ';
margin: ' . $content_margin_top . 'px ' . $content_margin_right . 'px ' . $content_margin_bottom . 'px ' . $content_margin_left . 'px;
padding: ' . $content_padding_top . 'px ' . $content_padding_right . 'px ' . $content_padding_bottom . 'px ' . $content_padding_left . 'px;
}

#tp_contentin h1, #tp_contentin h2, #tp_contentin h3, #tp_contentin h4, #tp_contentin h5, #tp_contentin h6 {
color: ' . $content_headlines_color . ';
font-family: ' . $content_headlines_font_family . ';
}

#tp_contentin a:link {
color: ' . $content_alink_color . ';
}

#tp_contentin a:visited {
color: ' . $content_vlink_color . ';
}

#tp_contentin a:hover, #tp_contentin a:active, #tp_contentin a:focus {
color: ' . $content_hoverlink_color . ';
text-decoration: underline;
}

#tp_contentin h1, #tp_contentin h2, #tp_contentin h3 {
font-size: ' . $content_h13_font_size . 'px;
}

#tp_contentin h4 {
font-size: ' . $content_h4_font_size . 'px;
}

#tp_contentin h5 {
font-size: ' . $content_h5_font_size . 'px;
}

#tp_contentin h6 {
font-size: ' . $content_h6_font_size . 'px;
}

#tp_submenuin {
background-color: ' . $submenu_background_color . ';
background-image: url(images/submenu/' . $submenu_background_image . ');
background-repeat: ' . $submenu_background_repeat . ';
background-position: ' . $submenu_background_position . ';
border: ' . $submenu_border_width . 'px ' . $submenu_border_style . ' ' . $submenu_border_color . ';
font-family: ' . $submenu_font_family . ';
font-size: ' . $submenu_font_size . 'px;
line-height: ' . $submenu_line_height . 'em;
color: ' . $submenu_font_color . ';
margin: ' . $submenu_margin_top . 'px ' . $submenu_margin_right . 'px ' . $submenu_margin_bottom . 'px ' . $submenu_margin_left . 'px;
padding: ' . $submenu_padding_top . 'px ' . $submenu_padding_right . 'px ' . $submenu_padding_bottom . 'px ' . $submenu_padding_left . 'px;
}

#tp_submenuin h1, #tp_submenuin h2, #tp_submenuin h3, #tp_submenuin h4, #tp_submenuin h5, #tp_submenuin h6 {
color: ' . $submenu_headlines_color . ';
font-family: ' . $submenu_headlines_font_family . ';
}

#tp_submenuin a:link {
color: ' . $submenu_alink_color . ';
}

#tp_submenuin a:visited {
color: ' . $submenu_vlink_color . ';
}

#tp_submenuin a:hover, #tp_submenuin a:active, #tp_submenuin a:focus {
color: ' . $submenu_hoverlink_color . ';
text-decoration: underline;
}

#tp_submenuin h1, #tp_submenuin h2, #tp_submenuin h3 {
font-size: ' . $submenu_h13_font_size . 'px;
}

#tp_submenuin h4 {
font-size: ' . $submenu_h4_font_size . 'px;
}

#tp_submenuin h5 {
font-size: ' . $submenu_h5_font_size . 'px;
}

#tp_submenuin h6 {
font-size: ' . $submenu_h6_font_size . 'px;
}

#tp_pagenavin {
background-color: ' . $pagenav_background_color . ';
background-image: url(images/pagenav/' . $pagenav_background_image . ');
background-repeat: ' . $pagenav_background_repeat . ';
background-position: ' . $pagenav_background_position . ';
border-top: ' . $pagenav_border_width . 'px ' . $pagenav_border_style . ' ' . $pagenav_border_color . ';
font-family: ' . $pagenav_font_family . ';
font-size: ' . $pagenav_font_size . 'px;
line-height: ' . $pagenav_line_height . 'em;
color: ' . $pagenav_font_color . ';
text-align: ' . $pagenav_text_align . ';
margin: ' . $pagenav_margin_top . 'px ' . $pagenav_margin_right . 'px ' . $pagenav_margin_bottom . 'px ' . $pagenav_margin_left . 'px;
padding: ' . $pagenav_padding_top . 'px ' . $pagenav_padding_right . 'px ' . $pagenav_padding_bottom . 'px ' . $pagenav_padding_left . 'px;
}

#tp_pagenavin h1, #tp_pagenavin h2, #tp_pagenavin h3, #tp_pagenavin h4, #tp_pagenavin h5, #tp_pagenavin h6 {
color: ' . $pagenav_headlines_color . ';
font-family: ' . $pagenav_headlines_font_family . ';
}

#tp_pagenavin a:link {
color: ' . $pagenav_alink_color . ';
}

#tp_pagenavin a:visited {
color: ' . $pagenav_vlink_color . ';
}

#tp_pagenavin a:hover, #tp_pagenavin a:active, #tp_pagenavin a:focus {
color: ' . $pagenav_hoverlink_color . ';
text-decoration: underline;
}

#tp_pagenavin h1, #tp_pagenavin h2, #tp_pagenavin h3 {
font-size: ' . $pagenav_h13_font_size . 'px;
}

#tp_pagenavin h4 {
font-size: ' . $pagenav_h4_font_size . 'px;
}

#tp_pagenavin h5 {
font-size: ' . $pagenav_h5_font_size . 'px;
}

#tp_pagenavin h6 {
font-size: ' . $pagenav_h6_font_size . 'px;
}

#tp_navin {
background-color: ' . $nav_background_color . ';
background-image: url(images/nav/' . $nav_background_image . ');
background-repeat: ' . $nav_background_repeat . ';
background-position: ' . $nav_background_position . ';
border: ' . $nav_border_width . 'px ' . $nav_border_style . ' ' . $nav_border_color . ';
font-family: ' . $nav_font_family . ';
font-size: ' . $nav_font_size . 'px;
line-height: ' . $nav_line_height . 'em;
color: ' . $nav_font_color . ';
margin: ' . $nav_margin_top . 'px ' . $nav_margin_right . 'px ' . $nav_margin_bottom . 'px ' . $nav_margin_left . 'px;
padding: ' . $nav_padding_top . 'px ' . $nav_padding_right . 'px ' . $nav_padding_bottom . 'px ' . $nav_padding_left . 'px;
}

#tp_navin h1, #tp_navin h2, #tp_navin h3, #tp_navin h4, #tp_navin h5, #tp_navin h6 {
color: ' . $nav_headlines_color . ';
font-family: ' . $nav_headlines_font_family . ';
}

#tp_navin a:link {
color: ' . $nav_alink_color . ';
}

#tp_navin a:visited {
color: ' . $nav_vlink_color . ';
}

#tp_navin a:hover, #tp_navin a:active, #tp_navin a:focus {
color: ' . $nav_hoverlink_color . ';
}

#tp_navin h1, #tp_navin h2, #tp_navin h3 {
font-size: ' . $nav_h13_font_size . 'px;
}

#tp_navin h4 {
font-size: ' . $nav_h4_font_size . 'px;
}

#tp_navin h5 {
font-size: ' . $nav_h5_font_size . 'px;
}

#tp_navin h6 {
font-size: ' . $nav_h6_font_size . 'px;
}

#tp_tocin {
position: relative;
z-index: ' . $toc_elements_level . ';
background-color: ' . $toc_background_color . ';
background-image: url(images/toc/' . $toc_background_image . ');
background-repeat: ' . $toc_background_repeat . ';
background-position: ' . $toc_background_position . ';
border: ' . $toc_border_width . 'px ' . $toc_border_style . ' ' . $toc_border_color . ';
font-family: ' . $toc_font_family . ';
font-size: ' . $toc_font_size . 'px;
line-height: ' . $toc_line_height . 'em;
color: ' . $toc_font_color . ';
margin: ' . $toc_margin_top . 'px ' . $toc_margin_right . 'px ' . $toc_margin_bottom . 'px ' . $toc_margin_left . 'px;
padding: ' . $toc_padding_top . 'px ' . $toc_padding_right . 'px ' . $toc_padding_bottom . 'px ' . $toc_padding_left . 'px;
}

#tp_tocin h1, #tp_tocin h2, #tp_tocin h3, #tp_tocin h4, #tp_tocin h5, #tp_tocin h6 {
color: ' . $toc_headlines_color . ';
font-family: ' . $toc_headlines_font_family . ';
}

#tp_tocin a:link {
color: ' . $toc_alink_color . ';
}

#tp_tocin a:visited {
color: ' . $toc_vlink_color . ';
}

#tp_tocin a:hover, #tp_tocin a:active, #tp_tocin a:focus {
color: ' . $toc_hoverlink_color . ';
}

#tp_tocin h1, #tp_tocin h2, #tp_tocin h3 {
font-size: ' . $toc_h13_font_size . 'px;
}

#tp_tocin h4 {
font-size: ' . $toc_h4_font_size . 'px;
}

#tp_tocin h5 {
font-size: ' . $toc_h5_font_size . 'px;
}

#tp_tocin h6 {
font-size: ' . $toc_h6_font_size . 'px;
}

#tp_tocin ul.menulevel1 li {
background: ' . $toc_ml1_background_color . ';
border-bottom: ' . $toc_ml1_border_width . 'px solid ' . $toc_ml1_border_color . ';
font-size: ' . $toc_ml1_font_size . 'px;
font-weight: ' . $toc_ml1_font_weight . ';
text-align: ' . $toc_ml1_textalign . ';
}

#tp_tocin ul ul.menulevel2 li {
font-size: ' . $toc_ml2_font_size . 'px;
}

#tp_tocin ul ul ul.menulevel3 li {
font-size: ' . $toc_ml3_font_size . 'px;
}

#tp_subnavin {
position: relative;
z-index: ' . $subnav_elements_level . ';
background-color: ' . $subnav_background_color . ';
background-image: url(images/subnav/' . $subnav_background_image . ');
background-repeat: ' . $subnav_background_repeat . ';
background-position: ' . $subnav_background_position . ';
border: ' . $subnav_border_width . 'px ' . $subnav_border_style . ' ' . $subnav_border_color . ';
font-family: ' . $subnav_font_family . ';
font-size: ' . $subnav_font_size . 'px;
line-height: ' . $subnav_line_height . 'em;
color: ' . $subnav_font_color . ';
margin: ' . $subnav_margin_top . 'px ' . $subnav_margin_right . 'px ' . $subnav_margin_bottom . 'px ' . $subnav_margin_left . 'px;
padding: ' . $subnav_padding_top . 'px ' . $subnav_padding_right . 'px ' . $subnav_padding_bottom . 'px ' . $subnav_padding_left . 'px;
}

#tp_subnavin h1, #tp_subnavin h2, #tp_subnavin h3, #tp_subnavin h4, #tp_subnavin h5, #tp_subnavin h6 {
color: ' . $subnav_headlines_color . ';
font-family: ' . $subnav_headlines_font_family . ';
}

#tp_subnavin a:link {
color: ' . $subnav_alink_color . ';
}

#tp_subnavin a:visited {
color: ' . $subnav_vlink_color . ';
}

#tp_subnavin a:hover, #tp_subnavin a:active, #tp_subnavin a:focus {
color: ' . $subnav_hoverlink_color . ';
text-decoration: underline;
}

#tp_subnavin h1, #tp_subnavin h2, #tp_subnavin h3 {
font-size: ' . $subnav_h13_font_size . 'px;
}

#tp_subnavin h4 {
font-size: ' . $subnav_h4_font_size . 'px;
}

#tp_subnavin h5 {
font-size: ' . $subnav_h5_font_size . 'px;
}

#tp_subnavin h6 {
font-size: ' . $subnav_h6_font_size . 'px;
}

#tp_lastupdatein {
background-color: ' . $lastupdate_background_color . ';
background-image: url(images/lastupdate/' . $lastupdate_background_image . ');
background-repeat: ' . $lastupdate_background_repeat . ';
background-position: ' . $lastupdate_background_position . ';
border: ' . $lastupdate_border_width . 'px ' . $lastupdate_border_style . ' ' . $lastupdate_border_color . ';
font-family: ' . $lastupdate_font_family . ';
font-size: ' . $lastupdate_font_size . 'px;
line-height: ' . $lastupdate_line_height . 'em;
color: ' . $lastupdate_font_color . ';
margin: ' . $lastupdate_margin_top . 'px ' . $lastupdate_margin_right . 'px ' . $lastupdate_margin_bottom . 'px ' . $lastupdate_margin_left . 'px;
padding: ' . $lastupdate_padding_top . 'px ' . $lastupdate_padding_right . 'px ' . $lastupdate_padding_bottom . 'px ' . $lastupdate_padding_left . 'px;
}

#tp_lastupdatein h1, #tp_lastupdatein h2, #tp_lastupdatein h3, #tp_lastupdatein h4, #tp_lastupdatein h5, #tp_lastupdatein h6 {
color: ' . $lastupdate_headlines_color . ';
font-family: ' . $lastupdate_headlines_font_family . ';
}

#tp_lastupdatein a:link {
color: ' . $lastupdate_alink_color . ';
}

#tp_lastupdatein a:visited {
color: ' . $lastupdate_vlink_color . ';
}

#tp_lastupdatein a:hover, #tp_lastupdatein a:active, #tp_lastupdatein a:focus {
color: ' . $lastupdate_hoverlink_color . ';
text-decoration: underline;
}

#tp_lastupdatein h1, #tp_lastupdatein h2, #tp_lastupdatein h3 {
font-size: ' . $lastupdate_h13_font_size . 'px;
}

#tp_lastupdatein h4 {
font-size: ' . $lastupdate_h4_font_size . 'px;
}

#tp_lastupdatein h5 {
font-size: ' . $lastupdate_h5_font_size . 'px;
}

#tp_lastupdatein h6 {
font-size: ' . $lastupdate_h6_font_size . 'px;
}

#tp_footerin {
background-color: ' . $footer_background_color . ';
background-image: url(images/footer/' . $footer_background_image . ');
background-repeat: ' . $footer_background_repeat . ';
background-position: ' . $footer_background_position . ';
border: ' . $footer_border_width . 'px ' . $footer_border_style . ' ' . $footer_border_color . ';
font-family: ' . $footer_font_family . ';
font-size: ' . $footer_font_size . 'px;
line-height: ' . $footer_line_height . 'em;
color: ' . $footer_font_color . ';
text-align: ' . $footer_text_align . ';
margin: ' . $footer_margin_top . 'px ' . $footer_margin_right . 'px ' . $footer_margin_bottom . 'px ' . $footer_margin_left . 'px;
padding: ' . $footer_padding_top . 'px ' . $footer_padding_right . 'px ' . $footer_padding_bottom . 'px ' . $footer_padding_left . 'px;
}

#tp_footerin h1, #tp_footerin h2, #tp_footerin h3, #tp_footerin h4, #tp_footerin h5, #tp_footerin h6 {
color: ' . $footer_headlines_color . ';
font-family: ' . $footer_headlines_font_family . ';
}

#tp_footerin a:link {
color: ' . $footer_alink_color . ';
}

#tp_footerin a:visited {
color: ' . $footer_vlink_color . ';
}

#tp_footerin a:hover, #tp_footerin a:active, #tp_footerin a:focus {
color: ' . $footer_hoverlink_color . ';
text-decoration: underline;
}

#tp_footerin h1, #tp_footerin h2, #tp_footerin h3 {
font-size: ' . $footer_h13_font_size . 'px;
}

#tp_footerin h4 {
font-size: ' . $footer_h4_font_size . 'px;
}

#tp_footerin h5 {
font-size: ' . $footer_h5_font_size . 'px;
}

#tp_footerin h6 {
font-size: ' . $footer_h6_font_size . 'px;
}

#tp_headerin {
background-color: ' . $header_background_color . ';
background-image: url(images/header/' . $header_background_image . ');
background-repeat: ' . $header_background_repeat . ';
background-position: ' . $header_background_position . ';
border: ' . $header_border_width . 'px ' . $header_border_style . ' ' . $header_border_color . ';
font-family: ' . $header_font_family . ';
font-size: ' . $header_font_size . 'px;
line-height: ' . $header_line_height . 'em;
color: ' . $header_font_color . ';
margin: ' . $header_margin_top . 'px ' . $header_margin_right . 'px ' . $header_margin_bottom . 'px ' . $header_margin_left . 'px;
padding: ' . $header_padding_top . 'px ' . $header_padding_right . 'px ' . $header_padding_bottom . 'px ' . $header_padding_left . 'px;
}

#tp_headerin h1, #tp_headerin h2, #tp_headerin h3, #tp_headerin h4, #tp_headerin h5, #tp_headerin h6 {
color: ' . $header_headlines_color . ';
font-family: ' . $header_headlines_font_family . ';
}

#tp_headerin a:link {
color: ' . $header_alink_color . ';
}

#tp_headerin a:visited {
color: ' . $header_vlink_color . ';
}

#tp_headerin a:hover, #tp_headerin a:active, #tp_headerin a:focus {
color: ' . $header_hoverlink_color . ';
text-decoration: underline;
}

#tp_headerin h1, #tp_headerin h2, #tp_headerin h3 {
font-size: ' . $header_h13_font_size . 'px;
}

#tp_headerin h4 {
font-size: ' . $header_h4_font_size . 'px;
}

#tp_headerin h5 {
font-size: ' . $header_h5_font_size . 'px;
}

#tp_headerin h6 {
font-size: ' . $header_h6_font_size . 'px;
}

#tp_newsareain {
background-color: ' . $newsarea_background_color . ';
background-image: url(images/newsarea/' . $newsarea_background_image . ');
background-repeat: ' . $newsarea_background_repeat . ';
background-position: ' . $newsarea_background_position . ';
border: ' . $newsarea_border_width . 'px ' . $newsarea_border_style . ' ' . $newsarea_border_color . ';
font-family: ' . $newsarea_font_family . ';
font-size: ' . $newsarea_font_size . 'px;
line-height: ' . $newsarea_line_height . 'em;
color: ' . $newsarea_font_color . ';
margin: ' . $newsarea_margin_top . 'px ' . $newsarea_margin_right . 'px ' . $newsarea_margin_bottom . 'px ' . $newsarea_margin_left . 'px;
padding: ' . $newsarea_padding_top . 'px ' . $newsarea_padding_right . 'px ' . $newsarea_padding_bottom . 'px ' . $newsarea_padding_left . 'px;
}

#tp_newsareain h1, #tp_newsareain h2, #tp_newsareain h3, #tp_newsareain h4, #tp_newsareain h5, #tp_newsareain h6 {
color: ' . $newsarea_headlines_color . ';
font-family: ' . $newsarea_headlines_font_family . ';
}

#tp_newsareain a:link {
color: ' . $newsarea_alink_color . ';
}

#tp_newsareain a:visited {
color: ' . $newsarea_vlink_color . ';
}

#tp_newsareain a:hover, #tp_newsareain a:active, #tp_newsareain a:focus {
color: ' . $newsarea_hoverlink_color . ';
text-decoration: underline;
}

#tp_newsareain h1, #tp_newsareain h2, #tp_newsareain h3 {
font-size: ' . $newsarea_h13_font_size . 'px;
}

#tp_newsareain h4 {
font-size: ' . $newsarea_h4_font_size . 'px;
}

#tp_newsareain h5 {
font-size: ' . $newsarea_h5_font_size . 'px;
}

#tp_newsareain h6 {
font-size: ' . $newsarea_h6_font_size . 'px;
}

.tp_newsboxin {
background-color: ' . $newsbox_background_color . '!important;
background-image: url(images/newsbox/' . $newsbox_background_image . ')!important;
background-repeat: ' . $newsbox_background_repeat . '!important;
background-position: ' . $newsbox_background_position . ';
border: ' . $newsbox_border_width . 'px ' . $newsbox_border_style . ' ' . $newsbox_border_color . '!important;
font-family: ' . $newsbox_font_family . '!important;
font-size: ' . $newsbox_font_size . 'px!important;
line-height: ' . $newsbox_line_height . 'em!important;
color: ' . $newsbox_font_color . '!important;
margin: ' . $newsbox_margin_top . 'px ' . $newsbox_margin_right . 'px ' . $newsbox_margin_bottom . 'px ' . $newsbox_margin_left . 'px!important;
padding: ' . $newsbox_padding_top . 'px ' . $newsbox_padding_right . 'px ' . $newsbox_padding_bottom . 'px ' . $newsbox_padding_left . 'px!important;
}

.tp_newsboxin h1, .tp_newsboxin h2, .tp_newsboxin h3, .tp_newsboxin h4, .tp_newsboxin h5, .tp_newsboxin h6 {
color: ' . $newsbox_headlines_color . '!important;
font-family: ' . $newsbox_headlines_font_family . '!important;
}

.tp_newsboxin a:link {
color: ' . $newsbox_alink_color . '!important;
}

.tp_newsboxin a:visited {
color: ' . $newsbox_vlink_color . '!important;
}

.tp_newsboxin a:hover, .tp_newsboxin a:active, .tp_newsboxin a:focus {
color: ' . $newsbox_hoverlink_color . '!important;
text-decoration: underline!important;
}

.tp_newsboxin h1, .tp_newsboxin h2, .tp_newsboxin h3 {
font-size: ' . $newsbox_h13_font_size . 'px!important;
}

.tp_newsboxin h4 {
font-size: ' . $newsbox_h4_font_size . 'px!important;
}

.tp_newsboxin h5 {
font-size: ' . $newsbox_h5_font_size . 'px!important;
}

.tp_newsboxin h6 {
font-size: ' . $newsbox_h6_font_size . 'px!important;
}

#tp_locatorin {
background-color: ' . $locator_background_color . ';
background-image: url(images/locator/' . $locator_background_image . ');
background-repeat: ' . $locator_background_repeat . ';
background-position: ' . $locator_background_position . ';
border-bottom: ' . $locator_border_width . 'px ' . $locator_border_style . ' ' . $locator_border_color . ';
font-family: ' . $locator_font_family . ';
font-size: ' . $locator_font_size . 'px;
line-height: ' . $locator_line_height . 'em;
color: ' . $locator_font_color . ';
margin: ' . $locator_margin_top . 'px ' . $locator_margin_right . 'px ' . $locator_margin_bottom . 'px ' . $locator_margin_left . 'px;
padding: ' . $locator_padding_top . 'px ' . $locator_padding_right . 'px ' . $locator_padding_bottom . 'px ' . $locator_padding_left . 'px;
}

#tp_locatorin a:link {
color: ' . $locator_alink_color . ';
}

#tp_locatorin a:visited {
color: ' . $locator_vlink_color . ';
}

#tp_locatorin a:hover, #tp_locatorin a:active, #tp_locatorin a:focus {
color: ' . $locator_hoverlink_color . ';
text-decoration: underline;
}

.text {
width: ' . $search_input_width . 'px;
background: ' . $search_input_background_color . ';
color: ' . $search_input_color . ';
border: ' . $search_input_border_width . 'px ' . $search_input_border_style . ' ' . $search_input_border_color . ';
padding: 2px 3px;
}

.submit {
background: ' . $search_submit_background_color . ';
color: ' . $search_submit_color . ';
border: ' . $search_submit_border_width . 'px ' . $search_submit_border_style . ' ' . $search_submit_border_color . ';
padding: 2px 3px 2px 3px;
}

#tp_contentin input.text {
width: ' . $mailform_input_width . 'px;
background: ' . $mailform_input_background_color . ';
color: ' . $mailform_input_color . ';
border: ' . $mailform_input_border_width . 'px ' . $mailform_input_border_style . ' ' . $mailform_input_border_color . ';
padding: 2px 3px;
}

#tp_contentin input.submit {
background: ' . $mailform_submit_background_color . ';
color: ' . $mailform_submit_color . ';
border: ' . $mailform_submit_border_width . 'px ' . $mailform_submit_border_style . ' ' . $mailform_submit_border_color . ';
padding: 2px 3px 1px 3px;
}
';

fwrite($cssdatei, $cssinhalt);
fclose($cssdatei);

$_SESSION['reload'] = 'true';

header('Location: ' . $_SESSION['sn'] . '?&templug&admin=plugin_main&action=plugin_text');
}
?>