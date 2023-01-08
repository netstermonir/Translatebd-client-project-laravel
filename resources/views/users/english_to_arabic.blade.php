@extends('users.master')

@section('content')

<!-- Content Area -->
<div class="container card-content my-5">
	<!-- Translate Area -->
	<div class="row top-textarea">
		<div class="col-12 d-flex justify-content-between py-2">
			<span>English</span>
			<a href="" id="clear">
				<i class="fa-solid fa-trash-can align-self-center"></i>
			</a>
		</div>
	</div>

	<div class="row input-textarea">
		<div class="col-12">
			<div class="form-floating">
				<textarea class="form-control" placeholder="Type your english text" id="english_text" style="height: 10rem"></textarea>
				<label for="english_text">Type your english text</label>
			</div>
		</div>
	</div>

	<div class="row change-icon text-center py-4">
		<div class="col-12">
			<a href="{{ route('arabic_to_english') }}"><i class="fa-solid fa-arrow-right-arrow-left p-2"></i></a>
		</div>
	</div>

	<div class="row top-textarea">
		<div class="col-12 d-flex justify-content-between py-2">
			<span>Arabic</span>
			<!-- <i class="fa-solid fa-trash-can align-self-center"></i> -->
		</div>
	</div>

	<div class="row input-textarea">
		<div class="col-12">
			<div class="form-floating">
				<textarea class="form-control" placeholder="Type your arabic text" id="arabic_text" style="height: 10rem"></textarea>
				<label for="arabic_text">Your arabic text</label>
			</div>
		</div>
	</div>

	<!-- End Translate Area -->
</div>
<!-- End Content Area -->

<!-- Main Content -->
<div class="container mb-5">
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-header text-center">
					<h3>
						{{ ucwords($translate->translate_type) }}
					</h3>
				</div>
				<div class="card-body">
					<p class="card-text">{!! $translate->content !!}</p>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Main Content -->

@endsection


@section('scripts')

<script type="text/javascript">
	$(document).ready(function() {
		$("#clear").click(function() {
			$("#english_text").val("");
			$("#arabic_text").val("");
		});


		//On pressing a key on "Search box" in "search.php" file. This function will be called.
		$('#english_text').on('keyup', function() {
			//Assigning search box value to javascript variable named as "name".
			var target_url = "{{ route('translate') }}";
			var english_text = $('#english_text').val();
			//Validating, if "name" is empty.
			if (english_text == "") {
				$("#arabic_text").html("");
			}
			//If name is not empty.
			else {
				//AJAX is called.
				$.ajax({
					//AJAX type is "Post".
					type: "GET",
					//Data will be sent to "ajax.php".
					url: target_url,
					//Data, that will be sent to "ajax.php".
					data: {
						//Assigning value of "name" into "search" variable.
						input_data: english_text,
						source: 'en',
						target: 'ar',
					},
					success: function(html) {
						//Assigning result to "display" div in "search.php" file.
						$("#arabic_text").html(html).show();
					}
				});
			}
		});
	});
</script>
<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
</script>

@endsection