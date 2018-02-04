//var myTrack = document.getElementByClass('myTrack');
//var playButton = document.getElementsByClass('playButton');

const wrappers = document.querySelectorAll('.wrapper');

wrappers.forEach(wrapper => {
    const playButton = wrapper.getElementsByClassName('playButton')[0];
    const myTrack = wrapper.getElementsByClassName('myTrack')[0];

    playButton.addEventListener('click', playOrPause, false);

    function playOrPause() {
        if (!myTrack.paused && !myTrack.ended) {
            myTrack.pause();
            playButton.style.backgroundImage = 'url(./play.png)';
        }
        else {
            myTrack.play();
            playButton.style.backgroundImage = 'url(./pause.png)';
        }
    }
});

// playButton.addEventListener('click', playOrPause, false);

// function playOrPause() {
//     if (!myTrack.paused && !myTrack.ended) {
//         myTrack.pause();
//         playButton.style.backgroundImage = 'url(./play.png)';
//     }
//     else {
//         myTrack.play();
//         playButton.style.backgroundImage = 'url(./pause.png)';
//     }
// }

