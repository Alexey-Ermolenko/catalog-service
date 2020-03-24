<?php

/* @var $this yii\web\View */
/* @var $companyPointsDataProvider \yii\data\ArrayDataProvider */

$this->title = 'My Yii Application';

$markers = [];

foreach ($companyPointsDataProvider->getModels() as $model) {
    $markers[] = [
        "id"         => $model['id'],
        "title"      => $model['name'],
        "lat"        => $model['latitude'],
        "lng"        => $model['longitude'],
        "created_at" => $model['created_at'],
        "updated_at" => $model['updated_at'],
    ];
}
?>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZkm7IUBM4g19HrxlWOqx0aGczXwwVJcw&callback=initMap"></script>
<script type="text/javascript">
    <?php
    $objJSON = json_encode($markers);
    echo "var markers  = " . $objJSON . ";\n";
    ?>
    window.onload = function () {
        var mapOptions   = {
            center   : new google.maps.LatLng(markers[0].lat, markers[0].lng),
            zoom     : 10,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map          = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
        var infoWindow   = new google.maps.InfoWindow();
        var lat_lng      = [];
        var latlngbounds = new google.maps.LatLngBounds();
        for (i = 0; i < markers.length; i++) {
            var data     = markers[i]
            var myLatlng = new google.maps.LatLng(data.lat, data.lng);
            lat_lng.push(myLatlng);
            var marker = new google.maps.Marker({
                position: myLatlng,
                map     : map,
                title   : data.title
            });
            latlngbounds.extend(marker.position);
            (function (marker, data) {
                google.maps.event.addListener(marker, "click", function (e) {

                    let html =
                        "<p>" +
                            "<h3>" + data.title + "</h3>" + "<br/>" +
                            data.lat + " - " + data.lng + "<br/>" +
                            data.created_at + " - " + data.updated_at +
                        "</p>"
                    ;
                    infoWindow.setContent(html);
                    infoWindow.open(map, marker);
                });
            })(marker, data);
        }
        map.setCenter(latlngbounds.getCenter());
        map.fitBounds(latlngbounds);

    }
</script>
<div class="site-index">
    <div class="row">
        <div id="dvMap" style="width: 100%; height: 700px"></div>
    </div>
</div>


