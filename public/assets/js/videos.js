const videoContainer = document.getElementById('video_container');
const videoTemplate  = document.getElementById('video_template').content.firstElementChild;
const videoBookmark  = document.getElementById('video_bookmark');

const elementForPage = 12;
let page = 1;
let videos = [];
let baseURL = '';

function initVideos(data, base_url) {
    baseURL = base_url;
    videos = [...data];
    render();
    watchMarker();
}

function loadVideos() {
    page = page + 1;
    render();
}

function getVideosSlice(page = 1) {
    const start = (page - 1) * elementForPage;
    const end = start + elementForPage;
    return videos.slice(start, end);
}

function watchMarker() {
    const observerMarker = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                loadVideos();
            }
        });
    });
    observerMarker.observe(videoBookmark);
}

function generateBigVideo() {
    const videoLinks = videoContainer.querySelectorAll('a');
        for (let i = 0; i < videoLinks.length; i++) {
            videoLinks[i].addEventListener('click', function(e) {
                e.preventDefault();
                BigPicture({
                    el: e.target,
                    vidSrc: e.target.getAttribute('vidsrc'),
                });
            });
        }
}

function render() {
    const videosSlice = getVideosSlice(page);
    videosSlice.forEach((video) => {
        console.log(video);
        const clone = videoTemplate.cloneNode(true);

        const videoUrl = clone.querySelector('#video_url');
        const videoImage = clone.querySelector('#video_image');
        const videoTitle = clone.querySelector('#video_title');
        const videoDifficulty = clone.querySelector('#video_difficulty');
        const videoDuration = clone.querySelector('#video_duration');

        videoUrl.href = `${baseURL}/assets/img/media/${video.url}`;
        videoImage.style.backgroundImage = `url('${baseURL}/assets/img/media/${video.image}')`;
        videoImage.setAttribute('vidsrc', `${baseURL}/assets/vid/${video.url}`);

        videoTitle.innerHTML = video.name;
        videoTitle.setAttribute('vidsrc', `${baseURL}/assets/vid/${video.url}`);

        videoDifficulty.innerHTML = `<i class='fas fa-thermometer-quarter mr-1'></i> ${video.difficulty}`;
        videoDuration.innerHTML = `<i class="far fa-clock"></i> ${video.duration}`;

        videoContainer.appendChild(clone);
    });

    generateBigVideo();
}