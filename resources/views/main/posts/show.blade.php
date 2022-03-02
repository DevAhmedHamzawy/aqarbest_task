@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">

                    <img src="{{ $post->img_path }}" alt="" srcset="">

                    <p>{{ $post->category->name }} - {{ $post->created_at->diffForHumans() }}</p>

                    <h1>{{ $post->title }}</h1>

                    <p>{!! $post->body !!}</p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
