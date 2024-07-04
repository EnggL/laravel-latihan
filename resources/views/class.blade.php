@include('home-header')
@section('title', 'Student')

<div class="container">
    <div class="row">
        <div class="col-md">
            <h2 style="text-align: center; margin-top: 20px;">Daftar Kelas</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kelas</th>
                        <th>Daftar Siswa</th>
                        <th>Wali Kelas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kelas as $row)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$row->name}}</td>
                            <td>
                                @foreach ($row->siswa as $siswa)
                                    {{$siswa['name']}} <br>
                                @endforeach
                            </td>
                            <td>{{$row->wali['name']}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@include('home-footer')