<!DOCTYPE html>
<html>
<head>
  <title><?php $this->archiveTitle(array(
    'category'  =>  _t('分类 %s 下的文章'),
    'search'    =>  _t('包含关键字 %s 的文章'),
    'tag'       =>  _t('标签 %s 下的文章'),
    'author'    =>  _t('%s 发布的文章')
), '', ' - '); ?><?php $this->options->title(); ?></title>
  <meta charset="utf-8" />
  <meta http-equiv="content-language" content="zh-CN" />
  <meta name="theme-color" content="#ffffff" />
  <meta name="supported-color-schemes" content="light dark">
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="applicable-device" content="pc,mobile">
  <link rel="stylesheet" href="<?php $this->options->themeUrl('css/common.css'); ?>">
  <link rel="stylesheet" href="<?php $this->options->themeUrl('css/theme-dark.css'); ?>">
  <link rel="stylesheet" href="<?php $this->options->themeUrl('css/page.css'); ?>">
  <link rel="stylesheet" href="<?php $this->options->themeUrl('css/post.css'); ?>">
  <link rel="stylesheet" href="<?php $this->options->themeUrl('css/code-dark.css'); ?>">
  <link rel="stylesheet" href="<?php $this->options->themeUrl('css/code-light.css'); ?>">
  <link rel="stylesheet" href="<?php $this->options->themeUrl('css/nprogress.min.css'); ?>">
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery@3/dist/jquery.min.js"></script>
  <script>
    window.blog = {
      baseurl:"",
      buildAt:"20210228214940",
      darkTheme: false,
      setDarkTheme: function (dark) {
        this.darkTheme = Boolean(dark);
        document.documentElement.className = this.darkTheme ? 'dark': '';
        document.querySelector('meta[name=theme-color]').setAttribute('content', this.darkTheme ? '#2D2E32': '#FFFFFF');
      }
    }
    if (sessionStorage.darkTheme !== undefined) {
      blog.setDarkTheme(sessionStorage.darkTheme === 'true'); // 记忆值，单个窗口内有效
    } else {
      blog.setDarkTheme(window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches); // 跟随系统
    }
    if (window.matchMedia) {
      var media = window.matchMedia('(prefers-color-scheme: dark)');
      media.addListener(function (ev) {
        blog.setDarkTheme(ev.currentTarget.matches);
        sessionStorage.removeItem('darkTheme');
      });
    }
  </script>
   <?php $this->header(); ?>
</head>
<body ondragstart="return false;">
<header class="header">
  <img class="logo" src="<?php $this->options->logoUrl();?>" alt="logo"/>
  <nav class="menu">
    <a href="<?php $this->options->siteUrl(); ?>" class="hover-underline">首页</a>
    <?php $this->widget('Widget_Contents_Page_List')
               ->parse('<a href="{permalink}" class="hover-underline">{title}</a>'); ?>
    </nav>
</header>
<div id="pjax">
