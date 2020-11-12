@extends('backend.layouts.app')

@section('title', 'Create Property')

@push('styles')

    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

@endpush


@section('content')

    <div class="block-header"></div>

    <div class="row clearfix">
        <form action="{{route('admin.properties.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-lg-8 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-teal">
                    <h2>T&#7841;o t�i s&#7843;n</h2>
                </div>
                <div class="body">

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" name="title" class="form-control" value="{{old('title')}}">
                            <label class="form-label">T�n t�i s&#7843;n</label>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="number" class="form-control" name="price" required>
                            <label class="form-label">Gi�</label>
                        </div>
                        <div class="help-info">Tri&#7879;u &#273;&#7891;ng</div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="number" class="form-control" name="bedroom" required>
                            <label class="form-label">S&#7889; ph�ng ng&#7911;</label>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="number" class="form-control" name="bathroom" required>
                            <label class="form-label">S&#7889; ph�ng t&#7855;m</label>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="city" required>
                            <label class="form-label">T&#7881;nh</label>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="address" required>
                            <label class="form-label">&#272;&#7883;a ch&#7881; c&#7909; th&#7875;</label>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="number" class="form-control" name="area" required>
                            <label class="form-label">Di&#7879;n t�ch</label>
                        </div>
                        <div class="help-info">m�t vu�ng</div>
                    </div>

                    <div class="form-group">
                        <input type="checkbox" id="featured" name="featured" class="filled-in" value="1" />
                        <label for="featured">T�nh n&#259;ng &#273;&#7863;c bi&#7879;t</label>
                    </div>

                    <hr>
                    <div class="form-group">
                        <label for="tinymce">M� t&#7843;</label>
                        <textarea name="description" id="tinymce">{{old('description')}}</textarea>
                    </div>

                    <hr>
                    <div class="form-group">
                        <label for="tinymce-nearby">G&#7847;n v&#7899;i khu v&#7921;c</label>
                        <textarea name="nearby" id="tinymce-nearby">{{old('nearby')}}</textarea>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="header bg-teal">
                    <h2>Th&#432; vi&#7879;n &#7843;nh</h2>
                </div>
                <div class="body">
                    <input id="input-id" type="file" name="gallaryimage[]" class="file" data-preview-file-type="text" multiple>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-teal">
                    <h2>L&#7921;a ch&#7885;n</h2>
                </div>
                <div class="body">

                    <div class="form-group form-float">
                        <div class="form-line {{$errors->has('purpose') ? 'focused error' : ''}}">
                            <label>Ki&#7875;u t�i s&#7843;n</label>
                            <select name="purpose" class="form-control show-tick">
                                <option value="">-- Ch&#7885;n m&#7897;t --</option>
                                <option value="sale">B�n</option>
                                <option value="rent">Cho thu�</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line {{$errors->has('type') ? 'focused error' : ''}}">
                            <label>Lo&#7841;i t�i s&#7843;n</label>
                            <select name="type" class="form-control show-tick">
                                <option value="">-- Ch&#7885;n m&#7897;t --</option>
                                <option value="house">Nh�</option>
                                <option value="apartment">C&#259;n h&#7897;</option>
                            </select>
                        </div>
                    </div>

{{--                    <h5>Tính năng khác</h5>--}}
{{--                    <div class="form-group demo-checkbox">--}}
{{--                        @foreach($features as $feature)--}}
{{--                            <input type="checkbox" id="features-{{$feature->id}}" name="features[]" class="filled-in chk-col-teal" value="{{$feature->id}}" />--}}
{{--                            <label for="features-{{$feature->id}}">{{$feature->name}}</label>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}

                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="video">
                            <label class="form-label">Link video</label>
                        </div>
                        <div class="help-info">Youtube Link</div>
                    </div>

                    <div class="clearfix">
                        <h5>Google Map</h5>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="location_latitude" class="form-control" required/>
                                <label class="form-label">V&#297; &#273;&#7897;</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="location_longitude" class="form-control" required/>
                                <label class="form-label">Kinh &#273;&#7897;</label>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="card">
                <div class="header bg-teal">
                    <h2>S&#417; &#273;&#7891; m&#7863;t b&#7857;ng</h2>
                </div>
                <div class="body">
                    <div class="form-group">
                        <input type="file" name="floor_plan">
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="header bg-teal">
                    <h2>&#7842;nh m� t&#7843;</h2>
                </div>
                <div class="body">
                    <div class="form-group">
                        <input type="file" name="image">
                    </div>

                    {{-- BUTTON --}}
                    <a href="{{route('admin.properties.index')}}" class="btn btn-danger btn-lg m-t-15 waves-effect">
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
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/fileinput.min.js"></script>

    <script src="{{ asset('backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <script src="{{asset('backend/plugins/tinymce/tinymce.js')}}"></script>
    <script>
        $(function () {
            $("#input-id").fileinput();
        });

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

        $(function () {
            tinymce.init({
                selector: "textarea#tinymce-nearby",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: '',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{asset('backend/plugins/tinymce')}}';
        });
    </script>

@endpush
