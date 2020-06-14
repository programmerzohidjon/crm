@extends('layouts.layouts')

@section('breadcrumb')
@component('components.breadcrumb')
@slot('title') Список меню @endslot
@slot('parent') Главная @endslot
@slot('active') Список меню @endslot
@endcomponent
@endsection

@section('content')
<div class="row">
	<div class="alert alert-success" style="display:none"></div>
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title"><a type="button" class="btn btn-block btn-primary btn-sm" href="{{route('admin.subject.create')}}">Добавить</a></h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th style="width: 10px">#</th>
							<th>Название</th>
							<th>Image</th>
							<th style="width: 100px">Cтатус</th>
							<th style="width: 100px">Действие</th>
						</tr>
					</thead>
					<tbody>
						<?php $n = 1; ?>
						@forelse($subjects as $key=>$subject)
						<tr>
							<td>#</td>
							<td>{{$subject->name}}</td>
							<td>{{$subject->image}}</td>
							<td>
								<span class="badge {{$subject->status ? 'bg-green' : 'bg-red'}}">
									{{$subject->status ? "Включен" : "Отключен"}}
								</span>
							</td>
							<td>
								<a type="button" class="btn btn-xs btn-default" href="#"><i class="fa fa-eye"></i>
								</a>
								<a type="button" class="btn btn-xs btn-default" href="{{route('admin.subject.edit',$subject->slug)}}"><i class="fa fa-pencil"></i>
								</a>
								<a onclick="if(confirm('Вы действительно хотите Удалить?')){return true}else{return false}" href="{{route('admin.subject.destroy',$subject->id)}}"  type="button" class="btn btn-xs btn-default"><i class="fa fa-trash"></i>
								</a>
							</td>
						</tr>
						@empty
						<tr>
							<td colspan="5" style="text-align: center;">Данные отсутствует</td>
						</tr>
						@endforelse
					</tbody>
				</table>
			</div>
			<!-- /.box-body -->
			<div class="box-footer clearfix">
				<ul class="pagination pagination-sm no-margin pull-right">
					{{$subjects->links()}}
				</ul>
			</div>
		</div>
		<!-- /.box -->
	</div>
</div>
@endsection