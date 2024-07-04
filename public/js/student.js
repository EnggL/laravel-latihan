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

    $(".edit-student").click(function name() {
        const id = $(this).val();
        window.location.href = base_url + "/students/edit/" + id;
    });

    $('.select2-default').select2({
        theme: 'bootstrap4',
        placeholder: $(this).attr('placeholder'),
    });

    $('.select2-multiple').select2({
        allowClear: true
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
    });

    $(document).on('input', 'input.uppercase', function () {
        this.value = this.value.toUpperCase()
    });
});