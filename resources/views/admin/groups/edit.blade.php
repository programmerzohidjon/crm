@extends('layouts.layouts')

@section('breadcrumb')
@component('components.breadcrumb')
@slot('title') Редактирование класса @endslot
@slot('parent') Главная @endslot
@slot('active') Редактирование класса @endslot
@endcomponent
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading"> Редактирование класса</div>
			<div class="panel-wrapper collapse in" aria-expanded="true">
				<div class="panel-body">
					<form method="post" action="{{route('admin.group.update')}}" enctype="multipart/form-data">
						@csrf
						@include('admin.groups.form')
					</form>	
				</div>
			</div>
		</div>
	</div>
</div>
@endsection