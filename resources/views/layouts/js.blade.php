
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>

<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/custom.js" type="text/javascript"></script>
<script src="assets/demo/demo10/base/scripts.bundle.js" type="text/javascript"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.9.1/underscore.js"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/0.5.7/chartjs-plugin-annotation.min.js"></script>
<script>
    $(window).on('load', function () {
        $('body').removeClass('m-page--loading');
        $(document).ready(function () {
            var link = window.location.href.split('/');
            var page = link[link.length - 1];
            // now select the link based on the address
            $('li > a[href="/' + page + '"]').closest('li').addClass('m-menu__item--active');
            $('li.m-menu__item--active').closest('.m-menu__item--submenu').addClass('m-menu__item--active');
            $('li.m-menu__item--active').closest('.m-menu__item--submenu').addClass('m-menu__item--active-tab');
        })

        $('.m-menu__toggle').click(function () {
            var title = $(this).attr("title");
            var defaultUrl = title + 'map';
            var currentUrlName = location.pathname;
            if (title == '') {
                window.location.href = location.origin;
                return;
            }
            if (currentUrlName.indexOf('dust') != -1) {
                window.location.href = location.origin + currentUrlName.replace("dust", title);
            } else if (currentUrlName.indexOf('noise') != -1) {
                window.location.href = location.origin + currentUrlName.replace("noise", title);
            } else if (currentUrlName.indexOf('vibration') != -1) {
                window.location.href = location.origin + currentUrlName.replace("vibration", title);
            } else {
                window.location.href = location.origin + '/' + defaultUrl;
            }
        })
    });
</script>
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.js'></script>