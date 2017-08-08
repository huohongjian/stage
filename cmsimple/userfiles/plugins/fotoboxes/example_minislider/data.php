<?php // utf-8 Marker: äöü 

if (!function_exists('sv') || preg_match('#data.php#i', $_SERVER['SCRIPT_NAME']))
{
	die('no direct access');
}

// FotoBox "Slideshow"
$fotoBoxesCaptionOpacity = "0.7";
$fotoBoxesCaptionEffect = "fade";
$fotoBoxesEffect = "13";
$fotoBoxesEffectRandom = "false";
$fotoBoxesBullets = "visible";
$fotoBoxesHoverPause = "true";
$fotoBoxesShowDesc = "true";
$fotoBoxesPauseTime = "5000";
$fotoBoxesTransitionTime = "3000";
$fotoboxesCss = "background: #101619;
color: #999;
border: 5px solid #fff;
border-radius: 5px;
box-shadow: 0 0 9px #666;";
$fotoBoxesImageBorderWidth = "1";
$fotoBoxesImageBorderStyle = "solid";
$fotoBoxesImageBorderColor = "#666";

// FotoBox "Thumbs"
$fotoBoxesThumbsGalleryName = "Hausboot Törn Berlin";
$fotoBoxesThumbsLightbox = "true";
$fotoBoxesThumbsDesc = "true";
$fotoBoxesThumbsNumberOf = "4";
$fotoboxesCssThumbs = "clear: both;
float: none;
background: #e6e9e3;
border: 1px solid #999;
padding: 16px;
margin: 16px auto;";
$fotoBoxesThumbsImageBorderWidth = "1";
$fotoBoxesThumbsImageBorderStyle = "solid";
$fotoBoxesThumbsImageBorderColor = "#666";
$fotoBoxesThumbsThumbsBorderColor = "#666";

// images and short descriptions
$fotoboxes_data["aaa_bg"]["caption"]="";
$fotoboxes_data["aaa_bg"]["link"]="";
$fotoboxes_data["bild1"]["caption"]="Oldtimer Boot";
$fotoboxes_data["bild1"]["link"]="";
$fotoboxes_data["bild2"]["caption"]="Penichette";
$fotoboxes_data["bild2"]["link"]="";
$fotoboxes_data["bild3"]["caption"]="Oldtimer Bus";
$fotoboxes_data["bild3"]["link"]="";
$fotoboxes_data["bild4"]["caption"]="Abenddämmerung";
$fotoboxes_data["bild4"]["link"]="";
$fotoboxes_data[""]["caption"]="";
$fotoboxes_data[""]["link"]="";
?>