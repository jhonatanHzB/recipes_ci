<?= $this->extend('front/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row mt-10 mb-5">

        <!-- BREADCRUMBS -->
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><?= $location ?? ''; ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $page ?? ''; ?></li>
                </ol>
            </nav>
        </div>
        <!-- ./breadcrumbs -->

        <!-- HEADER PAGE -->
        <div class="col-12">
            <p class="fw-bold h2 mb-3">
                <?= $page ?? ''; ?>
            </p>

            <hr>

        </div>
        <!-- ./header page -->

        <div class="row">
        </div>
        <div class="col-12 col-md-8">

            <!-- Alert -->
            <section id="alert"></section>


            <!-- Card -->
            <div class="card card-border border-primary shadow-light-lg animate__animated animate__fadeInUp">
                <div class="card-body">

                    <!-- Form -->
                    <form id="contact_form">
                        <div class="row">
                            <div class="col-12 col-md-6">

                                <div class="form-group mb-5">
                                    <label class="form-label" for="full_name">Nombre completo</label>
                                    <input class="form-control" id="full_name" name="full_name" type="text" placeholder="Nombre Apellido">
                                    <div class="error-message" id="full_name_error"></div>
                                </div>

                            </div>
                            <div class="col-12 col-md-6">

                                <div class="form-group mb-5">
                                    <label class="form-label" for="email">Correo</label>
                                    <input class="form-control" id="email" name="email" type="text" placeholder="nombre@email.com">
                                    <div class="error-message" id="email-error"></div>
                                </div>

                            </div>
                        </div> <!-- / .row -->
                        <div class="row">
                            <div class="col-12">

                                <div class="form-group mb-5">
                                    <label class="form-label" for="message">Déjanos tu mensaje y nosotros te contactaremos</label>
                                    <textarea class="form-control" id="message" name="message" rows="5" placeholder="¡Haznos saber!"></textarea>
                                    <div class="error-message" id="message-error"></div>
                                </div>

                            </div>
                        </div> <!-- / .row -->
                        <div class="row align-items-center">
                            <div class="col-12 col-md">

                                <!-- Submit -->
                                <button type="submit" class="btn btn-primary mb-6 mb-md-0 lift" id="submit_button" disabled>
                                    Enviar <i class="fe fe-arrow-right ms-3"></i>
                                </button>

                            </div>
                            <div class="col-12 col-md-auto">

                                <p class="fs-sm text-body-secondary mb-0">
                                    La solicitud se enviará de forma segura y permanecerá privada.
                                </p>

                            </div>
                        </div> <!-- / .row -->
                    </form>

                </div>
            </div>

        </div>
        <div class="col-12 col-md-4">
            <img
                class="img-fluid shadow d-none d-md-block"
                src="<?= base_url('assets/img/chef.jpg'); ?>"
                alt="Chef Ana Paula"
                data-aos="fade-up"
            />
        </div>

    </div>
</div>

<script src="<?= base_url('assets/js/contact.js'); ?>"></script>

<?= $this->endSection(); ?>
