$(document).ready(function () {
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
                window.location.replace(base_url+"/students");
            }
        });
    });

    $("#btnCheckEditStudent").click(function name() {
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

    $("input#name, select#gender, input#nis, select#class, select#ekskul").change(function () {
        $("#btnCheckEditStudent").attr('disabled', false);
    });
});

function ajaxCheckData(data) {
    swalLoading(); //fromn global.js
    c
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
            swalLoading();
            $("#formEditStudent").submit();
        }
    });
}