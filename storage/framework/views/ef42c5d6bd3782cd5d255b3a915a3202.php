<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Route Playback</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #map {
            height: 600px;
            width: 100%;
        }
        .playback-controls {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .route-info {
            background: #e9ecef;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1 class="mt-4">Driver Route Playback</h1>
                
                <!-- Route Selection Form -->
                <div class="playback-controls">
                    <form id="routeForm">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="driver_id" class="form-label">Select Driver</label>
                                <select class="form-select" id="driver_id" name="driver_id" required>
                                    <option value="">Choose Driver...</option>
                                    <?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($driver->id); ?>">
                                            <?php echo e($driver->user->name); ?> - <?php echo e($driver->vehicle ? $driver->vehicle->vehicle_number : 'No Vehicle'); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="date" class="form-label">Select Date</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">Load Route</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Route Information -->
                <div id="routeInfo" class="route-info" style="display: none;">
                    <div class="row">
                        <div class="col-md-3">
                            <strong>Start Time:</strong> <span id="startTime">-</span>
                        </div>
                        <div class="col-md-3">
                            <strong>End Time:</strong> <span id="endTime">-</span>
                        </div>
                        <div class="col-md-3">
                            <strong>Total Points:</strong> <span id="totalPoints">-</span>
                        </div>
                        <div class="col-md-3">
                            <strong>Vehicle:</strong> <span id="vehicleInfo">-</span>
                        </div>
                    </div>
                </div>

                <!-- Playback Controls -->
                <div class="playback-controls" id="playbackControls" style="display: none;">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <button id="playPause" class="btn btn-success">Play</button>
                            <button id="reset" class="btn btn-secondary">Reset</button>
                        </div>
                        <div class="col-md-8">
                            <input type="range" class="form-range" id="playbackSpeed" min="1" max="10" value="5">
                            <label class="form-label">Speed: <span id="speedValue">5x</span></label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="showRoute" checked>
                                <label class="form-check-label" for="showRoute">Show Route</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Map Container -->
                <div id="map"></div>
            </div>
        </div>
    </div>

    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    
    <!-- Leaflet Polyline Animation -->
    <script src="https://cdn.jsdelivr.net/npm/leaflet.polyline.snakeanim@1.0.2/L.Polyline.SnakeAnim.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        let map;
        let routePolyline;
        let driverMarker;
        let routePoints = [];
        let currentPointIndex = 0;
        let playbackInterval;
        let isPlaying = false;

        // Initialize map
        function initMap() {
            map = L.map('map').setView([0, 0], 2);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);
        }

        // Load route data
        document.getElementById('routeForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('<?php echo e(route("route.playback.data")); ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    displayRoute(data);
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error loading route data');
            });
        });

        // Display route on map
        function displayRoute(data) {
            // Clear existing layers
            if (routePolyline) map.removeLayer(routePolyline);
            if (driverMarker) map.removeLayer(driverMarker);
            
            routePoints = data.route;
            currentPointIndex = 0;
            
            // Create polyline
            const latlngs = routePoints.map(point => [point.lat, point.lng]);
            routePolyline = L.polyline(latlngs, { color: 'blue', weight: 4 }).addTo(map);
            
            // Fit map to route bounds
            map.fitBounds(routePolyline.getBounds());
            
            // Create driver marker
            const startPoint = routePoints[0];
            driverMarker = L.marker([startPoint.lat, startPoint.lng])
                .addTo(map)
                .bindPopup(`Start: ${startPoint.timestamp}`)
                .openPopup();
            
            // Update route info
            document.getElementById('startTime').textContent = data.start_location.timestamp;
            document.getElementById('endTime').textContent = data.end_location.timestamp;
            document.getElementById('totalPoints').textContent = data.total_points;
            document.getElementById('vehicleInfo').textContent = data.start_location.vehicle;
            
            // Show controls and info
            document.getElementById('routeInfo').style.display = 'block';
            document.getElementById('playbackControls').style.display = 'block';
            
            // Reset playback
            resetPlayback();
        }

        // Playback controls
        document.getElementById('playPause').addEventListener('click', function() {
            if (isPlaying) {
                pausePlayback();
            } else {
                startPlayback();
            }
        });

        document.getElementById('reset').addEventListener('click', resetPlayback);

        document.getElementById('playbackSpeed').addEventListener('input', function() {
            const speed = this.value;
            document.getElementById('speedValue').textContent = speed + 'x';
            
            if (isPlaying) {
                pausePlayback();
                startPlayback();
            }
        });

        function startPlayback() {
            isPlaying = true;
            document.getElementById('playPause').textContent = 'Pause';
            document.getElementById('playPause').classList.remove('btn-success');
            document.getElementById('playPause').classList.add('btn-warning');
            
            const speed = 1000 / document.getElementById('playbackSpeed').value;
            
            playbackInterval = setInterval(() => {
                if (currentPointIndex < routePoints.length - 1) {
                    currentPointIndex++;
                    updateDriverPosition();
                } else {
                    pausePlayback();
                }
            }, speed);
        }

        function pausePlayback() {
            isPlaying = false;
            document.getElementById('playPause').textContent = 'Play';
            document.getElementById('playPause').classList.remove('btn-warning');
            document.getElementById('playPause').classList.add('btn-success');
            
            if (playbackInterval) {
                clearInterval(playbackInterval);
            }
        }

        function resetPlayback() {
            pausePlayback();
            currentPointIndex = 0;
            updateDriverPosition();
        }

        function updateDriverPosition() {
            const point = routePoints[currentPointIndex];
            
            // Update marker position
            driverMarker.setLatLng([point.lat, point.lng]);
            driverMarker.setPopupContent(`
                Time: ${point.timestamp}<br>
                Speed: ${point.speed || 'N/A'} km/h<br>
                Vehicle: ${point.vehicle}
            `);
            
            // Center map on current position
            map.panTo([point.lat, point.lng]);
        }

        // Initialize map when page loads
        document.addEventListener('DOMContentLoaded', initMap);
    </script>
</body>
</html><?php /**PATH C:\wamp64\www\vlocus\resources\views/route-playback/index.blade.php ENDPATH**/ ?>