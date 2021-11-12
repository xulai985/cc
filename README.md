# wxcloudrun-thinkphp
微信云托管 thinkphp 框架模版

简介：ThinkPHP (https://www.thinkphp.cn/) 是一个免费开源的，快速、简单的面向对象的轻量级PHP开发框架，创立于2006年初，遵循Apache2开源协议发布，是为了敏捷WEB应用开发和简化企业应用开发而诞生的。

详细介绍：

1. 本示例中，使用的是ThinkPHP 6.0.0，要求php版本大于7.1.0.实际采用的是php7.3.
   * 如需换用其他php版本，请到Dockerfile中修改基础镜像。
2. 本示例中，通过框架默认的8000端口对外。
   * 在代码中修改端口号之后，如果使用流水线部署版本，请确保container.config.json中的containerPort字段也同步修改；如果在微信云托管控制台手动「新建版本」，请确保“监听端口”字段与代码中端口号保持一致，否则会引发部署失败。
3. 在微信云托管控制台一键部署本示例，会同时自动开通环境内的MySQL服务并完成初始化，后续可直接使用。数据库的地址、帐号、密码会被作为环境变量默认注入，在database.php中直接引用。
   * 如不想使用微信云托管自带的MySQL，请手动修改databse.php中数据库信息并在微信云托管控制台注销MySQL。
   * 未通过一键部署按钮，而是直接使用本示例的代表进行部署，需要手动在微信云托管控制台中开通MySQL，且数据库信息不会默认注入。在新建版本时需要手动将数据库信息作为环境变量填入。
4. 基于示例二次开发操作步骤：
   * 在微信云托管控制台一键部署，完成服务创建、MySQL初始化、首个版本部署上线。
   * fork示例代码到自己的代码仓库，在此基础上进行二次开发。
   * 服务的第二个及后续版本，基于自己的代码仓库进行部署。
5. 代码仓库中的container.config.json文件仅用于在微信云托管中创建流水线。如果不使用流水线，而是用本项目的代码在微信云托管控制台手动「新建版本」，则container.config.json配置文件不生效。最终版本部署效果以「新建版本」窗口中手动填写的值为准。

示例API列表：

1 查询所有todo项

* URL路径：
  ```/api/todos```
  
* 请求示例：
```
curl -X GET  http://{ip}:{port}/api/todos
```

* 响应示例：
```
{
	"code": 0,
	"errorMsg": "",
	"data": [{
		"id": 1,
		"title": "工作1",
		"status": "准备中",
		"create_time": "2021-11-09T08:45:40Z",
		"update_time": "2021-11-09T08:45:40Z"
	}, {
		"id": 2,
		"title": "工作2",
		"status": "已开始",
		"create_time": "2021-11-09T08:46:11Z",
		"update_time": "2021-11-09T08:46:11Z"
	}]
}
```


2 根据ID查询todo项

* URL路径：
  ```/api/todos/:id```
  
* 请求示例：
```
curl -X GET  http://{ip}:{port}/api/todos/1
```

* 响应示例：
```
{
	"code": 0,
	"errorMsg": "",
	"data": {
		"id": 1,
		"title": "工作1",
		"status": "准备中",
		"create_time": "2021-11-09T08:45:40Z",
		"update_time": "2021-11-09T08:45:40Z"
	}
}
```


3 新增todo项目

* URL路径：
  ```/api/todos```
  
* 请求示例：
```
curl http://{ip}:{port}/api/todos \
  -X POST \
  -H 'Content-Type: application/json' \
  -d '{  
      "title":"工作1",
      "status":"准备中"
  }'
```

* 响应示例：
```
{
	"code": 0,
	"errorMsg": "",
	"data": {
		"id": 1,
		"title": "工作1",
		"status": "准备中",
		"create_time": "2021-11-09T08:45:40Z",
		"update_time": "2021-11-09T08:45:40Z"
	}
}
```

4 根据ID修改todo项目

* URL路径：
  ```/api/todos```
  
* 请求示例：
```
curl http://{ip}:{port}/api/todos \
  -X PUT \
  -H 'Content-Type: application/json' \
  -d '{  
      "id":1,
      "status":"已完成"
  }'
```

* 响应示例：
```
{
	"code": 0,
	"errorMsg": ""
}
```

5 根据ID删除todo项

* URL路径：
  ```/api/todos/:id```
  
* 请求示例：
```
curl http://{ip}:{port}/api/todos/1 \
  -X DELETE \
  -H 'Content-Type: application/json' \
  -d '{   }'
```

* 响应示例：
```
{
	"code": 0,
	"errorMsg": ""
}
```

