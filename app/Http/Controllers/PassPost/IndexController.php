<?php

namespace App\Http\Controllers\PassPost;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\UserModel;
use Illuminate\Support\Facades\Redis;

class IndexController extends Controller
{
    //
    public function register(){
        return view('user.register');
    }
    public function registerdo(Request $request){
        if(empty($request->input('username'))){
            $arr=[
                'error'=>401,
                'msg'=>'账号不能为空'
            ];
            echo json_encode($arr);die;
        }
        $where=[
            'username'=>$request->input('username')
        ];
        $rel=UserModel::where($where)->first();
        if($rel){
            $arr=[
                'error'=>402,
                'msg'=>'账号已注册'
            ];
            echo json_encode($arr);die;
        }
        if(empty($request->input('pwd'))){
            $arr=[
                'error'=>403,
                'msg'=>'密码不能为空'
            ];
            echo json_encode($arr);die;
        }
        if($request->input('pwd')!==$request->input('pwd1')){
            $arr=[
                'error'=>404,
                'msg'=>'两次输入密码不正确'
            ];
            echo json_encode($arr);die;
        }
        $data=[
            'username'=>$request->input('username'),
            'pwd'=>password_hash($request->input('pwd'),PASSWORD_BCRYPT),
            'age'=>$request->input('age'),
            'email'=>$request->input('email'),
            //'atime'=>time()
        ];
        $uid=UserModel::insertGetId($data);
        if($uid){
            $token = substr(md5(time().mt_rand(1,99999)),10,20);
            setcookie('uid',$uid,time()+86400,'/','tactshan.com',false,true);
            setcookie('token',$token,time()+86400,'/','tactshan.com',false,true);
            //header("refresh:2;/test/list");
            $arr=[
                'error'=>0,
                'msg'=>'注册成功',
                'data'=>[
                    'token'=>$token
                ]
            ];
            echo json_encode($arr);
        }else{
            header('Location:/user/register');
            $arr=[
                'error'=>405,
                'msg'=>'注册失败'
            ];
            echo json_encode($arr);
        }
    }
    public function login(){
        return view('user.login');
    }
    public function logindo(Request $request){
        $username=$request->input('username');
        $pwd=$request->input('pwd');
        $where=[
            'username'=>$username
        ];
        $res=UserModel::where($where)->first();
        if($res){
            if(password_verify($pwd,$res->pwd)){
                $redis_token='redis_token_str:'.$res->uid.'';
                $token = substr(md5(time().mt_rand(1,99999)),10,20);
                setcookie('uid',$res->uid,time()+86400,'/','tactshan.com',false,true);
                setcookie('token',$token,time()+86400,'/','tactshan.com',false,true);
                //header('refresh:1;/goodslist');
                Redis::hset($redis_token,'token',$token);
                $arr=[
                    'error'=>0,
                    'msg'=>'登录成功',
                    'data'=>[
                        'token'=>$token
                    ]
                ];
                echo json_encode($arr);
            }else{
                //header('refresh:1;/user/login');
                $arr=[
                    'error'=>40003,
                    'msg'=>'账号密码错误'
                ];
                echo json_encode($arr);
            }
        }else{
            //header('refresh:1;/user/login');
            $arr=[
                'error'=>40004,
                'msg'=>'账号不存在'
            ];
            echo json_encode($arr);
        }
    }
}
