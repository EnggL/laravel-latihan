$(document).ready(function () {
    $("#btnEditCancel").click(function (e) { 
        e.preventDefault();
        
        Swal.fire({
            title: "Batal Mengedit data Kelas?",
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

    $("#btnEditSave").click(function (e) { 
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

$(document).on('change', '#class, #wali', function (e) {
    $("#btnEditSave").attr('disabled', false);
 }) 