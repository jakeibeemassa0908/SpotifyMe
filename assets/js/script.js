var currentPlaylist = [];
var audioElement;

function Audio(){

    this.currentlyPlaying;
    this.audio = document.createElement('audio');

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
}