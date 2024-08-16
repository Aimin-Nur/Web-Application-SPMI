 <!--   Core JS Files   -->
 <script src="{{asset('creative')}}/assets/js/core/popper.min.js"></script>
 <script src="{{asset('creative')}}/assets/js/core/bootstrap.min.js"></script>
 <script src="{{asset('creative')}}/assets/js/plugins/perfect-scrollbar.min.js"></script>
 <script src="{{asset('creative')}}/assets/js/plugins/smooth-scrollbar.min.js"></script>
 <script src="{{asset('creative')}}/assets/js/plugins/chartjs.min.js"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="{{asset('creative')}}/assets/js/jquery-3.3.1.min.js"></script>
 <script src="{{asset('creative')}}/assets/js/popper.min.js"></script>
 <script src="{{asset('creative')}}/assets/js/bootstrap.min.js"></script>
 <script src="{{asset('creative')}}/assets/js/main.js"></script>

 <script>
   var win = navigator.platform.indexOf('Win') > -1;
   if (win && document.querySelector('#sidenav-scrollbar')) {
     var options = {
       damping: '0.5'
     }
     Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
   }
 </script>
 <!-- Github buttons -->
 <script async defer src="https://buttons.github.io/buttons.js"></script>
 <script src="{{asset('creative')}}//assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
</body>

</html>
