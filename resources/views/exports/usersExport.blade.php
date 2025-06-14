<table>
    <thead>
    <tr>
        <th>Rut</th>
        <th>Nombres</th>
        <th>Paterno</th>
        <th>Materno</th>
        <th>Fecha Nacimiento</th>
        <th>Sede</th>
        <th>Email</th>
        <th>Teléfono</th>
        <th>Num. Cuenta Bancaria</th>
        <th>Banco</th>
        <th>Tipo de Cuenta</th>
        <th>Calidad</th>
        <th>Repartición</th>
        <th>Cargo</th>
        <th>Fecha creación</th>
        <th>Fecha eliminación</th>
    </tr>
    </thead>

    <tbody>

    @foreach($users as $user)

        <tr>
            <td> {{ rutFormat($user->rut) }}   </td>
            <td> {{ ($user->nombre) }}         </td>
            <td> {{ ($user->paterno) }}        </td>
            <td> {{ ($user->materno) }}        </td>
            <td> {{ $user->fecha_nacimiento }} </td>
            <td> {{ $user->sede->name }}       </td>
            <td> {{ $user->email }}            </td>
            <td> {{ $user->telefono }}         </td>
            <td> {{ $user->num_cuenta }}       </td>
            <td> {{ $user->banco->name }}      </td>
            <td> {{ $user->cuenta->name }}     </td>
            <td> {{ $user->calidad }}          </td>
            <td> {{ $user->reparticion->name }}</td>
            <td> {{ $user->cargo->name }}      </td>
            <td> {{ $user->created_at }}       </td>
            <td> {{ $user->deleted_at }}  </td>
        </tr>

    @endforeach

    </tbody>

</table>
