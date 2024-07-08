@include('home-header')
@section('title', 'Student')

<div class="container">
    <div class="row">
        <div class="col-md">
            <h2 style="text-align: center; margin-top: 20px;">Daftar Siswa</h2>

            <form action="" method="get" id="formOptionSiswa">
                <div class="row">
                    <div class="col-md-5 input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nama / Nis / Kelas / Wali / Ekskul" aria-label="Masukan Pencarian" aria-describedby="button-addon2" name="keyword" value="{{$keyword}}">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" style="width: 100px;" type="submit" id="button-addon2">Cari</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 input-group mb-3">
                        <select name="column" id="" class="form-control custom-select">
                            <option value="nama" {{$column == 'name' ? 'selected':''}}>Nama</option>
                            <option value="gender" {{$column == 'gender' ? 'selected':''}}>Gender</option>
                            <option value="nis" {{$column == 'nis' ? 'selected':''}}>Nis</option>
                            <option value="kelas" {{$column == 'class' ? 'selected':''}}>Kelas</option>
                            <option value="ekskul" {{$column == 'ekskul' ? 'selected':''}}>Ekskul</option>
                        </select>
                        <select name="order" id="" class="form-control custom-select">
                            <option value="asc" {{$order == 'asc' ? 'selected':''}}>Kecil - besar</option>
                            <option value="desc" {{$order == 'desc' ? 'selected':''}}>Besar - kecil</option>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" style="width: 100px;" type="submit" id="button-addon2">Urutkan</button>
                        </div>
                    </div>
                    <div class="col-md-7 mb-3" style="text-align: right">
                        <a class="btn btn-success" href="{{url('students/add')}}">
                            <i class="bi bi-plus"></i> Tambah Siswa
                        </a>
                    </div>
                </div>
            </form>

            @if (Session::has('status'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('message')}}
                </div>
            @endif
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Gender</th>
                        <th>NIS</th>
                        <th>Kelas - Wali</th>
                        <th>Ekskul</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($studentList as $row)
                        <tr>
                            <!-- https://stackoverflow.com/a/70305564 -->
                            <td>{{$studentList->firstItem() + $loop->index}}</td>
                            <td>{{$row->name}}</td>
                            <td>
                                <?php
                                    switch ($row->gender) {
                                        case '0':
                                            echo 'Laki-laki';
                                            break;
                                        
                                        case '1':
                                            echo 'Perempuan';
                                            break;

                                        default:
                                            echo'';
                                            break;
                                    }
                                ?>
                            </td>
                            <td>{{$row->nis}}</td>
                            <td>{{$row->kelas['name']}} - {{$row->kelas->wali->name}}</td>
                            <td>
                                @foreach ($row->ekskuls as $eks)
                                    - {{$eks->name}} <br>
                                @endforeach
                            </td>
                            <td style="text-align: center;">
                                <button value="{{$row->id}}" class="btn btn-primary edit-student" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button value="{{$row->id}}" siswa="{{$row->name}}" class="btn btn-danger delete-student" data-toggle="tooltip" data-placement="top" title="Hapus">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{$studentList->withQueryString()->links()}}
        </div>
    </div>
</div>

@include('home-footer')
