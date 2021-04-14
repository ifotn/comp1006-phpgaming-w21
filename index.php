<?php
$title = 'Home';
include 'header.php';
?>
<main class="container">
    <h1>PHP Gaming</h1>
    <p>This site is built using PHP and MySQL and hosted on AWS.</p>
    <p>We're building it for COMP1006 Intro to Web Programming @ Georgian College.</p>
    <p>Source Code available on
        <a href="https://github.com/ifotn/comp1006-phpgaming-w21.git">GitHub</a>.
    </p>
    <p>All game images sourced from
        <a href="https://wikipedia.org" target="_blank">Wikipedia</a>.
    </p>
    <!-- weather widget start --><div id="m-booked-small-t2-35465"> <div class="booked-weather-120x36 w120x36-03" style="background-color:#2071C9; color:#FFFFFF; border-radius:4px; -moz-border-radius:4px;"> <div style="color:#FFFFFF;" class="booked-bl-simple-city">Barrie</div> <div class="booked-weather-120x36-degree"><span class="plus">+</span>5...<span class="plus">+</span>11&deg; C</div> </div> </div><script type="text/javascript"> var css_file=document.createElement("link"); var widgetUrl = location.href; css_file.setAttribute("rel","stylesheet"); css_file.setAttribute("type","text/css"); css_file.setAttribute("href",'https://s.bookcdn.com/css/w/bw-120-36.css?v=0.0.1'); document.getElementsByTagName("head")[0].appendChild(css_file); function setWidgetData_35465(data) { if(typeof(data) != 'undefined' && data.results.length > 0) { for(var i = 0; i < data.results.length; ++i) { var objMainBlock = document.getElementById('m-booked-small-t2-35465'); if(objMainBlock !== null) { var copyBlock = document.getElementById('m-bookew-weather-copy-'+data.results[i].widget_type); objMainBlock.innerHTML = data.results[i].html_code; if(copyBlock !== null) objMainBlock.appendChild(copyBlock); } } } else { alert('data=undefined||data.results is empty'); } } var widgetSrc = "https://widgets.booked.net/weather/info?action=get_weather_info;ver=6;cityID=26910;type=12;scode=2;domid=w209;anc_id=6326;cmetric=1;wlangID=1;color=2071c9;wwidth=118;header_color=2071c9;text_color=ffffff;link_color=ffffff;border_form=0;footer_color=2071c9;footer_text_color=ffffff;transparent=0";widgetSrc += ';ref=' + widgetUrl;widgetSrc += ';rand_id=35465';widgetSrc += ';wstrackId=57456256';var weatherBookedScript = document.createElement("script"); weatherBookedScript.setAttribute("type", "text/javascript"); weatherBookedScript.src = widgetSrc; document.body.appendChild(weatherBookedScript) </script><!-- weather widget end -->
</main>
</body>
</html>
