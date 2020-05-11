$(function() {

    $('body').on('click', '.requestModal', function () {
        let type = $(this).attr('data-type');
        if (type) {
            $(this).closest('.parentContainer').find('.modalContainer[data-type="' + type + '"]').not($(this).closest('.parentContainer').find('.parentContainer .modalContainer')).modal('show');
        }
    });

    $('body').on('click', '.toggleCollapse', function () {
        $(this).find('[class^="iconsminds-arrow-"]').toggleClass("iconsminds-arrow-up iconsminds-arrow-down");
        $(this).parents('.parentContainer').find('.collapse').collapse('hide');
        let type = $(this).attr('data-type');
        if (type) {
            $(this).parents('.parentContainer').find('.collapse[data-type="' + type + '"]').collapse('toggle')
        }
    });

    $('body').on('click', '.toggleAssignList', function () {
        $(this).parents('.assign-list').find('select').select2('open');
    });

    $.fn.select2.defaults.set( "theme", "bootstrap" );
    $.fn.select2.defaults.set( "containerCssClass", "form-control" );


});