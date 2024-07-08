<table class="table table-bordered" id="table-siswa" style="width: 100%">
    <thead>
        <tr>
            <th style="text-align: center;">No</th>
            <th style="text-align: center;">Nama</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $row)
            <tr>
                <td style="text-align: left;">{{$loop->iteration}}</td>
                <td>{{$row->name}}</td>
            </tr>
        @endforeach
    </tbody>
</table>