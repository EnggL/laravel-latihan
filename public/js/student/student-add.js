$(document).ready(function () {
    $('#btnCancleAddStudent').click(function (e) { 
        e.preventDefault();
        Swal.fire({
            title: "Batal menambahkan data siswa?",
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

    $('#btnAddEditStudent').click(function (e) { 
        e.preventDefault();
        const data = {
            id: $(this).val(),
            name: $("#name").val(),
            gender: $("#gender").val(),
            nis: $("#nis").val(),
            class: $("#class").val(),
            ekskul: $("#ekskul").val()
        };
        // ajaxCheck
        ajaxCheckData(data);
    });
});

function ajaxCheckData(data) {
    swalLoading(); //fromn global.js
    $.ajax({
        url: base_url + '/students/add_check/',
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
            confirmAddSiswa(result, data);
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

function confirmAddSiswa(result, data) {
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
            swalLoading(); //fromn global.js
            $("#formAddStudent").submit();
        }
    });
}