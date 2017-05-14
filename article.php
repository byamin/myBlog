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
       <!--高速版-->
		<!--<div id="SOHUCS" sid="请将此处替换为配置SourceID的语句"></div>
		<script charset="utf-8" type="text/javascript" src="http://changyan.sohu.com/upload/changyan.js" ></script>
			<script type="text/javascript">
				window.changyan.api.config({
				appid: 'cyt0M0shM',
				conf: 'prod_bbfab99d913bf0453433bab2cf1493d5'
			});
		</script>-->
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