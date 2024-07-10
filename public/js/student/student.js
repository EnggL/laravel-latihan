$(function () {
    $('[data-toggle="tooltip"]').tooltip();

    //alert hapus student
    $(".delete-student").click(function () {
        const id = $(this).val();
        const siswa = $(this).attr('siswa');

        Swal.fire({
            title: 'Hapus Siswa Ini?',
            text: 'Do you want to continue',
            icon: 'warning',
            confirmButtonColor: 'red',
            cancelButtonColor: 'green',
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!"
        }).then((result) => {
            if (result.isConfirmed) {
                SweetAlert.loading("Menghapus Data...");
                ajaxDeleteSiswa(id, siswa);
            }
        });
    });


    $(".edit-student").click(function name() {
        const id = $(this).val();
        window.location.href = base_url + "/students/edit/" + id;
    });
});

function berhasilHapusSiswa(nama) {
    Swal.fire({
        title: "Deleted!",
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: true,
        text: "Siswa " + nama + " berhasil di hapus!",
        icon: "success"
    }).then((result) => {
        if (result.isConfirmed) {
            SweetAlert.loading();
            location.reload();
        }
    });
}

function ajaxDeleteSiswa(id, nama) {
    $.ajax({
        url: base_url + '/students/delete/' + id,
        type: 'DELETE',
        data: {
            'id': id,
            "_token": csrf,
        },
        dataType: 'json',
        success: function (data) {
            berhasilHapusSiswa(nama);
            // alert(data);
        },
        error: function (request, error) {
            alert("Request: " + JSON.stringify(request));
        }
    });
}

$(document).on('submit', '#formOptionSiswa', function () {
    swalLoading(); //dari global.js
});