@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>All Blogs</h2>
                    @if(auth()->user())
                    <a class="btn btn-primary" href="{{ route('blogs.create') }}"><i class="fa-solid fa-plus"></i> Add</a>
                    @endif
                </div>

                <div class="row mt-3">
                    @foreach ($blogs as $blog)
                        <div class="col-lg-4 col-md-6 my-2">
                            <div class="card">
                                <div class="card-header">
                                    <a href="{{ route('blogs.show', $blog->id) }}">{{ $blog->title }}</a>
                                </div>

                                <div class="card-body">
                                    <p>{{ Str::limit($blog->content, 100, '...') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
