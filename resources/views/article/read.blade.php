@extends('app')

@section('main-content')

<h1 class="display-2 text-center">{{ $article->title }}</h1>
<img src="{{ asset('/images/') }}/{{ $article->photo }}" class="mx-auto d-block" />
<br>
<h5 class="text-center">{{ $article->content }}</h5>

@endsection