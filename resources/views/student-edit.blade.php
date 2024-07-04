@include('home-header')
@section('title', 'Student')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">

<div class="container">
    <div class="row">
        <div class="col-md">
            <h1 style="text-align: center; margin-top: 20px;">Edit Siswa</h1>
            <form>
                <div class="col-md">
                    <h5>Nama Siswa</h5>
                </div>
                <div class="col-md">
                    <input type="text" class="form-control uppercase" placeholder="Masukan Nama Siswa" name="name"
                        value="{{strtoupper($student->name)}}" />
                </div>

                <div class="col-md" style="margin-top: 20px;">
                    <h5>Jenis Kelamin</h5>
                </div>
                <div class="col-md">
                    <select class="form-control select2-default" placeholder="Masukan Nama Siswa" name="gender"
                        style="width: 100%;">
                        <option value="0" {{$student->gender == '0' ? 'selected' : ''}}>Laki-laki</option>
                        <option value="1" {{$student->gender == '1' ? 'selected' : ''}}>Perempuan</option>
                    </select>
                </div>

                <div class="col-md" style="margin-top: 20px;">
                    <h5>Nomor Induk SIswa (NIS)</h5>
                </div>
                <div class="col-md">
                    <input type="text" class="form-control numeric-only" placeholder="Masukan Nomor Induk SIswa (NIS)"
                        name="nis" value="{{$student->nis}}" />
                </div>

                <div class="col-md" style="margin-top: 20px;">
                    <h5>Kelas</h5>
                </div>
                <div class="col-md">
                    <select class="form-control select2-default" placeholder="Masukan Kelas" name="class">
                        @foreach ($class_list as $class)
                            <option value="{{$class->id}}" {{$class->id == $student->class_id ? 'selected' : ''}}>
                                {{$class->name}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md" style="margin-top: 20px;">
                    <h5>Ekskul</h5>
                </div>
                <div class="col-md">
                    <select multiple class="form-control select2-multiple" name="class" style="width: 100%;"
                        data-placeholder="Masukan Ekskul">
                        @foreach ($ekskul_list as $ekskul)
                            <option value="{{$ekskul->id}}">{{$ekskul->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md" style="margin-top: 50px; text-align: center;">
                    <button type="button" class="btn btn-warning btn-lg" style="margin-right: 50px;"
                        id="btnCancleEditStudent">
                        <i class="bi bi-chevron-double-left"></i> Kembali
                    </button>
                    <button type="button" class="btn btn-success btn-lg" id="btnAddEditStudent" name="id"
                        value="{{$student->id}}">
                        Simpan <i class="bi bi-floppy"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('home-footer')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/student.js') }}"></script>