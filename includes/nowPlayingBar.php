<?php 
    $songQuery = mysqli_query($con, "SELECT id FROM songs ORDER BY RAND() LIMIT 5");

    $resultArray = array();

    while($row = mysqli_fetch_array($songQuery)){
        array_push($resultArray,$row['id']);
    }

    $jsonArray = json_encode($resultArray);

?>

<script>

    $(document).ready(function(){
        //create the playlist when the page loads
        currentPlaylist = <?php echo $jsonArray?>;
        audioElement = new Audio();
        setTrack(currentPlaylist[0],currentPlaylist,false);

        //set volume to maximum or prefered setting when the page loads
        updateVolumeProgressBar(audioElement.audio);

        //set the container to be unselectable
        $('#nowPlayingBarContainer').on("mousedown touchstart mouse move touchmove",function(e){
            //prevent default behavior when the event mentioned in the function happen
            e.preventDefault();
        });


        $(".playbackBar .progressBar").mousedown(function(){
            mouseDown = true;
        });

        $(".playbackBar .progressBar").mousemove(function(e){
            if(mouseDown){
                //set time song depending on position of mouse
                timeFromOffset(e,this);
            }
        });

        $(".playbackBar .progressBar").mouseup(function(e){
            //set time song depending on position of mouse
            timeFromOffset(e,this);
        });

// volume bar controler
        $(".volumeBar .progressBar").mousedown(function(){
            mouseDown = true;
        });

        $(".volumeBar .progressBar").mousemove(function(e){
            if(mouseDown){
                //set volume of the song depending on position of mouse
                //percentage is between 0 and 1
                var percentage = e.offsetX /$(this).width();
                if(percentage >=0 && percentage <=1){
                    audioElement.audio.volume = percentage;
                    }
            }
        });

        $(".volumeBar .progressBar").mouseup(function(e){
                //set volume of the song depending on position of mouse
                //percentage is between 0 and 1
                var percentage = e.offsetX /$(this).width();
                if(percentage >=0 && percentage <=1){
                    audioElement.audio.volume = percentage;
                    }
        });

        $(document).mouseup(function(){
            mouseDown = false;
        });
    });

    function timeFromOffset(mouse,progressBar){
        var percentage = mouse.offsetX / $(progressBar).width() *100;
        var seconds = audioElement.audio.duration * (percentage/ 100);
        audioElement.setTime(seconds);
    }

    //Determine what is the next song to play
    function nextSong(){
        if(repeat == true){
            audioElement.setTime(0);
            playSong();
            return;
        }
        if(currentIndex == currentPlaylist.length-1){
            currentIndex =0;
        }else{
            currentIndex++;
        }

        var trackToPlay = currentPlaylist[currentIndex];
        setTrack(trackToPlay,currentPlaylist,true);
    }

    //set track to be played
    function setTrack(trackId,newPlaylist,play){
        currentIndex = currentPlaylist.indexOf(trackId)
        pauseSong();
        //ajax call to php to retrieve song
        $.post("includes/handlers/ajax/getSongJson.php",{ songId:trackId},function(data){
            //parse the retrieved json data into a Javascript object
            var track = JSON.parse(data);

            $(".trackName span").text(track.title);

            $.post("includes/handlers/ajax/getArtistJson.php",{ artistId:track.artist},function(data){
                var artist = JSON.parse(data);
                $(".artistName span").text(artist.name);
            });

            $.post("includes/handlers/ajax/getAlbumJson.php",{ albumId:track.album},function(data){
                var album = JSON.parse(data);
                $(".albumLink img").attr("src",album.artworkPath);
            });

            audioElement.setTrack(track);
            playSong();
        });
        if(play){
           playSong();
        }
    }

    function playSong(){
        //update number of plays for the song
        if(audioElement.audio.currentTime == 0){
            $.post("includes/handlers/ajax/updatePlays.php",{songId:audioElement.currentlyPlaying.id});
        }
        audioElement.play();
    }
    function pauseSong(){
        audioElement.pause();
    }
</script>

<div id="nowPlayingBarContainer">
        <div id="nowPlayingBar">
            <div id="nowPlayingLeft">
                <div class="content">
                    <span class="albumLink">
                        <img class="albumArtwork" src="" alt="">
                    </span>
                    <div class ="trackInfo">
                        <span class="trackName">
                            <span></span>
                        </span>
                        <span class="artistName">
                            <span></span>
                        </span> 
                    </div>
                </div>
            </div>
            <div id="nowPlayingCenter">
                <div class="content playerControls">
                    <div class="buttons">
                        <button class ="controlButton shuffle" title="Shuffle Button">
                            <img src="assets/images/icons/shuffle.png" alt="Shuffle">
                        </button>
                        <button class ="controlButton previous" title="Previous Button">
                            <img src="assets/images/icons/previous.png" alt="Previous">
                        </button>
                        <button class ="controlButton play" title="Play Button" onclick="playSong()">
                            <img src="assets/images/icons/play.png" alt="Play">
                        </button>
                        <button class ="controlButton pause" title="Pause Button"  onclick="pauseSong()" style ="display:none">
                            <img src="assets/images/icons/pause.png" alt="Pause">
                        </button>
                        <button class ="controlButton next" title="Next Button" onclick = "nextSong()">
                            <img src="assets/images/icons/next.png" alt="Next">
                        </button>
                        <button class ="controlButton repeat" title="Repeat Button">
                            <img src="assets/images/icons/repeat.png" alt="Repeat">
                        </button>
                    </div> 
                    <div class ="playbackBar">
                        <span class="progressTime current">0.00</span>
                        <div class="progressBar">
                            <div class="progressBarBg"> 
                                <div class="progress"></div>
                            </div>
                        </div>
                        <span class="progressTime remaining">0.00</span>
                    </div>
                </div>
            </div>
            <div id="nowPlayingRight">
                <div class="volumeBar">
                    <button class="controlButton volume" title="Volume Button">
                        <img src="assets/images/icons/volume.png" alt="Volume">
                    </button>
                        <div class="progressBar">
                            <div class="progressBarBg"> 
                                <div class="progress"></div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>