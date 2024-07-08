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