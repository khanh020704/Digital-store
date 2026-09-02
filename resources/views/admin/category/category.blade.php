@extends('admin.layouts.app')
@section('content')

<div class="page-wrapper">

    <div class="container-fluid">

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($category as $item)
                                    <tr>
                                        <th>{{ $item->id }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <a href="#" class="btn btn-primary">Edit</a>
                                            <a href="#" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ route('admin.category.add') }}" class="btn btn-success">
    Add Category
</a>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>

@endsection