<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostTopic;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller
{
    //列表页
    public function index(){
        $user = Auth::user();
        $notices = $user->notices;
        return view('notice/index',compact('notices'));
    }
}
