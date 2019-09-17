@extends("layout.main")

@section("content")

    <div class="col-sm-8 blog-main">
        <form class="form-horizontal" action="/user/{{\Auth::id()}}/setting" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
                <label class="col-sm-2 control-label">用户名</label>
                <div class="col-sm-10">
                    <input class="form-control" name="name" readonly type="text" value="{{$me->name}}">

                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">头像</label>
                <div class="col-sm-2">
                    <input class=" file-loading preview_input" type="file" value="用户名" style="width:250px" name="avatar">
                    <img width="100"  class="preview_img" src="{{$me->avatar}}" alt="" class="img-rounded" style="border-radius:500px;margin-top: 10px;">
                </div>
            </div>
            <button type="submit" class="btn btn-default">修改</button>
        </form>
        <br>

    </div>

@endsection