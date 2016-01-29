<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    {!! Html::Style('plugins/sb-admin/bower_components/bootstrap/dist/css/bootstrap.min.css')!!}

    <!-- MetisMenu CSS -->
    {!! Html::Style('plugins/sb-admin/bower_components/metisMenu/dist/metisMenu.min.css')!!}

    <!-- Custom CSS -->
    {!! Html::Style('plugins/sb-admin/dist/css/sb-admin-2.css')!!}

    <!-- Custom Fonts -->
    {!! Html::Style('plugins/sb-admin/bower_components/font-awesome/css/font-awesome.min.css')!!}
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
 @yield('content')
    </div>

    <!-- jQuery -->
    {!! Html::Script('plugins/sb-admin/bower_components/jquery/dist/jquery.min.js') !!}

    <!-- Bootstrap Core JavaScript -->
    {!! Html::Script('plugins/sb-admin/bower_components/bootstrap/dist/js/bootstrap.min.js') !!}

    <!-- Metis Menu Plugin JavaScript -->
    {!! Html::Script('plugins/sb-admin/bower_components/metisMenu/dist/metisMenu.min.js') !!}

    <!-- Custom Theme JavaScript -->
    {!! Html::Script('plugins/sb-admin/dist/js/sb-admin-2.js') !!}

</body>

</html>
