@include('home-header')
@section('title', 'Student')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">

<div class="container">
    <div class="row">
        <div class="col-md">
            <h1 style="text-align: center; margin-top: 20px;">Edit Siswa</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $row)
                            <li>{{$row}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{url('/students/update/'.$student->id)}}" id="formEditStudent">
                @csrf
                <div class="col-md">
                    <h5>Nama Siswa</h5>
                </div>
                <div class="col-md">
                    <input type="text" class="form-control uppercase" placeholder="Masukan Nama Siswa" name="name"
                        value="{{strtoupper($student->name)}}" id="name" />
                </div>

                <div class="col-md" style="margin-top: 20px;">
                    <h5>Jenis Kelamin</h5>
                </div>
                <div class="col-md">
                    <select class="form-control select2-default" placeholder="Masukan Nama Siswa" name="gender"
                        style="width: 100%;" id="gender">
                        <option value="0" {{$student->gender == '0' ? 'selected' : ''}}>Laki-laki</option>
                        <option value="1" {{$student->gender == '1' ? 'selected' : ''}}>Perempuan</option>
                    </select>
                </div>

                <div class="col-md" style="margin-top: 20px;">
                    <h5>Nomor Induk SIswa (NIS)</h5>
                </div>
                <div class="col-md">
                    <input type="text" class="form-control numeric-only" placeholder="Masukan Nomor Induk SIswa (NIS)"
                        name="nis" value="{{$student->nis}}" id="nis" />
                </div>

                <div class="col-md" style="margin-top: 20px;">
                    <h5>Kelas</h5>
                </div>
                <div class="col-md">
                    <select class="form-control select2-default" placeholder="Masukan Kelas" name="class" id="class">
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
                    <select multiple class="form-control select2-multiple" name="ekskul" style="width: 100%;"
                        data-placeholder="Masukan Ekskul" id="ekskul">
                        @foreach ($ekskul_list as $ekskul)
                            <option value="{{$ekskul->id}}" {{in_array($ekskul->id, $student_ekskul) ? 'selected' : ''}}>
                                {{$ekskul->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>

            <div class="col-md" style="margin-top: 50px; text-align: center;">
                <button type="button" class="btn btn-warning btn-lg" style="margin-right: 50px;"
                    id="btnCancleEditStudent">
                    <i class="bi bi-chevron-double-left"></i> Kembali
                </button>
                <button type="button" class="btn btn-success btn-lg" id="btnCheckEditStudent" value="{{$student->id}}" disabled>
                    Simpan <i class="bi bi-floppy"></i>
                </button>
            </div>
        </div>
    </div>
</div>

@include('home-footer')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/student/student-edit.js') }}"></script>