<?php
/**
 * <font color="#c3d825">有毒，优读，有读，</font><font color="#83ccd2">有毒是因为这是一个代码全是我自己弄的模板，可能会有很大的问题；</font><font color="#e198b4">优读是想让自己能够更好的阅读别人的一些优秀文章；</font><font color="#aacf53">有读是希望更多的人能够阅读更多的书籍作品来积累内含。</font>
 * 
 * @package Yodu
 * @author Jrotty
 * @version 5.3.0
 * @link http://qqdie.com
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/** 文章置顶 */
$sticky = $this->options->sticky; //置顶的文章cid，按照排序输入, 请以半角逗号或空格分隔
if($sticky && $this->is('index') || $this->is('front')){
    $sticky_cids = explode(',', strtr($sticky, ' ', ','));//分割文本 
    $sticky_html = "<span style='color:red'>[置顶] </span>"; //置顶标题的 html
    $db = Typecho_Db::get();
    $pageSize = $this->options->pageSize;
    $select1 = $this->select()->where('type = ?', 'post');
    $select2 = $this->select()->where('type = ? && status = ? && created < ?', 'post','publish',time());
    //清空原有文章的列队
    $this->row = [];
    $this->stack = [];
    $this->length = 0;
    $order = '';
    foreach($sticky_cids as $i => $cid) {
        if($i == 0) $select1->where('cid = ?', $cid);
        else $select1->orWhere('cid = ?', $cid);
        $order .= " when $cid then $i";
        $select2->where('table.contents.cid != ?', $cid); //避免重复
    }
    if ($order) $select1->order(null,"(case cid$order end)"); //置顶文章的顺序 按 $sticky 中 文章ID顺序
    if ($this->_currentPage == 1) foreach($db->fetchAll($select1) as $sticky_post){ //首页第一页才显示
        $sticky_post['sticky'] = $sticky_html;
        $this->push($sticky_post); //压入列队
    }
$uid = $this->user->uid; //登录时，显示用户各自的私密文章
    if($uid) $select2->orWhere('authorId = ? && status = ?',$uid,'private');
    $sticky_posts = $db->fetchAll($select2->order('table.contents.created', Typecho_Db::SORT_DESC)->page($this->_currentPage, $this->parameter->pageSize));
    foreach($sticky_posts as $sticky_post) $this->push($sticky_post); //压入列队
    $this->setTotal($this->getTotal()-count($sticky_cids)); //置顶文章不计算在所有文章内
}
?>
  <?php $this->need('header.php'); ?> <?php $this->need('sidebar.php');?>
<?php if ($this->is('archive', 404)): ?><article>
<div id="post" class="post">
<h1 class="title">404Page Not Found</h1><div class="content">
<p>页面不存在或文章被管理员删除！！！</p>
</div></div></article> <?php else: ?>
<?php if($this->is('index')||$this->is('front')): ?><?php if ($this->options->goga): ?><div class="intro" id="intro">公告<br><span><?php $this->options->goga(); ?></span></div><?php endif; ?> <?php else: ?> 
<div class="intro" id="intro"><?php $this->archiveTitle(array(
'category'=>_t(' %s '),
'search'=>_t('包含关键字 %s 的文章'),
'tag' =>_t('标签 %s 下的文章'),
'author'=>_t('%s 的主页')
), '', ''); ?>
<?php if($this->is('category')){echo '<br><span>'.$this->getDescription().'</span>';} ?>
</div>
<?php endif; ?>
<article><?php if ($this->have()): ?><?php while($this->next()): ?>
<div class="post" itemscope itemtype="http://schema.org/BlogPosting">
<?php if($this->options->slimg && 'guanbi'==$this->options->slimg): ?>
<?php else: ?>
<?php if($this->options->slimg && 'showoff'==$this->options->slimg): ?><a href="<?php $this->permalink() ?>" ><?php showThumbnail($this); ?></a>
<?php else: ?><a href="<?php $this->permalink() ?>" >
<div class="index-img">
<div class="tutu">
<img class="b-lazy"
	 src="<?php echo theurl; ?>images/load.gif"
	 data-src="<?php showThumbnail($this); ?>" alt="<?php $this->excerpt(90, '...'); ?>" itemprop="image" data-no-instant/>
                </div></div></a>

        <?php endif; ?>
        <?php endif; ?>

<h1 class="title" itemprop="name headline"><a itemprop="url" href="<?php $this->permalink() ?>"><?php $this->sticky(); $this->title(); ?></a>
</h1>
<?php if (!empty($this->options->sidebarBlock) && !in_array('card', $this->options->sidebarBlock)): ?> 
<div class="meta">
 <time itemprop="datePublished" content="<?php $this->date('Y-m-j  H:i'); ?>"> <?php $this->date(); ?> 	
    </time><span>in </span>
   <a class="category-link"><?php $this->category(',', true, '木有分类或者该分类已被删除'); ?></a>
 <?php if (!empty($this->options->sidebarBlock) && in_array('readnum', $this->options->sidebarBlock)): ?><span>read (<?php get_post_view($this) ?>)</span><?php endif;?> 
 <?php if (!empty($this->options->sidebarBlock) && in_array('bianjii', $this->options->sidebarBlock)): ?><span style="margin-left: 6px;font-size: 12px;color: #fff;background: pink;border-radius: 2px;padding: 0 3px;box-shadow: 0 0 8px pink;opacity: .8;display: inline-block;margin: 0 5px;" itemprop="author" itemscope itemtype="http://schema.org/Person"><?php switch ($this->author->group) {case 'administrator':_e('站长');break;case 'editor': _e('特约编辑');break; default: break;} ?><?php $this->author(); ?></span><?php endif;?>

<?php if($this->user->hasLogin()):?>
<code class="notebook">
  <a href="<?php $this->options->adminUrl(); ?>write-post.php?cid=<?php echo $this->cid;?>" class="category-link"  target="_blank">编辑</a></code>
<?php endif;?>
</div>
<?php endif;?>
<div class="content" itemprop="articleBody">
<?php if ($this->fields->lock): ?>文章已加密，请打开文章输入密码观看内容。
 <?php else: ?><?php $this->excerpt(140, '...'); ?>
<?php endif; ?>
<p class="more"> <a  href="<?php $this->permalink() ?>" >阅读全文</a></p>
</div>

<?php if (!empty($this->options->sidebarBlock) && in_array('card', $this->options->sidebarBlock)): ?> 
<div class="meta"><span class="icon-calendar"></span>
 <time itemprop="datePublished" content="<?php $this->date('Y-m-j  H:i'); ?>"><?php $this->date(); ?></time>

<span class="icon-tags"></span>
   <a class="category-link"><?php $this->category(',', true, '木有分类或者该分类已被删除'); ?></a>

 <?php if (!empty($this->options->sidebarBlock) && in_array('readnum', $this->options->sidebarBlock)): ?>
<span class="icon-xin"></span>&nbsp;<span>read (<?php get_post_view($this) ?>)</span><?php endif;?> 
<span class="xuyin">
   <?php if (!empty($this->options->sidebarBlock) && in_array('zishu', $this->options->sidebarBlock)): ?><span class="icon-xie"></span>&nbsp;<span><?php echo art_count($this->cid); ?>汉字</span><?php endif;?><?php if (!empty($this->options->sidebarBlock) && in_array('bianjii', $this->options->sidebarBlock)): ?><span style="margin-left: 6px;font-size: 12px;color: #fff;background: pink;border-radius: 2px;padding: 0 3px;box-shadow: 0 0 8px pink;opacity: .8;display: inline-block;margin: 0 5px;" itemprop="author" itemscope itemtype="http://schema.org/Person"><?php switch ($this->author->group) {case 'administrator':_e('站长');break;case 'editor': _e('特约编辑');break; default: break;} ?><?php $this->author(); ?></span><?php endif;?>

<?php if($this->user->hasLogin()):?>
<code class="notebook">
  <a href="<?php $this->options->adminUrl(); ?>write-post.php?cid=<?php echo $this->cid;?>" class="category-link"  target="_blank">编辑</a></code>
<?php endif;?>
</span>
</div>

<?php endif;?>
</div>

<?php endwhile; ?>
<nav class="page">
<?php if (!empty($this->options->jrottytool) && in_array('cnhan', $this->options->jrottytool)): ?>

 <?php $this->pageLink('<xt class="btn--two"><i class="iconfont icon-zuo text-base mr"></i><span>上一页</span></xt>'); ?>
<?php $this->pageLink('<xt class="btn--two"><span>下一页</span><i class="iconfont icon-you text-base ml"></i></xt>','next'); ?><?php if(ceil($this->getTotal() / $this->parameter->pageSize)>1): ?><div class="page-right">页码
<?php if($this->_currentPage>1) echo $this->_currentPage;  else echo 1;?> <span>/</span> <?php echo   ceil($this->getTotal() / $this->parameter->pageSize); ?></div><?php endif; ?>

<?php else: ?>
 <?php $this->pageLink('<xt class="btn--two"><i class="iconfont icon-zuo text-base mr"></i><span>NEWER</span></xt>'); ?>
<?php $this->pageLink('<xt class="btn--two"><span>OLDER</span><i class="iconfont icon-you text-base ml"></i></xt>','next'); ?>
<?php if(ceil($this->getTotal() / $this->parameter->pageSize)>1): ?><div class="page-right">PAGE
<?php if($this->_currentPage>1) echo $this->_currentPage;  else echo 1;?> <span>OF</span> <?php echo   ceil($this->getTotal() / $this->parameter->pageSize); ?></div>
<?php endif; ?>
<?php endif; ?>
</nav>
 <?php else: ?>
<?php if ($this->is('category')) : ?>该分类下没有任何文章。<?php else: ?><?php if ($this->is('tag')) : ?>该标签下没有任何文章。<?php else: ?>暂无与之相关文章<?php endif; ?><?php endif; ?><?php endif; ?>
</article>
<?php endif; ?>

<?php $this->need('footer.php');?>