@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <div class="card text-center mt-4">
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-primary text-left" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="row">
                <div class="col-sm">
                    <a href="{{ url('api') }}" class="btn btn-primary btn-lg" data-api-import role="button" aria-pressed="true">
                        <span style="display:none;" data-api-import-loading class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Import API Data
                    </a>
                </div>
                <div class="col-sm">
                    <a href="{{ url('properties/create') }}" class="btn btn-primary btn-lg" role="button"
                       aria-pressed="true">Add Property</a>
                </div>
            </div>
            <div class="row mt-4">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Address</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($properties as $property)
                        <tr>
                            <td>{{ $property->id }}</td>
                            <td>{{ $property->address }}</td>
                            <td><a href="{{ url("properties/{$property->id}/edit") }}" class="btn btn-primary"><i class="fas fa-edit"></i></a></td>
                            <td>
                                <form action="{{ route('properties.destroy', $property->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row mt-4">
                <div class="col-sm">
                    {{ $properties->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
