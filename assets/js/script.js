var currentPlaylist = [];
var audioElement;
var mouseDown = false;

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

function Audio(){

    this.currentlyPlaying;
    this.audio = document.createElement('audio');

    this.audio.addEventListener("canplay",function(){
        //this refers to the object that the event was called on
        var duration = formatTime(this.duration);
        $(".progressTime.remaining").text(duration);
    });

    this.audio.addEventListener("timeupdate",function(){
        if(this.duration){
            updateTimeProgressBar(this);
        }
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