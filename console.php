#!/usr/bin/env php
<?php
set_time_limit(0); 

$client_id = "22e8f71d7ca75e156d6b2f0e0a5172b3";

$url = $argv[1]; 
// $url = $_GET['url'];

$url_api='https://api.soundcloud.com/resolve.json?url='.$url.'&client_id='.$client_id;
$json =  file_get_contents($url_api);
$obj=json_decode($json);

mkdir($obj->permalink, 0755, true);

$dir = $obj->permalink;

if($obj->kind=='playlist')
{
	
	foreach ($obj->tracks as $key) 
	{
		echo 'Start download: '.$key->id.PHP_EOL;

		$file = file_get_contents($key->stream_url.'?client_id='.$client_id);
		file_put_contents(__DIR__.'/'.$dir.'/'.$key->id.'.mp3', $file);
		
		echo 'Download finish'.PHP_EOL;
	}
}
else
{
	echo 'Start download: '.$obj->id.PHP_EOL;

	$file = file_get_contents($obj->stream_url.'?client_id='.$client_id);
	file_put_contents(__DIR__.'/'.$dir.'/'.$obj->id.'.mp3', $file);
	
	echo 'Download finish'.PHP_EOL;
}