<?php

namespace A4fteam\Admpanel\Http\Controllers;

use A4fteam\Admpanel\Http\Controllers\Controller;
use A4fteam\Admpanel\Http\Requests;
use A4fteam\Admpanel\Http\Models\User;
use Notifications;
use Title;

class UsersController extends Controller
{
    public function index()
    {
        Title::prepend('Пользователи');
        $data = [
            'title' => Title::renderr(' : ', true),
            'users' => User::all(),
        ];


        return view('admpanel::layouts.admin.users.index', $data);
    }

    public function add()
    {
        Title::prepend('Новый пользователь');

        $data = [
            'title'    => Title::renderr(' : ', true),
            'user'     => null,
            'save_url' => route('root-users-save'),
        ];


        return view('admpanel::layouts.admin.users.user', $data);
    }

    public function edit($user_id)
    {
        $user = User::find($user_id);

        Title::prepend('Редактировать пользователя');
        Title::prepend($user->name);

        $data = [
            'title'    => Title::renderr(' : ', true),
            'user'     => $user,
            'save_url' => route('root-users-save', ['user_id' => $user->id]),
        ];


        return view('admpanel::layouts.admin.users.user', $data);
    }

    public function store(Requests\StoreUserRequest $request, $user_id = null)
    {
        $user = User::findOrNew($user_id);

        $user->email = $request->get('email');
        $user->name = $request->get('name');
        $user->role = $request->get('role');

        $password = trim($request->get('password'));  //TODO: Не шифрует пароль!исправить

        if ($password != '') {
            $user->password = $request->get('password');
            Notifications::add('Пароль изменен', 'success');
        } else {
            Notifications::add('Пароль не изменен!', 'warning');
        }

        $user->active = $request->has('active');
        $user->save();

        Notifications::add('Пользователь сохранен', 'success');

        return redirect()->route('root-users');
    }
}
