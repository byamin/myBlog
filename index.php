<?php
	require ('header.php');	//引入头部
	//获取请求参数
	$cat_id = isset($_GET['cat_id'])?$_GET['cat_id']:'';
	$keyword = isset($_GET['keyword'])?$_GET['keyword']:'';
	
	//查询文章
    $page = isset($_GET['page'])?$_GET['page']:1;
    $page_size = 2;
    $offset = $page_size*($page-1);


    //文章查询条件
    $a_where = '';
    if($cat_id)
    {
        $a_where = "AND a.category_id =$cat_id";
    }
	if($keyword)
	{
		$a_where = "AND a.title like '%$keyword%'";
	}

    $page_count = db_sql_find("SELECT count(*) as page_count from article as a LEFT JOIN category as c on a.category_id = c.id where a.status = 0 $a_where")[0]['page_count'];
    $articles = db_sql_find("SELECT a.*,c.category_name from article as a LEFT JOIN category as c on a.category_id = c.id where a.status = 0 $a_where ORDER BY a.add_time DESC LIMIT $offset,$page_size");
    //获取分页
    $page_html = multipage($page_count,$page,$page_size);
?>
<section class="container">
  <div class="content-wrap">
    <div class="content">
      <div class="jumbotron">
        <h1>欢迎访问symphp博客</h1>
        <p>在这里可以看到前端技术，后端程序，网站内容管理系统等文章，还有我的程序人生！</p>
      </div>
      <div id="focusslide" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#focusslide" data-slide-to="0" class="active"></li>
          <li data-target="#focusslide" data-slide-to="1"></li>
          <li data-target="#focusslide" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <div class="item active"> <a href="" target="_blank"><img src="img/banner/banner_01.jpg" alt="" class="img-responsive"></a>
            <!--<div class="carousel-caption"> </div>-->
          </div>
          <div class="item"> <a href="" target="_blank"><img src="img/banner/banner_02.jpg" alt="" class="img-responsive"></a>
            <!--<div class="carousel-caption"> </div>-->
          </div>
          <div class="item"> <a href="" target="_blank"><img src="img/banner/banner_03.jpg" alt="" class="img-responsive"></a>
            <!--<div class="carousel-caption"> </div>-->
          </div>
        </div>
        <a class="left carousel-control" href="#focusslide" role="button" data-slide="prev" rel="nofollow"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">上一个</span> </a> <a class="right carousel-control" href="#focusslide" role="button" data-slide="next" rel="nofollow"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">下一个</span> </a> </div>

      <div class="title">
        <h3>最新发布</h3>
      </div>
      <?php
        if(!empty($articles)){
            foreach ($articles as $article) {?>
      <article class="excerpt excerpt-2"><a class="focus" href="article.php?id=<?php echo $article['id'];?>" title=""><img class="thumb" data-original="<?php echo $article['cover_img'];?>" src="<?php echo $article['cover_img'];?>" alt=""></a>
        <header><a class="cat" href="cat_id=<?php echo $article['category_id'];?>"><?php echo $article['category_name'];?><i></i></a>
          <h2><a href="article.php?id=<?php echo $article['id'];?>" title=""><?php echo $article['title'];?></a></h2>
        </header>
        <p class="meta">
          <time class="time"><i class="glyphicon glyphicon-time"></i><?php echo $article['add_time'];?></time>
        <p class="note"><?php echo $article['content'];?></p>
      </article>
      <?php }}?>
      <div class="page">
      		<?php if(!empty($page_html)){echo $page_html;} ?>
      </div>
</nav>
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
	require 'footer.php';	
?>