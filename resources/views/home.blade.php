@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="panel-heading">
                        <h2>
                            Recent posts
                            <a href="{{ url('admin/posts') }}" class="btn btn-link float-right">Show all</a>
                        </h2>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Published</th>
                                <th>Action</th>
                            </tr>

                            </thead>
                            <tbody>
                            @forelse ($posts as $post)
                                <tr>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->category->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($post->published_at)->format('d/m/Y')}}</td>
                                    <td class="text-nowrap">
                                        <a href="{{ url("/admin/posts/{$post->id}") }}" class="btn btn-xs btn-success">Show</a>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="5">No post available.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="panel-heading">
                        <h2>
                            Recent categories
                            <a href="{{ url('admin/categories') }}" class="btn btn-link float-right">Show all</a>
                        </h2>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="5">No categories available.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
