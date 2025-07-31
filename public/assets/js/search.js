const recipeContainer = document.getElementById('recipe_container');
const recipeTemplate = document.getElementById('recipe_template').content.firstElementChild;
const recipeBookmark = document.getElementById('recipe_bookmark');
const elementForPage = 10;
let page = 1;
let recipes = [];
let baseURL = '';

function initRecipes(data, base_url) {
    baseURL = base_url;
    recipes = [...data];
    if (recipes.length === 0) {
        document.querySelector('.recipe_message_error').innerHTML = `<p class="h2 text-center my-10">No se encontraron recetas, con el parámetro de búsqueda</p>`;
    } else {
        render();
        watchMarker();
    }
}

function watchMarker() {
    const observerMarker = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                loadRecipes();
            }
        });
    });
    observerMarker.observe(recipeBookmark);
}

function loadRecipes() {
    page = page + 1;
    render();
}

function getRecipeSlice(page = 1) {
    const start = (page - 1) * elementForPage;
    const end = start + elementForPage;
    return recipes.slice(start, end);
}

function render() {
    const recipeSlice = getRecipeSlice(page);
    recipeSlice.forEach((recipe) => {
        const clone = recipeTemplate.cloneNode(true);

        const recipeUrl = clone.querySelector('#recipe_url');
        const recipeImage = clone.querySelector('#recipe_image');
        const recipeRaiting = clone.querySelector('#recipe_raiting');
        const recipeDifficulty = clone.querySelector('#recipe_difficulty');
        const recipeTitle = clone.querySelector('#recipe_title');
        const recipeAuthor = clone.querySelector('#recipe_author');
        const recipeCalories = clone.querySelector('#recipe_calories');

        recipeUrl.href = `${baseURL}/receta/${recipe.slug}`;
        recipeImage.classList.add('loading');

        const img = new Image();
        img.src = `${baseURL}assets/img/recipes/${recipe.image}`;
        img.onload = () => {
            recipeImage.style.backgroundImage = `url('${img.src}')`;
            recipeImage.classList.remove('loading');
        };

        recipeRaiting.innerHTML = getStars(recipe.rating);
        recipeDifficulty.innerHTML = recipe.difficulty;
        recipeTitle.innerHTML = recipe.name;
        recipeAuthor.innerHTML = 'Chef Ana Paula'; // Assuming a static author for now
        recipeCalories.innerHTML = `${recipe.calories} Calorías`;

        recipeContainer.appendChild(clone);
    });
}

function getStars(raiting) {
    const stars = Math.floor(raiting);
    const starsArray = Array.from({ length: 5 }, (_, index) => {
        if (index < stars) {
            return '<i class="fas fa-star star star-selected"></i>';
        }
        return '<i class="fas fa-star star"></i>';
    });
    return starsArray.join('');
}