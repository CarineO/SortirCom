$(document).on('change', '#app_sortie_ville, #app_sortie_lieux', function () {
    let $field = $(this)
    let $villeField = $('#app_sortie_ville')
    let $form = $field.closest('form')
    let target = '#' + $field.attr('id').replace('ville', 'lieux')
    // Les données à envoyer en Ajax
    let data = {}
    data[$villeField.attr('nom')] = $villeField.val()
    data[$field.attr('nom')] = $field.val()
    // On soumet les données
    $.post($form.attr('action'), data).then(function (data) {
        // On récupère le nouveau <select>
        let $input = $(data).find(target)
        // On remplace notre <select> actuel
        $(target).replaceWith($input)
    })
})