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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('node_modules/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('node_modules/toastr/build/toastr.min.js') }}"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js'></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<meta name="keywords" content="SPMI Kalla Institute">
<meta name="description" content="Santuan Penjaminan Mutu Kalla Institute">

<meta name="twitter:card" content="Santuan Penjaminan Mutu Kalla Institute">
<meta name="twitter:site" content="@aiminnur">
<meta name="twitter:title" content="Santuan Penjaminan Mutu Kalla Institute">
<meta name="twitter:description" content="Santuan Penjaminan Mutu Kalla Institute">
<meta name="twitter:creator" content="@aiminnur">

<meta property="fb:app_id" content="655968634437471">
<meta property="og:title" content="Audit Mutu Internal Kalla Institute" />
<meta property="og:type" content="article" />
<meta property="og:description" content="SPMI Kalla Institute" />
<meta property="og:site_name" content=https://aiminnur.vercel.app/home/>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
<link href="{{asset('creative')}}/assets/css/nucleo-icons.css" rel="stylesheet" />
<link href="{{asset('creative')}}/assets/css/nucleo-svg.css" rel="stylesheet" />
<script src="https://kit.fontawesome.com/92d0ae0eff.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{asset('creative')}}/assets/css/font-awesome.min.css">
<link rel="stylesheet" href="{{asset('creative')}}/assets/css/font-awesome.css">
<link href="{{asset('creative')}}/assets/css/nucleo-svg.css" rel="stylesheet" />
<link id="pagestyle" href="{{asset('creative')}}/assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/r-2.5.0/sc-2.3.0/datatables.min.css"rel="stylesheet" />
<link id="pagestyle" href="{{asset('creative')}}/assets/css/custom.css" rel="stylesheet" />
<style>
    #ofBar {
        display: none !important;
    }
</style>

<script>
    window.onload = function() {
        var modal = document.getElementById('ofBar');
        if (modal) {
            modal.style.display = 'none';
        }
    };

    document.addEventListener('DOMContentLoaded', function() {
        var modal = document.getElementById('ofBar');
        if (modal) {
            modal.style.display = 'none';
        }
    });
</script>

{{-- Alert --}}
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
    <symbol id="exclamation-triangle-fill" fill="danger" viewBox="0 0 16 16">
        <path d="M8 0a8 8 0 1 0 8 8A8 8 0 0 0 8 0zM4.46 12h7.08a1 1 0 0 0 .921-1.39L9.921 4.5A1 1 0 0 0 8.08 4.5l-2.54 6.11a1 1 0 0 0 .92 1.39zM7.002 7a1 1 0 0 1 1 1v2a1 1 0 0 1-2 0V8a1 1 0 0 1 1-1zm0 4a1 1 0 1 1-1 1 1 1 0 0 1 1-1z"/>
    </symbol>
    <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </symbol>
    <symbol id="info-fill" viewBox="0 0 16 16">
        <path fill="#b71c1c" d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
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
            toastIcon.innerHTML = '<use xlink:href="#info-fill"/>';
        }

        setTimeout(function() {
            toast.className = toast.className.replace('show', '');
        }, 3000);
    @endif
</script>

