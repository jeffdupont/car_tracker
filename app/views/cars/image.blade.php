
@if(App::environment() == "production")
<script src="/dist/lite-uploader/jquery.liteuploader.min.js"></script>
@else
<script src="/dist/lite-uploader/jquery.liteuploader.js"></script>
@endif


<div id="car_image">
@if( $car && file_exists( storage_path() . Config::get('upload.path') . '/' . $car->id . '.jpg') )
  <img src="{{ URL::route('cars.image', $car->id) }}"/>
@endif
</div>
<input type="file" name="image" id="image" class="file-upload" accept="image/*" />


@section('script')
<script>
  $(document).ready(function () {
    $('.file-upload').liteUploader({
      script: 'upload',
      rules: {
        allowedFileTypes: 'image/jpeg,image/png,image/gif',
        maxSize: 2500000
      }
    })
    .on('lu:success', function (e, response) {
      var img = $("#car_image img");
      if ( ! img ) img = $("<img />");
      var new_image = response + '?' + Date.now();
      img.attr('src', new_image).load(function() {
          if (!this.complete || typeof this.naturalWidth == "undefined" || this.naturalWidth == 0) {
              console.log('broken image!: ' + response);
          } else {
              $("#car_image").empty().append(img);
          }
      });
    });
  });
</script>
@stop
