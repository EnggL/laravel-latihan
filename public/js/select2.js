$(function () {
    $('.select2-default').select2({
        theme: 'bootstrap4'
    });

    $('.select2-multiple').select2({
        allowClear: true,
        theme: 'classic',
        dropdownAutoWidth: true,
        multiple: true,
        width: '100%',
    });
    $('.select2-multiple').select2('open');
    $('.select2-multiple').select2('close');
});