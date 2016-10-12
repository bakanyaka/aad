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
                    <ad-user-list></ad-user-list>
                </div>
            </div>
        </div>
    </div>

@endsection
