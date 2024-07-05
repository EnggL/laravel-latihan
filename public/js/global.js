$(document).on("input", ".numeric-only", function () {
    this.value = this.value.replace(/\D/g, '');
});

$(document).on('input', 'input.uppercase', function () {
    this.value = this.value.toUpperCase()
});

$(function () {
    $('.select2-default').select2({
        theme: 'bootstrap4'
    });

    $('.select2-multiple').select2({
        allowClear: true
    });

});

function showAlert(html, icon = 'error') {
    Swal.fire({
        html: html,
        icon: icon
    });
}

function showErrorAlert(html) {
    Swal.fire({
        title: "Terjadi Kesalahan!",
        html: html,
        icon: "error"
    });
}

//Menampilkan loading untuk memblokir interface
//jangan lupa close swall atau reload halaman
function swalLoading(text = "Sedang Memuat...") {
    Swal.fire({
        title: text,
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
    });
}