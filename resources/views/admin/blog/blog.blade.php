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
                                        <th>Tittle</th>
                                        <th>Image</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($blog as $item)
                                    <tr>
                                        <th>{{ $item->id}}</th>
                                        <td>{{ $item->title }}</td>
                                        <td><a href="{{ asset('storage/' . $item->image) }} " >{{ $item->image }}</a></td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            <a href="{{ route('admin.blog.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                                            <form action="{{ route('admin.blog.delete', $item->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ route('admin.blog.create') }}" class="btn btn-success">
    Add Blog
</a>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>

@endsection