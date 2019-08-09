@extends('layouts.app')
@section('content')
    
    <div class="d-flex justify-content-end mb-2">
        <a href="{{route('categories.create')}}" class="btn btn-success">เพิ่มประเภทการซ่อม</a>
    </div>

    {{-- ส่วนของการแสดง --}}
    <div class="card card-default">
        <div class="card-header">
              ประเภทการซ่อม
        </div>
    <div class="card-body">
        @if($categories->count()>0)
        <table class="table">
            <thead>
              <th>Name</th>
              <th></th>
              <th></th>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                  <td>{{$category->name}}</td>
                  <td>
                      <a href="{{route('categories.edit',$category->id)}}" class="btn btn-info btn-sm">แก้ไข</a>
                  </td>

                  <td>
                      <form class="delete_form" action="{{route('categories.destroy',$category->id)}}" method="post">
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
                      <h3 class="text text-center">ไม่มีประเภทการซ่อม</h3>
      @endif
        
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script type="text/javascript">
            $(document).ready(function(){
                  $('.delete_form').on('submit',function(){
                        if(confirm("คุณต้องการลบข้อมูลหรือไม่"))
                        {
                              return true;
                        }
                        else
                        {
                              return false;
                        }

                  });
            });
    </script>

@endsection