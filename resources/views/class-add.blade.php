@include('home-header')
@section('title', 'Student')

<div class="container">
    <form action="save" id="formAddClass" method="post">
        @csrf
        <div class="row">
            <div class="col-md-12" style="text-align: center;">
                <br>
                <h1>Tambah Data Kelas</h1>
            </div>
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <b>Error!</b>
                        <br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-md-12">
                <p><b>Nama Kelas :</b></p>
                <input type="text" class="form-control" placeholder="Masukan Nama Kelas" name="class" id="class">
            </div>
            <div class="col-md-12" style="margin-top: 20px;">
                <p><b>Wali Kelas</b></p>
                <select name="wali" id="wali" class="select2-default" style="width: 100%;">
                    @foreach ($teacher as $row)
                        <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12" style="margin-top: 40px; text-align: center;">
                <button class="btn btn-warning btn-lg" id="btnAddCancel" type="button">
                    <i class="bi bi-chevron-double-left"></i> Kembali
                </button>
                <button class="btn btn-success btn-lg" id="btnAddSave" type="button">
                    Simpan <i class="bi bi-floppy"></i>
                </button>
            </div>
        </div>
    </form>
</div>

@include('home-footer')