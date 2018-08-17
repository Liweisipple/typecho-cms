<?php 
/**
 * archives
 * 
 * @package custom 
 * 
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php'); 
$this->need('sidebar.php');
?> 
           
<article>
<div id="post" class="post">
<h1 class="title"> <?php $this->title() ?>
</h1>
<div id="archives" class="content">
<?php if (!empty($this->options->sidebarBlock) && !in_array('gdso', $this->options->sidebarBlock)): ?>
<form id="filter-form" action="#">
        <input name="date" type="text" id="archive-so" placeholder="Search date (YYYY/MM/DD)" autofocus="autofocus" autocomplete="off">
    </form>
<h5 class="archive-result text-color-base text-xlarge" data-message-zero="no post found" data-message-one="1 post found" data-message-other="{n} posts found"></h5>
<?php endif; ?>
<?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->to($archives);   
    $year=0; $mon=0; $i=0; $j=0;  
 $ml = $archives->options->rootUrl;
   $output = ''; 
    while($archives->next()):   

        $year_tmp = date('Y',$archives->created);   
        $mon_tmp = date('m',$archives->created);   
        $y=$year; $m=$mon;   

        if ($mon != $mon_tmp && $mon > 0) $output .= '</ul>';   
        if ($year != $year_tmp && $year > 0) $output .= '</div>';   
        if ($year != $year_tmp) {   
            $year = $year_tmp;   
            $output .= ' <div class="archive archive-year" data-date="'. $year .'"><h3>'. $year .'</h3>
                      '; //输出年份   


 if ($mon == $mon_tmp){
 $year = $year_tmp;   
            $mon = $mon_tmp;   
if ($this->options->rewrite==0){
      $output .=  ' <ul class="archive-posts archive-month" data-date="'. $year .''. $mon .'">
                    <h4>
                        <a class="guidang" href="' . $ml . '/index.php/'. $year .'/'. $mon .'">'. $mon .'月</a>
                    </h4>'; //输出月份 
}else{
            $output .=  ' <ul class="archive-posts archive-month" data-date="'. $year .''. $mon .'">
                    <h4>
                        <a class="guidang" href="'. $ml .'/'. $year .'/'. $mon .'">'. $mon .'月</a>
                    </h4>'; //输出月份 

}
}



}  

 if ($mon != $mon_tmp){

 $year = $year_tmp;   
            $mon = $mon_tmp;   
if ($this->options->rewrite==0){
  $output .=  ' <ul class="archive-posts archive-month" data-date="'. $year .''. $mon .'">
                    <h4>
                        <a class="guidang" href="' . $ml . '/index.php/'. $year .'/'. $mon .'">'. $mon .'月</a>
                    </h4>'; //输出月份 
}else{
            $output .=  ' <ul class="archive-posts archive-month" data-date="'. $year .''. $mon .'">
                    <h4>
                        <a class="guidang" href="'. $ml .'/'.$year .'/'. $mon .'">'. $mon .'月</a>
                    </h4>'; //输出月份 
}
}


        $output .= '  <li class="li_guidang archive-post archive-day" data-date="'. $year .''. $mon .''.date('d',$archives->created).'">
                <a class="guidang" href="'.$archives->permalink .'">'. $archives->title .'</a>
                <span class="date">'. $year .'-'.date('m',$archives->created).'-'.date('d',$archives->created).'</span>
            </li>
'; //输出文章日期和标题  

    endwhile;   
    $output .= '</div>';   
    echo $output;  
?>  
</div>
</article> 

                  

 <?php $this->need('footer.php');?>