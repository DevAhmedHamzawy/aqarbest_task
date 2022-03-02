@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h2 class="card-header text-center">
                    @if($action == 'post')  إضافة تصنيف جديد @else  التعديل على بيانات التصنيف {{ $category->name }}   @endif
                </h2>

                <div class="card-body">
                    <form method="POST" action="{{ $action == 'post' ? route('categories.store') : route('categories.update', $category->id) }}" enctype="multipart/form-data">
                        @if ($action != 'post') @method('PUT')  @endif
                        @csrf

                        {{--<div class="col-md-12" id="the_icon">
                            <img src="{{ asset('admin/panel/img/upload.png') }}" class="the_image_changing"  onclick="document.getElementById('image').click()" alt="Cinque Terre">
                            <h5 class="text-center" style="margin-top: -15px;">إرفع صورة من هنا</h5>
                            <input  style="display: none;"  id="image" type="file" name="main_image">
                        </div>
                        <br>--}}

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">الإسم</label>

                            <div class="col-md-10">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $action == 'post' ?  old('name') : $category->name }}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        {{--<div class="form-group row">
                            <label for="description" class="col-md-2 col-form-label text-md-right">الوصف</label>

                            <div class="col-md-10">
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror textarea" cols="30" rows="10">
                                    {{ $action == 'post' ? old('description') : $category->description }}
                                </textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>--}}


                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary col-md-12">
                                    @if($action == 'post')  إضافة تصنيف جديد @else  التعديل على بيانات التصنيف {{ $category->name }}   @endif
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <script>
         function changeImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                $('.the_image_changing').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#image").change(function() {
            changeImage(this);
        });
    </script>
@endsection
