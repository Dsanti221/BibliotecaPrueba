<table>
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Titulo</th>
            <th>Autor</th>
        </tr>
    </thead>
    <tbody>
        @foreach($$libros as $$libro)
        <tr>
            <td>{{ $$libro->fecha }}</td>
            <td>{{ $$libro->Titulo }}</td>
            <td>{{ $$libro->Autor }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
