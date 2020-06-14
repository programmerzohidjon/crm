@extends('layouts.layouts')

@section('breadcrumb')
@component('components.breadcrumb')
@slot('title') Список учителей @endslot
@slot('parent') Главная @endslot
@slot('active') Список учителей @endslot
@endcomponent
@endsection

@section('content')
<div class="row">
	<div class="alert alert-success" style="display:none"></div>
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title"><a type="button" class="btn btn-block btn-primary btn-sm" href="{{route('admin.teacher.create')}}">Добавить</a></h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th style="width: 10px">#</th>
							<th>ФИО</th>
							<th>Email</th>
							<th>Адрес</th>
							<th>Телефон</th>
							<th>Предмет</th>
							<th>Классы</th>
							<th style="width: 100px">Cтатус</th>
							<th style="width: 100px">Действие</th>
						</tr>
					</thead>
					<tbody>
						@forelse($teachers as $teacher)
						<tr>
							<td>#</td>
							<td>{{$teacher->name}}</td>
							<td>{{$teacher->email}}</td>
							<td>{{$teacher->address}}</td>
							<td>{{$teacher->phone}}</td>
							<td>1</td>
							<td>2</td>
							<td>
								@if(Cache::has('is_online' . $teacher->id))
								<span class="badge bg-green"> Онлайн </span>
								@else 
								<span class="badge bg-red"> Не в сети </span>
								@endif
							</td>
							<td>
								<a type="button" class="btn btn-xs btn-default" href="#"><i class="fa fa-eye"></i>
								</a>
								<a type="button" class="btn btn-xs btn-default" href="{{route('admin.teacher.edit',$teacher->id)}}"><i class="fa fa-pencil"></i>
								</a>
								<a onclick="if(confirm('Вы действительно хотите Удалить?')){return true}else{return false}" href="{{route('admin.teacher.destroy',$teacher->id)}}"  type="button" class="btn btn-xs btn-default"><i class="fa fa-trash"></i>
								</a>
							</td>
						</tr>
						@empty
						<tr>
							<td colspan="9" style="text-align: center;">Данные отсутствует</td>
						</tr>
						@endforelse
					</tbody>
				</table>
			</div>
			<!-- /.box-body -->
			<div class="box-footer clearfix">
				<ul class="pagination pagination-sm no-margin pull-right">
					{{$teachers->links()}}
				</ul>
			</div>
		</div>
		<!-- /.box -->
	</div>
</div>
@endsection