<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?><!--<nopangu>-->
<?php if ($this->options->pinglun == '1'||$this->options->pinglun == '4'): ?>
<?php
$imgurl = theurl.'biaoqing/';
$GLOBALS['z']  = $this->options->CDNURL;
function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';$idcard="<span class=\"idcard\">本文作者</span>";
        } else {
            $commentClass .= ' comment-by-user';$idcard="<span class=\"idcard\">其他编辑</span>";
        }
    }else{$idcard="";
}
    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
    if ($comments->url) {
        $author = '<a href="' . $comments->url . '" target="_blank" rel="external nofollow">' . $comments->author . '</a>';
    } else {
        $author = $comments->author;
    }
?>

<li data-no-instant id="li-<?php $comments->theId(); ?>" class="comment-body<?php
if ($comments->levels > 0) {
    echo ' comment-child';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
} else {
    echo ' comment-parent';
}
$comments->alt(' comment-odd', ' comment-even');
echo $commentClass;
?>">
    <div id="<?php $comments->theId(); ?>" class="comment-id">
        <?php
$url = Typecho_Widget::widget('Widget_Options')->gravatars;
$host = 'https://'.$url.'/';
            $rating = Helper::options()->commentsAvatarRating;
            $hash = md5(strtolower($comments->mail));
            $email = strtolower($comments->mail);
            $color = '#'.substr($hash,1,6);
           $sjtx = 'mm';
$qq=str_replace('@qq.com','',$email);
if(strstr($email,"qq.com") && is_numeric($qq) && strlen($qq) < 11 && strlen($qq) > 4)
{


$avatar = '//q.qlogo.cn/g?b=qq&nk='.$qq.'&s=100';

 
}else{
 

 $avatar = $host . $hash . '?d='.$sjtx;
}

        ?>
    <a href="<?php $comments->url(); ?>" target="_blank" rel="external nofollow">   
        <img class="avatar"
	 src="<?php echo $avatar ?>" alt="<?php echo $comments->author; ?>"/></a>
        <div class="comment-main">
  <div class="comment-author">
<?php echo $author; ?><?php echo $idcard;?><?php if (!empty(Typecho_Widget::widget('Widget_Options')->jrottytool) && in_array('uapd', Typecho_Widget::widget('Widget_Options')->jrottytool)): ?>
<span class="agent" style="background: <?php echo $color; ?>;box-shadow: 0 0 8px <?php echo $color; ?>;"><?php getOs($comments->agent); ?></span><span class="agent" style="background: <?php echo $color; ?>;box-shadow: 0 0 8px <?php echo $color; ?>;"><?php getBrowser($comments->agent); ?></span><?php endif ; ?>
<div class="comment-meta">
  <time class="comment-time"><?php echo timesince($comments->created);?></time> <span class="comment-reply"><?php $comments->reply(); ?></span>
</div></div>
     


   <p>   <?php get_comment_at($comments->coid); ?>  <?php 
$imgurl = theurl.'biaoqing/';
$cos = preg_replace('#</?[p|P][^>]*>#','',$comments->content);
$cos = preg_replace('#\@\((.*?)\)#','<img src="'.$imgurl.'$1.png" class="biaoqing newpaopao">',$cos);
$cos = preg_replace('#<a(.*?) href="([^"]*/)?(([^"/]*)\.[^"]*)"(.*?)>#',
        '<a$1 href="$2$3"$5 target="_blank">', $cos);
echo $cos;
 ?></p>
          
        </div>
    </div>
 

    <?php if ($comments->children) { ?>
        <div class="comment-children">
            <?php $comments->threadedComments($options); ?>
        </div>
    <?php } ?>
    
</li>
<?php } ?>

<div id="comments">
    <?php $this->comments()->to($comments); ?>



    <?php if($this->allow('comment')): ?>
    <div id="<?php $this->respondId(); ?>" class="respond"  data-no-instant>
        <div class="cancel-comment-reply"><span class="response"><?php _e('发表新评论'); ?></span>
 <?php if($this->user->hasLogin()): ?>
            <span><?php _e('已登入: '); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a> <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a></span>
              <?php endif ; ?>


<span class="cancel-reply"><?php $comments->cancelReply(); ?></span></div>
        <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
            <?php if(!$this->user->hasLogin()): ?>
                <?php if($this->remember('author',true) != "" && $this->remember('mail',true) != "") : ?> 
                
              <div class="hyhl">
                    <span onClick='showhidediv("author_info")'; style="cursor:pointer;color:#2479cc;"><?php $this->remember('author'); ?></span>，<?php _e('欢迎回来'); ?> 
                    <span id="cancel-comment-reply"><?php $comments->cancelReply(); ?></span>
                </div>
                <span id="author_info" style="display:none;"><?php else : ?>
                <span id="author_info">
                <?php endif ; ?>
          <input type="text" name="author" maxlength="12" id="author" class="form-control" placeholder="<?php _e('称呼 *'); ?>" value="<?php $this->remember('author'); ?>">
          <input type="email" name="mail" id="mail" class="form-control" placeholder="<?php _e('电子邮箱 *'); ?>" value="<?php $this->remember('mail'); ?>">
          <input type="url" name="url" id="url" class="form-control" placeholder="<?php _e('网址(http://)'); ?>" value="<?php $this->remember('url'); ?>"> </span>
          
                <?php endif; ?> 

<?php if (!empty($this->options->jrottytool) && in_array('biaoqing', $this->options->jrottytool)): ?> 

<style>
.textarea{
    width:300px;
    height:100px;
    border:1px solid gray;-webkit-user-select:text;
}
.textarea:empty:before{
    content:attr(placeholder);
    font-size: 16px;
    color: #999;
}
.textarea:focus:before{
    content:none;
}
</style>

 <div contenteditable="true" name="text" id="textarea" class="form-control textarea" placeholder="在这里输入你的评论" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('misubmit').click();return false};"></div>

<input name="text" id="textareax" class="form-control" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('misubmit').click();return false};" placeholder="<?php _e('在这里输入你的评论(Ctrl/Cmd+Enter也可以提交)...'); ?>" type="hidden"><?php $this->remember('text',false); ?></input>
 <?php else: ?> 

<textarea name="text" id="textarea" class="form-control" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('misubmit').click();return false};" placeholder="<?php _e('在这里输入你的评论(Ctrl/Cmd+Enter也可以提交)...'); ?>" ><?php $this->remember('text',false); ?></textarea>

 <?php endif; ?> 
         <div class="huaji">
      

<div class="OwO" id="qaq" ><?php if (!empty($this->options->jrottytool) && in_array('biaoqing', $this->options->jrottytool)): ?>    <div class="OwO-body">
                <ul class="OwO-items OwO-items-emoticon OwO-items-show" style="max-height: 197px;" onClick="$('#qaq').toggleClass('OwO-open');">
             <li class="OwO-item"><img src="<?php echo $imgurl; ?>hehe.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>haha.png" class="biaoqing newpaopao"></li>  <li class="OwO-item" ><img src="<?php echo $imgurl; ?>tushe.png" class="biaoqing newpaopao"></li>  <li class="OwO-item" ><img src="<?php echo $imgurl; ?>taikaixin.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>xiaoyan.png" class="biaoqing newpaopao"></li>  <li class="OwO-item" ><img src="<?php echo $imgurl; ?>huaxin.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>xiaoguai.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>guai.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>wuzuixiao.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>huaji.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>nidongde.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>bugaoxing.png" class="biaoqing newpaopao"></li>  <li class="OwO-item" ><img src="<?php echo $imgurl; ?>nu.png" class="biaoqing newpaopao"></li>  <li class="OwO-item" ><img src="<?php echo $imgurl; ?>han.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>heixian.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>lei.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>zhenbang.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>pen.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>jingku.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>yinxian.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>bishi.png" class="biaoqing newpaopao"></li>  <li class="OwO-item" ><img src="<?php echo $imgurl; ?>ku.png" class="biaoqing newpaopao"></li>  <li class="OwO-item" ><img src="<?php echo $imgurl; ?>a.png" class="biaoqing newpaopao"></li>  <li class="OwO-item" ><img src="<?php echo $imgurl; ?>kuanghan.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>what.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>yiwen.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>suanshuang.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>yamaidei.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>weiqu.png" class="biaoqing newpaopao"></li>  <li class="OwO-item" ><img src="<?php echo $imgurl; ?>jingya.png" class="biaoqing newpaopao"></li>  <li class="OwO-item" ><img src="<?php echo $imgurl; ?>shuijiao.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>xiaoniao.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>wabi.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>tu.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>xili.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>xiaohonglian.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>landeli.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>mianqiang.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>aixin.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>xinsui.png" class="biaoqing newpaopao"></li>  <li class="OwO-item" ><img src="<?php echo $imgurl; ?>meigui.png" class="biaoqing newpaopao"></li>  <li class="OwO-item" ><img src="<?php echo $imgurl; ?>liwu.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>caihong.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>taiyang.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>xingxingyueliang.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>qianbi.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>chabei.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>dangao.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>damuzhi.png" class="biaoqing newpaopao"></li>  <li class="OwO-item" ><img src="<?php echo $imgurl; ?>shengli.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>OK.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>shafa.png" class="biaoqing newpaopao"></li>  <li class="OwO-item" ><img src="<?php echo $imgurl; ?>shouzhi.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>xiangjiao.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>bianbian.png" class="biaoqing newpaopao"></li>  <li class="OwO-item" ><img src="<?php echo $imgurl; ?>yaowan.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>honglingjin.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>lazhu.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>yinyue.png" class="biaoqing newpaopao"></li>  <li class="OwO-item"><img src="<?php echo $imgurl; ?>dengpao.png" class="biaoqing newpaopao"></li> 


</ul>
    
            </div>
            <div class="OwO-logo" ><span>OωO表情</span></div>
         <?php endif; ?>  
<span>     
<button type="submit" class="submit" id="misubmit"<?php if (!empty($this->options->jrottytool) && in_array('biaoqing', $this->options->jrottytool)): ?> onclick="submits();"<?php endif; ?>><?php _e('提交评论'); ?></button>
 </span>



</div>
            <?php $security = $this->widget('Widget_Security'); ?>
            <input type="hidden" name="_" value="<?php echo $security->getToken($this->request->getReferer())?>">
        </form>
    </div>   
</div>
    <?php else: ?>
    <h4 class="comment-close">此处评论已关闭</h4>
    <?php endif; ?>  
    <?php if ($comments->have()): ?>
<div class="info-com">    <?php $this->commentsNum(_t('暂无评论'), _t('仅有 <span class="comment-num">1</span> 条评论'), _t('已有 <span class="comment-num">%d</span> 条评论')); ?><?php if($this->user->hasLogin()):?><a href="<?php $this->options->adminUrl(); ?>manage-comments.php?cid=<?php echo $this->cid;?>" target="_blank"  style="float: right;">管理评论</a>
<?php endif;?></div>
 <span id="loadxiaoshi">
    <?php $comments->listComments(); ?>

    <?php $comments->pageNav('&laquo;', '&raquo;'); ?>
</span>
<div id="loading">
<div class="cssload-loader">
	<div class="cssload-inner cssload-one"></div>
	<div class="cssload-inner cssload-two"></div>
	<div class="cssload-inner cssload-three"></div>
</div></div>
    <?php endif; ?>
<!--<nocompress>-->
<script>
function showhidediv(id){  
var sbtitle=document.getElementById(id);  
if(sbtitle){  
   if(sbtitle.style.display=='block'){  
   sbtitle.style.display='none';  
   }else{  
   sbtitle.style.display='block';  
   }  
}  
}

(function () {
    window.TypechoComment = {
        dom : function (id) {
            return document.getElementById(id);
        },
        create : function (tag, attr) {
            var el = document.createElement(tag);
            for (var key in attr) {
                el.setAttribute(key, attr[key]);
            }
            return el;
        },
        reply : function (cid, coid) {
            var comment = this.dom(cid), parent = comment.parentNode,
                response = this.dom('<?php echo $this->respondId(); ?>'),
                input = this.dom('comment-parent'),
                form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0],
                textarea = response.getElementsByTagName('textarea')[0];
            if (null == input) {
                input = this.create('input', {
                    'type' : 'hidden',
                    'name' : 'parent',
                    'id'   : 'comment-parent'
                });
                form.appendChild(input);
            }
            input.setAttribute('value', coid);
            if (null == this.dom('comment-form-place-holder')) {
                var holder = this.create('div', {
                    'id' : 'comment-form-place-holder'
                });
                response.parentNode.insertBefore(holder, response);
            }
            comment.appendChild(response);

            this.dom('cancel-comment-reply-link').style.display = '';
if (null != textarea && 'text' == textarea.name) {
                textarea.focus();
            }
            return false;
        },
        cancelReply : function () {
            var response = this.dom('<?php echo $this->respondId(); ?>'),
            holder = this.dom('comment-form-place-holder'),
            input = this.dom('comment-parent');
            if (null != input) {
                input.parentNode.removeChild(input);
            }
            if (null == holder) {
                return true;
            }
            this.dom('cancel-comment-reply-link').style.display = 'none';
            holder.parentNode.insertBefore(response, holder);
            return false;
        }
    };

})();
</script>
<script type = "text/javascript" data-no-instant>
(function() {
    var event = document.addEventListener ? {
        add: 'addEventListener',
        focus: 'focus',
        load: 'DOMContentLoaded'
    } : {
        add: 'attachEvent',
        focus: 'onfocus',
        load: 'onload'
    };
    document[event.add](event.load, function() {
        var r = document.getElementById('<?php echo $this->respondId(); ?>');
        if (null != r) {
            var forms = r.getElementsByTagName('form');
            if (forms.length > 0) {
                var f = forms[0],
                    textarea = f.getElementsByTagName('textarea')[0],
                    added = false;
                if (null != textarea && 'text' == textarea.name) {
                    textarea[event.add](event.focus, function() {
                        if (!added) {
                            var input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = '_';
                            input.value = (function() {
                                var _a8C5A = //'xr'
                                    '8d0' + //'vI'
                                    'vI' + /* 'mj'//'mj' */ '' + //'P'
                                    '06' + 'd' //'chS'
                                    + //'wo'
                                    '0ef' + '41' //'9G'
                                    + '8c8' //'R'
                                    + //'p1'
                                    'd0' + //'mi'
                                    'mi' + 'baf' //'lu'
                                    + 'c' //'dm'
                                    + //'ED'
                                    '1a9' + //'Lh'
                                    'd9' + '6' //'luM'
                                    + //'xH'
                                    'f1' + //'W'
                                    '2c7' + 'f' //'f'
                                    + //'9'
                                    '9' + //'Nd'
                                    'Nd' + /* '8ys'//'8ys' */ '' + '' ///*'6Yc'*/'6Yc'
                                    + //'H'
                                    '0',
                                    _LceE8M = [
                                        [3, 5],
                                        [16, 18],
                                        [31, 32],
                                        [31, 32],
                                        [31, 33]
                                    ];
                                for (var i = 0; i < _LceE8M.length; i++) {
                                    _a8C5A = _a8C5A.substring(0, _LceE8M[i][0]) + _a8C5A.substring(_LceE8M[i][1]);
                                }
                                return _a8C5A;
                            })();
                            f.appendChild(input);
                            added = true;
                        }
                    });
                }
            }
        }
    });
})();
</script><!--</nocompress>-->
<?php endif; ?>
<?php if ($this->options->pinglun == '2'): ?><div id="comments"  data-no-instant>
<?php $this->need('disanfang.php'); ?></div>
<?php endif; ?>
<!--</nopangu>-->