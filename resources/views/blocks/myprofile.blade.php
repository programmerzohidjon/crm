@extends('layouts.layouts')

@section('breadcrumb')
@component('components.breadcrumb')
@slot('title') Мой профиль @endslot
@slot('parent') Главная @endslot
@slot('active') Профиль @endslot
@endcomponent
@endsection
@section('content')
<div class="alert alert-success" style="display:none"></div>
<div class="row">
	<div class="col-md-3">
		<!-- Profile Image -->
		<div class="box box-primary">
			<div class="box-body box-profile">
				@if(isset($user->avatar))
				<img src="{{asset($user->avatar)}}" class="profile-user-img img-responsive img-circle">
				@else
				<img class="profile-user-img img-responsive img-circle" src="{{asset('assets/images/avatar/all_user.png')}}">
				@endif
				<h3 class="profile-username text-center">{{$user->name}}</h3>

				<p class="text-muted text-center">{{$user->role->name}}</p>

				<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<b>Followers</b> <a class="pull-right">1,322</a>
					</li>
					<li class="list-group-item">
						<b>Following</b> <a class="pull-right">543</a>
					</li>
					<li class="list-group-item">
						<b>Friends</b> <a class="pull-right">13,287</a>
					</li>
				</ul>

				<a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->

		<!-- About Me Box -->
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Мои данные</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<strong><i class="fa fa-book margin-r-5"></i> Класс</strong>
				<p class="text-muted">
					B.S. in Computer Science from the University of Tennessee at Knoxville
				</p>

				<hr>

				<strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

				<p class="text-muted">Malibu, California</p>

				<hr>

				<strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

				<p>
					<span class="label label-danger">UI Design</span>
					<span class="label label-success">Coding</span>
					<span class="label label-info">Javascript</span>
					<span class="label label-warning">PHP</span>
					<span class="label label-primary">Node.js</span>
				</p>

				<hr>

				<strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
	<!-- /.col -->
	<div class="col-md-9">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Редактировать профиль</h3>
			</div>
			<div class="box-body">
				<form class="form-horizontal" action="{{route('myprofile_edit')}}" enctype="multipart/form-data" method="post">
					@csrf
					<div class="form-group">
						<label for="inputName" class="col-sm-2 control-label">ФИО</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" placeholder="ФИО" name="name" value="{{$user->name}}" >
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail" class="col-sm-2 control-label">Email</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" placeholder="Email" name="email" value="{{$user->email}}">
						</div>
					</div>
					<div class="form-group">
						<label for="inputName" class="col-sm-2 control-label">Адрес</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="address" value="{{$user->address}}">
						</div>
					</div>
					<div class="form-group">
						<label for="inputName" class="col-sm-2 control-label">Телефон</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="phone" value="{{$user->phone}}">
						</div>
					</div>
					<div class="form-group">
						<label for="inputExperience" class="col-sm-2 control-label">Дата рождения</label>
						<div class="col-sm-10">
							<input type="date" class="form-control" name="birthday" name="birthday" value="{{$user->birthday}}">
						</div>
					</div>
					<div class="form-group">
						<label for="inputSkills" class="col-sm-2 control-label">Аватар</label>
						<div class="col-sm-10">
							<input type="file" class="form-control" name="file" accept=".jpg,png,jpeg">
						</div>
					</div>
					<div class="form-group">
						<label for="inputSkills" class="col-sm-2 control-label">Новый пароль</label>
						<div class="col-sm-10">
							<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
						</div>
					</div>
					<div class="form-group">
						<label for="inputSkills" class="col-sm-2 control-label">Повторите пароль</label>
						<div class="col-sm-10">
							<input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
						</div>
					</div>
					
					<input type="hidden" name="id" value="{{$user->id}}">
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="check"> Согласен для изменение данных
								</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-success" id="profile_submit">Сохранить</button>
						</div>
					</div>
				</form>
				
			</div>
			<!-- /.col -->
		</div>
	</div>
</div>
@endsection
