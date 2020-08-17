<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha de Renta</th>
            <th>Fecha de Entrega</th>
            <th>Metodo de Pago</th>
            <th>Id del Vehículo</th>
            <th>Matricula del Vehículo</th>
            <th>Id del Usuario</th>
            <th>Nombre del Usuario</th>
            <th>Email del Usuario</th>
            <th>Numero de Documento del Usuario</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rentaldates as $rentaldate)
            <tr>
                <th>{{$rentaldate->id}}</th>
                <th>{{$rentaldate->departure_date}}</th>
                <th>{{$rentaldate->admission_date}}</th>
                <th>{{$rentaldate->payment}}</th>
                <th>{{$rentaldate->car_id}}</th>
                <th>{{$rentaldate->car->registration}}</th>
                <th>{{$rentaldate->user_id}}</th>
                <th>{{$rentaldate->user->name}}</th>
                <th>{{$rentaldate->user->email}}</th>
                <th>{{$rentaldate->user->doc_number}}</th>
            </tr>
        @endforeach
    </tbody>
</table>
