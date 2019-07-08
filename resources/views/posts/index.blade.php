@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>
                            Posts

                            <a href="{{ url('admin/posts/create') }}" class="btn btn-primary float-right">Create New</a>
                        </h2>
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Category</th>
                                <th>Published</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($posts as $post)
                                <tr>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ str_limit($post->body, 60) }}</td>
                                    <td>{{ $post->category->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($post->published_at)->format('d/m/Y')}}</td>
                                    <td class="text-nowrap">
                                        <a href="{{ url("/admin/posts/{$post->id}") }}" class="btn btn-xs btn-success">Show</a>
                                        <a href="{{ url("/admin/posts/{$post->id}/edit") }}" class="btn btn-xs btn-primary">Edit</a>
                                        {!! Form::open(['method' => 'DELETE', 'url' => "/admin/posts/{$post->id}", 'role' => 'form', 'onsubmit' => 'return confirm("Are you sure?");', 'class' => 'd-inline']) !!}
                                        <button type="submit" class="btn btn-xs btn-danger" onclick="">Delete</button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No post available.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        {!! $posts->links() !!}

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
