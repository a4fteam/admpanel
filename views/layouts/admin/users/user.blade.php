@extends('admpanel::layouts.admin.index')

@section('content')
<h1>{{ $title }}</h1>
    <form action="{{ $save_url }}" method="post">
        {!! csrf_field() !!}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputName">Имя</label>
                    <input type="text" name="name" value="{{ $user->name or old('name') }}" class="form-control" id="inputName">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputEmail">E-mail</label>
                    <input type="text" name="email" value="{{ $user->email or old('email') }}" class="form-control" id="inputEmail">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="inputPassword">Пароль</label>
                    <input type="text" name="password" class="form-control" id="inputPassword">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="inputRole">Роль</label>
                    <select name="role" id="inputRole" class="form-control">
                        <!--TODO: Значения перенести в БД -->
                        <option value="user" {{ (!empty($user) && $user->role == 'user') ? 'selected' : '' }}>Пользователь</option>
                        <option value="author" {{ (!empty($user) && $user->role == 'author') ? 'selected' : '' }}>Автор</option>
                        <option value="admin" {{ (!empty($user) && $user->role == 'admin') ? 'selected' : '' }}>Администратор</option>
                        <option value="superadmin" {{ (!empty($user) && $user->role == 'superadmin') ? 'selected' : '' }}>Superadmin</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="inputActive">Активировать?</label>
                    <br />
                    <input type="checkbox" name="active" data-toggle="switch" id="inputActive"
                    {{ empty($user) || $user->active ? 'checked' : '' }} >
                </div>
            </div>
            <div class="col-lg-3">
                <label for="inputSubmit">&nbsp;</label>
                <br />
                <input type="submit" value="Save" class="btn btn-success btn-block" >
            </div>
        </div>
    </form>
@stop