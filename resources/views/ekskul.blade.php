@include('home-header')
@section('title', 'Student')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 style="text-align: center; margin-top: 20px;">Daftar Ekskul</h2>
        </div>

        <div class="col-md-12" style="text-align: right; margin-bottom: 20px;">
            <button class="btn btn-success btn-lg" id="btnAddEkskul" data-toggle="modal" data-target="#modalAddEkskul" data-backdrop="static" data-keyboard="false">
                <i class="bi bi-plus"></i> Tambah Ekskul
            </button>
        </div>
        <div class="col-md-12">
            @if (Session::has('status'))
                <div class="alert {{Session::get('type')}}" role="alert">
                    {{Session::get('message')}}
                </div>
            @endif
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $row)
                        <li>{{$row}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <table class="table table-bordered table-hover" id="tableEkskul">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Ekskul</th>
                        <th>Anggota</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ekskul as $row)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$row->name}}</td>
                            <td>
                                @foreach ($row->students as $stud)
                                    - {{$stud->name}} <br>
                                @endforeach
                            </td>
                            <td style="text-align: center;">
                                <button class="btn btn-primary btnEkskulEdit" id="{{$row->id}}" value="{{$row->name}}" data-toggle="tooltip" data-placement="top" title="Edit" data-target="#modalEditEkskul" style="margin-right: 10px;" data-backdrop="static" data-keyboard="false">
                                    <i class="bi bi-pencil"></i>
                                </>
                                <button class="btn btn-danger btnEkskulDelete" value="{{$row->name}}" id="{{$row->id}}"
                                    data-toggle="tooltip" data-placement="top" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalAddEkskul" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Ekstrakurikuler</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{Request::url().'/save'}}" method="post" id="formSaveEkskul">
                    @csrf
                    <br>
                    <p><b>Nama Ekstrakurikuler :</b></p>
                    <input type="text" class="form-control" placeholder="Masukan Nama Ekstrakurikuler" id="inputAddEkskul" name="name">
                    <b id="alertAddEkskul" hidden style="color: red;">Test</b>
                    <br>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success btn-lg" id="btnSaveEkskul">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditEkskul" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Ekstrakurikuler</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{Request::url().'/update'}}" method="post" id="formUpdateEkskul">
                    @csrf
                    <br>
                    <p><b>Nama Ekstrakurikuler :</b></p>
                    <input type="text" class="form-control" placeholder="Masukan Nama Ekstrakurikuler" id="inputEditEkskul" name="name">
                    <b id="alertAddEkskul" hidden style="color: red;">Test</b>
                    <br>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success btn-lg" id="btnUpdateEkskul">Update</button>
            </div>
        </div>
    </div>
</div>

@include('home-footer')