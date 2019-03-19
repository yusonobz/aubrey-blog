@extends('app')

@section('main-content')

<h1 class="display-2 text-center">{{ $article->title }}</h1>
<div class="container">
    <div class="row">
        <div class="col"><p>{{ $article->content }}</p></div>
        <div class="col"><img src="{{ asset('/images/') }}/{{ $article->photo }}" class="img-fluid" width="460" height="345"/></div>
    </div>
</div>
@endsection