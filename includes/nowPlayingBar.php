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
        currentPlaylist = <?php echo $jsonArray?>;
        audioElement = new Audio();
        setTrack(currentPlaylist[0],currentPlaylist,false);
    });

    function setTrack(trackId,newPlaylist,play){
            audioElement.setTrack('assets/music/heal.mp3');
            if(play){
            audioElement.play();
    }
    }
</script>

<div id="nowPlayingBarContainer">
        <div id="nowPlayingBar">
            <div id="nowPlayingLeft">
                <div class="content">
                    <span class="albumLink">
                        <img class="albumArtwork" src="https://lh3.googleusercontent.com/gdg509nVE8Ri5-P2SDeoEpzvZ1XRl5hmY26b5Q-Kv68tmr0kN6cVsX6Q7Hl0bHzVNQ=s360" alt="">
                    </span>
                    <div class ="trackInfo">
                        <span class="trackName">Jesus is Lord</span>
                        <span class="artistName">Jacques Massa </span> 
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
                        <button class ="controlButton play" title="Play Button">
                            <img src="assets/images/icons/play.png" alt="Play">
                        </button>
                        <button class ="controlButton pause" title="Pause Button" style ="display:none">
                            <img src="assets/images/icons/pause.png" alt="Pause">
                        </button>
                        <button class ="controlButton next" title="Next Button">
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