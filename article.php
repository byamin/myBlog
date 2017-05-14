<?php
	//引入头部
    require 'header.php';
    if(!isset($_GET['id']))
    {
        error('文章id错误');
    }
	else
	{
		//获取文章信息
		$article = db_find('article',['status'=>0,'id'=>(int)$_GET['id']]);
		if($article == false)
		{
			error('文章内容不存在');
		}
		$article = $article[0];
	}
?>
<section class="container">
  <div class="content-wrap">
    <div class="content"  style="background: white">
      <header class="article-header">
        <h1 class="article-title"><a href="article.php?id=<?php echo $article['id'];?>"><?php echo $article['title'];?></a></h1>
        <div class="article-meta">
        <span class="item article-meta-time">
          <time class="time" data-toggle="tooltip" data-placement="bottom" title="时间：<?php echo $article['add_time'];?>"><i class="glyphicon glyphicon-time"></i> <?php echo $article['add_time'];?></time>
          </span>
           </div>
      </header>
      <article class="article-content">
        <p><img data-original="<?php echo $article['cover_img'];?>" src="<?php echo $article['cover_img'];?>" alt="" /></p>
        <p>
        	<?php echo $article['content'];?>
        </p>
        <p class="article-copyright hidden-xs">未经允许不得转载：<a href="">symphp博客</a> » <a href="article.html">php如何判断一个日期的格式是否正确</a></p>
      </article>

      <div class="title" id="comment">
        <h3>评论 <small>抢沙发</small></h3>
      </div>
      <!--<div id="respond">
        <div class="comment-signarea">
          <h3 class="text-muted">评论前必须登录！</h3>
          <p> <a href="javascript:;" class="btn btn-primary login" rel="nofollow">立即登录</a> &nbsp; <a href="javascript:;" class="btn btn-default register" rel="nofollow">注册</a> </p>
          <h3 class="text-muted">当前文章禁止评论</h3>
        </div>
      </div>-->
      <div id="respond">
        <form action="" method="post" id="comment-form">
          <div class="comment">
            <div class="comment-title"><img class="avatar" src="img/icon/icon.png" alt="" /></div>
            <div class="comment-box">
              <textarea placeholder="您的评论可以一针见血" name="comment" id="comment-textarea" cols="100%" rows="3" tabindex="1" ></textarea>
              <div class="comment-ctrl"> <span class="emotion"><img src="img/face/5.png" width="20" height="20" alt="" />表情</span>
                <div class="comment-prompt"> <i class="fa fa-spin fa-circle-o-notch"></i> <span class="comment-prompt-text"></span> </div>
                <input type="hidden" value="1" class="articleid" />
                <button type="submit" name="comment-submit" id="comment-submit" tabindex="5" articleid="1">评论</button>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div id="postcomments">
        <ol class="commentlist">
          <li class="comment-content"><span class="comment-f">#1</span>
            <div class="comment-avatar"><img class="avatar" src="img/icon/icon.png" alt="" /></div>
            <div class="comment-main">
              <p>来自<span class="address">河南郑州</span>的用户<span class="time">(2016-01-06)</span><br />
                这是匿名评论的内容这是匿名评论的内容，这是匿名评论的内容这是匿名评论的内容这是匿名评论的内容这是匿名评论的内容这是匿名评论的内容这是匿名评论的内容。</p>
            </div>
          </li>
        </ol>

        <div class="quotes"><span class="disabled">首页</span><span class="disabled">上一页</span><a class="current">1</a><a href="">2</a><span class="disabled">下一页</span><span class="disabled">尾页</span></div>
      </div>
    </div>
  </div>
  <aside class="sidebar">
    <div class="fixed">
      <div class="widget widget-tabs">
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#notice" aria-controls="notice" role="tab" data-toggle="tab">网站公告</a></li>
          <li role="presentation"><a href="#contact" aria-controls="contact" role="tab" data-toggle="tab">联系站长</a></li>
        </ul>
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane notice active" id="notice">
          今天天气不错

          </div>

          <div role="tabpanel" class="tab-pane contact" id="contact">
            <h2>Email:<br />
              <a href="mailto:symphp@foxmail.com" data-toggle="tooltip" data-placement="bottom" title="symphp@foxmail.com">symphp@foxmail.com</a></h2>
          </div>
        </div>
      </div>
      <div class="widget widget_search">
        <form class="navbar-form" action="" method="get">
          <div class="input-group">
            <input type="text" name="keyword" class="form-control" size="35" placeholder="请输入关键字" maxlength="15" autocomplete="off">
            <span class="input-group-btn">
            <button class="btn btn-default btn-search" name="search" type="submit">搜索</button>
            </span> </div>
        </form>
      </div>
    </div>
  </aside>
</section>
  <?php
  	require_once 'footer.php';	
  ?>