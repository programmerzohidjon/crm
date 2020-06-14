@extends('layouts.layouts')

@section('breadcrumb')
@component('components.breadcrumb')
@slot('title') Добавление учебника @endslot
@slot('parent') Главная @endslot
@slot('active') Список учебников @endslot
@endcomponent
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading"> Добавление предмета</div>
			<div class="panel-wrapper collapse in" aria-expanded="true">
				<div class="panel-body">
					<form method="post" action="{{route('admin.tutorial.store')}}" enctype="multipart/form-data">
						@csrf
						@include('admin.tutorial.form')
					</form>	
				</div>
			</div>
		</div>
	</div>
</div>
@endsection