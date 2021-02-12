@extends('layouts.header')
@section('title', 'FAQ - Admin')
@section('content')
<section class="content">
  <div class="">
    <header class="content__title">
      <h1>FAQ Settings</h1>
    </header>
    <div class="card">
      <div class="card-body">
        <form method="POST" action="{{ url('admin\partner_save') }}"  enctype="multipart/form-data">
          {{ csrf_field() }} 


    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="col-xs-12 control-label">Partner Logo</label>
          <div class="col-xs-12 inputGroupContainer">
              <label for="file-upload2" class="custom-file-upload"> <i class="fa fa-cloud-upload"></i> Upload File </label>
            <input id="file-upload2" name='image' type="file" style="display:none;">
               <img id="doc2" width="100px"  height="100px" class="img-responsive" />
            
            @if ($errors->has('image'))
                    <span class="help-block">
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                @endif
          </div>
        </div>
      </div>
    </div>

            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>&nbsp;</label>
                </div>
              </div>
              <div class="col-md-4">
                <button class="btn btn-md btn-warning" type="submit"> Add</button><br /><br />
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  @endsection

    <script>
    function readURL1(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#doc1').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#file-upload1").change(function() {
      var fsize1 = this.files[0].size/1024/1024;  
      if(fsize1 < 1)
      { 
        $("#file-name1").text(this.files[0].name);
          readURL1(this);
      } else { 
        alert('Not Exceed above 1 MB');
        $('#file-upload1').val('');
      } 
    });
  </script>
