<footer class="footer">
    <div class="copy-right_text">
        <div class="container">
            <div class="footer_border"></div>
            <div class="row">
                <div class="col-xl-12">
                    <p class="copy_right text-center">

                        @lang('lang.copyright')
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script
    src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-de7e2ef6bfefd24b79a3f68b414b87b8db5b08439cac3f1012092b2290c719cd.js">
</script>
<script src=" https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

{{-- <script src="{{ asset('js/vendor/modernizr-3.5.0.min.js') }}"></script> --}}

<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('frontend/js/ajax-form.js') }}"></script>
<script src="{{ asset('frontend/js/waypoints.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('frontend/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('frontend/js/scrollIt.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.scrollUp.min.js') }}"></script>
<script src="{{ asset('frontend/js/wow.min.js') }}"></script>
<script src="{{ asset('frontend/js/nice-select.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.slicknav.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('frontend/js/plugins.js') }}"></script>

<script src="{{ asset('frontend/js/slick.min.js') }}"></script>

<script src="{{ asset('frontend/js/contact.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.ajaxchimp.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.form.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('frontend/js/mail-script.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>
<script>
    function collision($div1, $div2) {
        var x1 = $div1.offset().left;
        var w1 = 40;
        var r1 = x1 + w1;
        var x2 = $div2.offset().left;
        var w2 = 40;
        var r2 = x2 + w2;

        if (r1 < x2 || x1 > r2) return false;
        return true;
    }
    // Fetch Url value
    var getQueryString = function(parameter) {
        var href = window.location.href;
        var reg = new RegExp("[?&]" + parameter + "=([^&#]*)", "i");
        var string = reg.exec(href);
        return string ? string[1] : null;
    };
    // End url
    // // slider call
    $("#slider").slider({
        range: true,
        min: 20,
        max: 200,
        step: 1,
        values: [
            getQueryString("minval") ? getQueryString("minval") : 20,
            getQueryString("maxval") ? getQueryString("maxval") : 200,
        ],

        slide: function(event, ui) {
            $(".ui-slider-handle:eq(0) .price-range-min").html(
                ui.values[0] + "K"
            );
            $(".ui-slider-handle:eq(1) .price-range-max").html(
                ui.values[1] + "K"
            );
            $(".price-range-both").html(
                "<i>K" + ui.values[0] + " - </i>K" + ui.values[1]
            );

            // get values of min and max
            $("#minval").val(ui.values[0]);
            $("#maxval").val(ui.values[1]);

            if (ui.values[0] == ui.values[1]) {
                $(".price-range-both i").css("display", "none");
            } else {
                $(".price-range-both i").css("display", "inline");
            }

            if (collision($(".price-range-min"), $(".price-range-max")) == true) {
                $(".price-range-min, .price-range-max").css("opacity", "0");
                $(".price-range-both").css("display", "block");
            } else {
                $(".price-range-min, .price-range-max").css("opacity", "1");
                $(".price-range-both").css("display", "none");
            }
        },
    });

    $(".ui-slider-range").append(
        '<span class="price-range-both value"><i>' +
        $("#slider").slider("values", 0) +
        " - </i>" +
        $("#slider").slider("values", 1) +
        "</span>"
    );

    $(".ui-slider-handle:eq(0)").append(
        '<span class="price-range-min value">' +
        $("#slider").slider("values", 0) +
        "k</span>"
    );

    $(".ui-slider-handle:eq(1)").append(
        '<span class="price-range-max value">' +
        $("#slider").slider("values", 1) +
        "k</span>"
    );
</script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag("js", new Date());

    gtag("config", "UA-23581568-13");
</script>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/v84a3a4012de94ce1a686ba8c167c359c1696973893317"
    integrity="sha512-euoFGowhlaLqXsPWQ48qSkBSCFs3DPRyiwVu3FjR96cMPx+Fr+gpWRhIafcHwqwCqWS42RZhIudOvEI+Ckf6MA=="
    data-cf-beacon='{"rayId":"857c891b78fb771b","b":1,"version":"2024.2.1","token":"cd0b4b3a733644fc843ef0b185f98241"}'
    crossorigin="anonymous"></script>


@yield('script')
