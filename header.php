<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php wp_title('',true); ?><?php if(wp_title('',false)) { ?> | <?php } ?><?php bloginfo('name'); ?></title>
<meta http-equiv="Pragma" content="no-cache" />
<meta name="description" content="<?php bloginfo('description'); ?>" />
<meta name="keywords" content="麹町法人会,税務,福利厚生,企業経営,研修,セミナー,講演会,皇居一周マラソン" />
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-script-type" content="text/javascript" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link type="text/css" rel="stylesheet" media="all" href="<?php echo get_template_directory_uri(); ?>/css/main.css?ver=20190703" />

<?php wp_head(); ?>

<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/js/Naver-master/jquery.fs.naver.css"/>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/Naver-master/jquery.fs.naver.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($){
// $をjQueryに置き換え

$(function() {
	$("#gNav ul").naver({
			animated: true
	});
	});
});
</script>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.smoothScroll.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/pagetop.js"></script>

<?php if(is_page( 'about' ) ): ?>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.rwdImageMaps.min.js"></script>
<script>
jQuery(document).ready(function($){
// $をjQueryに置き換え

      $(document).ready(function(e) {
        $('img[usemap]').rwdImageMaps();
      });
      });
</script>

<?php elseif(is_page( 'tax-info' ) ): ?>

<script>
jQuery(document).ready(function($){
// $をjQueryに置き換え

$(function() {
function slideToggleWrap() {
$(this).toggleClass("active").next().slideToggle(100);
}
$(".switch .toggle").click(slideToggleWrap);
});
});
</script>

<?php endif; ?>

<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->

<!--Google Analytics-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-72065262-1', 'auto');
  ga('send', 'pageview');

</script>
<!--/Google Analytics-->
</head>

<body>
<a id="page_top"></a>

<!--container-->
<div id="container">

<!--headerCol-->
<div id="headerCol">
<div id="headerColInner">

<!--header-->
<header>
<h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>

<!--telLink-->
<p id="telLink"><a href="tel:0332612282">TEL：03-3261-2282</a></p>
<!--telLink-->

<!--headerNav-->
<nav id="headerNav">
<ul>
<li class="notification"><a href="<?php echo home_url(); ?>/notification">各種届出用紙</a></li>
<li class="admission"><a href="<?php echo home_url(); ?>/admission">入会について</a></li>
<li class="access"><a href="<?php echo home_url(); ?>/access">アクセス</a></li>
<li class="inquiry"><a href="<?php echo home_url(); ?>/inquiry">お問合せ</a></li>
</ul>
</nav>
<!--/headerNav-->

<div class="member-list_btn_area">
<p class="member-list_btn"><a href="<?php echo home_url(); ?>/member-list/" target="_blank">会員ページにログインする</a></p>
</div>

</header>
<!--/header-->

</div>
</div>
<!--/headerCol-->

<!--gNavCol-->
<div id="gNavCol">
<div id="gNavColInner">

<!--gNav-->
<nav id="gNav">
<ul>
<li class="info"><a href="<?php echo home_url(); ?>/info">新着情報</a></li>
<li class="about"><a href="<?php echo home_url(); ?>/about">麹町法人会について</a></li>
<li class="schedule"><a href="<?php echo home_url(); ?>/schedule">行事予定</a></li>
<li class="tax"><a href="<?php echo home_url(); ?>/tax">税の説明会</a></li>
<li class="services"><a href="<?php echo home_url(); ?>/services">会員サービス</a></li>
<li class="notification"><a href="<?php echo home_url(); ?>/notification">各種届出用紙</a></li>
<li class="admission sp"><a href="<?php echo home_url(); ?>/admission">入会について</a></li>
<li class="access sp"><a href="<?php echo home_url(); ?>/access">アクセス</a></li>
<li class="inquiry sp"><a href="<?php echo home_url(); ?>/inquiry">お問合せ</a></li>
</ul>
</nav>
<!--/gNav-->

</div>
</div>
<!--/gNavCol-->

<!--mainCol-->
<div id="mainCol">
<div id="mainColInner">

<!--contents-->
<div id="contents">

<!--/////contents start/////-->