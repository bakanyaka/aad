@extends('layouts.app')

@section('title', 'Main page')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Создать задачу</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('main')}}">Главная</a>
                </li>
                <li>
                    Задачи
                </li>
                <li class="active">
                    <strong>Новая</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Создание новой задачи</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="project" class="col-sm-2 control-label">Проект</label>
                                <div class="col-sm-6">
                                    <select id="project" class="form-control" name="project">
                                        @foreach($projects as $project)
                                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label for="tracker" class="col-sm-2 control-label">Трекер</label>
                                <div class="col-sm-2">
                                    <select id="tracker" class="form-control" name="tracker">
                                        <option value="3" selected="selected">Поддержка</option>
                                        <option value="2">Улучшение</option>
                                        <option value="1">Ошибка</option>
                                        <option value="9">Проект</option>
                                        <option value="18">Web сайт</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="assigned_to" class="col-sm-2 control-label">Назначена</label>
                                <div class="col-sm-2">
                                    <select id="assigned_to" class="form-control" name="assigned_to">
                                        @foreach($todoUsers as $todoUser)
                                            <option value="{{ $todoUser['id'] }}">{{ $todoUser['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="priority" class="col-sm-2 control-label">Приоритет</label>
                                <div class="col-sm-2">
                                    <select id="priority" class="form-control" name="priority">
                                        <option value="3">Низкий</option>
                                        <option value="4" selected="selected">Нормальный</option>
                                        <option value="5">Высокий</option>
                                        <option value="6">Срочный</option>
                                        <option value="7">Немедленный</option>
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label for="subject" class="col-sm-2 control-label">Тема</label>
                                <div class="col-sm-6">
                                    <input id="subject" type="text" class="form-control" name="subject" value="{{old('subject')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="department" class="col-sm-2 control-label">Подразделение</label>
                                <div class="col-sm-6">
                                    <select id="department" class="form-control" name="department">
                                        @foreach($departments as $department)
                                            <option value="{{ $department }}">{{ $department }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-2 control-label">Описание</label>
                                <div class="col-sm-6">
                                    <textarea id="description" class="form-control" rows="10" name="description"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary" type="submit">Создать задачу</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
