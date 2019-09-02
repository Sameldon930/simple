$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
});
var editor = new wangEditor('content');
if (editor.config) {
    // 上传图片（举例）
    editor.config.uploadImgUrl = '/posts/image/upload';
    editor.config.uploadHeaders = {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    };

    // 隐藏掉插入网络图片功能。该配置，只有在你正确配置了图片上传功能之后才可用。
    editor.config.hideLinkImg = true;
    editor.create();
}

//关注和取关
$(".preview_input").change(function (event) {
    var file = event.currentTarget.files[0];
    var url = window.URL.createEventObject(file);
    $(event.target).next(".preview_img").attr("src",url);
})
$(".like-button").click(function (event) {
    var target =  $(event.target);
    var current_like = target.attr('like-value');
    var user_id = target.attr("like-user");
    //如果是关注的状态 那么点击下去 就是取反 也就是取消关注
    if(current_like == 1){
        $.ajax({
            url:'/user/'+user_id+'/unfan',
            method:'post',
            dataType:"json",
            success:function (data) {
                if(data.error != 0){
                    alert(data.msg);
                    return;
                }
                target.attr("like-value",0);
                target.text("关注")
            }
        })
    }else{//
        $.ajax({
            url:'/user/'+user_id+'/fan',
            method:'post',
            dataType:"json",
            success:function (data) {
                if(data.error!=0){
                    alert(data.msg)
                    return
                }
                target.attr("like-value",1);
                target.text("取消关注")
            }
        })

    }
})