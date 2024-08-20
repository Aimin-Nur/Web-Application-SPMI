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
 <script src="https://cdn.datatables.net/v/bs5/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/r-2.5.0/sc-2.3.0/datatables.min.js"></script>

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
