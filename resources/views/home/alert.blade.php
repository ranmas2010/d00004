<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>訊息</title>
    <link rel="stylesheet" href="/js/sweetalert/sweetalert.css">
</head>

<body>
</body>
<script src="/js/vendor/jquery-1.12.4.min.js"></script>
<script src="/js/sweetalert/sweetalert.min.js"></script>
<script>

    swal({
                title: "{{$altTitle}}",
                text: "{{$altSubTitle}}",
                type: "{{$type}}",
                showCancelButton: false,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "{{$confirmButtonText}}",
                closeOnConfirm: false
            },
            function(){
               window.location.href='/{{$url}}';
            });
</script>
</html>