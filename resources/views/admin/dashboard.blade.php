@extends('admin.layouts.app')

@section('content')

<div class="row" style="margin-top: 50px; margin-right: 0px;">
  <div class="col-md-3">
    <div class="card-counter primary">
      <i class="material-icons icon">person</i>
      <span class="count-numbers">{{ $postsCount }}</span>
      <span class="count-name">عدد المقالات</span>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card-counter danger">
      <i class="material-icons icon">track_changes</i>
      <span class="count-numbers">{{ $usersCount  }}</span>
      <span class="count-name">عدد المستخدمين</span>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card-counter info">
      <i class="material-icons icon">collections</i>
      <span class="count-numbers">{{ $categoriesCount }}</span>
      <span class="count-name">عدد التصنيفات</span>
    </div>
  </div>




</div>


@endsection
