@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>{{ $blog->title }}</h2>
                    @if(auth()->user())
                    <div class="button-group">
                        <a class="btn btn-primary me-1" href="{{ route('blogs.edit', $blog->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{ route('blogs.destroy', $blog) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                        </form>
                    </div>
                    @endif
                </div>

                <div class="row mt-4">
                    <p>{{ $blog->content }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
