@extends('layout.template')

@section('title', 'Doctor')

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Doctor</h1>
        </div>

        <a href="{{ url('doctor/create') }}" class="btn btn-primary mb-2">Create</a>

        <div class="row g-3 float-end">
            <div class="col-auto">
                <form action="{{ url('doctor') }}" method="get" class="d-flex">
                    <input type="search" name="search" class="form-control me-2" placeholder="Search.."
                        value="{{ request('search') }}" aria-label="Search">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>

        @session('success')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endsession

        @session('error')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Error : {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endsession

        <div class="table-responsive small">
            <table class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($doctors as $doctor)
                        <tr>
                            <td>{{ ($doctors->currentpage() - 1) * $doctors->perpage() + $loop->iteration }}</td>
                            <td>{{ $doctor->name }}</td>
                            <td>{{ $doctor->email }}</td>
                            <td>{{ $doctor->phone }}</td>
                            <td>
                                <a href="{{ url('doctor/' . $doctor->uuid) }}" class="btn btn-primary">Detail</a>

                                <a href="{{ url('doctor/' . $doctor->uuid . '/edit') }}" class="btn btn-warning">Edit</a>

                                <form action="{{ url('doctor/' . $doctor->uuid) }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger">Delete</button>
                                </form>


                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $doctors->links() }}
        </div>
    </main>
@endsection
