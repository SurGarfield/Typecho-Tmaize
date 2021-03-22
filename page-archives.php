<?php
/**
* 文章归档
*
* @package custom
*/
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
<div class="page page-categories">
  <div class="list-category">
    <h2>所有分类</h2>
    <div>
    <?php $this->widget('Widget_Metas_Category_List')
               ->parse('<a href="{permalink}">{name}</a>'); ?>
    </div>
  </div>

  <?php $archives = archives($this); $index = 0; foreach ($archives as $year => $posts): ?>
  <div class="list-post">
    <h2 id="Python"><?php echo $year; ?></h2>
    <ul>
    <?php foreach($posts as $created => $post ): ?>
      <li>
        <span class="date"><?php echo date('Y/m/d', $created); ?></span>
        <div class="title">
          <a href="<?php echo $post['permalink']; ?>" class="hover-underline"><?php echo $post['title']; ?></a>
        </div>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
  <?php endforeach; ?>



</div>
<?php $this->need('footer.php'); ?>