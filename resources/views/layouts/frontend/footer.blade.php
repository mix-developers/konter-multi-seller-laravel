<!--footer-main-->
<footer class="footer-main">
    <div class="footer-top">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="about-widget">
                        <div class="footer-logo">
                            <figure>
                                <a href="index.html">
                                    <img loading="lazy" class="img-fluid" src="images/logo-2.png" alt="medic">
                                </a>
                            </figure>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias, temporibus?</p>
                        <ul class="location-link">
                            <li class="item">
                                <i class="fas fa-map-marker-alt"></i>
                                <p>Modamba, NY 80021, United States</p>
                            </li>
                            <li class="item">
                                <i class="far fa-envelope" aria-hidden="true"></i>
                                <a href="mailto:support@medic.com">
                                    <p>support@medic.com</p>
                                </a>
                            </li>
                            <li class="item">
                                <i class="fas fa-phone" aria-hidden="true"></i>
                                <p>(88017) +123 4567</p>
                            </li>
                        </ul>
                        <ul class="list-inline social-icons">
                            <li class="list-inline-item"><a href="https://facebook.com/themefisher"
                                    aria-label="facebook"><i class="fab fa-facebook-f"></i></a></li>
                            <li class="list-inline-item"><a href="https://twitter.com/themefisher"
                                    aria-label="twitter"><i class="fab fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="https://instagram.com/themefisher"
                                    aria-label="instagram"><i class="fab fa-instagram"></i></a></li>
                            <li class="list-inline-item"><a href="https://github.com/themefisher" aria-label="github"><i
                                        class="fab fa-github"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-5 mb-3 mb-md-0">
                    <h2>Layanan Kami</h2>
                    <ul class="menu-link">

                        <li>
                            <a href="{{ url('/') }}">
                                <i class="fa fa-angle-right" aria-hidden="true"></i>Bantuan</a>
                        </li>
                        <li>
                            <a href="{{ url('/') }}">
                                <i class="fa fa-angle-right" aria-hidden="true"></i>Garansi</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container clearfix">
            <div class="copyright-text">
                <p>&copy; Copyright {{ date('Y') }} .
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
