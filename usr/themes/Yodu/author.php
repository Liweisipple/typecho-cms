<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>  <?php $this->need('header.php'); ?> <?php $this->need('sidebar.php');?>


   <article>
<div id="post" class="post"><div class="content"><?php if ($this->have()): ?> 

<h4 class="archive-title">
           <?php $this->author->name() ?>的信息<img src="<?php $url = Typecho_Widget::widget('Widget_Options')->gravatars;echo 'https://'.$url.'/'.md5(strtolower($this->author->mail)); ?>?s=140" class="txtx">

        </h4>
 <ul>
<li style="display: block;">称呼：<?php $this->author->name() ?>  </li>
<li style="display: block;">主页：<a href="<?php $this->author('url'); ?>"><?php $this->author('url'); ?></a></li>
<li style="display: block;">联系：<a href="mailto:<?php $this->author('mail'); ?> " target="_blank" rel="external"><?php $this->author('mail'); ?> </a></li> 
<li style="display: block;">用户组：<?php switch ($this->author->group) {case 'administrator':_e('管理员');break;case 'editor': _e('编辑');break; case 'contributor': _e('贡献者'); break;case 'subscriber': _e('关注者'); break; case 'visitor':_e('访问者'); break; default: break;} ?></li>
<li style="display: block;">撰写文章：<?php echo allpostnum($this->author->uid); ?> 篇</li>


                    <?php if($this->user->hasLogin()):?><div style="float:right">
  <a href="<?php $this->options->adminUrl(); ?>profile.php" class="category-link"  target="_blank">编辑</a></div>
<?php endif;?>
                 
</ul>




<div id="posts-list-<?php $this->author->name() ?>" class="archive box" data-category="<?php $this->author->name() ?>"> <h4 class="archive-title"> <?php $this->author->name() ?>的文章 </h4> 
<ul class="archive-posts archive-month"> 
  <?php while($this->next()): ?>

<li class="li_guidang archive-day"> <a class="guidang"  href="<?php $this->permalink() ?>"><?php $this->title() ?></a> <span class="date"><?php $this->date('M d,Y'); ?></span> </li> 


 <?php endwhile; ?> 
</ul>


 </div>


 </div>



 </div>

<nav class="page"> <?php $this->pageLink('<xt class="btn--one"><i class="iconfont icon-zuo text-base mr"></i><span>NEWER</span></xt>'); ?>
<?php $this->pageLink('<xt class="btn--one"><span>OLDER</span><i class="iconfont icon-you text-base ml"></i></xt>','next'); ?><?php if(ceil($this->getTotal() / $this->parameter->pageSize)>1): ?><div class="page-right">PAGE
<?php if($this->_currentPage>1) echo $this->_currentPage;  else echo 1;?> <span id="txt" onclick="$.Eggs()">OF</span> <?php echo   ceil($this->getTotal() / $this->parameter->pageSize); ?></div><?php endif; ?></nav>

 <?php else: ?>该用户很懒，没有写任何文章！！！ <?php endif; ?></article>
 <?php $this->need('footer.php');?>

