const wrappers = document.querySelectorAll('.wrapper');

wrappers.forEach(wrapper => {
    const myTrack = wrapper.getElementsByClassName('myTrack')[0];

    const playButton = wrapper.getElementsByClassName('playButton')[0];

    const progressBar = wrapper.querySelector('.progressBar');

    const currentTime = wrapper.querySelector('.current');
    const durTime = wrapper.querySelector('.duration');
    let duration = myTrack.duration;

    playButton.addEventListener('click', playOrPause, false);
    myTrack.ontimeupdate = function () {
        currentTime.innerHTML = secondsToMinutes(myTrack.currentTime);

        let size = (myTrack.currentTime / duration * 100);
        progressBar.value = size;
    }

    myTrack.onloadedmetadata = function () {
        duration = myTrack.duration;
        wrapper.querySelector('.duration').innerHTML = secondsToMinutes(myTrack.duration);
    }

    myTrack.onpause = function () {
        playButton.style.backgroundImage = 'url(/images/play.png)';
    }

    progressBar.addEventListener('click', function (event) {
        const percent = event.offsetX / event.target.offsetWidth;
        myTrack.currentTime = percent * duration;
        progressBar.value = percent * 100;

    })

    function playOrPause() {
        if (!myTrack.paused && !myTrack.ended) {
            myTrack.pause();
        } else {
            for (const player of document.getElementsByTagName('audio')) {
                player.pause();
            }
            myTrack.play();
            playButton.style.backgroundImage = 'url(/images/pause.png)';
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