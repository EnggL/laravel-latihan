$(document).ready(function () {
    // Area yang perlu di perhatikan
    // *************************************************************
    // ini miliknya data tables, fungsi posisikanUlang() hanya berlaku  jika tabel rownya visible
    $(document).on('click', '.dt-paging-button', function () {
        setTimeout(aturTable(), 10); //10 ms
    });

    function aturTable() {
        posisikanUlang();

        var info = table.page.info();
        reNumbering((info.page + 1) * 10 - 9); //misalnya page 2 berarti awalannya 11
    }

    // **************************************************************
    // End Area yang perlu di perhatikan
    const table = $('#tableTeacher').DataTable({
        order: [[1, 'asc']]
    });

    $('#btnAdd').click(function (e) {
        Swal.fire({
            title: "Masukan Nama Guru!",
            icon: 'question',
            showConfirmButton: true,
            confirmButtonColor: 'green',
            cancelButtonColor: 'red',
            showCancelButton: true,
            confirmButtonText: "Simpan",
            cancelButtonText: "Batalkan",
            input: "text",
            inputLabel: "Contoh : Enggal Aldiansyah",
            preConfirm: (value) => {
                if (!value) {
                    Swal.showValidationMessage('<i class="fa fa-info-circle"></i> Nama tidak boleh kosong!')
                }
                var regex = /^[a-zA-Z\s]+$/;
                if (!regex.test(value)) {
                    Swal.showValidationMessage('<i class="fa fa-info-circle"></i> Nama hanya boleh huruf dan spasi!')
                }
            }
        }).then((result) => {
            if (result.isConfirmed && result.value) {
                SweetAlert.loading()
                ajaxSaveTeacher(result.value);
            }
        });
    });

    function ajaxSaveTeacher(name) {
        $.ajax({
            url: url + '/save',
            type: 'post',
            data: {
                "_token": csrf,
                name: name
            },
            success: function (result) {
                alertToast(name);
                addRow(name, result);
            },
            error: function (request, error) {
                var pesan = '';
                $.each(request.responseJSON.errors, function (i, error) {
                    pesan += "<p>" + error[0] + "</p>";
                });
                SweetAlert.error(pesan); //from global.js
            }
        });
    }

    function alertToast(name) {
        Toast.fire({
            icon: "success",
            title: "Berhasil Menambahkan Guru " + name,
            position: 'center',
            background: 'green',
            color: 'white'
        });
    }

    function addRow(name, id) {
        var rowCount = table.rows().count();

        table.row.add([
            rowCount + 1,
            name,
            getActionButton(name, id)
        ])
            .draw(false);

        //posisikan ulang
        posisikanUlang();
        var index = getFirstIndex();
        reNumbering(index);

    }

    function posisikanUlang() {
        $("#tableTeacher").find('tbody').find('tr').each(function (e) {
            $(this).find('td').first().css('text-align', 'center');
            $(this).find('td').last().css('text-align', 'center');
        });
    }

    function reNumbering(index = 1) {
        $("#tableTeacher").find('tbody').find('tr').each(function (e) {
            $(this).find('td').first().text(index);
            index++;
        });
    }

    function getActionButton(name, id) {
        var actionButton =
            `<button class="btn btn-primary btnEdit" data-id="${id}" value="${name}">
            <i class="bi bi-pencil"></i>
        </button>
        <button class="btn btn-danger btnDelete" data-id="${id}" value="${name}">
            <i class="bi bi-trash"></i>
        </button>`;

        return actionButton;
    }

    // console.log(getActionButton('aw',987));

    $(document).on('click', '.btnDelete', function (e) {
        const name = $(this).val();
        const id = $(this).attr('data-id');
        const row = $(this).parents('tr');
        Swal.fire({
            title: "Hapus Guru " + name + "?",
            text: "Anda yakin ingin menghapus data Guru ini?",
            icon: 'warning',
            showConfirmButton: true,
            confirmButtonColor: 'green',
            cancelButtonColor: 'red',
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus",
            cancelButtonText: "Batalkan",
        }).then((result) => {
            if (result.isConfirmed) {
                SweetAlert.loading();
                ajaxDeleteTeacher(id, name, row);
            }
        });
    });

    function getFirstIndex() {
        return $("#tableTeacher").find('tbody').find('tr').find('td').first().text();
    }

    function ajaxDeleteTeacher(id, name, row) {
        $.ajax({
            url: url + '/delete',
            type: 'post',
            data: {
                "_token": csrf,
                id: id
            },
            success: function (result) {
                alertToastDelete(name);

                // dapetin angka pertama di setiap halaman table
                var index = getFirstIndex();

                //hapus langsung ajah, tidak perlu nunggu ajax
                table.row(row).remove().draw(false);

                reNumbering(index);
            },
            error: function (request, error) {
                var pesan = '';
                $.each(request.responseJSON.errors, function (i, error) {
                    pesan += "<p>" + error[0] + "</p>";
                });
                SweetAlert.error(pesan); //from global.js
            }
        });
    }

    function alertToastDelete(name) {
        Toast.fire({
            icon: "success",
            title: "Berhasil Menghapus Guru " + name,
            position: 'center',
            background: 'green',
            color: 'white'
        });
    }

    $(document).on('click', '.btnEdit', function () {
        const name = $(this).val();
        const id = $(this).attr('data-id');
        const elemen = $(this).parents('tr').find('td').eq(1);
        Swal.fire({
            title: "Edit Nama Guru!",
            icon: 'question',
            showConfirmButton: true,
            confirmButtonColor: 'green',
            cancelButtonColor: 'red',
            showCancelButton: true,
            confirmButtonText: "Simpan",
            cancelButtonText: "Batalkan",
            input: "text",
            inputValue: name,
            inputLabel: "Contoh : Enggal Aldiansyah",
            preConfirm: (value) => {
                if (!value) {
                    Swal.showValidationMessage('<i class="fa fa-info-circle"></i> Nama tidak boleh kosong!')
                }
                var regex = /^[a-zA-Z\s]+$/;
                if (!regex.test(value)) {
                    Swal.showValidationMessage('<i class="fa fa-info-circle"></i> Nama hanya boleh huruf dan spasi!')
                }
            }
        }).then((result) => {
            if (result.isConfirmed && result.value) {
                SweetAlert.loading()
                ajaxUpdateTeacher(result.value, id, elemen);
            }
        });
    });

    function ajaxUpdateTeacher(name, id, elemen) {
        $.ajax({
            url: url + '/update/' + id,
            type: 'post',
            data: {
                "_token": csrf,
                name: name
            },
            success: function (result) {
                alertToastEdit(name);
                elemen.text(name);
            },
            error: function (request, error) {
                var pesan = '';
                $.each(request.responseJSON.errors, function (i, error) {
                    pesan += "<p>" + error[0] + "</p>";
                });
                SweetAlert.error(pesan); //from global.js
            }
        });
    }

    function alertToastEdit(name) {
        Toast.fire({
            icon: "success",
            title: "Berhasil Mengedit Guru " + name,
            position: 'center',
            background: 'green',
            color: 'white'
        });
    }
    // var rowCount = table.rows().count();
    // alert(rowCount);
});