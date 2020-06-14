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
				<input type="text" class="form-control" name="name" required="" value="{{isset($subject['name'])?$subject['name']:old('name')}}" autocomplete="off">
			</div>
			<div class="form-group">
				<label for="type">Изображение:</label>
				<input type="file" name="file" class="form-control">
			</div>
			
		</div>
		<div class="col-md-6">
			<input type="hidden" name="id" value="{{isset($subject['id'])?$subject['id']:old('id')}}">
			@if(isset($subject))
			<div class="form-group">
				<label for="type">Status:</label>
				<select class="form-control" name="status">
					<option value="1" {{isset($subject->status)&&$subject->status ? 'selected' : '' }}>Включен</option>
					<option value="0">Отключен</option>
				</select>
			</div>
			<div class="form-group">
				<img src="{{asset($subject->image)}}" >
			</div>
			@endif
			<div class="box-footer">
				<a type="submit" href="{{URL::previous()}}" class="btn btn-default">Отмена</a>
				<button type="submit" class="btn btn-primary pull-right">Сохранить</button>
			</div>
		</div>
	</div>
</div>