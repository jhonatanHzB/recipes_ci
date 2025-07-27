<?= $this->extend('front/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row mt-10 mb-5">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><?= $location ?? ''; ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $page ?? ''; ?></li>
                </ol>
            </nav>
        </div>
        <div class="col-12">
            <p class="display-1 kalam">
                <?= $page ?? ''; ?>
            </p>

            <hr>

            <div class="row" id="video_container"></div>

            <div id="video_bookmark" style="height: 1px"></div>

            <template id="video_template">
                <div class="col-12 col-md-3 mt-5 animate__animated animate__fadeIn animate__delay-1s">
                    <a class="card card-flush mb-7 mb-md-0 card_videos" href="#" id="video_url">


                        <div class="card-zoom video_img video_img_small" id="video_image"></div>

                        <div class="card-footer">

                            <h5 class="text-uppercase mb-1 text-primary video_title" id="video_title"></h5>

                            <div class="d-flex justify-content-between">
                                <p class="h6" id="video_difficulty"></p>
                                <p class="h6" id="video_duration"></p>
                            </div>

                        </div>

                    </a>
                </div>
            </template>

        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/videos.js'); ?>"></script>
<script>
    initVideos(<?= $videos ?>, '<?= base_url(); ?>');
</script>

<?= $this->endSection(); ?>
