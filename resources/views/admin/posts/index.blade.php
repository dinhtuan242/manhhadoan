@extends('backend.layouts.app')

@section('title', 'Posts')

@push('styles')

    <!-- JQuery DataTable Css -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}">

@endpush

@section('content')

    <div class="block-header">
        <a href="{{route('admin.posts.create')}}" class="waves-effect waves-light btn right m-b-15 addbtn">
            <i class="material-icons left">add</i>
            <span>Thêm mới </span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-teal">
                    <h2>Danh sách bài viết</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Ảnh mô tả</th>
                                    <th>Tên bài viết</th>
                                    <th>Tác giả</th>
                                    <th>Thể loại</th>
                                    <th>Trạng thái</th>
                                    <th width="150">Hành động</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach( $posts as $key => $post )
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        @if(Storage::disk('public')->exists('posts/'.$post->image))
                                            <img src="{{asset(Storage::url('posts/'.$post->image))}}" alt="{{$post->title}}" style="width: 200px" class="img-responsive img-rounded">
                                        @endif
                                    </td>
                                    <td>
                                        <span title="{{$post->title}}">
                                            {{ str_limit($post->title, 40) }}
                                        </span>
                                    </td>
                                    <td>{{$post->user->name}}</td>
                                    <td>
                                        @foreach($post->categories as $key=>$category)
                                            @if($key!=0)
                                                <span>,</span>
                                            @endif
                                            {{$category->name}}
                                        @endforeach
                                    </td>
                                    <td>
                                        @if($post->status == true)
                                            <span class="badge bg-green">Công khai</span>
                                        @else 
                                            <span class="badge bg-pink">Đang chờ</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('blog.show',$post->slug)}}" target="_blank" class="btn btn-success btn-sm waves-effect">
                                            <i class="material-icons">visibility</i>
                                        </a>
                                        <a href="{{route('admin.posts.edit',$post->slug)}}" class="btn btn-info btn-sm waves-effect">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm waves-effect" onclick="deletePost({{$post->id}})">
                                            <i class="material-icons">delete</i>
                                        </button>
                                        <form action="{{route('admin.posts.destroy',$post->slug)}}" method="POST" id="del-post-{{$post->id}}" style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('backend/js/pages/tables/jquery-datatable.js') }}"></script>

    <script>
        function deletePost(id){
            
            swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    document.getElementById('del-post-'+id).submit();
                    swal(
                    'Deleted!',
                    'Post has been deleted.',
                    'success'
                    )
                }
            })
        }
    </script>


@endpush