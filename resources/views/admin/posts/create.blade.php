@extends('backend.layouts.app')

@section('title', 'Create Post')

@push('styles')

    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.css')}}">

@endpush


@section('content')

    <div class="block-header"></div>

    <div class="row clearfix">
        <form action="{{route('admin.posts.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-lg-8 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-teal">
                    <h2>Thêm bài vi&#7871;t</h2>
                </div>
                <div class="body">

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" name="title" class="form-control" value="{{old('title')}}">
                            <label class="form-label">Tên bài vi&#7871;t</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="checkbox" id="published" name="status" class="filled-in" value="1" />
                        <label for="published">Công khai bài vi&#7871;t</label>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="">N&#7897;i dung bài vi&#7871;t</label>
                        <textarea name="body" id="tinymce">{{old('body')}}</textarea>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-teal">
                    <h2>Ch&#7885;n th&#7875; lo&#7841;i</h2>
                </div>
                <div class="body">

                    <div class="form-group form-float">
                        <div class="form-line {{$errors->has('categories') ? 'focused error' : ''}}">
                            <label>Ch&#7885;n th&#7875; lo&#7841;i</label>
                            <select name="categories[]" class="form-control show-tick" multiple>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line {{$errors->has('tags') ? 'focused error' : ''}}">
                            <label>Ch&#7885;n Tag</label>
                            <select name="tags[]" class="form-control show-tick" multiple>
                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="form-label">&#7842;nh mô t&#7843;</label>
                        <input type="file" name="image">
                    </div>


                    <a href="{{route('admin.posts.index')}}" class="btn btn-danger btn-lg m-t-15 waves-effect">
                        <i class="material-icons left">arrow_back</i>
                        <span>Quay l&#7841;i</span>
                    </a>

                    <button type="submit" class="btn btn-teal btn-lg m-t-15 waves-effect">
                        <i class="material-icons">save</i>
                        <span>L&#432;u</span>
                    </button>

                </div>
            </div>
        </div>
        </form>
    </div>

@endsection


@push('scripts')

    <script src="{{ asset('backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <script src="{{asset('backend/plugins/tinymce/tinymce.js')}}"></script>
    <script>
        $(function () {
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{asset('backend/plugins/tinymce')}}';
        });
    </script>

@endpush
