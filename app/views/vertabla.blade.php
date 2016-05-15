
<table class="table responsive-table hoverable centered">
    <thead>
        <tr>
            @foreach ($tabla[0] as $key => $value)
            <th class="text" style="text-transform: uppercase" data-field="{{$key}}">{{$key}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($tabla as $fila)                
            <tr style="text-transform: capitalize">
                @foreach ($fila as $dato)
                <td>{{$dato}} </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
