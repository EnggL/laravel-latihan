<h1>Pastikan data siswa sudah benar!</h1>
<div style="text-align: left;">
    <b>Nama :</b>
    <p>{{$name}}</p>
    <b>Jenis Kelamin :</b>
    <p>{{$gender}}</p>
    <b>Nis :</b>
    <p>{{$nis}}</p>
    <b>Kelas :</b>
    <p>{{$class}}</p>
    <b>Ekskul :</b>
    @foreach ($ekskul as $row)
        <p style="margin-bottom: 0px;">- {{$row->name}}</p>
    @endforeach
</div>