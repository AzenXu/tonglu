<?php
/**
 * @overview 通用头部
 * @author Meathill <meathilL@gmail.com>
 * @since 1.0
 *
 * Date: 2018/6/17
 * Time: 上午12:26
 */

// 对应tonglu/template/header.html模板，主要实现页面<head>部分内容
// 会覆盖wordpress中默认的head内容，插入自己定义的内容 - head部分知识点介绍文章：移动前端不得不了解的html5 head头标签
//

global $page, $paged;
$page_num = $page > 2 || $paged > 2 ? ' | ' . sprintf(__('第 %s 页'), max($paged, $page)) : '';

// 提取描述和关键词
$tags = $description = '';
if (is_single()) { // 如果是独立页面，先展示「摘录」 - get_the_excerpt()
  $description = apply_filters('the_excerpt', get_the_excerpt());
  $post_tags = get_the_terms(0, 'post_tag');
  $tags = ',';
  if ($post_tags) {
    foreach ($post_tags as $tag) {
      $tags .= $tag->name . ',';
    }
  }
  $tags = substr($tags, 0, -1);
}

// 适配微信小程序 webview
$pid = (int)$_GET['wx'];
$blog_class = get_body_class($pid ? 'wx-app-webview' : null);

$home_url = esc_url(home_url('/', is_ssl() ? 'https' : 'http'));

// 注意：此页面关键点
$result = array(
  'title' => wp_title('|', FALSE, 'right') . get_bloginfo('name') . $page_num, // 显示在title标签里的
  'description' => $description ? $description : get_bloginfo('description'),   // 都调用wordpress提供的函数 - 所有文章/页面相关的，wordpress都提供了API可调用
  'keywords' => $tags,
  'pingback' => get_bloginfo('pingback_url'),
  'home_url' => $home_url,
  'theme_url' => get_theme_root_uri() . '/' . get_template(),
  'name' => get_bloginfo('name'),
  'name_title' => esc_attr(get_bloginfo('name', 'display')),
  'nav' => tonglu_bootstrap_nav(),
  'body_class' => join( ' ',  $blog_class),
);

// 为了保证wp_head的输出
$template = dirname(__FILE__) . '/template/header.html';
$template = file_get_contents($template); // 读前端通过gulp生成的本地模板
$tpl = new Mustache_Engine([
  'cache' => '/tmp/',
]);
$html = $tpl->render($template, $result);   // 使用mustache把模板和字符渲染起来
$htmls = explode('<!-- wp_head -->', $html);
echo $htmls[0];
wp_head();
echo $htmls[1];
