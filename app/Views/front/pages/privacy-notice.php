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

            <!-- Section -->
            <section class="animate__animated animate__fadeInUp mt-5 mb-6">

                <h3 class="fw-bold mb-4">1. Responsable del Tratamiento de los Datos Personales:</h3>
                <p>
                    Chef Ana Paula, responsable de este sitio web, se compromete a garantizar la privacidad y protección de los datos personales de los usuarios.
                </p>

            </section>

            <!-- Section -->
            <section class="animate__animated animate__fadeInUp mt-5 mb-6">
                <h3 class="fw-bold mb-4">2. Datos Personales Recopilados:</h3>

                <p>
                    Al registrarse en chefanapaula.com, los usuarios proporcionan información personal que puede incluir:
                </p>

                <ul>
                    <li>Nombre y apellidos</li>
                    <li>Correo electrónico</li>
                    <li>Información de contacto</li>
                    <li>Preferencias culinarias</li>
                    <li>Datos de navegación (cookies)</li>
                </ul>
            </section>

            <!-- Section -->
            <section class="animate__animated animate__fadeInUp mt-5 mb-6">

                <h3 class="fw-bold mb-4">3. Finalidad del Tratamiento de Datos:</h3>
                <p>
                    Los datos personales recabados se utilizarán para los siguientes propósitos:
                </p>

                <ul>
                    <li>Administrar y gestionar la cuenta de usuario.</li>
                    <li>Permitir la calificación y comentario de recetas.</li>
                    <li>Facilitar la creación de listas de favoritos.</li>
                    <li>Enviar boletines informativos y promociones relacionadas con los servicios ofrecidos.</li>
                    <li>Mejorar la experiencia del usuario mediante la personalización del contenido.</li>
                </ul>

            </section>

            <!-- Section -->
            <section class="animate__animated animate__fadeInUp mt-5 mb-6">
                <h3 class="fw-bold mb-4">4. Compartición de Datos:</h3>

                <p>
                    Los datos personales no se compartirán con terceros, excepto en los siguientes casos:
                </p>

                <ul>
                    <li>Cuando sea necesario para cumplir con una obligación legal.</li>
                    <li>Para proteger los derechos, propiedad o seguridad de Chef Ana Paula y sus usuarios.</li>
                </ul>
            </section>

            <!-- Section -->
            <section class="animate__animated animate__fadeInUp mt-5 mb-6">

                <h3 class="fw-bold mb-4">5. Derechos del Usuario:</h3>
                <p>
                    Los usuarios tienen derecho a acceder, rectificar, cancelar u oponerse al tratamiento de sus
                    datos personales en cualquier momento. Para ejercer estos derechos, pueden contactar a
                    Chef Ana Paula a través del correo electrónico proporcionado en el sitio web.
                </p>

            </section>

            <!-- Section -->
            <section class="animate__animated animate__fadeInUp mt-5 mb-6">

                <h3 class="fw-bold mb-4">6. Seguridad de los Datos:</h3>
                <p>
                    Chef Ana Paula implementa medidas de seguridad adecuadas para proteger los datos personales
                    de los usuarios contra el acceso no autorizado, alteración, divulgación o destrucción.
                </p>

            </section>

            <!-- Section -->
            <section class="animate__animated animate__fadeInUp mt-5 mb-6">

                <h3 class="fw-bold mb-4">7. Cambios en el Aviso de Privacidad:</h3>
                <p>
                    Chef Ana Paula se reserva el derecho de actualizar este Aviso de Privacidad para reflejar
                    cambios en nuestras prácticas de información. Se notificará a los usuarios sobre cambios
                    significativos a través de nuestro sitio web.
                </p>

            </section>

            <!-- Section -->
            <section class="animate__animated animate__fadeInUp mt-9">

                <h2 class="fw-bold mb-3">Términos y Condiciones</h2>
                <hr>

                <h3 class="fw-bold mb-4 mt-5">1. Aceptación de los Términos:</h3>

                <p>
                    Al acceder y utilizar el sitio web chefanapaula.com, el usuario acepta y se compromete a cumplir
                    con los presentes Términos y Condiciones.
                </p>

            </section>

            <!-- Section -->
            <section class="animate__animated animate__fadeInUp mt-5 mb-6">

                <h3 class="fw-bold mb-4">2. Uso del Sitio:</h3>

                <p>
                    El usuario se compromete a utilizar el sitio web de manera responsable y únicamente para fines
                    legales. Queda prohibido:
                </p>

                <ul>
                    <li>Utilizar el sitio para realizar actividades ilegales o no autorizadas.</li>
                    <li>Interferir con el funcionamiento del sitio web.</li>
                    <li>Suplantar a cualquier persona o entidad.</li>
                </ul>

            </section>

            <!-- Section -->
            <section class="animate__animated animate__fadeInUp mt-5 mb-6">

                <h3 class="fw-bold mb-4">3. Contenido del Sitio:</h3>

                <p>
                    Todos los contenidos, incluidas las recetas, imágenes, textos y videos, son propiedad de Chef Ana Paula
                    y están protegidos por derechos de autor. Está prohibida la reproducción, distribución o uso no autorizado del contenido.
                </p>

            </section>

            <!-- Section -->
            <section class="animate__animated animate__fadeInUp mt-5 mb-6">

                <h3 class="fw-bold mb-4">4. Registro y Cuenta de Usuario:</h3>

                <p>
                    Para acceder a ciertas funciones del sitio, el usuario debe registrarse y crear una cuenta. El usuario es responsable de
                    mantener la confidencialidad de su contraseña y cuenta, así como de todas las actividades que ocurran bajo su cuenta.
                </p>

            </section>

            <!-- Section -->
            <section class="animate__animated animate__fadeInUp mt-5 mb-6">

                <h3 class="fw-bold mb-4">5. Comentarios y Calificaciones:</h3>

                <p>
                    Los usuarios pueden calificar y comentar las recetas. Chef Ana Paula se reserva el derecho de moderar, editar o eliminar
                    comentarios que sean ofensivos, inapropiados o que no cumplan con las políticas del sitio.
                </p>

            </section>

            <!-- Section -->
            <section class="animate__animated animate__fadeInUp mt-5 mb-6">

                <h3 class="fw-bold mb-4">6. Enlaces a Terceros:</h3>

                <p>
                    El sitio puede contener enlaces a otros sitios web operados por terceros. Chef Ana Paula no se responsabiliza por el
                    contenido o las prácticas de privacidad de estos sitios.
                </p>

            </section>

            <!-- Section -->
            <section class="animate__animated animate__fadeInUp mt-5 mb-6">

                <h3 class="fw-bold mb-4">7. Modificaciones de los Términos:</h3>

                <p>
                    Chef Ana Paula se reserva el derecho de modificar estos Términos y Condiciones en cualquier momento. Los cambios serán
                    efectivos a partir de su publicación en el sitio web.
                </p>

            </section>

            <!-- Section -->
            <section class="animate__animated animate__fadeInUp mt-5 mb-6">

                <h3 class="fw-bold mb-4">8. Contacto:</h3>

                <p>
                    Para cualquier duda o comentario sobre estos Términos y Condiciones, los usuarios pueden contactar a Chef Ana Paula a
                    través del formulario de contacto en el sitio web.
                </p>

            </section>


        </div>
        <div class="col-12 col-md-4">
            <?= $this->include('front/sections/chef_sidebar.php'); ?>
            <?= view_cell('App\Cells\PopularCell'); ?>
        </div>

    </div>
</div>

<?= $this->endSection(); ?>
