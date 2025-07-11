$(document).ready(function () {
// $(document).on("click", "#addSkillBtn", function () {
//     const newRow = $modal.find('#skill-template').html();
//     console.log("Appending skill row at", new Date().toLocaleTimeString());
//     $modal.find('#skills-wrapper').append(newRow);
// });



$(document).on('click', '.remove-btn', function () {
    if ($('.skill-row').length > 1) {
        $(this).closest('.skill-row').remove();
    }
});

    $(document).on('click', '#addSkillBtn', function () {
        const $newRow = $('.skill-row:first').clone();
        $newRow.find('input').val('');
        $newRow.find('select').val('');
        $('#skills-wrapper').append($newRow);
    });

});

