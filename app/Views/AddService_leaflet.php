<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مسیریابی با نشان و Leaflet</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
        #reset-btn {
            margin: 10px;
            padding: 10px 20px;
            background-color: #f44336;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div id="map"></div>
<button id="reset-btn">ریست</button>

<div id="details">
    <p id="start-address">آدرس نقطه شروع: </p>
    <p id="end-address">آدرس نقطه پایان: </p>
    <p id="distance">مسافت: </p>
    <p id="duration">زمان: </p>
    <p id="fare">کرایه: </p>
</div>



<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
// کلید API نشان
const apiKey = 'service.89629a97053c4dd3bd06adb146db6886';  

// تنظیمات نقشه Leaflet با استفاده از OpenStreetMap
const map = L.map('map').setView([35.6892, 51.3890], 12);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

// تابع برای دریافت آدرس متنی از API نشان
function getAddress(lat, lng, elementId) {
    const url = `https://api.neshan.org/v5/reverse?lat=${lat}&lng=${lng}`;
    fetch(url, {
        method: 'GET',
        headers: {
            'Api-Key': apiKey
        }
    }).then(response => response.json())
      .then(data => {
        document.getElementById(elementId).innerHTML = `آدرس: ${data.formatted_address}`;
    });
}

// تابع برای دریافت مسافت و زمان از API نشان
function getRoute(startLat, startLng, endLat, endLng) {
    const url = `https://api.neshan.org/v1/routing?origin=${startLat},${startLng}&destination=${endLat},${endLng}&avoidTrafficZone=false&avoidOddEvenZone=false&alternative=false`;
    
    return fetch(url, {
        method: 'GET',
        headers: {
            'Api-Key': apiKey
        }
    }).then(response => response.json());
}

// رسم مسیر روی نقشه
function drawRoute(route) {
    const routeCoordinates = route.routes[0].legs[0].steps.map(step => {
        return [step.start_location[1], step.start_location[0]];
    });

    const polyline = L.polyline(routeCoordinates, { color: 'blue' }).addTo(map);
    map.fitBounds(polyline.getBounds());
}

// محاسبه کرایه بر اساس مسافت و زمان
function calculateFare(distanceKm, durationMinutes) {
    const baseFarePerKm = 10000; // کرایه پایه به ازای هر کیلومتر
    const tollFare = 50000; // هزینه عوارض (مثال)
    const totalFare = distanceKm * baseFarePerKm + tollFare;
    return totalFare;
}

// متغیرهای نقاط شروع و پایان
let startMarker, endMarker;
let startLat, startLng, endLat, endLng;

// اضافه کردن نقاط به نقشه
map.on('click', function(e) {
    if (!startMarker) {
        // اگر نقطه شروع انتخاب نشده است
        startLat = e.latlng.lat;
        startLng = e.latlng.lng;
        startMarker = L.marker([startLat, startLng]).addTo(map)
            .bindPopup("نقطه شروع").openPopup();

        // دریافت آدرس نقطه شروع
        getAddress(startLat, startLng, 'start-address');
    } else if (!endMarker) {
        // اگر نقطه پایان انتخاب نشده است
        endLat = e.latlng.lat;
        endLng = e.latlng.lng;
        endMarker = L.marker([endLat, endLng]).addTo(map)
            .bindPopup("نقطه پایان").openPopup();

        // دریافت آدرس نقطه پایان
        getAddress(endLat, endLng, 'end-address');

        // درخواست مسیر از API نشان
        getRoute(startLat, startLng, endLat, endLng).then(route => {
            drawRoute(route);  // رسم مسیر

            // دریافت اطلاعات مسافت و زمان
            const distanceMeters = route.routes[0].legs[0].distance.value;
            const durationSeconds = route.routes[0].legs[0].duration.value;
            const distanceKm = (distanceMeters / 1000).toFixed(2);
            const durationMinutes = Math.ceil(durationSeconds / 60);

            document.getElementById('distance').innerHTML = `مسافت: ${distanceKm} کیلومتر`;
            document.getElementById('duration').innerHTML = `زمان: ${durationMinutes} دقیقه`;

            // محاسبه کرایه
            const fare = calculateFare(distanceKm, durationMinutes);
            document.getElementById('fare').innerHTML = `کرایه: ${fare.toLocaleString()} ریال`;
        });
    }
});

// دکمه ریست برای پاک کردن نقشه
document.getElementById('reset-btn').addEventListener('click', function() {
    map.eachLayer(function(layer) {
        if (layer instanceof L.Polyline || layer instanceof L.Marker) {
            map.removeLayer(layer);
        }
    });
    startMarker = null;
    endMarker = null;
    startLat = null;
    startLng = null;
    endLat = null;
    endLng = null;
    document.getElementById('start-address').innerHTML = 'آدرس نقطه شروع: ';
    document.getElementById('end-address').innerHTML = 'آدرس نقطه پایان: ';
    document.getElementById('distance').innerHTML = 'مسافت: ';
    document.getElementById('duration').innerHTML = 'زمان: ';
    document.getElementById('fare').innerHTML = 'کرایه: ';
});

</script>

</body>
</html>
