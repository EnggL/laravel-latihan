$(document).ready(function () {
    $("#tableEkskul").dataTable();
    
    $("#btnAddEkskul").click(function (e) { 
        e.preventDefault();        
    });
    
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click', '#btnSaveEkskul', function (e) {
    const ekskul = $('#inputAddEkskul').val();

    if(ekskul.length < 1)
    {
        $("#alertAddEkskul").text('Nama Ekstrakurikuler tidak boleh kosong!');
        $('#alertAddEkskul').attr('hidden', false);

        return;
    }

    $("#formSaveEkskul").submit();
    $(this).attr('disabled', true);
});

$(document).on('click', '.btnEkskulDelete', function (e) {
    e.preventDefault();
    const name = $(this).val();
    const id = $(this).attr('id');

    Swal.fire({
        title: "Hapus Ekskul "+name+"?",
        text: "Anda yakin ingin menghapus kelas ini!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "red",
        cancelButtonColor: "green",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batalkan"
      }).then((result) => {
        if (result.isConfirmed) {
            SweetAlert.loading();
            ajaxDeleteEkskul(id, name);
        }
      });
});

function ajaxDeleteEkskul(id, name) {
    $.ajax({
        url: url + '/delete',
        type: 'post',
        data: {
            id: id,
            "_token": csrf
        },
        success: function (result) {
            alertSuccessDeleteEkskul(name);
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

function alertSuccessDeleteEkskul(name) {
    Swal.fire({
        title: "Berhasil Menghapus Ekstrakurikuler "+name,
        icon: "success"
      }).then((result) => {
        if (result.isConfirmed) {
            SweetAlert.loading();
            location.reload();
        }
      });
}

$(document).on('click', '.btnEkskulEdit', function(e){
    e.preventDefault();

    const id = $(this).attr('id');
    const name = $(this).val();
    const modal = $('#modalEditEkskul');

    modal.find('.modal-title').text('Edit Ekstrakurikuler '+name);
    modal.find('#inputEditEkskul').val(name);
    modal.find('#formUpdateEkskul').attr('action', url + '/update/'+id);

    $('#btnUpdateEkskul').attr('disabled', true);

    modal.modal('show');
});

$(document).on('click', '#btnUpdateEkskul', function (e) {
    const ekskul = $('#inputEditEkskul').val();

    if(ekskul.length < 1)
    {
        $("#alertAddEkskul").text('Nama Ekstrakurikuler tidak boleh kosong!');
        $('#alertAddEkskul').attr('hidden', false);

        return;
    }

    $('#formUpdateEkskul').submit();
    $(this).attr('disabled', true);
});



$(document).ready(function () {
    $(document).on('change', '#inputEditEkskul', function (e) {
        $('#btnUpdateEkskul').attr('disabled', false);
    });

    $(window).keydown(function(event){
        if(event.keyCode == 13) {
          event.preventDefault();
          return false;
        }
    });
});