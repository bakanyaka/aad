@extends('layouts.app')

@section('title', 'Пользователи')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Пользователи</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('main')}}">Главная</a>
                </li>
                <li class="active">
                    <strong>Пользователи</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Поиск пользователей в Active Directory</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input type="text" placeholder="Имя пользовтеля или учетная запись" class="input-sm form-control">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary"> Поиск</button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6 m-b-xs col-sm-offset-2"><select class="input-sm form-control input-s-sm inline">
                                    <option value="0">Все подразделения</option>
                                    <option value="1">Отдел номер 1</option>
                                    <option value="2">Option 3</option>
                                    <option value="3">Option 4</option>
                                </select>
                            </div>
                        </div>
                        <div class="table-responsive m-t-lg">
                            <table class="table table-striped">
                                <thead>
                                <tr>

                                    <th>ФИО</th>
                                    <th>Должность</th>
                                    <th>Номер телефона</th>
                                    <th>Подразделение</th>
                                    <th>Местоположение</th>
                                    <th>Дата логина</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Васильев Петр Петрович</td>
                                    <td>Сантехник</td>
                                    <td>333-22-44,40-33,292-4323</td>
                                    <td>119 Управление канализационных систем</td>
                                    <td>Здание 18, 1 этаж, Комната 3</td>
                                    <td>11.09.2016</td>
                                    <td>
                                        <a href="#"><i class="fa fa-laptop text-navy fa-lg"></i></a>
                                        <a href="#"><i class="fa fa-clipboard text-navy m-l-xs fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Николаев Александр Васильевич</td>
                                    <td>Инженер</td>
                                    <td>42-33,232-4323</td>
                                    <td>183 Технический центр</td>
                                    <td>Здание 22, 3 этаж, Комната 304</td>
                                    <td>30.10.2016</td>
                                    <td>
                                        <a href="#"><i class="fa fa-laptop text-navy fa-lg"></i></a>
                                        <a href="#"><i class="fa fa-clipboard text-navy m-l-xs fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Васильев Петр Петрович</td>
                                    <td>Сантехник</td>
                                    <td>333-22-44,40-33,292-4323</td>
                                    <td>119 Управление канализационных систем</td>
                                    <td>Здание 18, 1 этаж, Комната 3</td>
                                    <td>11.09.2016</td>
                                    <td>
                                        <a href="#"><i class="fa fa-laptop text-navy fa-lg"></i></a>
                                        <a href="#"><i class="fa fa-clipboard text-navy m-l-xs fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Николаев Александр Васильевич</td>
                                    <td>Инженер</td>
                                    <td>42-33,232-4323</td>
                                    <td>183 Технический центр</td>
                                    <td>Здание 22, 3 этаж, Комната 304</td>
                                    <td>30.10.2016</td>
                                    <td>
                                        <a href="#"><i class="fa fa-laptop text-navy fa-lg"></i></a>
                                        <a href="#"><i class="fa fa-clipboard text-navy m-l-xs fa-lg"></i></a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
