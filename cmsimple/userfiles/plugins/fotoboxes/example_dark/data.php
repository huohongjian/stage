<?php // utf-8 Marker: äöü 

if (!function_exists('sv') || preg_match('#data.php#i', $_SERVER['SCRIPT_NAME']))
{
	die('no direct access');
}

// FotoBox "Slideshow"
$fotoBoxesCaptionOpacity = "0.7";
$fotoBoxesCaptionEffect = "fade";
$fotoBoxesEffect = "1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17";
$fotoBoxesEffectRandom = "false";
$fotoBoxesBullets = "visible";
$fotoBoxesHoverPause = "true";
$fotoBoxesShowDesc = "true";
$fotoBoxesPauseTime = "5000";
$fotoBoxesTransitionTime = "500";
$fotoboxesCss = "clear: both;
float: none;
background: #16191c;
color: #999;
border: 6px solid #998;
padding: 40px 16px 20px 16px;
margin: 16px auto 16px auto;";
$fotoBoxesImageBorderWidth = "1";
$fotoBoxesImageBorderStyle = "solid";
$fotoBoxesImageBorderColor = "#ccc";

// FotoBox "Thumbs"
$fotoBoxesThumbsGalleryName = "Galerie Hausboot Törn Berlin";
$fotoBoxesThumbsLightbox = "";
$fotoBoxesThumbsDesc = "true";
$fotoBoxesThumbsNumberOf = "4";
$fotoboxesCssThumbs = "clear: both;
float: none;
background: #16191c;
color: #999;
border: 6px solid #998;
padding: 20px 16px;
margin: 16px auto 16px auto;";
$fotoBoxesThumbsImageBorderWidth = "1";
$fotoBoxesThumbsImageBorderStyle = "solid";
$fotoBoxesThumbsImageBorderColor = "#ccc";
$fotoBoxesThumbsThumbsBorderColor = "#ccc";

// images and short descriptions
$fotoboxes_data["bild10"]["caption"]="Stahlmännchen";
$fotoboxes_data["bild10"]["link"]="";
$fotoboxes_data["bild20"]["caption"]="Oberbaumbrücke";
$fotoboxes_data["bild20"]["link"]="";
$fotoboxes_data["bild30"]["caption"]="Fernsehturm";
$fotoboxes_data["bild30"]["link"]="";
$fotoboxes_data["bild40"]["caption"]="Berlin Mitte";
$fotoboxes_data["bild40"]["link"]="";
$fotoboxes_data["bild50"]["caption"]="Spreebrücke";
$fotoboxes_data["bild50"]["link"]="";
$fotoboxes_data["bild60"]["caption"]="Oldtimer Boot";
$fotoboxes_data["bild60"]["link"]="";
$fotoboxes_data["bild70"]["caption"]="Stadtrundfahrt im historischen Stadtbus";
$fotoboxes_data["bild70"]["link"]="";
$fotoboxes_data["bild80"]["caption"]="Technikmuseum";
$fotoboxes_data["bild80"]["link"]="";
?>