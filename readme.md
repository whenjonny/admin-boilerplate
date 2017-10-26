# Pires Admin Framework

### Laravel 5.4 Boilerplate - with Infyom Generator

[Click here for the official documentation](http://laravel-boilerplate.com/5.4/documentation.html)

### Official Generator Documentation / Laravel 5.3

[Click here for the official documentation](http://labs.infyom.com/laravelgenerator/docs)

### With Datatables / 6.*

[Click here view code](https://github.com/yajra/laravel-datatables)

## Basic Usage

    sudo chmod -R 777 storage/ bootstrap/

    composer install
    
    npm install

    #yarn

    Create Database & Change Env
	
	cp .env.example .env

    php artisan key:generate

    php artisan migrate

    php artisan db:seed

## Generate code
    
### 查看生成代码的具体脚本
    [Click here view helper](http://labs.infyom.com/laravelgenerator/docs/5.3/getting-started#field-inputs)

### 后台模版案例参考
    http://adminlte.la998.com/

## 操作记录 

### 编写数据库模型文件

    1. 约定:
        最后一个单词为数据表名
        表名大写且不带后缀
        
        resources/model_schemas/Post

    2. 编写规则

        title string,255 text required null
        summary string,255:nullable:default,'' text required null
        description string,255 text required ii
        具体参考 #[generate code](#generate-code)

    3. 生成后台 

        php artisan infyom:parser Post
    
    4. 生成接口

        php artisan infyom:rest Post

    注意：生成的代码会覆盖，善于使用git 
