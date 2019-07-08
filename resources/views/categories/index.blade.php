@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>
                            Categories

                            <a href="{{ url('admin/categories/create') }}" class="btn btn-primary float-right">Create New</a>
                        </h2>
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Post Count</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ str_limit($category->description, 60) }}</td>
                                    <td>{{ $category->posts_count }}</td>
                                    <td class="text-nowrap">
                                        <a href="{{ url("/admin/categories/{$category->id}/edit") }}" class="btn btn-xs btn-primary">Edit</a>
                                        {!! Form::open(['method' => 'DELETE', 'url' => "/admin/categories/{$category->id}", 'role' => 'form', 'onsubmit' => 'return confirm("Are you sure?");', 'class' => 'd-inline']) !!}
                                        <button type="submit" class="btn btn-xs btn-danger" onclick="">Delete</button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">No category available.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        {!! $categories->links() !!}

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
