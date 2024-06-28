<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="apple-touch-icon" sizes="76x76" href="{{asset('creative')}}/assets/img/apple-icon.png">
<link rel="icon" type="image/png" href="{{asset('creative')}}/assets/img/favicon.png">
<title>
    SPMI - Kalla Institute
  </title>

  <script src="{{ asset('node_modules/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('node_modules/toastr/build/toastr.min.js') }}"></script>
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js'></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="canonical" href="https://www.creative-tim.com/product/soft-ui-dashboard" />

<meta name="keywords" content="creative tim, html dashboard, html css dashboard, web dashboard, bootstrap 5 dashboard, bootstrap 5, css3 dashboard, bootstrap 5 admin, Soft UI Dashboard bootstrap 5 dashboard, frontend, responsive bootstrap 5 dashboard, free dashboard, free admin dashboard, free bootstrap 5 admin dashboard">
<meta name="description" content="Soft UI Dashboard is a beautiful Bootstrap 5 admin dashboard with a large number of components, designed to look beautiful and organized. If you are looking for a tool to manage and visualize data about your business, this dashboard is the thing for you.">

<meta name="twitter:card" content="product">
<meta name="twitter:site" content="@creativetim">
<meta name="twitter:title" content="Soft UI Dashboard by Creative Tim">
<meta name="twitter:description" content="Soft UI Dashboard is a beautiful Bootstrap 5 admin dashboard with a large number of components, designed to look beautiful and organized. If you are looking for a tool to manage and visualize data about your business, this dashboard is the thing for you.">
<meta name="twitter:creator" content="@creativetim">
<meta name="twitter:image" content="https://s3.amazonaws.com/creativetim_bucket/products/450/original/opt_sd_free_thumbnail.png">

<meta property="fb:app_id" content="655968634437471">
<meta property="og:title" content="Soft UI Dashboard by Creative Tim" />
<meta property="og:type" content="article" />
<meta property="og:url" content="http://demos.creative-tim.com/soft-ui-dashboard/examples/dashboard.html" />
<meta property="og:image" content="https://s3.amazonaws.com/creativetim_bucket/products/450/original/opt_sd_free_thumbnail.png" />
<meta property="og:description" content="Soft UI Dashboard is a beautiful Bootstrap 5 admin dashboard with a large number of components, designed to look beautiful and organized. If you are looking for a tool to manage and visualize data about your business, this dashboard is the thing for you." />
<meta property="og:site_name" content="Creative Tim" />

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

<link href="{{asset('creative')}}/assets/css/nucleo-icons.css" rel="stylesheet" />
<link href="{{asset('creative')}}/assets/css/nucleo-svg.css" rel="stylesheet" />

<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
<link href="{{asset('creative')}}/assets/css/nucleo-svg.css" rel="stylesheet" />

<link id="pagestyle" href="{{asset('creative')}}/assets/css/soft-ui-dashboard.min.css?v=1.0.7" rel="stylesheet" />
<script>
    @if(session('status') && session('message'))
        var type = "{{ session('status') }}";
        var message = "{{ session('message') }}";
        if (type === 'success') {
            toastr.success(message);
        } else if (type === 'error') {
            toastr.error(message);
        }
    @endif
</script>
<style>
    .async-hide {
      opacity: 0 !important
    }
  </style>
<script>
    (function(a, s, y, n, c, h, i, d, e) {
      s.className += ' ' + y;
      h.start = 1 * new Date;
      h.end = i = function() {
        s.className = s.className.replace(RegExp(' ?' + y), '')
      };
      (a[n] = a[n] || []).hide = h;
      setTimeout(function() {
        i();
        h.end = null
      }, c);
      h.timeout = c;
    })(window, document.documentElement, 'async-hide', 'dataLayer', 4000, {
      'GTM-K9BGS8K': true
    });
  </script>

<script>
    (function(i, s, o, g, r, a, m) {
      i['GoogleAnalyticsObject'] = r;
      i[r] = i[r] || function() {
        (i[r].q = i[r].q || []).push(arguments)
      }, i[r].l = 1 * new Date();
      a = s.createElement(o),
        m = s.getElementsByTagName(o)[0];
      a.async = 1;
      a.src = g;
      m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
    ga('create', 'UA-46172202-22', 'auto', {
      allowLinker: true
    });
    ga('set', 'anonymizeIp', true);
    ga('require', 'GTM-K9BGS8K');
    ga('require', 'displayfeatures');
    ga('require', 'linker');
    ga('linker:autoLink', ["2checkout.com", "avangate.com"]);
  </script>


<script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-NKDMSK6');
  </script>



<script defer data-site="demos.creative-tim.com" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>
<body class="g-sidenav-show  bg-gray-100">


<style>
    .toast {
        visibility: hidden;
        min-width: 250px;
        margin-left: -125px;
        background-color: #d1e7dd;
        color: #0f5132;
        text-align: left;
        border-radius: 2px;
        position: fixed;
        z-index: 1;
        left: 50%;
        top: 30px;
        font-size: 15px;
        display: flex;
        align-items: center;
        padding: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    .toast svg {
        margin-right: 10px;
    }

    .toast.success {
        background-color: #d1e7dd;
        color: #0f5132;
    }

    .toast.error {
        background-color: #f8d7da;
        color: #842029;
    }

    .toast.show {
        visibility: visible;
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    @-webkit-keyframes fadein {
        from {top: 0; opacity: 0;}
        to {top: 30px; opacity: 1;}
    }

    @keyframes fadein {
        from {top: 0; opacity: 0;}
        to {top: 30px; opacity: 1;}
    }

    @-webkit-keyframes fadeout {
        from {top: 30px; opacity: 1;}
        to {top: 0; opacity: 0;}
    }

    @keyframes fadeout {
        from {top: 30px; opacity: 1;}
        to {top: 0; opacity: 0;}
    }
</style>


<div id="toast" class="toast">
    <svg id="toast-icon" class="bi flex-shrink-0" width="24" height="24" role="img"></svg>
    <div id="toast-message"></div>
</div>

<!-- SVG icons -->
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 11.03a.75.75 0 0 0 1.07 0l3.992-3.992a.75.75 0 1 0-1.07-1.07L7.5 9.439 5.854 7.793a.75.75 0 1 0-1.07 1.07l2.186 2.166z"/>
    </symbol>
    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8 0a8 8 0 1 0 8 8A8 8 0 0 0 8 0zM4.46 12h7.08a1 1 0 0 0 .921-1.39L9.921 4.5A1 1 0 0 0 8.08 4.5l-2.54 6.11a1 1 0 0 0 .92 1.39zM7.002 7a1 1 0 0 1 1 1v2a1 1 0 0 1-2 0V8a1 1 0 0 1 1-1zm0 4a1 1 0 1 1-1 1 1 1 0 0 1 1-1z"/>
    </symbol>
</svg>


<script>
    @if(session('status') && session('message'))
        var type = "{{ session('status') }}";
        var message = "{{ session('message') }}";
        var toast = document.getElementById('toast');
        var toastMessage = document.getElementById('toast-message');
        var toastIcon = document.getElementById('toast-icon');

        toast.className = 'toast ' + type + ' show';
        toastMessage.innerText = message;

        if (type === 'success') {
            toastIcon.innerHTML = '<use xlink:href="#check-circle-fill"/>';
        } else {
            toastIcon.innerHTML = '<use xlink:href="#exclamation-triangle-fill"/>';
        }

        setTimeout(function() {
            toast.className = toast.className.replace('show', '');
        }, 3000);
    @endif
</script>

<script>

    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth'
      });
      calendar.render();
    });

  </script>

