<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delivery Route</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <style>
        #map { height: 500px; width: 100%; }
        .toggle-buttons { margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="toggle-buttons">
        <button onclick="loadRoute('admin')">Admin Route</button>
        <button onclick="loadRoute('optimized')">Optimized Route</button>
        <button class="btn btn-primary" id="openGoogleRoute">Open Google Maps Route</button>
    </div>
    <div id="map"></div>

    <script>
        let map = L.map('map').setView([0, 0], 10); // Default view
        let routeLayer;
        let adminRoute = <?php echo json_encode($adminRoute, 15, 512) ?>;
        let optimizedRoute = <?php echo json_encode($optimizedRoute, 15, 512) ?>;

        // Load Map Tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        function loadRoute(type) {
            if (routeLayer) map.removeLayer(routeLayer);

            let route = type === 'admin' ? adminRoute : optimizedRoute;
            if (route.length < 2) {
                alert("At least two locations are required.");
                return;
            }

            let latlngs = route.map(loc => loc.split(',').map(Number));

            // Set map center to the first point
            map.setView(latlngs[0], 12);

            // Draw route
            routeLayer = L.polyline(latlngs, { color: type === 'admin' ? 'blue' : 'green', weight: 5 }).addTo(map);

            // Add markers
            latlngs.forEach((latlng, index) => {
                L.marker(latlng).addTo(map).bindPopup(`Stop ${index + 1}`);
            });
        }

        loadRoute('admin'); // Default route
    </script>
    <script>
    document.getElementById('openGoogleRoute').addEventListener('click', function () {
        const shops = <?php echo json_encode($shopsForMap, 15, 512) ?>;

        // Optionally include user location first
        navigator.geolocation.getCurrentPosition(function (position) {
            const userLat = position.coords.latitude;
            const userLng = position.coords.longitude;

            let url = `https://www.google.com/maps/dir/${userLat},${userLng}`;

            shops.forEach(shop => {
                url += `/${shop.lat},${shop.lng}`;
            });

            window.open(url, '_blank');
        }, function () {
            // If location not allowed, use only shop points
            let url = `https://www.google.com/maps/dir`;
            shops.forEach(shop => {
                url += `/${shop.lat},${shop.lng}`;
            });
            window.open(url, '_blank');
        });
    });
</script>
</body>
</html>
<?php /**PATH /home/u697667486/domains/delivery.flexcellents.com/public_html/resources/views/admin/delivery_schedules/show.blade.php ENDPATH**/ ?>