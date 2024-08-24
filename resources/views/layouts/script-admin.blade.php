 <!--   Core JS Files   -->
 <script src="{{asset('creative')}}/assets/js/jquery-3.3.1.min.js"></script>
 <script src="{{asset('creative')}}/assets/js/core/popper.min.js"></script>
 <script src="{{asset('creative')}}/assets/js/core/bootstrap.min.js"></script>
 {{-- <script src="{{asset('creative')}}/assets/js/plugins/datatables.js"></script> --}}
 <script src="{{asset('creative')}}/assets/js/plugins/perfect-scrollbar.min.js"></script>
 <script src="{{asset('creative')}}/assets/js/plugins/smooth-scrollbar.min.js"></script>
 <script src="{{asset('creative')}}/assets/js/plugins/chartjs.min.js"></script>
 <script src="{{asset('creative')}}/assets/js/popper.min.js"></script>
 <script src="{{asset('creative')}}/assets/js/bootstrap.min.js"></script>
 <script src="{{asset('creative')}}/assets/js/main.js"></script>
 <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.1/af-2.7.0/b-3.0.0/b-colvis-3.0.0/b-html5-3.0.0/b-print-3.0.0/cr-2.0.0/date-1.5.2/fc-5.0.0/kt-2.12.0/r-3.0.0/rg-1.5.0/rr-1.5.0/sc-2.4.0/sb-1.7.0/sp-2.3.0/sl-2.0.0/sr-1.4.0/datatables.min.js"></script>

 <script>
   var win = navigator.platform.indexOf('Win') > -1;
   if (win && document.querySelector('#sidenav-scrollbar')) {
     var options = {
       damping: '0.5'
     }
     Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
   }
 </script>
 <script src="{{asset('creative')}}//assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
</body>
</html>
