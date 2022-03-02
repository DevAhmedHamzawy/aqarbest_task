@extends('layouts.app')

@section('content')
<div class="container">

    <form action="{{ route('search') }}" method="get" class="form-group">

        <input type="text" name="title" placeholder="search...." class="form-control">

        <br>

        <button type="submit" class="btn btn-primary col-md-12">Search</button>

    </form>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach ($posts as $post)
                        <a href="{{ route('the_posts.show', $post->id) }}">{{ $post->title }}</a>
                        <br>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {!! $posts->links() !!}
    </div>
</div>
@endsection
