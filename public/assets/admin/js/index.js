document.addEventListener('DOMContentLoaded', function () {
    createCategoryChart();
    createTagsChart();
});

const sectionModal = document.getElementById('sectionModal');
const loaderWrapper = document.querySelector('#sectionModal #loader-wrapper');

sectionModal.addEventListener('show.bs.modal', function (event) {

    loaderWrapper.classList.add('d-none');

    const sectionWrapper = document.querySelector('#sectionModal #section-wrapper');

    const button = event.relatedTarget;

    // Obtener los datos de los atributos data-*
    const sectionId = button.getAttribute('data-section-id');
    const sectionName = button.getAttribute('data-section-name');

    sectionWrapper.innerHTML = `
        <form id="sectionUpdateForm" class="my-3" onsubmit="editSectionForm(event)">
            <input type="hidden" name="id" value="${sectionId}">
            <div class="row">
                <label
                    for="name"
                    class="col-sm-4 col-form-label">
                    Nombre de la sección</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="name" name="name" value="${sectionName}">
                </div>
            </div>
        </form>
    `;
});

function editSectionForm(event) {
    event.preventDefault();

    axios.post(`${baseURL}admin/section/update`, new FormData(event.target))
        .then((response) => {
            const data = response.data;
            if (data.success) {
                // Encontrar la fila correspondiente
                const row = document.querySelector(`button[data-section-id="${data.content.id}"]`)
                    .closest('tr');

                // Actualizar el nombre en la celda correspondiente
                row.querySelector('td:nth-child(2)').textContent = data.content.name;

                // Actualizar el atributo data-section-name del botón
                row.querySelector('button[data-section-id]')
                    .setAttribute('data-section-name', data.content.name);

                // Actualizar la fecha si viene en la respuesta
                if (data.content.updated_at) {
                    row.querySelector('td:nth-child(3)').textContent = data.content.updated_at;
                }

                // Resaltar la fila actualizada
                highlightRow(row);

                // Cerrar el modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('sectionModal'));
                modal.hide();

                // Opcional: Mostrar mensaje de éxito
                // Puedes usar un toast o algún otro sistema de notificaciones
                // alert('Sección actualizada correctamente');
            } else {
                // Manejar el error
                alert(data.message || 'Error al actualizar la sección');
            }
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('Error al procesar la solicitud');
        })
        .finally(() => {
            loaderWrapper.classList.remove('d-none');
        });

}

function highlightRow(row) {
    row.style.backgroundColor = '#fff3cd';
    setTimeout(() => {
        row.style.transition = 'background-color 1s ease';
        row.style.backgroundColor = '';
        // Limpiar después de la transición
        setTimeout(() => {
            row.style.transition = '';
        }, 1000);
    }, 100);
}

