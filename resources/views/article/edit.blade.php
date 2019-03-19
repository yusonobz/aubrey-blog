@extends('app')

@section('main-content')
<div class="container">
    <div class="panel panel-success">
      <div class="panel-heading">
      	Edit Article
      </div>
      <div class="panel-body">
      	@if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
	 	 <form action="{{ route('article.update', $article->id) }}" method="post" enctype="multipart/form-data">
	 	 	{{ csrf_field() }}
	 	 	{{ method_field('PATCH') }}
			  <div class="container">
			  	<div class="form-group">
				    <label for="title">Article Title <span class="required">*</span></label>
				    <input type="text" class="form-control" placeholder="Article Title" required name="title" value="{{ $article->title }}">
				 </div>
			  	<div class="form-group">
				    <label for="content">Body Content</label>
				    <textarea class="form-control" rows="5" id="content" name="content" required></textarea>
                    <input style="display: none;" id="contentval" value="{{ $article->content }}"/>
				 </div>
                 <div class="form-group">
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile02" name="photo" accept=".png, .jpg, .jpeg"> 
                            <label class="custom-file-label" for="inputGroupFile02">Cover Photo</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="preview">Cover Photo Preview</label>
                    <img src="{{ asset('/images/') }}/{{ $article->photo }}" id="preview" class="mx-auto d-block"/>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Options</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect01" name="status" required>
                        @if($article->status == 0)
                            <option value="0" selected>Draft</option>
                            <option value="1">Published</option>
                        @else
                            <option value="0">Draft</option>
                            <option value="1" selected>Published</option>
                        @endif
                        </select>
                    </div>
                </div>
              <br>
			  <button type="submit" class="btn btn-primary">Update</button>
			  <a href="{{ route('article.index') }}" class="btn btn-danger">Back</a>
			</form> 
   	  </div>
    </div>
</div>
@endsection



@section('extra-scripts')
<script>

function readURL(input) {
if (input.files && input.files[0]) {
  var reader = new FileReader();

  reader.onload = function(e) {
    $('#preview').attr('src', e.target.result);
  }

  reader.readAsDataURL(input.files[0]);
}
}

$("#inputGroupFile02").change(function() {
readURL(this);
});

var content = document.getElementById('contentval').value
$('#content').val(content);


</script>
@endsection