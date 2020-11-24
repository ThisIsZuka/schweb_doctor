@section('search')
    <table class="table table-hover table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Firsts</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody>
            @for($i = 0 ; $i < 20 ; $i++)
            <tr>
                <th scope="row">1111</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            @endfor
        </tbody>
    </table>
@endsection
