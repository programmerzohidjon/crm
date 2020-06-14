@extends('layouts.layouts')
@section('content')
<section class="content">
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Title</h3>

			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
				title="Collapse">
				<i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
					<i class="fa fa-times"></i></button>
			</div>
		</div>
	<div class="box-body">
		<?php $role = Auth::user()->role_id;  ?>
		@foreach(App\Models\Menu::getMenu($role) as $menu)
	    <li>{{$menu->name}}</li>
	    @endforeach
	</div>
	  <!-- /.box-body -->
	<div class="box-footer">
	    Footer
	</div>
	  <!-- /.box-footer-->
	</div>
</section>
@endsection