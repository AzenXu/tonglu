Demo中放pug文件
- 使用Pug模板语言
- 最终会编译成html（使用gulpfile.babel.js输出）
    - 生成的html文件用来调试，用于辅助把样式写好
- 输出tonglu/template目录下的模板文件
    - 使用gulp.task('template'
    - 把写好的pug文件，先进行一次替换（使用mustache.php模板）

模板说明：
1. category - 分类列表页 - 对应文章中的分类目录
2. homepage - 首页
3. house - 特殊文章页
4. list - 企业列表页
5. location - house的分类目录列表页
6. metaBox - 一个小的子页面
7. page - 就是page
8. single - 对应的是wordpress中的post，某一篇文章
