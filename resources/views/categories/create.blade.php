@extends('layouts.app')
@section('content')
    
<div class="card card-default">
    @if($errors->any())
          <div class="alert alert-danger">
                <ul class="list-group">
                      @foreach($errors->all() as $error)
                            <li class="list-group-item">{{$error}}</li>
                      @endforeach
                </ul> 
          </div>
    @endif
    <div class="card-header">

          {{isset($category)?"Edit Category":"Create Category"}}

    </div>

    <div class="card-body">
          <form action="{{isset($category)?route('categories.update',$category->id):route('categories.store')}}" method="post">
              @csrf


              @if(isset($category))
                    @method('put')
              @endif
              
              <div class="form-group">
                    <label for="">ชื่อประเภทการซ่อม</label>
                    <input type="text" name="name" value="{{isset($category)?$category->name:''}}" class="form-control" placeholder="กรุณาใส่ข้อมูล">
              </div>
              <div class="form-group">
                    <input type="submit" name="" value="{{isset($category)?'แก้ไขประเภทการซ่อม':'เพิ่มประเภทการซ่อม'}}" class="btn btn-success">
              </div>
          </form>
    </div>
</div>

@endsection