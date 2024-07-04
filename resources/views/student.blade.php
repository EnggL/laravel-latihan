@include('home-header')
@section('title', 'Student')

<div class="container">
    <div class="row">
        <div class="col-md">
            <h2 style="text-align: center; margin-top: 20px;">Daftar Siswa</h2>
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
                            <td>{{$loop->iteration}}</td>
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
        </div>
    </div>
</div>

@include('home-footer')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="{{ URL::asset('js/student.js') }}"></script>
