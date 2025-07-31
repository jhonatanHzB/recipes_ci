<div class="container mb-10">
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-baseline">
            <p class="display-2 kalam">Videos</p>
            <a class="video_link" href="<?= base_url(); ?>videos" data-aos="fade-left">
                Ver más videos <span class="fe fe-arrow-right video_icon"></span>
            </a>
        </div>
    </div>

    <hr>

    <div class="row">
        <?php if (is_array($videos) && count($videos) > 0) { ?>
            <?php foreach ($videos as $video) { ?>
                <div class="col-12 col-md-4" data-aos="fade-up">
                    <a class="card card-flush bigpicture_video" href="<?= base_url(); ?>assets/vid/<?= $video->url; ?>">

                        <!-- Image -->
                        <div class="card-zoom video_img" vidsrc="<?= base_url(); ?>assets/vid/<?= $video->url; ?>" style="
                            background-image: url('assets/img/media/<?= $video->image; ?>');
                            ">
                        </div>

                        <!-- Footer -->
                        <div class="card-footer">

                            <!-- Preheading -->
                            <h5 class="text-uppercase mb-1 text-body-secondary video_title">
                                <?= $video->name; ?>
                            </h5>

                            <!-- Heading -->
                            <div class="d-flex justify-content-between">
                                <p class="h6">
                                    <i class="fas fa-thermometer-quarter mr-1"></i>
                                    <?= $video->difficulty; ?>
                                </p>
                                <p class="h6">
                                    <i class="far fa-clock"></i>
                                    <?= $video->duration; ?>
                                </p>
                            </div>

                        </div>

                    </a>
                </div>
            <?php } ?>
        <?php } ?>
    </div>

    <div class="row mt-5" data-aos="fade-up">
        <div class="col-12 d-flex justify-content-center">
            <a class="btn btn-primary-subtle" href="<?= base_url('videos'); ?>">Ver más videos</a>
        </div>
    </div>
</div>

<script>
    window.onload = function () {
        const bigpicture_video = document.querySelectorAll('.bigpicture_video');

        bigpicture_video.forEach((video) => {
            video.addEventListener('click', function(e) {
                e.preventDefault();
                BigPicture({
                    el: e.target,
                    vidSrc: e.target.getAttribute('vidsrc'),
                });
            });
        });
    };
</script>
