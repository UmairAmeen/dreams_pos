<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<meta name="description" content="POS - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive">
		<meta name="author" content="Dreamguys - Bootstrap Admin Template">
		<meta name="robots" content="noindex, nofollow">
		<title>{{ config('app.name') }}</title>

		<link rel="shortcut icon" type="image/x-icon" href="{{asset('theme/assets/img/favicon.png')}}">

		<link rel="stylesheet" href="{{asset('theme/assets/css/bootstrap.min.css')}}">

		<link rel="stylesheet" href="{{asset('theme/assets/css/animate.css')}}">

		<link rel="stylesheet" href="{{asset('theme/assets/css/dataTables.bootstrap4.min.css')}}">
        
        <link rel="stylesheet" href="{{asset('theme/assets/plugins/fontawesome/css/fontawesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('theme/assets/plugins/fontawesome/css/all.min.css')}}">
		<link rel="stylesheet" href="{{asset('fonts/font-awesome/css/font-awesome.min.css')}}">

		<link rel="stylesheet" href="{{asset('theme/assets/css/style.css')}}">
		<!-- Dev Express Data Grid -->
		<link rel="stylesheet" href="{{asset('theme/assets/css/dx.light.css')}}?v=0.4"> 
        <!-- Custom login Stylesheet -->
        <link type="text/css" rel="stylesheet" href="{{asset('css/style.css')}}">
        <link rel="stylesheet" href="{{asset('theme/assets/plugins/toastr/toatr.css')}}">
	</head>
    <body>
        <!-- Authentication -->
        @guest
        <div id="top" class="login-bodycolor">
            <div class="login">
                <div class="login-inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-info">
                                    <div class="form-section p-5">

                                    <div class="page-header">
                                        <div class="page-title">
                                            <a href="{{ route('login') }}" class="logo">
                                                <img src="{{asset('theme/assets/img/logo.png')}}" alt="logo">
                                            </a>
                                        </div>
                                        <div class="page-btn d-flex">
                                            @if (Route::has('login'))
                                                <a href="{{ route('login') }}" class="btn btn-added m-2">Login</a>
                                            @endif
                                            @if (Route::has('register'))
                                                <a href="{{ route('register') }}" class="btn btn-added m-2">Register</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="page-header">
                                        <div class="page-title">
                                            <h1 class="heading">Welcome!</h1>
                                        </div>
                                    </div>

                                        @yield('login_content')
                                        
                                        <p>Help & Support</p>
                                        <div class="social-list">
                                            <a href="#">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                                <a href="#">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                                <a href="{{ url('auth/google') }}">
                                                <i class="fa fa-google"></i>
                                            </a>
                                                <a href="#">
                                                <i class="fa fa-linkedin"></i>
                                            </a>
                                                <a href="#">
                                                <i class="fa fa-pinterest"></i>
                                            </a>
                                                <a href="#">
                                                <i class="fa fa-youtube"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Ripple background start -->
            <div class="ripple-background">
                <div class="circle xxlarge shade1"></div>
                <div class="circle xlarge shade2"></div>
                <div class="circle large shade3"></div>
                <div class="circle mediun shade4"></div>
                <div class="circle small shade5"></div>
            </div>
            <!-- Ripple background end -->
        </div> 

        @else
        
        <!-- Pre-loader -->
        <div id="global-loader">
            <div class="whirly-loader"> </div>
        </div>
        <!-- End Preloader-->

        <!-- Start Topbar -->
        @include('includes.top-nav')
        <!-- Topbar End -->

        <!-- Start Left Sidebar -->
        @include('includes.sidebar')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            @yield('content')
        </div>
        <!-- Page Content End -->
        @endguest
        <!-- Start Footer -->
        @include('includes.footer')
        <!-- Footer End -->

        @yield('script')

       
    </body>

    </html>
        <script type="text/javascript">
        $(document).ready(function(e) {

        });
        function launchFullScreen(element) {
            if(element.requestFullScreen) {
                element.requestFullScreen();
            } else if(element.mozRequestFullScreen) {
                element.mozRequestFullScreen();
            } else if(element.webkitRequestFullScreen) {
                element.webkitRequestFullScreen();
            }
        }
        function spinner_start(e) {
            $(e).prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>');
        }
        function spinner_end(e) {
            $(e).find('.spinner-grow').remove();
        }
        // Launch fullscreen for browsers that support it!
        $("#videoElement").click(function (e) {
            e.preventDefault();
            launchFullScreen(document.documentElement); // the whole page
        });
        var old_request = false;
        // function init() {}
        var form;
       
        $(document).on("submit", "form", function (e) {
            form = $(this);
            submit_btn = $(form).find("button[type=submit]");
            if ($(form).hasClass('no-ajax')) {return;}
            $(submit_btn).addClass('disabled');//disable submit button
            e.preventDefault();
            spinner_start(submit_btn);
            
            try {
                if(old_request) {
                    old_request.abort();
                }                
            } catch (e) {
                console.log(e);//nothing to do
            }
            old_request = $.ajax({
                url: $(this).attr('action'),
                data: $(this).serialize(),
                method: "POST",
                dataType: "json"
            }).done(function(resp) {
                if(resp.message)
                    {
                        toastr.success(resp.message);
                    }
               
                if (resp.action) {
                    setTimeout(function(){callback(resp.action, resp.do, resp.val, resp.text, resp.script);}, 1000);
                }
            }).fail(function(e) {
                IS_JSON = false;
                var obj = "";
                try {
                    var obj = $.parseJSON(e.responseText);
                    IS_JSON = true;
                } catch(err) {
                    IS_JSON = false;
                }
                if (IS_JSON) {
                    if(obj.errors)
                    {
                        $.each(obj.errors, function(key,value) {
                            toastr.error(value);
                        });
                    }
                    else{
                        $.each(obj.message, function(key,value) {
                            toastr.error(value);
                        });
                    }
                } else {
                    try {
                        if (e.responseJSON.message) {
                            toastr.error(e.responseJSON.message);
                        } else {
                            toastr.error("Some Error Occured, Try Again");
                        }                        
                    } catch(err) {
                        toastr.error("Some Error Occured, Try Again or Call our helpline");
                    }
                }
            }).always(function() {
                spinner_end(submit_btn);
                $(submit_btn).removeClass('disabled');
            });
        });

        function callback(action, data, vali=false, text=false, extra_script=false) {
            switch(action) {
                case 'redirect':
                    window.location = data;
                    return;
                case 'reload':
                    window.location.reload();
                    return;
                case 'reset':
                  resetForm(data, vali, text);
                    if ($("#warehouse").length > 0) {
                        // $("#warehouse").val("4").trigger("change");
                    }
                    break;
                case 'same_state_datable_reload':
                    var table = $(data).DataTable();
                    table.ajax.reload( null, false );

                    // if instance not null or undefined
                    if (typeof(instance) != "undefined" && instance != null) {
                        instance.refresh();
                    }
                break;
                case 'dismiss':
                    if (extra_script) {
                        extra_script();
                    }
                    if (text) {
                        // debugger
                        $(data).append('<option value="'+vali+'" >'+text+"</option>");
                        $(data).trigger('change'); 
                    }
                    // debugger;
                    $(data).val(vali).trigger('change');
                    $(".modal").modal("hide");
                    $(".modal").find("form").each(function(index, ele){
                        $(ele).find("#log").html("");
                        $(ele)[0].reset();
                    });
                    return;
                case 'update':
                    // $(data).dataTable('refresh');
                    var table = $(data).DataTable();
                    table.ajax.reload();
                    $("[role=dialog]").modal('hide');
                    if (typeof(instance) != "undefined" && instance != null) {
                        instance.refresh();
                    }
                    return;
            }
        }

        $(".sub-menu").click(function(e) {
            $("html, body").animate({ scrollTop: 0 }, "slow"); 
            load_start();
        });
        
        function fetch_show(url, set_to, showSpareModal=false) {
            $.ajax({
                url: url,
                method: "GET",
                dataType: "HTML"
            }).done(function(e) {
                // load_end();
                if (showModal) {
                    $("#spareModal").modal('show');
                }
                $(set_to).html(e);
            }).error(function(e) {
                if (showModal) {
                    $("#spareModal").modal('show');
                }
                $(set_to).find("#log").removeClass();
                $(set_to).find("#log").addClass( "alert alert-danger" );
                IS_JSON = false;
                var obj = "";
                try {
                    var obj = $.parseJSON(e.responseText);
                    IS_JSON = true;
                } catch(err) {
                    IS_JSON = false;
                }
                if (IS_JSON) {
                    var errhtml = "";
                    // var obj = jQuery.parseJSON(e.responseText);
                    $.each(obj, function(key,value) {
                        // alert(value.com);
                        errhtml = errhtml + value + "<br>";
                    });
                    $(set_to).find("#log").html(errhtml);
                } else {
                    try {
                        if (e.responseJSON.message) {
                            $(set_to).find("#log").html(e.responseJSON.message);
                        } else {
                            $(set_to).find("#log").html("Some Error Occured, Try Again");
                        }
                    } catch(err) {
                        $(set_to).find("#log").html("Some Error Occured, Try Again or Call our helpline");
                    }
                }
            });
        }
    </script>