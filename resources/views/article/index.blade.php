@extends('app')

@section('main-content')
<div class="container">
     @if(Session::has('message'))
     <div class="alert alert-success alert-dismissible fade show" role="alert">
         {{ Session::get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
     @endif
    <div class="panel panel-primary">
        <div class="panel-heading">
            <a href="{{ route('article.create') }}" class="btn btn-primary btn-sm">Add New</a>
        </div>
        <div class="panel-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th>Count</th>
                    <th>Title</th>
                    <th>URL</th>
                    <th>Date Created</th>
                    <th>Date Updated</th>
                    <th>Published</th>
                    <th style="width:200px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td><a href="{{ route('article.edit',$article->id) }}">{{ $article->title }}</a></td>
                        @if($article->status == 0)
                            <td><a href="{{ url('/404') }}">{{ $article->url }}</a></td>
                        @else
                            <td><a href="{{ route('article.show',$article->id)}}">{{ $article->url }}</a></td>
                        @endif
                        <td>{{ $article->created_at->diffForHumans() }}</td>
                        <td>{{ $article->updated_at->diffForHumans() }}</td>
                        @if($article->status == 0)
                            <td><span style='font-size:20px;'></span></td>
                        @else
                            <td><span style='font-size:20px;'>&#10004;</span></td>
                        @endif
                        <td>
                            <form  method="post" action="{{ route('article.destroy',$article->id) }}" class="delete_form">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <a href="{{ route('article.edit',$article->id) }}" class="btn btn-xs btn-primary">Edit</a>
                                <button class="btn btn-xs btn-danger" type="submit" onclick="return confirm('Are You Sure? Want to Delete It.');">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection