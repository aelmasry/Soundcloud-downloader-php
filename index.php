<html>
    <link rel="stylesheet" type="text/css" href="css/foundation.min.css">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <style type="text/css">
        body{
            background-color:#f5f5f5;
        }
    </style>

    <body>
        <div class="row">
            <div class="large-4 large-centered columns">
                <a href="http://<?php echo $_SERVER['HTTP_HOST'] . '/' . $_SERVER['PHP_SELF'] ?>"> <img border="0" src="img/as.png" alt="SoundCloudDownloder"/> </a>
            </div>
        </div>
        <div class="row">
            <div class="large-5 large-centered columns">
                <h3 class="subheader">SoundCloud Downloader Online</h3>
            </div>
        </div>
        <div class="row">
            <div class="large-7 large-centered columns">
                <h3 class="subheader">Download any track /playlist from SoundCloud</h3>
            </div>
        </div>
        <div class="row">
            <form method="get" <?php echo "action '" . $_SERVER['PHP_SELF'] . "'" ?> >
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
        </div>
        <div class='row'>
            <?php
            if (isset($_GET['value'])) {
                $url = $_GET['value'];
                $url_api = 'https://api.soundcloud.com/resolve.json?url=' . $url . '&client_id=22e8f71d7ca75e156d6b2f0e0a5172b3';
                $json = file_get_contents($url_api);
                $obj = json_decode($json);

//                echo '<pre>';
//                print_r($obj);
//                echo '</pre>';

                if ($obj->kind == 'playlist') {
                    ?>

                    <div class="large-9 large-centered columns">
                        <table class="hover" style="width: 100%">
                            <thead>
                                <tr>
                                    <th width="100">#</th>
                                    <th>Track Title</th>
                                    <th width="200">Track download</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $index = 0;
                                foreach ($obj->tracks as $key) {
                                    $url_str = $key->stream_url . '?client_id=22e8f71d7ca75e156d6b2f0e0a5172b3';
                                    $index++;
                                    ?>
                                    <tr>
                                        <td><?php echo $index ?></td>
                                        <td><?php echo $key->title ?></td>
                                        <td><a href="<?php echo $url_str ?>">Download</a></td>
                                    </tr>
            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                <?php
                } else {

                    $url_str = $obj->stream_url . '?client_id=22e8f71d7ca75e156d6b2f0e0a5172b3';
                    $index = 1;
                    ?>

                    <div class="large-9 large-centered columns">
                        <table class="hover" style="width: 100%">
                            <thead>
                                <tr>
                                    <th width="100">#</th>
                                    <th>Track Title</th>
                                    <th width="200">Track download</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $index++ ?></td>
                                    <td><a href="<?php echo $obj->permalink_url ?>" target="_black"> <?php echo $obj->title ?> </a></td>
                                    <td><a href="<?php echo $url_str ?>">Download</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

            <?php } ?>

            </div>

<?php } else { ?>

            <div class="row">
                <h3 class="subheader">SoundCloud Downloader Online</h3>

                <p>soundCloud downloader is online tool to download SoundCloud tracks and music. SoundCloud is audio distribution site, where users can record, upload and promote their sound tracks. SoundCloud allows you to listen as many tracks you can but it does not allow sound track download.
                </p>
            </div>

<?php } ?>

        <script type="text/javascript">
            $('a').click(function (e) {
                e.preventDefault();
                //do other stuff when a click happens
            });
        </script>

    </body>
</html>