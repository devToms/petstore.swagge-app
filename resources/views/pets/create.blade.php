<!-- resources/views/pets/create.blade.php -->

@extends('layouts')

@section('content')
    <h1>Add New Pet</h1>
    <form action="{{ route('pets.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="available">Available</option>
                <option value="pending">Pending</option>
                <option value="sold">Sold</option>
            </select>
        </div>
        <button type="submit">Add Pet</button>
    </form>
@endsection
