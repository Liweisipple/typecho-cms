<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8"/>
<meta name="author" content="jrotty,bssf@qq.com">
 <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"><meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="x-dns-prefetch-control" content="on"> 
<link rel="dns-prefetch" href="<?php echo theurl; ?>" />
<link rel="dns-prefetch" href="<?php $url = Typecho_Widget::widget('Widget_Options')->gravatars;echo 'https://'.$url.'/'; ?>" />
<meta http-equiv="Cache-Control" content="no-transform" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<meta property="og:type" content="blog"/>
<?php if($this->is('post')||$this->is('page')): ?>
<meta property="og:image" content="<?php if($this->options->slimg && 'guanbi'==$this->options->slimg ||  'showoff'==$this->options->slimg): ?><?php if ($this->options->logoUrl){ ?><?php $this->options->logoUrl();?><?php }else{ ?>//cdn.v2ex.com/gravatar/<?php echo md5(strtolower($this->author->mail)); ?>?s=140<?php };?><?php else: ?><?php showThumbnail($this); ?><?php endif; ?>"/>
<meta property="og:release_date" content="<?php $this->date('Y-m-j'); ?>"/>
<meta property="og:title" content="<?php $this->title(); ?>"/>
<meta property="og:description" content="<?php $this->description() ?>" />
<meta property="og:author" content="<?php $this->author(); ?>"/>
<?php else: ?>
<meta property="og:image" content="<?php if ($this->options->logoUrl){ ?><?php $this->options->logoUrl();?><?php }else{ ?>https://cdn.v2ex.com/gravatar/<?php echo md5(strtolower($this->author->mail)); ?>?s=140<?php };?>"/>
 <?php if ($this->options->starttime){ ?><meta property="og:release_date" content="<?php $this->options->starttime();?>"/><?php };?>
<meta property="og:title" content="<?php if($this->is('index')||$this->is('front')): ?><?php $this->options->title(); ?><?php else: ?><?php echo $this->getArchiveTitle(); ?><?php endif; ?>"/>
<meta property="og:description" content="<?php if($this->is('index')||$this->is('front')): ?><?php $this->options->description() ?><?php else: ?><?php echo $this->getArchiveSlug(); ?><?php endif; ?>" />
<meta property="og:author" content="<?php $this->author(); ?>"/>
<?php endif; ?>
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="theme-color" content="<?php 
if($this->options->skin && 'mr'==$this->options->skin){
if($this->options->color && 'red'==$this->options->color)echo '#F1587E';
elseif($this->options->color && 'purple'==$this->options->color)echo '#800080';
elseif($this->options->color && 'black'==$this->options->color)echo '#000000';
else echo '#00BDFF';
}else{
if('tea.css'==$this->options->skin)echo '#795548';
else echo '#ffffff';}?>">
<?php if (!empty($this->options->sidebarBlock) && in_array('ucqq', $this->options->sidebarBlock)): ?><meta name="full-screen" content="yes"><meta name="x5-fullscreen" content="true"><?php endif;?>
  <link rel="icon" href="/favicon.ico">
   <?php if(!empty($this->options->CDNURL)): ?><link rel="apple-touch-icon" href="<?php $this->options->CDNURL() ?>/YoDuCDN/images/favicon.png"><?php else: ?>
<link rel="apple-touch-icon" href="<?php echo theurl; ?>images/favicon.png">
<?php endif; ?>
 <!--[if lt IE 9]><style>body{overflow-y: hidden; }</style>
<div class="browsehappy" role="dialog"><a href="http://browsehappy.com/"><img  src="<?php echo theurl; ?>images/hj.png"><br>您的浏览器很滑稽，建议点击滑稽升级您的浏览器！</a></div>
<![endif]-->
<title><?php if($this->_currentPage>1) echo '第 '.$this->_currentPage.' 页 - '; ?><?php $this->archiveTitle(array(
'category'=>_t('分类 %s 下的文章'),
'search'=>_t('包含关键字 %s 的文章'),
'tag' =>_t('标签 %s 下的文章'),
'author'=>_t('%s 的主页')
), '', ' - '); ?><?php $this->options->title(); ?><?php if($this->is('index')||$this->is('front')): ?>
<?php endif; ?></title> 

<?php 
echo '<link rel="stylesheet" href="'.theurl.'style.css?v='.Yodu_Version.'" data-instant-track>';
if (!empty($this->options->jrottytool) && in_array('highlight', $this->options->jrottytool)){ echo'<link rel="stylesheet" href="'.theurl.'js/prism.css?v='.Yodu_Version.'" data-instant-track>';if (!empty($this->options->jrottytool) && in_array('linenumbers', $this->options->jrottytool)){ echo'<link rel="stylesheet" href="'.theurl.'js/line-numer.css?v='.Yodu_Version.'" data-instant-track>';}}
 ?>

<?php if($this->options->color && 'red'==$this->options->color): ?> <style>#instantclick-bar{background:#E295A8;}.intro{background-color: #F1587E; }.tx {background: #F1587E;}.header { border: 1px solid #F1587E;background-color: #F1587E;}</style><?php endif; ?><?php if($this->options->color && 'purple'==$this->options->color): ?> <style>#instantclick-bar{background:#AF2DAF;}.intro{background-color: #800080; }.tx {background: #800080;}.header { border: 1px solid #800080;background-color: #800080;}</style><?php endif; ?><?php if($this->options->color && 'black'==$this->options->color): ?> <style>#instantclick-bar{background:#252525;}.intro{background-color: #000000;}.tx {background: #000000;}.header { border: 1px solid #000000;background-color: #000000;}</style><?php endif; ?>
<?php 
if($this->options->skin && 'mr'!=$this->options->skin){echo'<link rel="stylesheet" href="'.theurl.'skin/'.$this->options->skin.'?v='.Yodu_Version.'" data-instant-track>';}


if (!empty($this->options->stylecx) && 'mr'!=$this->options->stylecx && strpos($this->options->skin,'-') === false){echo'<link rel="stylesheet" href="'.theurl.'style-'.$this->options->stylecx.'.css?v='.Yodu_Version.'" data-instant-track>';}
 ?>
<?php if ($this->options->diycss): ?><style><?php $this->options->diycss(); ?></style><?php endif; ?>
<?php $this->header('generator=&template=&commentReply=&rss1=&rss2=&atom='); ?><?php $this->options->tongji(); ?>
</head>
<!--                                                                      
                                                                           
     ...             ...                            ...                    
    5MMMh           XMMM;                          XMMM:                   
    3@@@5           A@@@;                          A@@@;                   
    ,;8@MHr       9H@@1;                           &@@@;                   
      ,iX@MAi   3A@@5i      ,AAHHHHA3        SAHHHH#@@@;   ,AAA9   iAAAS   
        ,rA@B&&&@@Sr      ,&A@Msss3@#&S    5&#@3sssB@@@;   :@@@H   s@@@X   
          ;sA@@@9s        ;@@@&   i@@@X    G@@@i   &@@@;   :@@@A   r@@@G   
            8@@@r         :@@@A   r@@@G    8@@@r   A@@@;   :@@@A   r@@@G   
            G@@@s         :@@@A   r@@@G    8@@@r   A@@@;   :@@@A   r@@@G   
            G@@@s         ;@@@&   i@@@X    G@@@i   &@@@;   :@@@&   i@@@G   
            X@@@s         ,9G@#333X@M91    19M@X333#@@@;   ,9G@#333X@@@X   
            h888;            88XXXG8h        18GXXX8888,      88XXXG888h   
                                                                        
-->                                                                    
<body id="menu">