@extends('layouts.app')

@section('content')

<h1>Manage Groups</h1>

<div class='form-group d-flex justify-content-center mt-5'>
    <input id='search' type='text' data-db='group' class='form-control mr-3' placeholder='Find Groups'/>
    <form id='fileform' method='post' action='/command/addgroupscsv' enctype='multipart/form-data'>
        <button id='fileinputfacade' class='btn btn-primary'>Upload</button>
        <input type='file' id='fileinput' name='group_csv' class='d-none'/>
    </form>
</div>

<table class='table rounded my-4'>
    <thead>
        <th class='sorter' data-orderby='group_id' scope='col'>id</th>
        <th class='sorter' data-orderby='group_name' scope='col'>name</th>
        <th scope='col'>members</th>
    </thead>
    <tbody id='fillable'>
        @forelse($groups as $group)
            <tr>
                <td>{{ $group->group_id }}</td>
                <td>{{ $group->group_name }}</td>
                @if(isset($group->members)) 
                    <td>{{ count($group->members) }}</td>
                @else <td>0</td>
                @endif
            </tr>
        @empty
            <tr><td colspan='3'>No group data available</td></tr>
        @endforelse
    </tbody>
</table>

@endsection