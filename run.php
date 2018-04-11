<html>
<link rel="stylesheet" type="text/css" href="css/foundation.min.css">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<style type="text/css">
body{
	background-color:#f5f5f5;
}
a:link {
    color: blue;
}


/* mouse over link */
a:hover {
    color:yellow;
}

/* selected link */
a:active {
    color: black;
}

</style>

<body>
<div class="row">
	<div class="large-4 large-centered columns">
  <img border="0" src="/img/as.png" alt="SoundCloudDownloder"/>
</div>
<div class="row">
	<div class="large-5 large-centered columns">
<h3 class="subheader">SoundCloud Downloader Online</h3>
</div>
<div class="row">
	<div class="large-7 large-centered columns">
<h3 class="subheader">Download any track /playlist from SoundCloud</h3>
</div>

<form method="get" <?php echo "action '".$_SERVER['PHP_SELF']."'"?> >
  <div class="row">
    <div class="large-8 large-centered columns">
      <div class="row collapse">
        <div class="small-10 columns">
          <input type="url"  name='value' required placeholder="Copy SoundCloud Track/ Playlist">
        </div>
        <div class="small-2 columns">
        	<input type="submit" class="button postfix" value="Go">
        </div>
      </div>
    </div>
  </div>

</form>
<?php
if(isset($_GET['value'])){
$url=$_GET['value'];
$url_api='https://api.soundcloud.com/resolve.json?url='.$url.'&client_id=22e8f71d7ca75e156d6b2f0e0a5172b3';
$json = file_get_contents($url_api);
$obj=json_decode($json);
if($obj->kind=='playlist'){

echo "<div class='row'>
<div class='large-7 large-centered columns'>";
echo "<table>
      <thead>
    <tr>
      <th>Track count</th>
      <th>Track Title</th>
      <th>Track download</th>

    </tr>
  </thead>
    <tbody>
";
$index=0;
foreach ($obj->tracks as $key) {
	var_dump($key); exit;
	$url_str=$key->stream_url.'?client_id=22e8f71d7ca75e156d6b2f0e0a5172b3';
       $index++;     
	# code..
     echo "<div class='row collapse'>";
	echo "<tr>";
	echo "<td  class='small-2 columns'>".$index."</td>";
	echo "<td class='small-10 columns'>'".$key->title."</td>";
    echo "<td class='small-2 columns'><a href='".$url_str."'download>Download</a></td>";

	echo "</tr>
	</div>";


}
echo "
  </tbody>
</table>" ;


echo "
</div>
</div>";



}
else{

$url_str=$obj->stream_url.'?client_id=1edfe9605870313cafeeeca3a1bcf44a';
echo "<div class='large-6 large-centered columns'>";

echo "<a href='".$url_str."'download>".$obj->title."</a>";
echo "</div>";

}

}



?>



</div>
</div>
<div class="row">
<h3 class="subheader">SoundCloud Downloader Online</h3>

<p>soundCloud downloader is online tool to download SoundCloud tracks and music. SoundCloud is audio distribution site, where users can record, upload and promote their sound tracks. SoundCloud allows you to listen as many tracks you can but it does not allow sound track download.
</p>
</div>
<script type="text/javascript">
$('a').click(function(e) {
    e.preventDefault();
    //do other stuff when a click happens
});
</script>
</body>
</html>