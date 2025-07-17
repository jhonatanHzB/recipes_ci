function initTimeCounter(config) {
    const defaults = {
        inputId: '',
        max: 55,
        step: 5,
        initialValue: 0
    };

    // Combinar configuración predeterminada con la proporcionada
    const settings = { ...defaults, ...config };

    const input = document.getElementById(settings.inputId);
    if (!input) return;

    // Formatear el valor inicial
    input.value = formatNumber(settings.initialValue);

    // Generar IDs únicos para los botones
    const incrementId = `increment_${settings.inputId}`;
    const decrementId = `decrement_${settings.inputId}`;

    // Agregar botones de incremento/decremento personalizados
    const wrapper = input.closest('.input-group');
    wrapper.insertAdjacentHTML('beforeend', `
        <button type="button" class="btn btn-secondary-light" id="${incrementId}">
            <i class="ri-arrow-up-s-line"></i>
        </button>
        <button type="button" class="btn btn-secondary-light" id="${decrementId}">
            <i class="ri-arrow-down-s-line"></i>
        </button>
    `);

    // Deshabilitar la edición directa y las flechas nativas
    input.addEventListener('keydown', (e) => e.preventDefault());
    input.style.MozAppearance = 'textfield';
    input.style.appearance = 'textfield';

    // Manejador para incremento
    document.getElementById(incrementId).addEventListener('click', () => {
        let value = parseInt(input.value);
        value = (value + settings.step) > settings.max ? 0 : value + settings.step;
        input.value = formatNumber(value);
    });

    // Manejador para decremento
    document.getElementById(decrementId).addEventListener('click', () => {
        let value = parseInt(input.value);
        value = (value - settings.step) < 0 ? settings.max : value - settings.step;
        input.value = formatNumber(value);
    });

    // Función para formatear el número
    function formatNumber(num) {
        return num.toString().padStart(2, '0');
    }
}

function initDynamicInputs(config) {
    const defaults = {
        addButtonId: '',          // ID del botón para agregar
        containerListId: '',      // ID del contenedor donde se agregarán los inputs
        inputName: '',           // Nombre del input (se usará como name="inputName[]")
        placeholder: '',         // Placeholder del input
        buttonText: 'Borrar',    // Texto del botón de borrar
        buttonClass: 'btn-danger-light', // Clase del botón de borrar
        inputClass: '',          // Clase adicional para el input (opcional)
        customValidation: null,  // Función de validación personalizada (opcional)
        onAdd: null,            // Callback después de agregar (opcional)
        onDelete: null,         // Callback después de eliminar (opcional)
        initialValues: []       // Parámetro para valores iniciales
    };

    // Combinar configuración predeterminada con la proporcionada
    const settings = { ...defaults, ...config };

    // Obtener elementos del DOM
    const addButton = document.getElementById(settings.addButtonId);
    const containerList = document.getElementById(settings.containerListId);

    if (!addButton || !containerList) {
        console.error('No se encontraron los elementos necesarios');
        return;
    }

    // Función para crear un nuevo input
    function createNewInput(value = '') {
        const inputGroup = document.createElement('div');
        inputGroup.className = 'input-group mb-2';

        const inputClasses = ['form-control'];
        if (settings.inputClass) {
            inputClasses.push(settings.inputClass);
        }

        inputGroup.innerHTML = `
            <input 
                type="text" 
                class="${inputClasses.join(' ')}" 
                name="${settings.inputName}[]" 
                placeholder="${settings.placeholder}"
                value="${value}"
                ${settings.customValidation ? 'onchange="(' + settings.customValidation + ')(this)"' : ''}>
            <div class="input-group-append">
                <button type="button" class="btn ${settings.buttonClass} delete-item">
                    ${settings.buttonText}
                </button>
            </div>
        `;

        // Agregar manejador para el botón de borrar
        const deleteButton = inputGroup.querySelector('.delete-item');
        deleteButton.addEventListener('click', function() {
            inputGroup.remove();
            if (typeof settings.onDelete === 'function') {
                settings.onDelete(inputGroup);
            }
        });

        return inputGroup;
    }

    // Renderizar valores iniciales si existen
    if (settings.initialValues && Array.isArray(settings.initialValues)) {
        settings.initialValues.forEach(value => {
            const newInput = createNewInput(value);
            containerList.appendChild(newInput);
        });
    }

    // Manejador para el botón de agregar
    addButton.addEventListener('click', function() {
        const newInput = createNewInput();
        containerList.appendChild(newInput);

        // Enfocar el nuevo input
        const input = newInput.querySelector('input');
        input.focus();

        if (typeof settings.onAdd === 'function') {
            settings.onAdd(newInput);
        }
    });
}
