@include('home-header')
@section('title', 'Student')

<div class="container">
    <div class="row">
        <div class="col-md">
            <h2 style="text-align: center; margin-top: 20px;">Daftar Guru</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Guru</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $row)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$row->name}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@include('home-footer')