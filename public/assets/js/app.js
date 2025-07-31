const baseURL = 'http://localhost:8080/recipes_ci';
document.addEventListener('DOMContentLoaded', () => {
    // Parar loader
    stopLoading();

    // Obtenemos el contenedor del carousel
    const carouselContainer = document.querySelector('.carousel-home');

    if (!carouselContainer) return;

    // Función para cargar los elementos del carousel
    const loadCarouselItems = async () => {
        startLoading();

        try {
            const response = await fetch(baseURL + '/api/carousel');
            const items = await response.json();

            // Limpiamos el contenedor actual
            carouselContainer.innerHTML = '';

            // Creamos y añadimos los elementos del carousel
            items.forEach(item => {
                const div = document.createElement('div');
                div.innerHTML = `
                    <a href="${baseURL}/receta/${item.slug}">
                        <img src="${baseURL}/assets/img/recipes/${item.image}" class="img-fluid" alt="${item.name}">
                        <h3 class="text-center mt-2">${item.name}</h3>
                    </a>
                `;
                carouselContainer.appendChild(div);
            });

            // Inicializamos el slider (asumiendo que usas Slick)
            $(carouselContainer).slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 1,
                adaptiveHeight: false,
            });
        } catch (error) {
            console.error('Error al cargar los elementos del carousel:', error);
        }
    };

    // Creamos el observer
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                loadCarouselItems().then(() => {
                    stopLoading();
                });
                // Desconectamos el observer después de cargar
                observer.disconnect();
            }
        });
    }, {
        threshold: 0.1 // El carousel será cargado cuando al menos el 10% sea visible
    });

    // Comenzamos a observar el contenedor del carousel
    observer.observe(carouselContainer);

    // Obtener los contenedores del carousel con todas las categorías
    const carouselAllCategoriesWrapper = document.getElementById('carouselAllCategoriesWrapper');

    if (!carouselAllCategoriesWrapper) return;

    const loadCarouselCategories = async () => {
        startLoading();

        try {
            const response = await fetch(baseURL + '/api/all-categories-carousel');
            const items = await response.json();

            // Limpiamos el contenedor actual
            carouselAllCategoriesWrapper.innerHTML = '';

            const categories = items.categories;
            const seasonMenu = items.seasonMenu;
            const holidayMenu = items.holidayMenu;

            const divAllRecipe = document.createElement('div');
            divAllRecipe.classList.add('d-block', 'col-12', 'col-md-2', 'px-3');
            divAllRecipe.style.height = '165px';
            divAllRecipe.innerHTML = `
                <a href="${baseURL}/recetas">
                    <img
                            src="${baseURL}/assets/img/categories/chef_ana_paula.png"
                            class="img-fluid"
                            alt="Recetario completo"
                    />
                    <p class="text-center mt-1 h6">Recetario completo</p>
                </a>
            `;
            carouselAllCategoriesWrapper.appendChild(divAllRecipe);

            // Creamos y añadimos los elementos de las categorías
            categories.forEach(category => {
                const div = document.createElement('div');
                div.classList.add('d-block', 'col-12', 'col-md-2', 'px-3');
                div.style.height = '150px';
                div.innerHTML = `
                    <a href="${baseURL}/recetas/${category.slug}">
                        <img
                            src="${baseURL}/assets/img/categories/${category.image}"
                            class="img-fluid"
                            alt="${category.name}"
                        />
                        <p class="text-center mt-1 h6">${category.name}</p>
                </a>`;
                carouselAllCategoriesWrapper.appendChild(div);
            });

            // Creamos y añadimos los elementos del menú de temporada
            seasonMenu.forEach(menu => {
                const div = document.createElement('div');
                div.classList.add('d-block', 'col-12', 'col-md-2', 'px-3');
                div.style.height = '165px';
                div.innerHTML = `
                    <a href="${baseURL}/recetas/${menu.slug}">
                        <img
                            src="${baseURL}/assets/img/menus/${menu.image}"
                            class="img-fluid"
                            alt="${menu.name}"
                        />
                        <p class="text-center mt-1 h6">${menu.name}</p>
                </a>`;
                carouselAllCategoriesWrapper.appendChild(div);
            });

            // Creamos y añadimos los elementos del menú día festivo
            holidayMenu.forEach(menu => {
                const div = document.createElement('div');
                div.classList.add('d-block', 'col-12', 'col-md-2', 'px-3');
                div.style.height = '165px';
                div.innerHTML = `
                    <a href="${baseURL}/recetas/${menu.slug}">
                        <img
                            src="${baseURL}/assets/img/menus/${menu.image}"
                            class="img-fluid"
                            alt="${menu.name}"
                        />
                        <p class="text-center mt-1 h6">${menu.name}</p>
                </a>`;
                carouselAllCategoriesWrapper.appendChild(div);
            });

            const flkty = new Flickity('#carouselAllCategoriesWrapper', {
                pageDots: false,
                cellAlign: 'left',
                wrapAround: true,
                imagesLoaded: true,
                autoPlay: 2500
            });

        } catch (error) {
            console.error('Error al cargar los elementos de las categorías:', error);
        }
    }

    // Creamos el observer para el carousel de categorías
    const categoriesObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                loadCarouselCategories().then(() => {
                    stopLoading();
                });
                // Desconectamos el observer después de cargar
                categoriesObserver.disconnect();
            }
        });
    }, {
        threshold: 0.1 // El carousel será cargado cuando al menos el 10% sea visible
    });

    // Comenzamos a observar el contenedor del carousel de categorías
    categoriesObserver.observe(carouselAllCategoriesWrapper);
});

function startLoading() {
    const loadingScreen = document.getElementById('loading-screen');
    const body = document.body;
    if (loadingScreen.classList.contains('active')) return;
    loadingScreen.classList.add('active');
    body.classList.add('loading');
}

function stopLoading() {
    const loadingScreen = document.getElementById('loading-screen');
    const body = document.body;
    if (!loadingScreen.classList.contains('active')) return;
    loadingScreen.classList.remove('active');
    body.classList.remove('loading');
}

window.startLoading = startLoading;
window.stopLoading = stopLoading;