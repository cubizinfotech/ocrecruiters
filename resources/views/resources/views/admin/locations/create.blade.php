@extends('admin.layouts.backend')

@section('content')
<h2 class="text-2xl font-bold mb-4">Add New Location</h2>

<form action="{{ route('admin.locations.store') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Location Name" class="border p-2 w-full mb-4">
    @error('name')
        <p class="text-red-600">{{ $message }}</p>
    @enderror
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
</form>
@endsection
