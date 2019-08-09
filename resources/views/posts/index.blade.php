@extends('layouts.app')
@section('content')
          <div class="d-flex justify-content-end mb-2">
                  <a href="{{route('posts.create')}}" class="btn btn-success">เพิ่มข้อมูลอู่ซ่อม</a>
          </div>
          <div class="card card-default">
            <div class="card-header">
                  ข้อมูลอู่ซ่อม
            </div>
            <div class="card-body">
                @if($posts->count()>0)
                    <table class="table">
                        <thead>
                            <th>รูปร้าน</th>
                            <th>ชื่อร้าน</th>
                            <th>ที่อยู่</th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                          @foreach($posts as $post)
                              <tr>
  
                                  <td>
                                      <img src="storage/{{$post->image}}" alt="" width="200px" height="150px">
                                  </td>
                                  <td>{{$post->title}}</td>
                                  <td>{{$post->content}}</td>
  
                                  <td>
                                        <a href="{{route('posts.edit',$post->id)}}" class="btn btn-info btn-sm">แก้ไข</a>
                                  </td>
  
                                  <td>
                                      <form class="delete_form" action="{{route('posts.destroy',$post->id)}}" method="post">
                                              @csrf
                                              <input type="hidden" name="_method" value="DELETE">
                                              <input type="submit" name="" value="ลบ" class="btn btn-danger btn-sm">
                                      </form>
                                  </td>
  
                              </tr>
                          @endforeach
                        </tbody>
                    </table>
                    @else
                      <h3 class="text text-center">ไม่มีข้อมูลร้าน</h3>
                @endif
            </div>
          </div>
          <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
          <script type="text/javascript">
                  $(document).ready(function(){
                        $('.delete_form').on('submit',function(){
                              if(confirm("คุณต้องการลบข้อมูลหรือไม่")){
                                    return true;
                              }else{
                                    return false;
                              }

                        });
                  });
          </script>
@endsection
