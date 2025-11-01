@extends('admin.layouts.backend')

@section('content')
<h2 class="text-2xl font-bold mb-4">Locations
    <a href="{{ route('admin.locations.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded float-right">Add New</a>
</h2>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">{{ session('success') }}</div>
@endif

<table class="table-auto w-full border">
    <thead>
        <tr class="bg-gray-200">
            <th class="border px-4 py-2">ID</th>
            <th class="border px-4 py-2">Name</th>
            <th class="border px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($locations as $location)
        <tr>
            <td class="border px-4 py-2">{{ $location->id }}</td>
            <td class="border px-4 py-2">{{ $location->name }}</td>
            <td class="border px-4 py-2">
                <a href="{{ route('admin.locations.edit', $location->id) }}" class="text-blue-600">Edit</a>
                <form action="{{ route('admin.locations.destroy', $location->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Are you sure?')" class="text-red-600 ml-2">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">{{ $locations->links() }}</div>
@endsection
