<table class="table table-bordered">
    <thead>
        <tr>
            <th width="100px">ID</th>
            <th>Name</th>
            <th>Slug</th>
            <th>Description</th>
        </tr>
    </thead>

    <tbody>

    @foreach ($data as $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->name }}</td>
            <td>{{ $value->slug }}</td>
            <td>{{ $value->description }}</td>
        </tr>
    @endforeach

    </tbody>
</table>
{!! $data->render() !!}