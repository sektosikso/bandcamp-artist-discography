<?php

/**
  * define constants
  */
define('API_KEY', '');          //your Bandcamp API key
define('BAND_ID', 1101422854);  //my artist profile


/**
  * array sorting function. sort albums by year released.
  * for some reason bandcamp doesn't return sorted data
  */
function cmp($a, $b)
{
  return strcmp($b['released'], $a['released']);
}

/**
  * get discography from an artist on bandcamp
  * @param int $bandid artist's bandcamp id
  * @return array of albums in discography
  */
function getDiscography($bandid = BAND_ID)
{
  if (!$json = @file_get_contents('http://api.bandcamp.com/api/band/3/discography?key='.API_KEY.'&band_id='.BAND_ID.'&debug'))
    die('could not connect to bandcamp API');

  $obj = json_decode($json);
  $discography = array();
  foreach($obj->discography as $album)
    $discography[]=array('artist' => $album->artist, 'title' => $album->title, 'released' => date('Y', $album->release_date), 'image' => strpos($album->small_art_url, '.jpg') ? '<img src="'.$album->small_art_url.'" />' : '(no cover art)');

  usort($discography, "cmp");
  return $discography;
}

?>