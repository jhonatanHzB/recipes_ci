function imagesLoaded() {
    const images = document.images;
    let loaded = true;

    for (let i = 0; i < images.length; i++) {
        if (!images[i].complete) {
            loaded = false;
            break;
        }
    }

    return loaded;
}

function checkAllResourcesLoaded() {
    if (imagesLoaded()) {
        document.getElementById('loading-screen').classList.remove('active');
        document.body.classList.remove('loading');
    } else {
        // Vuelve a comprobar después de un tiempo
        setTimeout(checkAllResourcesLoaded, 100);
    }
}

window.addEventListener('load', function () {
    checkAllResourcesLoaded();
});