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
            {{isset($post)?'แก้ไขข้อมูล':'ข้อมูลอู่ซ่อม'}}
    </div>
    <div class="card-body">
            <form action="{{isset($post)?route('posts.update',$post->id):route('posts.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @if(isset($post))
                    @method('PUT')
                @endif
                    <div class="form-group">
                        <label for="title">ชื่ออู่ซ่อม</label>
                        <input type="text" name="title" value="{{isset($post)?$post->title:''}}" class="form-control" placeholder="กรุณาใส่ข้อมูล">
                    </div>
                    <div class="form-group">
                        <label for="title">ชื่อ</label>
                        <input type="text" name="title1" value="" class="form-control" placeholder="กรุณาใส่ข้อมูล">
                    </div>
                    <div class="form-group">
                        <label for="title">นามสกุล</label>
                        <input type="text" name="title2" value="" class="form-control" placeholder="กรุณาใส่ข้อมูล">
                    </div>
                    <div class="form-group">
                            <label for="title">รายละเอียดร้าน</label>
                            <input id="x" type="hidden" name="description" value="{{isset($post)?$post->description:''}}" >
                            <trix-editor input="x" placeholder="กรุณาใส่ข้อมูล"></trix-editor>
                    </div>
                    <div class="form-group">
                            <label for="title">ที่อยู่ปัจจุบัน</label>
                            <textarea name="content" rows="4" cols="4" class="form-control" placeholder="กรุณาใส่ข้อมูล">{{isset($post)?$post->content:''}}</textarea>
                    </div>

                      <div class="form-group">
                        <label for="title">จังหวัด</label>
                        <input type="text" name="city_name" id="city_name" class="form-control" placeholder="กรุณาใส่ข้อมูล" />
                          <div id="cityList">
                          </div>
                      </div>
                        {{ csrf_field() }}
                        
                        <div class="form-group">
                            <label for="title">อำเภอ</label>
                            <input type="text" name="city_name1" id="city_name1" class="form-control" placeholder="กรุณาใส่ข้อมูล" />
                              <div id="cityList">
                              </div>
                        </div>
                            {{ csrf_field() }}  

                        <div class="form-group">
                            <label for="title">ตำบล</label>
                            <input type="text" name="city_name2" id="city_name2" class="form-control" placeholder="กรุณาใส่ข้อมูล" />
                                <div id="cityList">
                                </div>
                        </div>
                            {{ csrf_field() }}
                            
                        <div class="form-group">
                            <label for="title">รหัสไปรษณีย์</label>
                            <input type="text" name="title3" value="" class="form-control" placeholder="กรุณาใส่ข้อมูล">
                        </div>
                      
                    <div class="form-group">
                        <label for="title">รูปอู่ซ่อม</label>
                        <input type="file" name="image" value="" class="form-control">
                    </div>
                    <div class="form-group">
                            <input type="submit" name="" value="{{isset($post)?'แก้ไขข้อมูล':'เพิ่มข้อมูลอู่ซ่อม'}}" class="btn btn-success">
                    </div>
                   
            </form>
    </div>
</div>
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.1.1/trix.js" charset="utf-8"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.1.1/trix.css">
          <script type="text/javascript">
                $(document).ready(function(){
                        $('#select-tags').select2();
                });
          </script>

            <script type="text/javascript">
                $(document).ready(function(){
                    $('#city_name').keyup(function(){
                    var query = $(this).val();

                    if(query != ''){
                    var _token = $('input[name="_token"]').val();
                    }

                    $.ajax({
                        url:"{{ route('autocomplete.show') }}",
                        method:"POST",
                        data:{query:query,_token:_token},
                        success:function(data){
                            $('#cityList').fadeIn();
                            $('#cityList').html(data);
                        }
                    })
                    });
                });
                $(document).on('click', 'li', function(){
                    $('#cityList').fadeOut();
                    $('#city_name').val($(this).text());
                    
                });
            </script>

@endsection