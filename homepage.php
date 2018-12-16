<?php
/*
Template Name: Homepage
*/

// 模板页的写法，顶部定义了Template Name之后，wordpress会在创建页面的时候，让你的页面在「页面属性」中可选
// 通用做法：在后台创建页面，然后选择「模板」
// homepage，大部分内容已经在模板中写好了，只有少部分需要在后台中写 - 标题、内容（建议不要放太多富文本内容在wordpress后台中，不然结构会乱）、图片

/**
 * 首页模板
 *
 * @author Meathill <meathill@gmail.com>
 * @since 1.0.0
 *
 * Date: 2018/6/17
 * Time: 下午11:49
 */

get_header();

$tpl = new Mustache_Engine([
  'cache' => '/tmp/',
]);

while (have_posts()) {
  the_post();

  $title = get_the_title();

  // 手機端的空格替換成換行
  $title = preg_replace('/\s+/', '<span class="d-none d-sm-inline">$0</span><br class="d-sm-none">', $title);
  
  $content = get_the_content();
  $content = apply_filters( 'the_content', $content );
  $content = str_replace( ']]>', ']]&gt;', $content );
  $thumbnail = get_the_post_thumbnail_url();
  $result = [
    'title' => $title,
    'content' => $content,
    'thumbnail' => $thumbnail,
  ];
  $template = dirname(__FILE__) . '/template/homepage.html';
  $template = file_get_contents($template);
  $html = $tpl->render($template, $result);
  echo $html;
}

get_footer();
