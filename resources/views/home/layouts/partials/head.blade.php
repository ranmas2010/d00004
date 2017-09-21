
<head>
	<meta charset="utf-8">
	<title>{{$webTitle}}</title>
	<!-- Stylesheets -->
	<link href="/css/bootstrap.css" rel="stylesheet">
	<link href="/css/revolution-slider.css" rel="stylesheet">
	<link href="/css/style.css" rel="stylesheet">
	<link href="/css/jquery-ui.css" rel="stylesheet">
	<link rel="stylesheet" href="/js/sweetalert/sweetalert.css">
	<!--Favicon-->
	<link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/images/favicon.ico" type="image/x-icon">
	<!-- Responsive -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta name="description" content="{{$seoDescription}}">
	<meta name="keywords" content="{{$seoKeywords}}">
	<meta name="author" content="">
	<meta name="csrf-token" content="{{ csrf_token() }}"/>

	<link href="/css/responsive.css" rel="stylesheet">
	<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
	<!--[if lt IE 9]><script src="/js/respond.js"></script><![endif]-->
	@if($webData["ga_code"] != '')
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
						(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
					m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			ga('create', '{{$webData["ga_code"]}}', 'auto');
			ga('send', 'pageview');

		</script>
	@endif

</head>
