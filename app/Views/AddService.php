<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaflet with Start and End Markers</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.min.js"></script>
    <style>
        body { margin: 0; padding: 0; }
        #map { width: 1200px; height: 800px; margin: 0 auto; }
        #reset-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
        #reset-btn:hover {
            background-color: #ff1a1a;
        }
    </style>
</head>
<body>

<div id="map"></div>
<button id="reset-btn">ریست</button> <!-- دکمه ریست -->

<script>
    // ایجاد نقشه
    const map = L.map('map').setView([35.6892, 51.3890], 12); // مختصات تهران

    // اضافه کردن لایه نقشه
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    // متغیرهای مارکرها و نقاط
    let startPoint = null;
    let endPoint = null;
    let startMarker = null;
    let endMarker = null;
    let routingControl = null;

    // جستجوگر
    const geocoder = L.Control.geocoder({
        defaultMarkGeocode: false,
    }).on('markgeocode', function(e) {
        const bbox = e.geocode.bbox;
        const poly = L.polygon([
            [bbox.getSouthEast().lat, bbox.getSouthEast().lng],
            [bbox.getNorthEast().lat, bbox.getNorthEast().lng],
            [bbox.getNorthWest().lat, bbox.getNorthWest().lng],
            [bbox.getSouthWest().lat, bbox.getSouthWest().lng]
        ]);
        map.fitBounds(poly.getBounds());
    }).addTo(map);

    // افزودن مارکر قابل جابجایی
    function addDraggableMarker(latlng, color, isStartPoint) {
        const marker = L.marker(latlng, { draggable: true, icon: L.icon({
            iconUrl: `https://unpkg.com/leaflet@1.9.3/dist/images/marker-icon-${color}.png`,
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
        }) }).addTo(map);

        marker.on('dragend', function() {
            const newLatLng = marker.getLatLng();
            if (isStartPoint) {
                startPoint = [newLatLng.lat, newLatLng.lng];
            } else {
                endPoint = [newLatLng.lat, newLatLng.lng];
            }
            checkRoute();
        });

        return marker;
    }

    // انتخاب نقطه با کلیک روی نقشه
    map.on('click', function(e) {
        const latlng = [e.latlng.lat, e.latlng.lng];
        if (!startPoint) {
            // اگر نقطه شروع انتخاب نشده باشد
            if (startMarker) map.removeLayer(startMarker);
            startPoint = latlng;
            startMarker = addDraggableMarker(startPoint, 'green', true);
            console.log(`نقطه شروع انتخاب شد: ${startPoint}`);
        } else if (!endPoint) {
            // اگر نقطه پایان انتخاب نشده باشد
            if (endMarker) map.removeLayer(endMarker);
            endPoint = latlng;
            endMarker = addDraggableMarker(endPoint, 'red', false);
            console.log(`نقطه پایان انتخاب شد: ${endPoint}`);
            checkRoute(); // بعد از انتخاب مقصد، مسیر نمایش داده شود
        } else {
            console.log("هر دو نقطه قبلاً انتخاب شده‌اند. ابتدا یکی را جابجا کنید.");
        }
    });

    // محاسبه و نمایش مسیر
    function checkRoute() {
        if (startPoint && endPoint) {
            if (routingControl) {
                map.removeControl(routingControl);
            }
            routingControl = L.Routing.control({
                waypoints: [
                    L.latLng(startPoint[0], startPoint[1]),
                    L.latLng(endPoint[0], endPoint[1])
                ],
                routeWhileDragging: true,
                createMarker: function() { return null; }, // غیرفعال کردن مارکرهای پیش‌فرض
            }).on('routesfound', function(e) {
                const route = e.routes[0];
                const distance = route.summary.totalDistance / 1000; // به کیلومتر
                let duration = route.summary.totalTime / 60; // به دقیقه

                console.log(`مسافت: ${distance.toFixed(2)} کیلومتر`);
                console.log(`زمان تقریبی: ${formatDuration(duration)}`);
            }).addTo(map);
        }
    }

    // فرمت زمان براساس دقیقه، ساعت و روز
    function formatDuration(duration) {
        if (duration < 60) {
            return `${duration.toFixed(0)} دقیقه`;
        } else if (duration < 1440) {
            const hours = Math.floor(duration / 60);
            const minutes = duration % 60;
            return `${hours} ساعت و ${minutes.toFixed(0)} دقیقه`;
        } else {
            const days = Math.floor(duration / 1440);
            const hours = Math.floor((duration % 1440) / 60);
            const minutes = duration % 60;
            return `${days} روز و ${hours} ساعت و ${minutes.toFixed(0)} دقیقه`;
        }
    }

    // تابع ریست کردن نقاط و مسیر
    function resetMarkers() {
        if (startMarker) map.removeLayer(startMarker);
        if (endMarker) map.removeLayer(endMarker);
        if (routingControl) map.removeControl(routingControl);
        startPoint = null;
        endPoint = null;
        startMarker = null;
        endMarker = null;
        routingControl = null;
        console.log("نقاط و مسیر ریست شد.");
    }

    // افزودن event listener به دکمه ریست
    document.getElementById('reset-btn').addEventListener('click', resetMarkers);

</script>

</body>
</html>
