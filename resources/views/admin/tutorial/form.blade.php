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
		<div class="col-md-6">
			<div class="form-group">
				<label for="name">Название:</label>
				<input type="text" class="form-control" name="name" required="" value="{{isset($tutorial['name'])?$tutorial['name']:old('name')}}" autocomplete="off">
			</div>
			<div class="form-group">
				<label for="name">Автор:</label>
				<input type="text" class="form-control" name="author" required="" value="{{isset($tutorial['author'])?$tutorial['author']:old('author')}}" autocomplete="off">
			</div>
			<div class="form-group">
				<label for="name">Класс:</label>
				<select class="form-control" name="class">
					@if(isset($tutorial))
						<option value="{{$tutorial->class}}" selected="">{{$tutorial->class}}</option>
						@for($i=1;$i<=11;$i++)
						<option value="{{$i}}">{{$i}}</option>
						@endfor
					@else
						@for($i=1;$i<=11;$i++)
						<option value="{{$i}}">{{$i}}</option>
						@endfor
						
					@endif
					
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<input type="hidden" name="slug" value="{{isset($tutorial['slug'])?$tutorial['slug']:old('slug')}}">
			<div class="form-group">
				<label for="type">Изображение:</label>
				<input type="file" name="file" class="form-control">
			</div>
			<div class="form-group">
				<label for="type">Файл:</label>
				<input type="file" name="filepath" class="form-control">
			</div>
			@if(isset($tutorial))
			<div class="form-group">
				<label for="type">Status:</label>
				<select class="form-control" name="status">
					<option value="1" {{isset($tutorial->status)&&$tutorial->status ? 'selected' : '' }}>Включен</option>
					<option value="0">Отключен</option>
				</select>
			</div>
			<div class="form-group">
				<img src="{{asset($tutorial->image)}}" >
			</div>
			@endif
		</div>
	</div>
	<div class="box-footer">
		<a type="submit" href="{{URL::previous()}}" class="btn btn-default">Отмена</a>
		<button type="submit" class="btn btn-primary pull-right">Сохранить</button>
	</div>
</div>