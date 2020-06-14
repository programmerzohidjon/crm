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
				<input type="text" class="form-control" name="name" required="" value="{{isset($menu['name'])?$menu['name']:old('name')}}" autocomplete="off">
			</div>
			<div class="form-group">
				<label for="type">URL:</label>
				<input type="text" class="form-control" name="url" required="" value="{{isset($menu['url'])?$menu['url']:old('url')}}" autocomplete="off">
			</div>
			<div class="form-group">
				<label for="price">Icon:</label>
				<input type="text" class="form-control" name="icon" value="{{isset($menu['icon'])?$menu['icon']:old('icon')}}" autocomplete="off">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="name">ParentID :</label>
				<select class="form-control" name="parent_id">
					<?php $menus = App\Models\Menu::getMenuParents(); ?>
					@if(isset($menu->parent_id))
					<option value="{{isset($menu->parent_id)}}">{{$menu->parent->name}}</option>
						@foreach($menus as $item)
							<option value="{{$item->id}}">{{$item->name}}</option>
						@endforeach
					@endif
						@if(count($menus)>0)
							<option value="0">По умолчанию</option>
							@foreach($menus as $item)
								<option value="{{$item->id}}">{{$item->name}}</option>
							@endforeach
							@else
							<option value="0">По умолчанию</option>
						@endif
				</select>
			</div>

			<div class="form-group">
				<label for="type">Role:</label>
				<select class="form-control" name="role_id">
					@if(isset($menu))
					<option value="{{isset($menu->role_id)}}" {{isset($menu->role_id)&&$menu->role_id ? 'selected' : ''}}>{{$menu->role->name}}</option>
						@foreach(App\Models\Role::getRole() as $role)
						<option value="{{$role->id}}">{{$role->name}}</option>
						@endforeach
					@endif
					@foreach(App\Models\Role::getRole() as $role)
					<option value="{{$role->id}}">{{$role->name}}</option>
					@endforeach
				</select>
			</div>
			<input type="hidden" name="slug" value="{{isset($menu['slug'])?$menu['slug']:old('slug')}}">
			<div class="form-group">
				<label for="type">Status:</label>
				<select class="form-control" name="status">
					<option value="1" {{isset($menu->status)&&$menu->status ? 'selected' : '' }}>Включен</option>
					<option value="0">Отключен</option>
				</select>
			</div>
		</div>
		<div class="box-footer">
			<button type="submit" class="btn btn-primary">Сохранить</button>
		</div>
	</div>
</div>