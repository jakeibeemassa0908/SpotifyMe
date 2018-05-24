<?php
    include("includes/includedFiles.php");
    if(isset($_GET['term'])){
        $term = urldecode($_GET['term']);
    }else{
        $term = "";
    }
?>

<div class="searchContainer">
    <h4>Search for an artist, album or song</h4>
    <input type="text" class="searchInput" value="<?php echo $term; ?> " onfocus="this.value ='<?php echo $term?>'"  placeholder = "Start typing..."/>
</div>

<script>
    //restore focus on input
    $(".searchInput").focus();
        $(function(){
            $(".searchInput").keyup(function(){
                //cancel the timer as soon as user starts typing
                clearTimeout(timer);

                timer = setTimeout(function(){
                    var val = $(".searchInput").val();
                    openPage("search.php?term="+val);     
                },2000);
            })
        })
</script>
<?php
//don't do anything if the term is an empty string
    if($term =="") exit();
?>


<div class ="tracklistContainer borderBottom">
    <h2>SONGS</h2>
    <ul class="tracklist">
        <?php 
            $songsQuery = mysqli_query($con,"SELECT id FROM songs WHERE title LIKE '$term%' LIMIT 10");

            if(mysqli_num_rows($songsQuery)==0){
                echo "<span class ='noResults'>No songs found matching ".$term."</span>";
            }

            $songIdArray = array(); 

            $i = 1;
            while ($row = mysqli_fetch_array($songsQuery)){
                //only show 15 songs
                if($i>15){
                    break;
                }

                array_push($songIdArray, $row['id']);

                $albumSong = new Song($con,$row['id']);
                $albumArtist = $albumSong->getArtist();
                
                echo "
                    <li class ='tracklistRow'> 
                        <div class='trackCount'>
                            <img class='play' src='assets/images/icons/play-white.png' onclick = 'setTrack(\"". $albumSong->getId(). "\", temporaryPlaylist,true)'>
                            <span class='trackNumber'>$i</span>
                        </div>

                        <div class ='trackInfo'>
                            <span class='trackName'>".$albumSong->getTitle()."</span>
                            <span class='artistName'>".$albumArtist->getName()."</span>
                        </div>

                        <div class ='trackOptions'>
                            <img class='optionButton' src='assets/images/icons/more.png'>
                        </div>

                        <div class='trackDuration'>
                            <span class='duration'>". $albumSong->getDuration()."</span>
                        </div>
                    </li>
                ";

                $i = $i+1;
            }
        ?>
        
        <!-- Create the temporary list as soon as the page is loaded to be able to start playing right away-->
        <script>
            var tempSongIds = '<?php echo json_encode($songIdArray);?>';
            temporaryPlaylist = JSON.parse(tempSongIds);
        </script>
    </ul>
</div>

<div class="artistContainer borderBottom">
    <h2>ARTISTS</h2>

    <?php
        $artistsQuery = mysqli_query($con,"SELECT id FROM artists WHERE name LIKE '$term%' LIMIT 10");

        if(mysqli_num_rows($artistsQuery)==0){
            echo "<span class ='noResults'>No artists found matching ".$term."</span>";
        }

        while($row = mysqli_fetch_array($artistsQuery)){
            $artistFound = new Artist($con,$row['id']);
            
            echo '<div class= "searchResultRow">
                    <div class= "artistName">
                        <span role="link" tabindex="0" onclick="openPage(\'artist.php?id='.$artistFound->getId().'\')">
                            '.$artistFound->getName().
                            '
                        </span>
                    </div>
                </div>';
        }
    ?>

</div>

<div class ="gridViewContainer">
    <h2>ALBUMS</h2>
        <?php 
            $albumQuery = mysqli_query($con,"SELECT * FROM albums WHERE title LIKE '$term%' LIMIT 10");

            if(mysqli_num_rows($albumQuery)==0){
                echo "<span class ='noResults'>No albums found matching ".$term."</span>";
            }

			while($row = mysqli_fetch_array($albumQuery)){

				echo " 
				<div class='gridViewItem'>
					<span href='index.php'  role = 'link' tabindex = '0' onclick ='openPage(\"album.php?id=".$row['id']."\")' >
						<img src='". $row['artworkPath']. "' alt=''>

						<div class='gridViewInfo'>"
							.$row['title']."
						</div>
					</span>
				</div>";
			}
		?>
</div>