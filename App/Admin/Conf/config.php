<?php
return array(
	//'配置项'=>'配置值'

	 /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',          // 数据库类型
    'DB_HOST'               =>  'localhost',      // 服务器地址
    'DB_NAME'               =>  'recruitment',    // 数据库名
    'DB_USER'               =>  'root',           // 用户名
    'DB_PWD'                =>  '',               // 密码
    'DB_PORT'               =>  '',               // 端口
    'DB_PREFIX'             =>  'it_',            // 数据库表前缀
    'DB_FIELDTYPE_CHECK'    =>  false,            // 是否进行字段类型检查
    'DB_FIELDS_CACHE'       =>  true,             // 启用字段缓存
    'DB_CHARSET'            =>  'utf8',           // 数据库编码默认采用utf8

    //RBAC认证配置信息
    'RBAC_SUPERADMIN'=>'admin',                              //超级管理员名称 对应users表中某一用户名
    'ADMIN_AUTH_KEY' =>'superadmin',                         //超级管理员识别

    'USER_AUTH_ON' => true,                                  //是否需要认证
    'USER_AUTH_TYPE'=>1,                                     //认证类型 1为登录后才认证 2为实时认证
    'USER_AUTH_KEY'=>'authid',                               //认证识别号
    'REQUIRE_AUTH_MODULE'=>'JobType,Apply,Resume,Enterprise,BroEnterprise,Hot,Advantages,Link,Role,UserEnterprise,UserWorker,Admin,SystemInfo,Slides,Access,Collection', //需要认证模块
    'NOT_AUTH_MODULE'=>'Index,Login',                        //无需认证模块
    'NOT_AUTH_ACTION'=>'insert,update,save,updateTitle,setSwitch',  //无需认证方法
    // 'USER_AUTH_GATEWAY'                                   //认证网关
    // 'RBAC_DB_DSN'                                         //数据库连接DSN
    'RBAC_ROLE_TABLE'=>'it_role',                            //角色表名称
    'RBAC_USER_TABLE'=>'it_role_user',                       //用户表名称
    'RBAC_ACCESS_TABLE'=>'it_access',                        //权限表名称
    'RBAC_NODE_TABLE'=>'it_node'                             //节点表名称
);