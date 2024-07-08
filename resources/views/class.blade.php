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
                                    - {{$siswa['name']}} <br>
                                @endforeach
                                @if (count($row->siswa) > 4)
                                    - ........... <br>
                                    <a id="{{$row->id}}" siswa="{{$row->name}}" class="showAllStudentClass pointer">
                                        Tampilkan semua siswa kelas {{$row->name}}
                                    </a>
                                @endif
                            </td>
                            <td>{{$row->wali['name']}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="daftar-siswa" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="daftar-siswa-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@include('home-footer')