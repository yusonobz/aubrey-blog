@extends('app')

@section('main-content')
<div class="container">
    <div class="panel panel-success">
      <div class="panel-heading">
      	Create New Article
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
	 	 <form action="{{ route('article.store') }}" method="post" enctype="multipart/form-data">
	 	 	{{ csrf_field() }}
			  <div class="container">
			  	<div class="form-group">
				    <label for="title">Article Title <span class="required">*</span></label>
				    <input type="text" class="form-control" placeholder="Article Title" required name="title">
				 </div>
			  	<div class="form-group">
				    <label for="content">Body Content</label>
				    <textarea class="form-control" rows="5" id="content" name="content" required></textarea>
				 </div>
                 <div class="form-group">
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile02" name="photo" accept=".png, .jpg, .jpeg" required> 
                            <label class="custom-file-label" for="inputGroupFile02">Cover Photo</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="preview">Cover Photo Preview</label>
                    <img src="" id="preview" class="mx-auto d-block"/>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Options</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect01" name="status" required>
                            <option value="0">Draft</option>
                            <option value="1">Published</option>
                        </select>
                    </div>
                </div>
              <br>
			  <button type="submit" class="btn btn-primary">Add</button>
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

</script>
@endsection