$(document).ready(function () {
    $('.modal-box').click(function () {
        $(this).hide();
    });
    $('.modal-container').click(function (e) {
        e.stopPropagation();
        return true;
    });
    $('.close-modal').click(function () {
        $('.modal-box').hide();
    });
})