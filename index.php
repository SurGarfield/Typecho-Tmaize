<?php
/**
 * tmaize
 * 原作者：https://github.com/TMaize/tmaize-blog
 * @package tmaize
 * @author <a href="https://imxxz.cn">森木志</a>
 * @version 1.0.0
 * @link https://imxxz.cn
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 ?>
<div class="page page-index">
<div class="list-post">

      <ul>

        <?php while($this->next()): ?>
        <li>
          <span class="date"><?php $this->date('Y/m/d'); ?></span>
          <div class="title">
            <a href="<?php $this->permalink() ?>" class="hover-underline"><?php $this->title() ?></a>
          </div>
          <div class="categories">
          <?php $this->category(','); ?>
          </div>
        </li>
        <?php endwhile; ?>

      </ul>

    </div>
    <?php $this->need('fenye.php'); ?>
</div>
<?php $this->need('footer.php'); ?>