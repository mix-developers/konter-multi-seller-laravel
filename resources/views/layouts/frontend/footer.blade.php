<!--footer-main-->
<footer class="footer-main">
    <div class="footer-bottom">
        <div class="container clearfix">
            <div class="copyright-text">
                <p>&copy; Copyright {{ date('Y') }} . <a href="{{ url('/') }}">SimVice</a>
                </p>
            </div>
            <ul class="footer-bottom-link">
                <li>
                    <a href="{{ url('/') }}">Beranda</a>
                </li>
                <li>
                    <a href="{{ url('/konter_list') }}">Konter</a>
                </li>
                <li>
                    <a href="{{ url('/produk_list') }}">Produk</a>
                </li>
            </ul>
        </div>
    </div>
</footer>
<!--End footer-main-->
</div>
<!--End pagewrapper-->


<!-- scroll-to-top -->
<div id="back-to-top" class="back-to-top">
    <i class="fa fa-angle-up"></i>
</div>


</div>
<!--End pagewrapper-->


<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target=".header-top">
    <span class="icon fa fa-angle-up"></span>
</div>

@yield('script')
<!-- jquery -->
<script src="{{ asset('frontend_theme/') }}/plugins/jquery.min.js"></script>
<!-- bootstrap -->
<script src="{{ asset('frontend_theme/') }}/plugins/bootstrap/bootstrap.min.js"></script>
<!-- Slick Slider -->
<script src="{{ asset('frontend_theme/') }}/plugins/slick/slick.min.js"></script>
<script src="{{ asset('frontend_theme/') }}/plugins/slick/slick-animation.min.js"></script>
<!-- FancyBox -->
<script src="{{ asset('frontend_theme/') }}/plugins/fancybox/jquery.fancybox.min.js" defer></script>
<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU" defer></script>
<script src="{{ asset('frontend_theme/') }}/plugins/google-map/gmap.js" defer></script>

<!-- jquery-ui -->
<script src="{{ asset('frontend_theme/') }}/plugins/jquery-ui/jquery-ui.js" defer></script>
<!-- timePicker -->
<script src="{{ asset('frontend_theme/') }}/plugins/timePicker/timePicker.js" defer></script>

<!-- script js -->
<script src="{{ asset('frontend_theme/') }}/js/script.js"></script>
</body>

</html>
