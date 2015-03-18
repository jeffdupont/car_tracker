
@if(App::environment() == "production")
<script src="/dist/lite-uploader/jquery.liteuploader.min.js"></script>
@else
<script src="/dist/lite-uploader/jquery.liteuploader.js"></script>
@endif


<div class="car-image main">
@if( $car && $image_exists )
  <img src="{{ URL::route('cars.image', $car->id) }}"/>
@else
  <img src="//placehold.it/250x250"/>
@endif
</div>
<input type="file" name="image" id="image" class="file-upload" accept="image/*;capture=camera" />


@section('script')
@parent
  <script>
    $(document).ready(function () {
      $('.file-upload').liteUploader({
        script: '/cars/{{ $car->id }}/upload',
        rules: {
          allowedFileTypes: 'image/jpeg,image/png,image/gif',
          // maxSize: 2500000
        },
        params: {
          '_token': '{{ csrf_token() }}'
        }
      })
      .on('lu:errors', function (e, errors) {
        console.log(errors);
        // var isErrors = false;
        // $('#display').html('');
        // $.each(errors, function (i, error) {
        //   if (error.errors.length > 0) {
        //     isErrors = true;
        //     $.each(error.errors, function (i, errorInfo) {
        //       $('#display').append('<br />ERROR! File: ' + error.name + ' - Info: ' + JSON.stringify(errorInfo));
        //     });
        //   }
        // });
        // if (!isErrors) {
        //   $('#display').append('<br />No errors');
        // }
      })
      .on('lu:before', function (e, files) {
        $(".car-image").prepend('<div class="progress-container"><div class="progress"><span class="meter"></span></div></div>');
      })
      .on('lu:progress', function (e, percentage) {
        console.log(percentage);
        $('.meter').css({ width: percentage + '%' });
      })
      .on('lu:success', function (e, response) {
        var img = $(".car-image img");
        if ( ! img ) img = $("<img />");
        var new_image = response + '?' + Date.now();
        img.attr('src', new_image).load(function() {
            if (!this.complete || typeof this.naturalWidth == "undefined" || this.naturalWidth == 0) {
                console.log('broken image!: ' + response);
            } else {
                $(".car-image").empty().append(img);
            }
        });
      });
    });
  </script>
@stop
