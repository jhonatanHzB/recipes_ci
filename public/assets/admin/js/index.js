$(window).on('load', function () {
    function createCategoryChart(categories) {
        var colors = [
            '#2B56E2',
            '#2B56E2',
            '#2B56E2',
            '#2B56E2',
            '#2B56E2',
            '#2B56E2',
            '#2B56E2',
            '#2B56E2',
            '#2B56E2',
            '#2B56E2',
        ]

        var options = {
            series: [
                {
                    name: 'Registros',
                    data: categories.values,
                },
            ],
            chart: {
                height: 350,
                type: 'bar',
                events: {
                    click: function (chart, w, e) {
                        console.log(chart, w, e)
                    },
                },
            },
            colors: colors,
            plotOptions: {
                bar: {
                    columnWidth: '45%',
                    distributed: true,
                },
            },
            dataLabels: {
                enabled: false,
            },
            legend: {
                show: false,
            },
            xaxis: {
                categories: categories.names,
                labels: {
                    style: {
                        colors: colors,
                        fontSize: '12px',
                    },
                },
            },
        }

        var categories_bar = new ApexCharts(
            document.querySelector('#categories-bar'),
            options
        )
        categories_bar.render()
    }

    function createTagsChart(tags) {
        var colors = [
            '#E87035',
            '#E87035',
            '#E87035',
            '#E87035',
            '#E87035',
            '#E87035',
            '#E87035',
            '#E87035',
            '#E87035',
            '#E87035',
        ]

        var options = {
            series: [
                {
                    name: 'Recetas con etiqueta',
                    data: tags.values,
                },
            ],
            chart: {
                height: 350,
                type: 'bar',
                events: {
                    click: function (chart, w, e) {
                        console.log(chart, w, e)
                    },
                },
            },
            colors: colors,
            plotOptions: {
                bar: {
                    columnWidth: '45%',
                    distributed: true,
                },
            },
            dataLabels: {
                enabled: false,
            },
            legend: {
                show: false,
            },
            xaxis: {
                categories: tags.names,
                labels: {
                    style: {
                        colors: colors,
                        fontSize: '12px',
                    },
                },
            },
            stroke: {
                width: 1,
            },
        }

        var tags_bar = new ApexCharts(
            document.querySelector('#tags-bar'),
            options
        )
        tags_bar.render()
    }

    // Get categories
    $.ajax({
        url: baseURL + 'v1/dashboard/categories',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            var categories = data
            var data = {
                names: [],
                values: [],
            }
            for (var i = 0; i < categories.length; i++) {
                data.names.push(categories[i].category_title)
                data.values.push(categories[i].category_count)
            }
            createCategoryChart(data)
        },
    })

    // Get tags
    $.ajax({
        url: baseURL + 'v1/dashboard/popular-tags',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            var tags = data
            var data = {
                names: [],
                values: [],
            }
            for (var i = 0; i < tags.length; i++) {
                data.names.push(tags[i].tag_name)
                data.values.push(tags[i].tag_count)
            }
            createTagsChart(data)
        },
    })

    // Get sections table
    $.ajax({
        url: baseURL + 'v1/dashboard/sections',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            var template = ''
            data.forEach(function (section) {
                template += '<tr>'
                template += '<td>' + section.section_id + '</td>'
                template += '<td>' + section.section_name + '</td>'
                template += '<td>' + section.section_updated_at + '</td>'
                template +=
                    '<td><button class="btn btn-info-light btn-sm btn-wave" data-bs-toggle="modal" data-bs-target="#modal-' +
                    section.section_id +
                    '"><i class="ri-edit-line"></i></button></td>'
                template += '</tr>'
                createModalForSection(section.section_id, section.section_name)
            })
            $('#sections-table').html(template)
        },
    })

    function createModalForSection(id, title) {
        var template = `<div class="modal fade" id="modal-${id}" tabindex="-1" role="dialog" aria-labelledby="modal-${id}-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-${id}-title">${title}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="edit-section-${id}" method="POST">
                            <input type="hidden" name="section_id" value="${id}">
                            <div class="form-group">
                                <label for="section-name-${id}">Nombre</label>
                                <input type="text" class="form-control" id="section-name-${id}" name="section_name" value="${title}">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary-light" onclick="editSectionForm(event, '${id}')">Guardar</button>
                        <button type="button" class="btn btn-secondary-light" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>`
        $('body').append(template)
    }

    // reiniciar tooltip
    $('[data-bs-toggle="tooltip"]').tooltip()
})

function getDraftRecipes() {
    let draftRecipes = localStorage.getItem('draftRecipes')
    const draftRecipesTable = $('#draft-table')
    if (draftRecipes) {
        draftRecipes = JSON.parse(draftRecipes)
        draftRecipesTable.empty()
        for (let i = 0; i < draftRecipes.length; i++) {
            const draftRecipe = draftRecipes[i]
            const template = `
            <tr>
                <td>${i + 1}</td>
                <td>${draftRecipe.recipe_title}</td>
                <td class="truncated-description">${draftRecipe.recipe_description}</td>
                <td>${draftRecipe.recipe_difficulty}</td>
                <td>
                    <div class="d-flex column-gap-1">
                        <a href="./dashboard/create?draft=${
                            draftRecipe.recipe_id
                        }" class="btn btn-info-light btn-sm btn-wave">
                            <i class="ri-edit-line"></i>
                        </a>
                        <button class="btn btn-danger-light btn-sm btn-wave" onclick="deleteDraftRecipe(${draftRecipe.recipe_id})"> 
                            <i class="ri-delete-bin-line"></i>
                        </button>
                    </div>
                </td>
            </tr>`
            draftRecipesTable.append(template)
        }
        return
    }
    const template = `<tr>
        <th scope="row" colspan="5" style="text-align: center;">No hay recetas guardadas como borrador</th>
    </tr>`
    draftRecipesTable.append(template)
}

getDraftRecipes()

function deleteDraftRecipe(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'No podrás revertir esta acción.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, borrar!',
    }).then((result) => {
        if (result.isConfirmed) {
            let draftRecipes = localStorage.getItem('draftRecipes')
            draftRecipes = JSON.parse(draftRecipes)

            const removeRecipeIndex = draftRecipes.findIndex(
                (recipe) => recipe.recipe_id === id
            )

            draftRecipes.splice(removeRecipeIndex, 1)
            localStorage.setItem(
                'draftRecipes',
                JSON.stringify(draftRecipes)
            )
            getDraftRecipes()
            Swal.fire({
                title: 'Eliminado!',
                icon: 'success',
                text: 'Tu receta ha sido eliminada.',
            })
        }
    })
}
