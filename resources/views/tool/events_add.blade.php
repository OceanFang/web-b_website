@extends('layouts.app')
@section('js')
<script src="{{ URL::asset('asset/js/toolControllers.js') }}"></script>

<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>

<script src="{{ URL::asset('asset/new/js/bootstrap-imageupload.js') }}"></script>
<link href="{{ URL::asset('asset/new/css/bootstrap-imageupload.css') }}" rel="stylesheet">

<script>
$(function(){

	var $imageupload = $('.imageupload');
            $imageupload.imageupload({
                maxWidth: 500,
                maxHeight: 500,
                maxFileSizeKb: 3048
            });

    var route_prefix = "{{ url(config('lfm.prefix')) }}";
    var options = {
            height: 350,
            filebrowserImageBrowseUrl: route_prefix + '?type=Images',
            filebrowserImageUploadUrl: route_prefix + '/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: route_prefix + '?type=Files',
            filebrowserUploadUrl: route_prefix + '/upload?type=Files&_token={{csrf_token()}}',

            extraPlugins: 'colorbutton,justify,font',
          };

    CKEDITOR.replace('input_add_content', options);
});
</script>

@stop
@section('content')
<div class="">
	<div class="page-title">
		<div class="title_left">
			<h3><b>{{ $title->name }}</b></h3>
		</div>

		<div class="title_right">

		</div>
	</div>

	<div class="clearfix"></div>

	<div class="row">
		<div class="x_panel">

			<div class="col-md-12 col-sm-12 col-xs-12">
<!-- add list start-->

{{ Form::open(array(
    'url' => '/tool/events/do_add',
    'class' => 'form-horizontal',
    'id' => 'media-frm',
    'method'=>'POST',
    'files'=>'true' ))
}}


<!-- <form class="form-horizontal" role="form" method="POST" action="/tool/events/do_add"> -->
{{ csrf_field() }}
 <div class="modal-body">

 	<!-- <div class="form-group">
    <label for="input_button" class="col-sm-2 control-label">公告時間</label>


	<fieldset> -->
		<!-- 日期 -->
		<!-- <div class="col-sm-6 xdisplay_inputx form-group has-feedback">
			<input type="text" class="form-control has-feedback-left" id="single_cala" placeholder="開始時間" aria-describedby="inputSuccessStatus" name="start_time" value="">
			<span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
			<span id="inputSuccessStatus" class="sr-only">(success)</span>
         </div> -->
		<!-- 日期 -->
		<!-- <div class="col-sm-6 xdisplay_inputx form-group has-feedback">
			<input type="text" class="form-control has-feedback-left" id="single_calb" placeholder="結束時間" aria-describedby="inputSuccessEnd" name="end_time" value="">
			<span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
			<span id="inputSuccessEnd" class="sr-only">(success)</span>
        </div>
	</fieldset>

	</div> -->

	<input type="hidden" name="game" value="{{ $game }}">

	<div class="form-group">
        <label for="input_mode" class="col-sm-2 control-label">類型</label>
        <div class="col-sm-10">
            <select id="input_mode" class="form-control" name="type_id">
            @foreach($list as $val)
            <option value="{{ $val->id}}" >{{ $val->description}}</option>
            @endforeach
          </select>
        </div>
    </div>

	<div class="form-group">
	<label for="input_title" class="col-sm-2 control-label" >示意圖</label>
	<div class="col-sm-10">
	    <div class="imageupload panel panel-default">

	        <div class="file-tab panel-body">
	            <label class="btn btn-primary btn-file">
	                <span>選擇檔案</span>
	                <!-- The file is stored here. -->
	                <!-- <input type="file" name="image-file"> -->
	                <input type="file" name="file[]" id="inputFiles" tabindex="-1" calss="position: absolute;"  multiple="multiple">
	            </label>
	            <button type="button" class="btn btn-danger">Delete image</button>
	        </div>

	    </div>
	</div>
    </div>

	<div class="form-group">
    <label for="input_title" class="col-sm-2 control-label" >主題</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="input_title" name="title" value="" required>
    </div>
	</div>

	<div class="form-group">
    <label for="input_author" class="col-sm-2 control-label" >作者</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="input_author" name="author" value="" required>
    </div>
	</div>

	<div class="form-group">
    <label for="input_content" class="col-sm-2 control-label">內容</label>
    <div class="col-sm-10">
	  <textarea class="form-control" rows="10"  id="input_add_content" name="content" required></textarea>
    </div>
	</div>

		</div>
		<!-- 頁尾 S -->
		<div class="modal-footer">
			<!--
			<div class="alert alert-danger" >
				!! 注意 ，若選擇已有群組的人員則將會取代原本的設定 !!
			</div>-->
			<button type="submit" class="btn btn-primary">送出</button>
			<a href="/tool/events/{{ $game }}">
				<button type="button" class="btn btn-secondary">取消</button>
			</a>
		</div>
		<!-- 頁尾 END -->
<!-- </form> -->
{{ Form::close() }}
<!-- add list end -->

<!--內容 END-->
				</div>

			</div>
		</div>
	</div>
</div>
@stop

@section('footerjs')
<script>
	/*
    //選擇日期
    $("#single_cala","#single_calb").flatpickr({
      enableTime: true,
      dateFormat: "Y-m-d H:i:S",
      minDate:new Date(),//預設顯示現在時間
    });
*/
	//自設-日期選擇
	// $('#single_cala').daterangepicker({
	// 	singleDatePicker: true,
	// 	timePicker: true,
	// 	timePickerIncrement: 30, // 以 30 分鐘為一個選取單位
	// 		singleClasses: "picker_2",
	// 		locale: {
	// 		format: "YYYY-MM-DD HH:mm:ss" // 日期+時間的顯示格式
	// 		}
	// });
	// $('#single_calb').daterangepicker({
	// 	singleDatePicker: true,
	// 	timePicker: true,
	// 	timePickerIncrement: 30, // 以 30 分鐘為一個選取單位
	// 		singleClasses: "picker_2",
	// 		locale: {
	// 		format: "YYYY-MM-DD HH:mm:ss" // 日期+時間的顯示格式
	// 		}
	// });

</script>
@stop
