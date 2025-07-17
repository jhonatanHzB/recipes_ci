const form = document.getElementById("recipeForm");
const draftSwitch = document.getElementById("draftSwitch");

form.addEventListener("submit", (event) => {
    event.preventDefault();
    const formData = new FormData(form);
    if (draftSwitch.checked) {
        formData.append("draft", draftSwitch.checked);
    }
    formData.append("description", quill.root.innerHTML);

    if (draftSwitch.checked) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success-light",
                cancelButton: "btn btn-danger-light",
            },
            buttonsStyling: false,
            allowOutsideClick: false,
        });

        swalWithBootstrapButtons
            .fire({
                title: "Borrador esta activado, quieres continuar?",
                showCancelButton: true,
                confirmButtonText: "Continuar",
            })
            .then((result) => {
                if (result.isConfirmed) {
                    sendForm(formData);
                }
            });
    } else {
        sendForm(formData);
    }
});

function sendForm(formData) {
    axios
        .post(`${baseURL}admin/recipe`, formData)
        .then((response) => {
            console.log(response);
            if (!response.data.success) {
                Swal.fire(
                    `${response.data.message}!`,
                    "",
                    "error",
                );
            }

            if (response.data.success) {
                Swal.fire(
                    `${response.data.message}!`,
                    "",
                    "success",
                );
                if (!response.data.updated) {
                    form.reset();
                    window.scrollTo({ top: 0, behavior: "smooth" });
                } else {
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500)
                }
            }
        })
        .catch((error) => {
            console.error("Error:", error);
        });
}

function setNutritionalUnits(units) {
    const [cal_unit, car_unit, pro_unit, gra_unit] = units;
    const calSelect = document.getElementById("calories_unit");
    const carSelect = document.getElementById("carbohydrates_unit");
    const proSelect = document.getElementById("protein_unit");
    const graSelect = document.getElementById("fat_unit");

    calSelect.value = cal_unit;
    carSelect.value = car_unit;
    proSelect.value = pro_unit;
    graSelect.value = gra_unit;
}

function createDateInputs(times) {
    const [t_hour, t_min, b_hour, b_min, r_hour, r_min] = times;

    // Inicializar contador de horas para cocción
    initTimeCounter({
        inputId: "time_hour",
        max: 12,
        step: 1,
        initialValue: t_hour,
    });

    // Inicializar contador de minutos para cocción
    initTimeCounter({
        inputId: "time_min",
        max: 55,
        step: 5,
        initialValue: t_min,
    });

    // Inicializar contador de horas para horneado
    initTimeCounter({
        inputId: "baked_hour",
        max: 12,
        step: 1,
        initialValue: b_hour,
    });

    // Inicializar contador de minutos para horneado
    initTimeCounter({
        inputId: "baked_min",
        max: 55,
        step: 5,
        initialValue: b_min,
    });

    // Inicializar contador de horas para refrigeración
    initTimeCounter({
        inputId: "refrigeration_hour",
        max: 12,
        step: 1,
        initialValue: r_hour,
    });

    // Inicializar contador de minutos para refrigeración
    initTimeCounter({
        inputId: "refrigeration_min",
        max: 55,
        step: 5,
        initialValue: r_min,
    });
}
