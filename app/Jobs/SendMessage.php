<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    //私有属性  代表 发布的通知
    private $notice;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(\App\Notice $notice)
    {
        //调用属性
        $this->notice = $notice;
    }

    /**
     * Execute the job.
     * 通知每个前台用户系统消息
     * @return void
     */
    public function handle()
    {
        //获取所有用户
        $users = \App\User::all();
        //遍历每个用户 给每个用户发布通知
        foreach ($users as $user) {
            $user->addNotice($this->notice);
        }
    }
}
