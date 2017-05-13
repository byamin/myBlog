<?php
	require 'function.php';

	//获取请求参数
	$cat_id = isset($_GET['cat_id'])?$_GET['cat_id']:'';
	$keyword = isset($_GET['keyword'])?$_GET['keyword']:'';
	

	//获取文章分类
	$categorys   = db_find('category',['status'=>0]);

	//查询文章
    $page = isset($_GET['page'])?$_GET['page']:1;
    $page_size = 2;
    $offset = $page_size*($page-1);

    $page_count = db_sql_find('SELECT count(*) as page_count from article as a LEFT JOIN category as c on a.category_id = c.id where a.status = 0')[0]['page_count'];
    $articles = db_sql_find("SELECT a.*,c.category_name from article as a LEFT JOIN category as c on a.category_id = c.id where a.status = 0 ORDER BY add_time DESC LIMIT $offset,$page_size");
    $page_html = multipage($page_count,$page,$page_size);
?>
<!doctype html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Blog</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="apple-touch-icon-precomposed" href="img/icon/icon.png">
<link rel="shortcut icon" href="img/icon/favicon.ico">
<script src="js/jquery-2.1.4.min.js"></script>
<script src="js/bootstrap.js" type="text/javascript" charset="utf-8"></script>
<!-- <script src="js/nprogress.js"></script> -->
<!-- <script src="js/jquery.lazyload.min.js"></script> -->
<!--[if gte IE 9]>
  <script src="js/jquery-1.11.1.min.js" type="text/javascript"></script>
  <script src="js/html5shiv.min.js" type="text/javascript"></script>
  <script src="js/respond.min.js" type="text/javascript"></script>
  <script src="js/selectivizr-min.js" type="text/javascript"></script>
<![endif]-->
<!--[if lt IE 9]>
  <script>window.location.href='upgrade-browser.html';</script>
<![endif]-->
</head>

<body class="user-select">
<header class="header">
  <nav class="navbar navbar-default" id="navbar">
    <div class="container">
      
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar" aria-expanded="false"> <span class="sr-only"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <h1 class="logo hvr-bounce-in"><a href="" title=""><img src="img/logo.png" alt="" style="height: 60px;"></a></h1>
      </div>
      <div class="collapse navbar-collapse" id="header-navbar">
        <ul class="nav navbar-nav navbar-right">
          <li class="hidden-index active"><a data-cont="symphp" href="index.html">首页</a></li>
          <?php foreach($categorys as $category):?>
          <li><a href="index.php?cat_id=<?php echo $category['id'];?>"><?php echo $category['category_name'];?></a></li>
          <?php endforeach;?>
        </ul>
        <form class="navbar-form visible-xs" action="/Search" method="post">
          <div class="input-group">
            <input type="text" name="keyword" class="form-control" placeholder="请输入关键字" maxlength="20" autocomplete="off">
            <span class="input-group-btn">
            <button class="btn btn-default btn-search" name="search" type="submit">搜索</button>
            </span> </div>
        </form>
      </div>
    </div>
  </nav>
</header>
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
      <?php foreach ($articles as $article) {?>
      <article class="excerpt excerpt-2"><a class="focus" href="article.php?id=<?php echo $article['id'];?>" title=""><img class="thumb" data-original="<?php echo $article['cover_img'];?>" src="<?php echo $article['cover_img'];?>" alt=""></a>
        <header><a class="cat" href="program"><?php echo $article['category_name'];?><i></i></a>
          <h2><a href="article.php?id=<?php echo $article['id'];?>" title=""><?php echo $article['title'];?></a></h2>
        </header>
        <p class="meta">
          <time class="time"><i class="glyphicon glyphicon-time"></i><?php echo $article['add_time'];?></time>
        <p class="note"><?php echo $article['content'];?></p>
      </article>
      <?php }?>
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
        <form class="navbar-form" action="/Search" method="post">
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
<footer class="footer">
  <div class="container">
    <p>&copy; 2017 <a href="http://www.symphp.com">www.symphp.com</a> &nbsp; <a href="http://www.miitbeian.gov.cn/" target="_blank" rel="nofollow">渝ICP备20151109-1</a> &nbsp; <!-- <a href="sitemap.xml" target="_blank" class="sitemap">网站地图</a> --></p>
  </div>
  <div id="gotop"><a class="gotop"></a></div>
</footer>
<script src="js/jquery.ias.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>