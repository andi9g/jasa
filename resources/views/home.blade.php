@extends('layouts.admin')

@section('content')


<table class="table table-sm">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Handle</th>
            <th scope="col">Tag</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            <td>
                <span class="badge badge-primary">Primary</span>
            </td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
            <td>
                <span class="badge badge-secondary">Secondary</span>
            </td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>Larry</td>
            <td>the Bird</td>
            <td>@twitter</td>
            <td>
                <span class="badge badge-success">Success</span>
            </td>
        </tr>
    </tbody>
</table>

<div class='form-group'>
    <label for='fornama' class='text-capitalize'>file</label>
    <input type='file'  name='file[]' multiple id='fornama' class='form-control' placeholder='masukan namaplaceholder'>
</div>


@endsection
