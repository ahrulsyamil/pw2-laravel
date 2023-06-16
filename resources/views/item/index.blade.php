@extends('layouts.master')
@section('content')
    <div class="d-flex justify-content-end gap-1 mb-2">
        <a href="{{ route('item.export.excel') }}" class="btn btn-success">Export to Excel</a>
        <a href="{{ route('item.export.pdf') }}" class="btn btn-secondary">Export to PDF</a>
        <a href="/item/create" class="btn btn-primary">Add Item</a>
    </div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <table class="table table-bordered table-hover table-sm">
        <thead>
            <th>#</th>
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Supplier</th>
            <th>Location</th>
            <th>Quantity</th>
            <th>Status</th>
            <th>Description</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($items as $data)
                <tr>
                    <th scope="row">{{ $data->id }}</th>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->price }}</td>
                    <td>{{ $data->category }}</td>
                    <td>{{ $data->supplier }}</td>
                    <td>{{ $data->location }}</td>
                    <td>{{ $data->qty }}</td>
                    <td>{{ $data->status }}</td>
                    <td>{{ $data->description }}</td>
                    <td>
                        <a href="/item/{{ $data->id }}/edit" class="btn btn-info">Edit</a>
                        <form method="POST" action="{{ route('item.destroy', $data->id) }}" style="display: inline">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {!! $items->links() !!}
    </div>
@endsection
