<?php

function get_media_instagram_by_user_id($user_id = 0, $count = 6)
{
  $media = array();

  $url = 'https://www.instagram.com/sergedenimes/media/';

  try {
    $curl_connection = curl_init($url);
    curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, true);

    $data = json_decode(curl_exec($curl_connection), true);
    curl_close($curl_connection);

    foreach ($data['items'] as $current_media) {
      $media[] = array(
        'description' => '',
        'link' => $current_media['link'],
        'image' => $current_media['images']['low_resolution']['url']
      );

    }
  } catch (Exception $e) {
    return array();
  }

  return array_slice($media, 0, $count);
}
