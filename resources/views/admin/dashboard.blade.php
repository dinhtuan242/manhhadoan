@extends('backend.layouts.app')
@section('title', 'Dashboard')
@push('styles')
@endpush
@section('content')

    <div class="block-header">
        <h2>DASHBOARD</h2>
    </div>

    <!-- Widgets -->
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">home</i>
                </div>
                <div class="content">
                    <div class="text">TỔNG TÀI SẢN</div>
                    <div class="number count-to" data-from="0" data-to="{{ $propertycount }}" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-deep-purple hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">event_note</i>
                </div>
                <div class="content">
                    <div class="text">TỔNG BÀI VIẾT</div>
                    <div class="number count-to" data-from="0" data-to="{{ $postcount }}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-orange hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">person_add</i>
                </div>
                <div class="content">
                    <div class="text">TỔNG NGƯỜI DÙNG</div>
                    <div class="number count-to" data-from="0" data-to="{{ $usercount }}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Widgets -->

    <div class="row clearfix">
        <!-- RECENT PROPERTIES -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>Tài sản gần đây</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Giá</th>
                                    <th>Thành phố</th>
                                    <th>Người đăng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($properties as $key => $property)
                                <tr>
                                    <td>{{ ++$key }}.</td>
                                    <td>
                                        <span title="{{ $property->title }}">
                                            {{ str_limit($property->title, 50) }}
                                        </span>
                                    </td>
                                    <td>{{ $property->price }} triệu đồng</td>
                                    <td>{{ $property->city }}</td>
                                    <td>{{ $property->user->name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# RECENT PROPERTIES -->

        <!-- RECENT POSTS -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>Bài viết gần đây</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Tác giả</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $key => $post)
                                <tr>
                                    <td>{{ ++$key }}.</td>
                                    <td>
                                        <span title="{{ $post->title }}">
                                            {{ str_limit($post->title, 100) }}
                                        </span>
                                    </td>
                                    <td>{{ strtok($post->user->name, " ")}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# RECENT POSTS -->
    </div>

    <div class="row clearfix">
        <!-- USER LIST -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>Danh sách user</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Vai trò</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $user)
                                <tr>
                                    <td>{{ ++$key }}.</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role->name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# USER LIST -->

        <!-- RECENT COMMENTS -->
{{--        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">--}}
{{--            <div class="card">--}}
{{--                <div class="header">--}}
{{--                    <h2>Comment gần đây</h2>--}}
{{--                </div>--}}
{{--                <div class="body">--}}
{{--                    <div class="table-responsive">--}}
{{--                        <table class="table table-hover dashboard-task-infos">--}}
{{--                            <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>STT</th>--}}
{{--                                    <th>Nội dung</th>--}}
{{--                                    <th><i class="material-icons small">check</i></th>--}}
{{--                                    <th>Người đăng</th>--}}
{{--                                    <th>Thời gian</th>--}}
{{--                                </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                                @foreach($comments as $key => $comment)--}}
{{--                                <tr>--}}
{{--                                    <td>{{ ++$key }}.</td>--}}
{{--                                    <td>--}}
{{--                                        <span title="{{ $comment->body }}">--}}
{{--                                            {{ str_limit($comment->body, 20) }}--}}
{{--                                        </span>--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        @if($comment->approved == 1)--}}
{{--                                            <span class="label bg-green">A</span>--}}
{{--                                        @else--}}
{{--                                            <span class="label bg-red">N</span>--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
{{--                                    <td>{{ strtok($comment->users->name, " ")}}</td>--}}
{{--                                    <td>{{ $comment->created_at->diffForHumans() }}</td>--}}
{{--                                </tr>--}}
{{--                                @endforeach--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <!-- #END# RECENT COMMENTS -->
    </div>


@endsection

@push('scripts')

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('backend/plugins/jquery-countto/jquery.countTo.js') }}"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="{{ asset('backend/js/pages/index.js') }}"></script>

@endpush
