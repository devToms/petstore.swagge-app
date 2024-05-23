<!-- resources/views/pets/index.blade.php -->

@extends('layouts')

@section('content')
    <div class="container">
        <h1>Pets</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <a href="{{ route('pets.create') }}" class="btn btn-primary mb-3">Add New Pet</a>

        <br>
        <br>
        <form action="{{ route('pets.index') }}" method="GET" class="mb-3">
         <div class="input-group">
             <label for="status" class="input-group-text">Status:</label>
             <select id="status" name="status" class="form-select">
                 <option value="available" {{ Request::get('status') == 'available' ? 'selected' : '' }}>Available</option>
                 <option value="pending" {{ Request::get('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                 <option value="sold" {{ Request::get('status') == 'sold' ? 'selected' : '' }}>Sold</option>
             </select>
             <button type="submit" class="btn btn-primary">Filter</button>
         </div>
       </form>
       <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pets as $pet)
                    <tr>
                        <td>{{ $pet['name'] }}</td>
                        <td>{{ $pet['status'] }}</td>
                        <td>
                            <a href="{{ route('pets.edit', $pet['id']) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('pets.destroy', $pet['id']) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
