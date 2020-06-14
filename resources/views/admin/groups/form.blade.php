@if (count($errors) > 0)
<div class="alert alert-danger">
	<strong>Whoops!</strong> There were some problems with your input.
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
<div class="form-body">
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label for="name">Название:</label>
				<input type="text" class="form-control" name="name" required="" value="{{isset($group['name'])?$group['name']:old('name')}}" autocomplete="off">
			</div>
			<div class="form-group">
				<label for="type">Руководитель:</label>
				<select class="form-control select2" style="width: 100%;" name="head_id">
					@if(isset($group))
					<option value="{{$group->head_id}}" selected="selected">{{$group->user->name}}</option>
						@foreach(App\User::getTeacherList() as $head)
							<option value="{{$head->id}}">{{$head->name}}</option>
						@endforeach
						@else
						<option selected="">Выбирайте руководителя</option>
						@foreach(App\User::getTeacherList() as $head)
							<option value="{{$head->id}}">{{$head->name}}</option>
						@endforeach
					@endif
					
				</select>
			</div>
			
		</div>
		<div class="col-md-6">
			<input type="hidden" name="id" value="{{isset($group['id'])?$group['id']:old('id')}}">
			@if(isset($group))
			<div class="form-group">
				<label for="type">Status:</label>
				<select class="form-control" name="status">
					<option value="1" {{isset($group->status)&&$group->status ? 'selected' : '' }}>Включен</option>
					<option value="0">Отключен</option>
				</select>
			</div>
			@endif
			<div class="box-footer">
				<a type="submit" href="{{URL::previous()}}" class="btn btn-default">Отмена</a>
				<button type="submit" class="btn btn-primary pull-right">Сохранить</button>
			</div>
		</div>
	</div>
</div>