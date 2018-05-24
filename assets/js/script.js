var currentPlaylist = [];
var shufflePlaylist = [];
var temporaryPlaylist = [];
var audioElement;
var mouseDown = false;
var currentIndex = 0;
var repeat = false;
var shuffle = false;
var userLoggedIn;

function openPage(url){
    if(url.indexOf("?")==-1){
        url = url+"?";
    }
    //changes uknown characters to their URL equivalent
    var encodeUrl = encodeURI(url+"&userLoggedIn=" + userLoggedIn);
    $("#mainContent").load(encodeUrl);
}
function formatTime(seconds){
    var time = Math.round(seconds);
    var minutes = Math.floor(time/60); //Rounds down
    var seconds = time - minutes*60;

    var extraZero = seconds < 10 ? "0" :"";

    return minutes +":"+extraZero+seconds;
}

function updateTimeProgressBar(audio){
    $(".progressTime.current").text(formatTime(audio.currentTime));
    $(".progressTime.remaining").text(formatTime(audio.duration - audio.currentTime));

    var progress = audio.currentTime / audio.duration * 100;
    $(".playbackBar .progress").css("width",progress + "%");
}

function updateVolumeProgressBar(audio){
    var volume = audio.volume * 100;
    $(".volumeBar .progress").css("width",volume + "%");
}

function Audio(){

    this.currentlyPlaying;
    this.audio = document.createElement('audio');

    this.audio.addEventListener("canplay",function(){
        //this refers to the object that the event was called on, which is the audio element
        var duration = formatTime(this.duration);
        $(".progressTime.remaining").text(duration);
    });

    //Event listener for time change in the audio due to movement in the progress bar
    this.audio.addEventListener("timeupdate",function(){
        if(this.duration){
            updateTimeProgressBar(this);
        }
    });

    //Event listener for the audio volume change due to movement in the volume progress bar

    this.audio.addEventListener("volumechange",function(){
        //'this' refers to the object that the event was called on, which is the audio element
        updateVolumeProgressBar(this);
    });

    this.audio.addEventListener("ended",function(){
        nextSong();
    });



    this.setTrack = function (track) {
        this.currentlyPlaying = track;
        this.audio.src = track.path;
    };

    this.play = function(){
        $(".controlButton.play").hide();
        $(".controlButton.pause").show();
        this.audio.play();
    };

    this.pause = function(){
        $(".controlButton.pause").hide();
        $(".controlButton.play").show();
        this.audio.pause();  
    };

    this.setTime = function(seconds){
        this.audio.currentTime = seconds;
    }
}