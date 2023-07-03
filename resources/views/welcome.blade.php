<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css' />
    <style>
        /*	Reset & General
---------------------------------------------------------------------- */
        * { margin: 0px; padding: 0px; }
        body {
            background: #ecf1f5;
            font:14px "Open Sans", sans-serif;
            text-align:center;
        }

        .tile{
            width: 100%;
            background:#fff;
            border-radius:5px;
            box-shadow:0px 2px 3px -1px rgba(151, 171, 187, 0.7);
            float:left;
            transform-style: preserve-3d;
            margin: 10px 5px;

        }

        .header{
            border-bottom:1px solid #ebeff2;
            padding:19px 0;
            text-align:center;
            color:#59687f;
            font-size:600;
            font-size:19px;
            position:relative;
        }

        .banner-img {
            padding: 5px 5px 0;
        }

        .banner-img img {
            width: 100%;
            border-radius: 5px;
        }

        .dates{
            border:1px solid #ebeff2;
            border-radius:5px;
            padding:20px 0px;
            margin:10px 20px;
            font-size:16px;
            color:#5aadef;
            font-weight:600;
            overflow:auto;
        }
        .dates div{
            float:left;
            width:50%;
            text-align:center;
            position:relative;
        }
        .dates strong,
        .stats strong{
            display:block;
            color:#adb8c2;
            font-size:11px;
            font-weight:700;
        }
        .dates span{
            width:1px;
            height:40px;
            position:absolute;
            right:0;
            top:0;
            background:#ebeff2;
        }
        .stats{
            border-top:1px solid #ebeff2;
            background:#f7f8fa;
            overflow:auto;
            padding:15px 0;
            font-size:16px;
            color:#59687f;
            font-weight:600;
            border-radius: 0 0 5px 5px;
        }
        .stats div{
            border-right:1px solid #ebeff2;
            width: 33.33333%;
            float:left;
            text-align:center
        }

        .stats div:nth-of-type(3){border:none;}

        div.footer {
            text-align: right;
            position: relative;
            margin: 20px 5px;
        }

        div.footer a.Cbtn{
            padding: 10px 25px;
            background-color: #DADADA;
            color: #666;
            margin: 10px 2px;
            text-transform: uppercase;
            font-weight: bold;
            text-decoration: none;
            border-radius: 3px;
        }

        div.footer a.Cbtn-primary{
            background-color: #5AADF2;
            color: #FFF;
        }

        div.footer a.Cbtn-primary:hover{
            background-color: #7dbef5;
        }

        div.footer a.Cbtn-danger{
            background-color: #fc5a5a;
            color: #FFF;
        }

        div.footer a.Cbtn-danger:hover{
            background-color: #fd7676;
        }
        </style>
</head>
<body class="antialiased">
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                    <a href="{{ url('count') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Count</a>
                    <a href="{{ url('/') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                @endif
            @endauth
        </div>
    @endif

        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <form class="cours-search" action="{{url('/')}}" method="get">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"  placeholder="Search">
                            <div class="input-group-append">
                                <button class="btn btn-block btn-primary"  type="submit">search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form class="cours-search" action="{{url('/')}}" method="get">
                        <div class="input-group">
                            <input type="date" name="sdate" class="form-control"  >&nbsp;
                            <input type="date" name="edate" class="form-control"  >
                            <div class="input-group-append">
                                <button class="btn btn-block btn-primary"  type="submit">search</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
    <div class="row">

        @foreach($event_data as $value)
            <?php
                $sdate=date_create($value->start_date);
                $edate=date_create($value->end_date);
                ?>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="tile">
                <div class="wrapper">
                    <div class="header">{{$value->eventname}}</div>

                    <div class="banner-img">
                        <img src="http://via.placeholder.com/640x360" alt="Image 1">
                    </div>

                    <div class="dates">
                        <div class="start">
                            <strong>STARTS</strong> {{ date_format($sdate,"d M Y") }}
                            <span></span>
                        </div>
                        <div class="ends">
                            <strong>ENDS</strong>  {{ date_format($edate,"d M Y") }}
                        </div>
                    </div>

                    <div class="stats">

                        <div>
                            <strong>ORGANIZER</strong> {{$value->fname}}
                        </div>

                        <div>
                            <strong>--</strong>
                        </div>

                        <div>
                            <strong>VENUE</strong> {{$value->venue}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex">
        {!! $event_data->links() !!}
    </div>
</div>

</body>
</html>
