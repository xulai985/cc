<?php

namespace app\controller;

use app\BaseController;
use Error;
use Exception;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
use think\Request;
use app\model\ToDoList;
use think\response\Html;
use think\response\Json;

class Index extends BaseController
{

    /**
     * 主页静态页面
     */
    public function index(Request $request): Html
    {
        $html="<!doctype html><html lang=\"en\"><head><meta charset=\"utf-8\"/><link rel=\"icon\" href=\"https://cloudbase-run-todolist-92bb28a0d-1258016615.tcloudbaseapp.com/favicon.ico\"/><meta name=\"viewport\" content=\"width=device-width,initial-scale=1\"/><meta name=\"theme-color\" content=\"#000000\"/><meta name=\"description\" content=\"Web site created using create-react-app\"/><link rel=\"apple-touch-icon\" href=\"https://cloudbase-run-todolist-92bb28a0d-1258016615.tcloudbaseapp.com/logo192.png\"/><link rel=\"manifest\" href=\"https://cloudbase-run-todolist-92bb28a0d-1258016615.tcloudbaseapp.com/manifest.json\"/><title>Todo List</title><link href=\"https://cloudbase-run-todolist-92bb28a0d-1258016615.tcloudbaseapp.com/static/css/2.20aa2d7b.chunk.css\" rel=\"stylesheet\"><link href=\"https://cloudbase-run-todolist-92bb28a0d-1258016615.tcloudbaseapp.com/static/css/main.d8680f04.chunk.css\" rel=\"stylesheet\"></head><body><noscript>You need to enable JavaScript to run this app.</noscript><div id=\"root\"></div><script>!function(e){function t(t){for(var n,l,a=t[0],p=t[1],i=t[2],f=0,s=[];f<a.length;f++)l=a[f],Object.prototype.hasOwnProperty.call(o,l)&&o[l]&&s.push(o[l][0]),o[l]=0;for(n in p)Object.prototype.hasOwnProperty.call(p,n)&&(e[n]=p[n]);for(c&&c(t);s.length;)s.shift()();return u.push.apply(u,i||[]),r()}function r(){for(var e,t=0;t<u.length;t++){for(var r=u[t],n=!0,a=1;a<r.length;a++){var p=r[a];0!==o[p]&&(n=!1)}n&&(u.splice(t--,1),e=l(l.s=r[0]))}return e}var n={},o={1:0},u=[];function l(t){if(n[t])return n[t].exports;var r=n[t]={i:t,l:!1,exports:{}};return e[t].call(r.exports,r,r.exports,l),r.l=!0,r.exports}l.m=e,l.c=n,l.d=function(e,t,r){l.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},l.r=function(e){\"undefined\"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:\"Module\"}),Object.defineProperty(e,\"__esModule\",{value:!0})},l.t=function(e,t){if(1&t&&(e=l(e)),8&t)return e;if(4&t&&\"object\"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(l.r(r),Object.defineProperty(r,\"default\",{enumerable:!0,value:e}),2&t&&\"string\"!=typeof e)for(var n in e)l.d(r,n,function(t){return e[t]}.bind(null,n));return r},l.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return l.d(t,\"a\",t),t},l.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},l.p=\"https://cloudbase-run-todolist-92bb28a0d-1258016615.tcloudbaseapp.com/\";var a=this.webpackJsonptodo=this.webpackJsonptodo||[],p=a.push.bind(a);a.push=t,a=a.slice();for(var i=0;i<a.length;i++)t(a[i]);var c=p;r()}([])</script><script src=\"https://cloudbase-run-todolist-92bb28a0d-1258016615.tcloudbaseapp.com/static/js/2.18b41bed.chunk.js\"></script><script src=\"https://cloudbase-run-todolist-92bb28a0d-1258016615.tcloudbaseapp.com/static/js/main.bde3e603.chunk.js\"></script></body></html>";
        return response($html);
    }


    /**
     * 获取todo list
     */
    public function getToDoList(Request $request): Json
    {
        try {
            $toDoList = (new ToDoList)->select();
            $res = [
                "code" => 0,
                "data" => ($toDoList),
                "errorMsg" => "查询成功"
            ];
            return json($res);
        } catch (Error $e) {
            $res = [
                "code" => -1,
                "data" => [],
                "errorMsg" => ("查询todo list异常" . $e->getMessage())
            ];
            return json($res);
        }
    }


    /**
     * 根据主键ID查询todo数据
     */
    public function queryToDoById($id): Json
    {
        try {
            $toDoList = (new ToDoList)->find($id);
            $res = [
                "code" => 0,
                "data" => ($toDoList->getData()),
                "errorMsg" => "查询成功"
            ];
            return json($res);
        } catch (Error $e) {
            $res = [
                "code" => -1,
                "data" => [],
                "errorMsg" => ("查询todo异常" . $e->getMessage())
            ];
            return json($res);
        }
    }

    /**
     * 增加todo
     * @param Request $request
     * @return Json
     */
    public function addToDo(Request $request): Json
    {
        try {
            $toDoList = new ToDoList;
            $todo = $toDoList->create(["title" => $request->param("title"), "status" => $request->param("status"),]);
            $res = [
                "code" => 0,
                "data" => $todo,
                "errorMsg" => "插入成功"
            ];
            return json($res);

        } catch (Exception $e) {
            $res = [
                "code" => -1,
                "data" => [],
                "errorMsg" => ("新增todo异常" . $e->getMessage()),
            ];
            return json($res);
        }
    }

    /**
     * 根据ID删除todo
     * @param $id
     * @return Json
     */
    public function deleteToDoById($id): Json
    {
        try {
            ToDoList::destroy($id);
            $res = [
                "code" => 0,
                "data" => [],
                "errorMsg" => "删除todo成功"
            ];
            return json($res);
        } catch (Exception $e) {
            $res = [
                "code" => -1,
                "data" => [],
                "errorMsg" => ("删除todo异常" . $e->getMessage())
            ];
            return json($res);
        }
    }

    /**
     * 根据ID更新todo数据
     * @param Request $request
     */
    public function updateToDo(Request $request)
    {
        try {
            $allowField = array();
            if (null != $request->param("title")) {
                $allowField[] = "title";
            }
            if (null != $request->param("status")) {
                $allowField[] = "status";
            }

            ToDoList::update(
                ["title" => $request->param("title"), "status" => $request->param("status"),],
                ['id' => $request->param('id')],
                $allowField
            );

            $res = [
                "code" => 0,
                "data" => [],
                "errorMsg" => ""
            ];
            return json($res);
        } catch (Exception $e) {
            $res = [
                "code" => -1,
                "data" => [],
                "errorMsg" => ("更新todo异常" . $e->getMessage())
            ];
            return json($res);
        }
    }
}
