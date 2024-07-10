@include('home-header')
@section('title', 'Student')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 style="text-align: center; margin-top: 20px;">Daftar Kelas</h2>
        </div>
        <div class="col-md-12 mb-5" style="text-align: right;">
            <a href="/class/add" class="btn btn-success btn-lg">
                <i class="bi bi-plus"></i> Tambah Kelas
            </a>
        </div>
        <div class="col-md-12">
            @if (Session::has('status'))
                <div class="alert {{Session::get('type')}}" role="alert">
                    {{Session::get('message')}}
                </div>
            @endif
            
            <table class="table table-bordered" id="table-class">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kelas</th>
                        <th>Daftar Siswa</th>
                        <th>Wali Kelas</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kelas as $row)
                        <tr>
                            <td style="text-align: center;">{{$loop->iteration}}</td>
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
                            <td style="text-align: center;">
                                <a class="btn btn-primary class-edit" href="/class/edit/{{$row->id}}" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button class="btn btn-danger class-delete" kelas="{{$row->name}}" id="{{$row->id}}" data-toggle="tooltip" data-placement="top" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-12" style="height: 50px;"></div>
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