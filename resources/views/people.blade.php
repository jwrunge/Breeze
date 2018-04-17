@extends('layouts.app')

@section('content')

<h1>Manage People</h1>

<div class='form-group d-flex justify-content-center mt-5'>
    <input id='search' type='text' data-db='people' class='form-control mr-3' placeholder='Find People'/>
    <form id='fileform' method='post' action='/command/addpeoplecsv' enctype='multipart/form-data'>
        <button id='fileinputfacade' class='btn btn-primary'>Upload</button>
        <input type='file' id='fileinput' name='people_csv' class='d-none'/>
    </form>
</div>

<table class='table rounded my-4'>
    <thead>
        <th class='sorter selected' data-orderby='person_id' scope='col'>id</th>
        <th class='sorter' data-orderby='last_name' scope='col'>name</th>
        <th scope='col'>group</th>
        <th class='sorter' data-orderby='state' scope='col'>state</th>
    </thead>
    <tbody id='fillable'>
        @forelse($people as $person)
            <tr>
                <td>{{ $person->person_id }}</td>
                <td>{{ $person->last_name }}, {{ $person->first_name }}</td>
                @if(isset($person->group)) 
                    <td>{{ $person->group->group_name }}</td>
                @else <td>none</td>
                @endif
                <td>{{ $person->state }}</td>
            </tr>
        @empty
            <tr><td colspan='3'>No person data available</td></tr>
        @endforelse
    </tbody>
</table>

@endsection