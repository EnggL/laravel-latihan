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
                swalLoading("Menghapus Data...");
                ajaxDeleteSiswa(id, siswa);
            }
        });
    });


    $(".edit-student").click(function name() {
        const id = $(this).val();
        window.location.href = base_url + "/students/edit/" + id;
    });

    $("#btnCancleEditStudent").click(function name() {
        Swal.fire({
            title: "Batal Menambahkan Siswa?",
            text: "Anda yakin ingin keluar dari halaman ini?",
            icon: "warning",
            showConfirmButton: true,
            confirmButtonColor: 'red',
            cancelButtonColor: 'green',
            showCancelButton: true,
            confirmButtonText: "Ya, kembali",
            cancelButtonText: "Tetap di sini"
        }).then((result) => {
            if (result.isConfirmed) {
                window.history.back();
            }
        });
    });

    $("#btnAddEditStudent").click(function name() {
        const data = {
            id: $(this).val(),
            name: $("#name").val(),
            gender: $("#gender").val(),
            nis: $("#nis").val(),
            class: $("#class").val(),
            ekskul: $("#ekskul").val()
        };
        ajaxCheckData(data);
    });

    $(document).on('input', 'input.uppercase', function () {
        this.value = this.value.toUpperCase()
    });
});

function ajaxCheckData(data) {
    swalLoading();
    $.ajax({
        url: base_url + '/students/edit_check/' + data.id,
        type: 'POST',
        data: {
            "_token": csrf,
            id: data.id,
            name: data.name,
            gender: data.gender,
            nis: data.nis,
            class: data.class,
            ekskul: data.ekskul
        },
        dataType: 'json',
        success: function (result) {
            // location.replace(base_url + '/students');
            confirmEditSiswa(result, data);
        },
        error: function (request, error) {
            var pesan = '';
            $.each(request.responseJSON.errors, function (i, error) {
                pesan += "<p>" + error[0] + "</p>";
            });
            showErrorAlert(pesan); //from global.js
        }
    });
}

function confirmEditSiswa(result, data) {
    Swal.fire({
        html: result.html,
        icon: "warning",
        showConfirmButton: true,
        confirmButtonColor: 'green',
        cancelButtonColor: 'red',
        showCancelButton: true,
        confirmButtonText: "Ya, simpan",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            ajaxSaveEdit(data)
        }
    });
}

function ajaxSaveEdit(data) {
    
}

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
            swalLoading();
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