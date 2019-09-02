{{--当前页面的用户id 不等于访问的id 才会显示关注的按钮--}}
@if($target_user->id != \Auth::id())
    <div>
        @if($target_user->hasFan(\Auth::id()))
            {{--like-user 表示关注或者取关的用户id  like-value表示是否已经关注  1关注 0未关注--}}
            <button class="btn btn-default like-button" like-value="1" like-user="{{$target_user->id}}" _token="{{csrf_token()}}" type="button">取消关注</button>
        @else
            <button class="btn btn-default like-button" like-value="0" like-user="{{$target_user->id}}" _token="{{csrf_token()}}" type="button">关注</button>
        @endif
    </div>
@endif

