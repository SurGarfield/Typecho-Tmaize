<?php $this->need('header.php'); ?>
<?php $this->header('commentReply=1&description=0&keywords=0&generator=0&template=0&pingback=0&xmlrpc=0&wlw=0&rss2=0&rss1=0&antiSpam=0&atom'); ?>
<div class="page page-post">
  <h1 class="title" id="<?php $this->title() ?>"><?php $this->title() ?></h1>
  
  <div class="subtitle"><?php $this->author(); ?> 于 <?php $this->date('Y-m-d'); ?> 发布</div>
  
  <div class="post">
  <?php $this->content(); ?>
  </div>
  <?php $this->need('comments.php'); ?>
  </div>

  <?php $this->need('footer.php'); ?>
 