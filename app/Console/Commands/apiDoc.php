<?php

namespace App\Console\Commands;

use App\Http\Models\Decorator\Compent;
use App\Http\Models\Decorator\DecoratorA;
use App\Http\Models\Decorator\DecoratorB;
use App\Http\Models\Proxy\Proxy as AppProxy;
use Illuminate\Console\Command;

class apiDoc extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:doc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '创建api文档';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $id = $this->ask('要修改哪个api，请输入id');

        $url = 'http://47.111.188.36:8089/edit.php?id=' . $id;
        $data['interface_path'] = 'get.api/Impl/implConfig/{Id}'; //api地址
        $data['interface_explain'] = '客户管理：客户列表';  //api名称
        $data['interface_author'] = '周涛'; //作者
        $data['interface_level'] = 3; //难度
        $data['comment'] = '';
        $data['submit_flag'] = '提交';
        //参数
        //参数名
        $param['name'] = ['page', 'pageSize', 'search.userName', 'search.mobile', 'search.inviteCode'];
        //参数类型
        $param['type'] = ['int', 'int', 'array', 'array','array'];
        //参数实例
        $param['example']= ['1', '10', '[like, 张三]', '[like, 183]','[like, 123]'];
        //参数说明
        $param['explain'] = ['页码', '每页数量', '模糊搜索用户名', '模糊搜索手机号','模糊搜索邀请码'];
        $data['param'] = $param;
        $data['return'] = '{"status":0,"msg":"Success","timeStamp":"2019-10-23 11:18:14","data":{"data":[{"id":"id","userName":"用户名","mobile":"手机","email":"邮箱","inviteCode":"邀请码","createdAt":"注册时间"}]}}';

        $req = \Httpful\Request::post($url)
                ->sendsForm()
                ->addHeaders(['Cookie'=> 'userName==U2FsdGVkX19prT35lSoK/1AjjMijS2ZzDFfUBs3cCWA=; userPwd==U2FsdGVkX1+36fM4WmMftRZjGIN5LCQS4Z15HpJUmv0=; PHPSESSID=dld15c306s2695g86ginjvdph3'])
                ->body($data);
        // dd($req);
        $res = $req->send();
        // dd($res);
        $body = $res->body;
        dd($body);
        // return $body;

    }
}
