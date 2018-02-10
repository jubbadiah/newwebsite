const wrappers = document.querySelectorAll('.wrapper');

wrappers.forEach(wrapper => {
    const playButton = wrapper.getElementsByClassName('playButton')[0];

    const barSize = 120;
    const bar = document.querySelector('#defaultBar');
    const progressBar = document.querySelector('#progressBar');

    const currentTime = wrapper.querySelector('#current');
    const durTime = wrapper.querySelector('#duration');

    const myTrack = wrapper.getElementsByClassName('myTrack')[0];
    const duration = myTrack.duration;


    wrapper.querySelector('#duration').innerHTML = secondsToMinutes(duration);

    playButton.addEventListener('click', playOrPause, false);
    myTrack.ontimeupdate = function () {
        currentTime.innerHTML = secondsToMinutes(myTrack.currentTime);

    }

    function playOrPause() {
        if (!myTrack.paused && !myTrack.ended) {
            myTrack.pause();
            playButton.style.backgroundImage = 'url(/images/play.png)';

        } else {
            myTrack.play();
            playButton.style.backgroundImage = 'url(/images/pause.png)';

            let size = (currentTime * barSize / durTime);
            progressBar.style.width = size + "px";
        }
    }

});

function secondsToMinutes(time) {
    let minutes = Math.floor(time / 60);
    let seconds = Math.floor(time - minutes * 60);

    if (seconds < 10) {
        seconds = "0" + seconds;
    }

    if (minutes < 10) {
        minutes = "0" + minutes;
    }

    return `${minutes}:${seconds}`;
}



// get element 
