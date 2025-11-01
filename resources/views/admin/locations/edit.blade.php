@extends('admin.layouts.backend')

@section('content')
<h2 class="text-2xl font-bold mb-4">Edit Location</h2>

<form action="{{ route('admin.locations.update', $location->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="name" value="{{ $location->name }}" class="border p-2 w-full mb-4">
    @error('name')
        <p class="text-red-600">{{ $message }}</p>
    @enderror
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
</form>
@endsection
