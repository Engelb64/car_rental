<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Matricula</th>
            <th>Color</th>
            <th>Año</th>
            <th>Descripción</th>
            <th>Precio por Dia</th>
            <th>URL de la imagen</th>
            <th>Model_id</th>
            <th>Estatus</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cars as $car)
            <tr>
                <th>{{$car->id}}</th>
                <th>{{$car->registration}}</th>
                <th>{{$car->color}}</th>
                <th>{{$car->year}}</th>
                <th>{{$car->description}}</th>
                <th>{{$car->price}}</th>
                <th>{{$car->url_picture}}</th>
                <th>{{$car->brandname}}</th>
                <th>{{$car->modelname}}</th>
                <th>{{$car->status}}
            </th>
            </tr>
        @endforeach
    </tbody>
</table>
