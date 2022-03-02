@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h2 class="card-header text-center">
                    @if($action == 'post')  إضافة تصنيف جديد @else  التعديل على بيانات التصنيف {{ $post->name }}   @endif
                </h2>

                <div class="card-body">
                    <form method="POST" action="{{ $action == 'post' ? route('posts.store') : route('posts.update', $post->id) }}" enctype="multipart/form-data">
                        @if ($action != 'post') @method('PUT')  @endif
                        @csrf

                        <div class="col-md-12" id="the_icon">
                            <img src="{{ $post->img_path ?? asset('admin/panel/img/upload.png') }}" class="the_image_changing"  onclick="document.getElementById('image').click()" alt="Cinque Terre">
                            <h5 class="text-center" style="margin-top: -15px;">إرفع صورة من هنا</h5>
                            <input  style="display: none;"  id="image" type="file" name="main_image">
                        </div>
                        <br>

                        <div class="form-group row">
                            <label for="users" class="col-md-2 col-form-label text-md-right">المستخدمين</label>

                            <div class="col-md-10">
                                <select class="form-control"  name="user_id">

                                    <option value="">اختر المستخدم ...</option>

                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                        @unless ($action == 'post')
                                            @if ($theUser == $user->id)
                                                selected
                                            @endif
                                        @endunless
                                        >{{ $user->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="categories" class="col-md-2 col-form-label text-md-right">التصنيفات</label>

                            <div class="col-md-10">
                                <select class="form-control" name="category_id">

                                    <option value="">اختر التصنيف ...</option>

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                        @unless ($action == 'post')
                                            @if ($theCategory == $category->id)
                                                selected
                                            @endif
                                        @endunless
                                        >{{ $category->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title" class="col-md-2 col-form-label text-md-right">العنوان</label>

                            <div class="col-md-10">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $action == 'post' ?  old('title') : $post->title }}">

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="body" class="col-md-2 col-form-label text-md-right">الوصف</label>

                            <div class="col-md-10">
                                <textarea name="body" id="body" class="form-control @error('body') is-invalid @enderror textarea" cols="30" rows="10">
                                    {{ $action == 'post' ? old('body') : $post->body }}
                                </textarea>

                                @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary col-md-12">
                                    @if($action == 'post')  إضافة تصنيف جديد @else  التعديل على بيانات التصنيف {{ $post->name }}   @endif
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
