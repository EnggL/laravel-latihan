$(document).ready(function () {
   $('[data-toggle="tooltip"]').tooltip();

   $('#table-class').dataTable();

   $("#btnAddCancel").click(function (e) { 
      e.preventDefault();
      
      Swal.fire({
         title: "Batal Menambah data Kelas?",
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
             window.location.replace(base_url+"/class");
         }
     });
   });

   $("#btnAddSave").click(function (e) { 
      e.preventDefault();
      var kelas = $('#class').val();
      var guru = $('#wali').select2('data')[0].text;

      if (kelas.length  < 1) {
         return SweetAlert.alert("Kelas tidak boleh kosong!");
      }

      const html = 
      "<b>Kelas : "+kelas+"</b><br><b>Wali Kelas : "+guru+"</b>";
      
      Swal.fire({
         title: "Pastikan Data Sudah Benar",
         html: html,
         icon: "warning",
         showConfirmButton: true,
         confirmButtonColor: 'green',
         cancelButtonColor: 'red',
         showCancelButton: true,
         confirmButtonText: "Ya, Simpan",
         cancelButtonText: "Batal"
     }).then((result) => {
         if (result.isConfirmed) {
            $("#formAddClass").submit();
         }
     });
   });
});

$(document).on('click', 'a.showAllStudentClass', function name(e) {
   e.preventDefault();
   const id = $(this).attr('id');
   // SweetAlert.setTitle(id).alert();
   const kelas = $(this).attr('siswa');
   $('#daftar-siswa-title').text("Daftar Siswa Kelas "+kelas);
   SweetAlert.loading();
   ajaxGetDaftarSiswa(id);
});

function ajaxGetDaftarSiswa(id)
{
   $.ajax({
      url: base_url + '/class/show_students/' + id,
      type: 'get',
      data: {
          "_token": csrf
      },
      success: function (result) {
         Swal.close();
         $('#daftar-siswa').find('.modal-body').html(result);
         $("#table-siswa").dataTable({
            bAutoWidth: false, 
            aoColumns : [
               { sWidth: '10%' },
               { sWidth: '90%' }
            ]
         });
         $('#daftar-siswa').modal('show');
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

$(document).on('click', '.class-delete', function (e) {
   e.preventDefault();
   const nama_kelas = $(this).attr('kelas');
   const id = $(this).attr('id');

   Swal.fire({
      title: "Hapus Kelas "+nama_kelas+"?",
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
        window.location.href = base_url+"/class/delete/"+id;
      }
    });
});