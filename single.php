<?php
/**
 * 文章页
 * @author Meathill <meathill@gmail.com>
 * @since 1.0.0
 *
 * Date: 2018/6/18
 * Time: 下午2:10
 */

// 页面都是这么写的：头部、身体、脚，最后输出一个完整的文章

get_header(); // 渲染页面头部

if (have_posts()) { // 读文章部分的内容 - 参考其他主题的实现就好
  while (have_posts()) {
    the_post();

    $tags = get_the_tags();
    $links = array();
    foreach ($tags as $tag) {
      $links[] = '<a href="/tag/'.$tag->slug.'">'.$tag->name.'</a>';
    }
    $content = get_the_content('继续阅读');
    $blog = array(
      'id' => get_the_ID(),
      'is_featured' => is_sticky() && is_home() && ! is_paged(),
      'blog_class' => join(' ', get_post_class($class, $post_id)),
      'full_title' => the_title_attribute(array('echo' => FALSE)),
      'is_search' => is_search(),
      'link' => apply_filters('the_permalink', get_permalink()),
      'date' => apply_filters('the_time', get_the_time('Y-m-d'), 'Y-m-d'),
      'excerpt' => apply_filters('the_excerpt', get_the_excerpt()),
      'content' => apply_filters('the_content', $content),
      'category' => get_the_category_list('<li class="breadcrumb-item">'),
      'tags' => implode(' ', $links),
      'thumbnail' => get_the_post_thumbnail_url(),
    );
  }
}


$tpl = new Mustache_Engine();   // 模板渲染
$template = dirname(__FILE__) . '/template/single.html';
$template = file_get_contents($template);
echo $tpl->render($template, $blog); // 数据渲染到字符上，做输出

get_footer(); // 渲染页面尾部
