var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";

var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

var player;

function onYouTubeIframeAPIReady() {
    console.log('YouTubeIframeAPIReady');
    var playerElement = document.getElementById('player');

    // Check if the player element and videoId attribute exist
    if (playerElement && playerElement.hasAttribute('data-video-id')) {
        var videoId = playerElement.getAttribute('data-video-id');

        // Delay the player initialization
        setTimeout(function () {
            player = new YT.Player('player', {
                height: '100%',
                width: '100%',
                videoId: videoId,
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
        }, 1000); // Adjust the delay as needed
    } else {
        console.error('Error: #player element or data-video-id attribute not found.');
    }
}


function onPlayerReady(event) {
    console.log('Player is ready');
    // Additional actions when the player is ready
}

function onPlayerStateChange(event) {
    // Additional actions when player state changes
}
