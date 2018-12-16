通路有家官网模板
=============

WordPress 主题

## 功能

1. 自定义模板，分类
2. 独立前端开发环境

## 使用说明
1. composer.json安装依赖



## 补充说明
1. 没有现成的style.css文件 - 因为这个文件是通过ui-src/stylus编译出来的，一开始木有
2. functions.php中放常用函数
    1. 这个文件一定会被加载
    2. 使用getcomposer.org（pnp的包管理工具） 管理php的包
    3. 依赖的包写在了composer.json中
        1. 这里只依赖了mustache
        2. 安装依赖之后，会生成vendor目录，安装依赖的包
