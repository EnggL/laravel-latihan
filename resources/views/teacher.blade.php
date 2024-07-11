@include('home-header')
@section('title', 'Student')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 style="text-align: center; margin-top: 20px;">Daftar Guru</h2>
        </div>
        <div class="col-md-12" style="text-align: right;">
            <button class="btn btn-success btn-lg" id="btnAdd">
                <i class="bi bi-plus"></i>Tambah
            </button>
        </div>
        <div class="col-md-12" style="margin-top: 20px;">
            <table class="table table-bordered table-hover" id="tableTeacher">
                <thead>
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th>Nama Guru</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $row)
                        <tr>
                            <td style="text-align: center;">{{$loop->iteration}}</td>
                            <td>{{$row->name}}</td>
                            <td style="text-align: center;">
                                <button class="btn btn-primary btnEdit" data-id="{{$row->id}}" value="{{$row->name}}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-danger btnDelete" data-id="{{$row->id}}" value="{{$row->name}}">
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


@include('home-footer')