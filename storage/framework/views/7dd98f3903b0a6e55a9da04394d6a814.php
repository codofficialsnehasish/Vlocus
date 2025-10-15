

<?php $__env->startSection('title', $page->meta_title ?? 'Home'); ?>
<?php $__env->startSection('meta_description', $page->meta_description ?? ''); ?>
<?php $__env->startSection('meta_keywords', $page->meta_keywords ?? ''); ?>

<?php $__env->startSection('content'); ?>
    <!--  <section class="top_banner">
        <div class="container">
            <div class="row mx-2">
                <div class="col-lg-6 col-md-6">
                    <h1>Quality Car Rental</h1>
                    <h1>In The Town,</h1>
                    <h2 class="d-flex">Safety
                        <button class="alignment rounded-circle">
                            <img src="<?php echo e(asset('assets/frontend_assets/img/home/img18.png')); ?>" alt="" srcset=""
                                class="top_banner_arrow">
                        </button>
                    </h2>
                </div>
                <div class="col-lg-6 col-md-6">
                    <img src="<?php echo e(asset('assets/frontend_assets/img/home/img1.png')); ?>" alt="" srcset=""
                        class="top_banner_img">
                </div>
            </div>
        </div>
    </section> -->
    

    

    <section class="topBanner py-5 px-3 search_warp">
        <div class="container-fluid">
            <div class="row booking-form">
                <div class="col-lg-12 fild_warp">
                    <div class="fild_search">
                        <h1 class="mb-3">From Here to Anywhere</h1>
                        <p>Enter your starting point, destination, and date to find the best routes.</p>
                      
                        
                          
                         <div class="tab_warp">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <?php $__currentLoopData = $vehicle_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $vehicle_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link <?php echo e($index == 0 ? 'active' : ''); ?>"
                                            id="tab-<?php echo e($vehicle_type->id); ?>" data-bs-toggle="tab"
                                            data-bs-target="#tab-pane-<?php echo e($vehicle_type->id); ?>" type="button" role="tab"
                                            aria-controls="tab-pane-<?php echo e($vehicle_type->id); ?>"
                                            aria-selected="<?php echo e($index == 0 ? 'true' : 'false'); ?>">
                                            <img src="<?php echo e($vehicle_type->getFirstMediaUrl('vehicle-type-icon')); ?>"
                                                alt=""
                                                style="display: <?php echo e(is_have_image($vehicle_type->getFirstMediaUrl('vehicle-type-icon'))); ?>;">
                                        </button>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>

                            <div class="tab-content" id="myTabContent">
                                <?php $__currentLoopData = $vehicle_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $vehicle_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="tab-pane fade <?php echo e($index == 0 ? 'show active' : ''); ?>"
                                        id="tab-pane-<?php echo e($vehicle_type->id); ?>" role="tabpanel"
                                        aria-labelledby="tab-<?php echo e($vehicle_type->id); ?>" tabindex="0">

                                        <form action="<?php echo e(route('book-buss')); ?>" method="GET" class="ajax-booking-form"
                                            id="index-booking-form" >
                                            <input type="hidden" name="vehicle_type_id" value="<?php echo e($vehicle_type->id); ?>">

                                            <div class="align-items-center">
                                                <!-- From -->
                                                <div class="col-lg-12 col-md-12 d-flex mb-2 position-relative">
                                                    <i class="fa fa-circle position-absolute"
                                                        style="left: 10px; top: 50%; transform: translateY(-50%); color: #555;"></i>
                                                    <input type="text" name="from" id="from" class="from" value="<?php echo e($from ?? ''); ?>"
                                                        placeholder="Enter Pickup location"
                                                        style="padding-left: 40px; width: 100%; border-radius:10px;">
                                                </div>

                                                <!-- To -->
                                                <div class="col-lg-12 col-md-12 d-flex mb-2 position-relative">
                                                    <i class="fa fa-stop-circle position-absolute"
                                                        style="left: 10px; top: 50%; transform: translateY(-50%); color: #555;"></i>
                                                    <input type="text" name="to" id="to" class="to" value="<?php echo e($to ?? ''); ?>"
                                                        placeholder="Enter dropoff location"
                                                        style="padding-left: 40px; width: 100%; border-radius:10px;">
                                                </div>

                                                <!-- Date -->
                                                <div class="d-flex col-lg-12 col-md-12 col-12 col-sm-12">
                                                    <div class="col-lg-8 col-md-8 col-8 col-sm-8 d-flex flex-column">
                                                        <input class="flatpickr-input" type="text" name="date"
                                                            placeholder="Select Date" value="<?php echo e($date ?? date('Y-m-d')); ?>"
                                                            style="border-radius:10px;">
                                                    </div>

                                                    <!-- Search Button -->
                                                    <div class="col-lg-4 col-md-4 col-4 col-sm-4">
                                                        <button
                                                            <?php if(auth()->guard()->check()): ?> type="submit" <?php else: ?> type="button"
                                                            data-bs-toggle="modal" data-bs-target="#exampleModalCenter" <?php endif; ?>
                                                            class="btn btn_style mx-1" style="border-radius:10px; width:100%">
                                                            Search Now
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        
                        
                        
                        <div class="viewBusesBox">
                            <div class="container">
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    
                    
                  
                    
                    
                    <div id="map" style="width: 100%; height: 400px; border-radius: 15px;"></div>
                </div>
            </div>
            
        </div>
        
        <div class="container">
            <div class="row mx-2">
        
        
        <div class="fild_search2" style="display: none">
                         
                        <div id="result-container"></div>
                        
                    
                    </div>
        
        </div></div>
        
    </section>

    <section class="track_shipment">
        <div class="container">
            <div class="row mx-2">
                <div class="col-lg-5 col-md-5">
                    <img src="<?php echo e(asset('assets/frontend_assets/img/home/img17.png')); ?>" alt="" srcset=""
                        class="track_shipment_img">
                </div>
                <div class="col-lg-7 col-md-7 alignment">
                    <div class=" track_shipment_padding">
                        <h1>Track your shipment through the application, At Any Time! </h1>
                        <p>No more uncertainty or endless waiting! Our user-friendly interface allows you to check
                            the status of your shipment anytime, from anywhere. Receive instant notifications about
                            dispatch, transit updates, and estimated delivery times, so you’re always in control.
                            Stay ahead and experience hassle-free shipping with our reliable tracking system today!
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>
    
    <section class="home_points">
        <div class="container">
            <div class="row mx-2">
                <div class="col-lg-6 col-md-12 py-5">
                    <div class="d-flex gfrs">
                        <div class="col-lg-3 col-md-3 me-2">
                            <img src="<?php echo e(asset('assets/frontend_assets/img/home/img5.png')); ?>" alt=""
                                srcset="" class="home_points_icon mx-auto d-block">
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <h2>Virtual Geo Fence</h2>
                            <p>A Virtual Geo-Fence is a digitally defined boundary that uses GPS, RFID, Wi-Fi, or
                                cellular data to trigger specific actions when a device enters or exits a designated
                                area.</p>
                        </div>
                    </div>
                    <div class="d-flex gfrs">
                        <div class="col-lg-3 col-md-3 me-2">
                            <img src="<?php echo e(asset('assets/frontend_assets/img/home/img6.png')); ?>" alt=""
                                srcset="" class="home_points_icon mx-auto d-block">
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <h2>Digital Proof of delivery</h2>
                            <p>A Virtual Geo-Fence is a digitally defined boundary that uses GPS, RFID, Wi-Fi, or
                                cellular data to trigger specific actions when a device enters or exits a designated
                                area.</p>
                        </div>
                    </div>
                    <div class="d-flex gfrs">
                        <div class="col-lg-3 col-md-3 me-2">
                            <img src="<?php echo e(asset('assets/frontend_assets/img/home/img7.png')); ?>" alt=""
                                srcset="" class="home_points_icon mx-auto d-block">
                        </div>
                        <div class="col-lg-9 col-lg-9">
                            <h2>Route Optimization for Multiple Deliveries </h2>
                            <p>A Virtual Geo-Fence is a digitally defined boundary that uses GPS, RFID, Wi-Fi, or
                                cellular data to trigger specific actions when a device enters or exits a designated
                                area.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 py-5">
                    <img src="<?php echo e(asset('assets/frontend_assets/img/home/img8.png')); ?>" alt="" srcset=""
                        class="home_points_img">
                </div>
            </div>
        </div>
    </section>
    <!--<section class="home_solution">
        <div class="container">
            <div class="row mx-3 pb-3">
                <h1>Solution For Every<b> Business Need</b></h1>
                <p>Whatever you deliver we will help you improve your delivery wit</p>
            </div>
            <div class="row mx-4">
                <div class="col-lg-12 col-md-12 d-flex ps-0">
                    <div class="col-lg-4 d-flex">
                        <div class="solution_img">
                            <img src="<?php echo e(asset('assets/frontend_assets/img/home/img9.png')); ?>" alt=""
                                srcset="" class="mt-3 mx-auto d-block">
                        </div>
                        <p>Moovers & packers</p>
                    </div>
                    <div class="col-lg-4 col-md-4 d-flex">
                        <div class="solution_img">
                            <img src="<?php echo e(asset('assets/frontend_assets/img/home/img10.png')); ?>" alt=""
                                srcset="" class="mt-3 mx-auto d-block">
                        </div>
                        <p>Food Delivery </p>
                    </div>
                    <div class="col-lg-4 col-md-4 d-flex">
                        <div class="solution_img">
                            <img src="<?php echo e(asset('assets/frontend_assets/img/home/img11.png')); ?>" alt=""
                                srcset="" class="mt-3 mx-auto d-block">
                        </div>
                        <p>E-Commerce</p>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 d-flex ps-0">
                    <div class="col-lg-4 col-md-4 d-flex">
                        <div class="solution_img">
                            <img src="<?php echo e(asset('assets/frontend_assets/img/home/img12.png')); ?>" alt=""
                                srcset="" class="mt-3 mx-auto d-block">
                        </div>
                        <p>Pharma</p>
                    </div>
                    <div class="col-lg-4 col-md-4 d-flex">
                        <div class="solution_img">
                            <img src="<?php echo e(asset('assets/frontend_assets/img/home/img13.png')); ?>" alt=""
                                srcset="" class="mt-3 mx-auto d-block">
                        </div>
                        <p>E-Grocery</p>
                    </div>
                    <div class="col-lg-4 col-md-4 d-flex">
                        <div class="solution_img">
                            <img src="<?php echo e(asset('assets/frontend_assets/img/home/img14.png')); ?>" alt=""
                                srcset="" class="mt-3 mx-auto d-block">
                        </div>
                        <p>Retail</p>
                    </div>
                </div>

            </div>
        </div>
    </section> --> 
    <section class="testimonial">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <img src="<?php echo e(asset('assets/frontend_assets/img/home/img14.png')); ?>" class="img-fluid"
                        alt="">
                </div>

                <div class="col-lg-12 col-md-12 alignment">
                    <div class="mx-3 pb-3 d-flex justify-content-between align-items-center testimonial_header">
                        <h1>What Our <b>Customers Say</b></h1>


                    </div>
                    <!-- Slick Carousel Wrapper -->
                    <div class="testimonial-slider">
                        <!-- Testimonial Item 1 -->
                        <div class="testimonial-item col-lg-12 col-md-12">
                            <div class="d-flex">
                                <img src="<?php echo e(asset('assets/frontend_assets/img/home/img15.png')); ?>" class="me-3"
                                    alt="">
                                <div class="alignment">
                                    <h4>John Doe</h4>
                                    <p class="text-muted">Customer</p>
                                </div>
                            </div>
                            <p>Safety is my top priority when traveling, and this bus agency ensures
                                it. The drivers are well-trained, and the buses are well-maintained.
                                I appreciate the GPS tracking feature, which keeps my family
                                informed about my journey.</p>
                        </div>

                        <!-- Testimonial Item 2 -->
                        <div class="testimonial-item col-lg-12 col-md-12">
                            <div class="d-flex">
                                <img src="<?php echo e(asset('assets/frontend_assets/img/home/img15.png')); ?>" class="me-3"
                                    alt="">
                                <div class="alignment">
                                    <h4>Jane Smith</h4>
                                    <p class="text-muted">Customer</p>
                                </div>
                            </div>
                            <p>Safety is my top priority when traveling, and this bus agency ensures
                                it. The drivers are well-trained, and the buses are well-maintained.
                                I appreciate the GPS tracking feature, which keeps my family
                                informed about my journey.</p>
                        </div>

                        <!-- Testimonial Item 3 -->
                        <div class="testimonial-item col-lg-12 col-md-12">
                            <div class="d-flex">
                                <img src="<?php echo e(asset('assets/frontend_assets/img/home/img15.png')); ?>" class="me-3"
                                    alt="">
                                <div class="alignment">
                                    <h4>Michael Lee</h4>
                                    <p class="text-muted">Customer</p>
                                </div>
                            </div>
                            <p>Safety is my top priority when traveling, and this bus agency ensures
                                it. The drivers are well-trained, and the buses are well-maintained.
                                I appreciate the GPS tracking feature, which keeps my family
                                informed about my journey.</p>
                        </div>

                        <!-- Testimonial Item 4 -->
                        <div class="testimonial-item col-lg-12 col-md-12">
                            <div class="d-flex">
                                <img src="<?php echo e(asset('assets/frontend_assets/img/home/img15.png')); ?>" class="me-3"
                                    alt="">
                                <div class="alignment">
                                    <h4>Alice Brown</h4>
                                    <p class="text-muted">Customer</p>
                                </div>
                            </div>
                            <p>Safety is my top priority when traveling, and this bus agency ensures
                                it. The drivers are well-trained, and the buses are well-maintained.
                                I appreciate the GPS tracking feature, which keeps my family
                                informed about my journey.</p>
                        </div>

                        <!-- Testimonial Item 5 -->
                        <div class="testimonial-item col-lg-12 col-md-12">
                            <div class="d-flex">
                                <img src="<?php echo e(asset('assets/frontend_assets/img/home/img15.png')); ?>" class="me-3"
                                    alt="">
                                <div class="alignment">
                                    <h4>Robert White</h4>
                                    <p class="text-muted">Customer</p>
                                </div>
                            </div>
                            <p>Safety is my top priority when traveling, and this bus agency ensures
                                it. The drivers are well-trained, and the buses are well-maintained.
                                I appreciate the GPS tracking feature, which keeps my family
                                informed about my journey.</p>
                        </div>
                        <!-- Testimonial Item 6 -->
                        <div class="testimonial-item col-lg-12 col-md-12">
                            <div class="d-flex">
                                <img src="<?php echo e(asset('assets/frontend_assets/img/home/img15.png')); ?>" class="me-3"
                                    alt="">
                                <div class="alignment">
                                    <h4>Robert White</h4>
                                    <p class="text-muted">Customer</p>
                                </div>
                            </div>
                            <p>Safety is my top priority when traveling, and this bus agency ensures
                                it. The drivers are well-trained, and the buses are well-maintained.
                                I appreciate the GPS tracking feature, which keeps my family
                                informed about my journey.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="download_app">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-offset-3 col-lg-9 col-md-9">
                    <div class="download_app_margin">
                        <h1>Download<b> The App</b></h1>
                    </div>
                    <div class="d-flex download_app_margin">
                        <div class="col-lg-2 col-sm-12 col-12 col-md-2 alignment me-2"><img
                                src="<?php echo e(asset('assets/frontend_assets/img/home/qrcode.png')); ?>" alt=""
                                srcset="" class="download_app_qr"></div>
                        <div class="col-lg-10 col-sm-10 col-md-10 download_app_m alignment">
                            <h5>Download the Delivery app</h5>
                            <p>Scan to download</p>
                            <div class="d-flex">
                                <button><img src="<?php echo e(asset('assets/frontend_assets/img/home/google_play.png')); ?>"
                                        alt="" srcset="" class="download_app_btn"></button>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 pt-5 download_app_bus">
                    <img src="<?php echo e(asset('assets/frontend_assets/img/home/img16.png')); ?>" alt="" srcset=""
                        class="download_app_img">
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('scripts'); ?>
<!-- Leaflet CSS & JS -->
<script src="https://maps.gomaps.pro/maps/api/js?key=AlzaSyC7RSr791vm_29LJiUOPJO-sLnBZg6qiGl&libraries=places,marker"></script>

<script>
    let map, directionsService, directionsRenderer;

    // $(document).on('click', '.vehicle-link', function(e) {
    //     e.preventDefault(); // Stop default link behavior
    //     var url = $(this).data('url');

    //     $.ajax({
    //         url: url,
    //         type: 'GET', // or 'POST' depending on your route
    //         success: function(response) {
    //             // Handle the response (you can update part of the page, show a modal, etc.)
    //             console.log(response);
    //             $('.fild_search2').show();
    //             $('#result-container').html(response.html);
    //             // Example: $('#result-container').html(response);
    //         },
    //         error: function(xhr) {
    //             // Handle error
    //             $('.fild_search2').hide();
    //             console.error(xhr.responseText);
    //         }
    //     });
    // });

    // $('#index-booking-form').on('submit', function(e) {
    //     e.preventDefault();

    //     $.ajax({
    //         url: "<?php echo e(route('book-buss')); ?>",
    //         method: "GET",
    //         data: $(this).serialize(),
    //         beforeSend: function() {
    //             // Optional: show loading spinner or clear results
    //             $('.viewBusesBox .container').html('<p>Loading...</p>');
    //         },
    //         success: function(response) {
    //             if (response.vehicleCounts) {
    //                 let container = $('.viewBusesBox .container');
    //                 container.empty();

    //                 console.log(response.from_stop.name);

    //                 $.each(response.vehicleCounts, function(type, data) {
    //                     // console.log(data);
    //                     let vehicleRoute = `<?php echo e(route('home.vehicle-search', ['ids' => '__IDS__', 'from' => '__FROM__', 'to' => '__TO__', 'date' => '__DATE__'])); ?>`;
    //                     vehicleRoute = vehicleRoute
    //                         .replace('__IDS__', data.ids.join(','))
    //                         .replace('__FROM__', response.from)
    //                         .replace('__TO__', response.to)
    //                         .replace('__DATE__', response.date);

    //                     //onclick="window.location.href='${vehicleRoute}'"
    //                     let vehicleHtml = `
    //                     <div class="row">
    //                         <div class="col-lg-12 m-auto booking-form d-flex vehicle-link" data-url="${vehicleRoute}" style="cursor: pointer; flex-wrap:wrap;"> 
    //                             <div class="col-lg-3 p-2">
    //                                 <img src="${data.image ?? ''}" alt="" width="100%">
    //                             </div>
    //                             <div class="col-lg-9 alignment p-2">
    //                                 <a href="javascript:void(0)" class="vehicle-link" data-url="${vehicleRoute}" style="text-decoration: none">
    //                                     ${type} (${data.count})
    //                                 </a>
    //                                 <p>Affordable compact rides</p>
    //                             </div>
    //                             <div class="col-lg-2"></div>
    //                         </div>
    //                     </div>
    //                     `;
    //                     container.append(vehicleHtml);
    //                 });

    //                 initMap(
    //                     response.from_stop.latitude,
    //                     response.from_stop.longitude,
    //                     response.to_stop.latitude,
    //                     response.to_stop.longitude,
    //                     response.from_stop.name,
    //                     response.to_stop.name
    //                 );

    //                 // You can also update direction map here if needed
    //             } else {
    //                 $('.viewBusesBox .container').html('<p>No buses found.</p>');
    //             }
    //         },
    //         error: function(xhr) {
    //             let errors = xhr.responseJSON?.errors;
    //             if (errors) {
    //                 alert(Object.values(errors).flat().join("\n"));
    //             } else {
    //                 alert("Something went wrong.");
    //             }
    //         }
    //     });
    // });
    
    
          $(document).on('submit', '.ajax-booking-form', function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo e(route('vehicles.direct-search')); ?>",
                method: "GET",
                data: $(this).serialize(),
                beforeSend: function() {
                    $('.viewBusesBox .container').html('<p>Loading...</p>');
                },
                success: function(response) {
                    console.log(response);

                    let from_bustop = response.data.from_stop;
                    let to_bustop = response.data.to_stop; 
                    $('.viewBusesBox .container').empty(); 
                    $('.fild_search2').show();
                    $('#result-container').html(response.html);
                    initMap(
                            from_bustop.latitude,
                            from_bustop.longitude,
                            to_bustop.latitude,
                            to_bustop.longitude,
                            from_bustop.name,
                            to_bustop.name
                        );
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON?.errors;
                    if (errors) {
                        alert(Object.values(errors).flat().join("\n"));
                    } else {
                        alert("Something went wrong.");
                    }
                }
            });
        });
        

    let vehicleMarkers = {}; // Stores all vehicle markers
    const vehicleIcons = {
        'bus': {
            url: 'https://maps.google.com/mapfiles/ms/icons/bus.png',
            scaledSize: new google.maps.Size(32, 32)
        },
        'taxi': {
            url: 'https://maps.google.com/mapfiles/ms/icons/taxi.png',
            scaledSize: new google.maps.Size(28, 28)
        },
        'auto': {
            url: 'https://maps.google.com/mapfiles/ms/icons/cabs.png',
            scaledSize: new google.maps.Size(26, 26)
        },
        'bike': {
            url: 'https://maps.google.com/mapfiles/ms/icons/motorcycling.png',
            scaledSize: new google.maps.Size(24, 24)
        }
    };

    function initMap(fromLat = null, fromLng = null, toLat = null, toLng = null, from_name = null, to_name = null) {
        console.log('comming to init');
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: 22.5726, lng: 88.3639 }, // Default center
            zoom: 13,
            mapTypeId: 'roadmap'
        });

        directionsService = new google.maps.DirectionsService();
        directionsRenderer = new google.maps.DirectionsRenderer({ map: map });

        console.log(fromLat, fromLng, toLat, toLng);
        // const fromLat = <?php echo json_encode($from_bus_stop->latitude ?? null, 15, 512) ?>;
        // const fromLng = <?php echo json_encode($from_bus_stop->longitude ?? null, 15, 512) ?>;
        // const toLat = <?php echo json_encode($to_bus_stop->latitude ?? null, 15, 512) ?>;
        // const toLng = <?php echo json_encode($to_bus_stop->longitude ?? null, 15, 512) ?>;

        // If both locations exist, draw route
        if (fromLat && fromLng && toLat && toLng) {
            calculateRoute(fromLat, fromLng, toLat, toLng, from_name, to_name);
        } else {
            // Show user's current location
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    position => {
                        const userPos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };

                        map.setCenter(userPos);
                        map.setZoom(17); // Zoom in closer

                        new google.maps.Marker({
                            position: userPos,
                            map: map,
                            title: "Your Location",
                            icon: {
                                url: "http://maps.google.com/mapfiles/ms/icons/red-dot.png", // Red pin
                                scaledSize: new google.maps.Size(48, 48) // Bigger marker
                            }
                        });
                    },
                    () => {
                        console.error("Geolocation permission denied.");
                    }
                );
            } else {
                console.error("Geolocation not supported.");
            }
        }

        startRealTimeUpdates(); // Show moving vehicles if needed
    }


    function calculateRoute(fromLat, fromLng, toLat, toLng, from_name, to_name) {
        const origin = new google.maps.LatLng(fromLat, fromLng);
        const destination = new google.maps.LatLng(toLat, toLng);

        directionsService.route(
            { origin, destination, travelMode: 'DRIVING' },
            (result, status) => {
                if (status === 'OK') {
                    directionsRenderer.setDirections(result);
                    createMarkerWithText(origin, <?php echo json_encode($from_bus_stop->name ?? "Start", 15, 512) ?>, '#4285F4');
                    createMarkerWithText(destination, <?php echo json_encode($to_bus_stop->name ?? "Destination", 15, 512) ?>, '#EA4335');
                }
            }
        );
    }


    function drawRoute(fromLat, fromLng, toLat, toLng) {
        const origin = new google.maps.LatLng(fromLat, fromLng);
        const destination = new google.maps.LatLng(toLat, toLng);

        directionsService.route(
            { origin, destination, travelMode: 'DRIVING' },
            (result, status) => {
                if (status === 'OK') {
                    directionsRenderer.setDirections(result);

                    createMarkerWithText(origin, <?php echo json_encode($from_bus_stop->name ?? "Start", 15, 512) ?>, '#4285F4');
                    createMarkerWithText(destination, <?php echo json_encode($to_bus_stop->name ?? "Destination", 15, 512) ?>, '#EA4335');
                }
            }
        );
    }


    function startRealTimeUpdates() {
        // Fetch vehicle data every 5 seconds
        setInterval(fetchVehicleData, 5000);
        fetchVehicleData(); // Initial load
    }

    function fetchVehicleData() {
        // Replace with your actual API endpoint
        fetch('/vehicles/realtime')
            .then(response => response.json())
            .then(data => updateVehiclePositions(data))
            .catch(error => console.error('Error:', error));
    }

    function updateVehiclePositions(vehicles) {
        // First, remove vehicles that are no longer in the data
        Object.keys(vehicleMarkers).forEach(vehicleId => {
            if (!vehicles.some(v => v.id === vehicleId)) {
                vehicleMarkers[vehicleId].setMap(null);
                delete vehicleMarkers[vehicleId];
            }
        });

        // Update or add new vehicles
        vehicles.forEach(vehicle => {
            const position = new google.maps.LatLng(vehicle.latitude, vehicle.longitude);
            
            if (vehicleMarkers[vehicle.id]) {
                // Update existing marker position
                vehicleMarkers[vehicle.id].setPosition(position);
            } else {
                // Create new marker
                vehicleMarkers[vehicle.id] = new google.maps.Marker({
                    position: position,
                    map: map,
                    icon: vehicleIcons[vehicle.type] || vehicleIcons['auto'],
                    title: `${vehicle.type.toUpperCase()} - ${vehicle.id}`,
                    optimized: false // Better for many markers
                });
                
                // Add info window with vehicle details
                const infoWindow = new google.maps.InfoWindow({
                    content: `
                        <div style="padding: 8px;">
                            <strong>${vehicle.type.toUpperCase()}</strong><br>
                            ID: ${vehicle.id}<br>
                            Speed: ${vehicle.speed || 'N/A'} km/h<br>
                            Last update: ${new Date(vehicle.timestamp).toLocaleTimeString()}
                        </div>
                    `
                });
                
                // Show info on click
                vehicleMarkers[vehicle.id].addListener('click', () => {
                    infoWindow.open(map, vehicleMarkers[vehicle.id]);
                });
            }
        });
    }

    // Creates a CIRCLE + Text for the origin (no close button)
    function createCircleWithText(position, text, color) {
        // Draw a circle
        new google.maps.Circle({
            map,
            center: position,
            radius: 10, // Small circle
            fillColor: color,
            fillOpacity: 1,
            strokeWeight: 0
        });

        // Create custom overlay for text
        const textDiv = document.createElement('div');
        textDiv.style.backgroundColor = color;
        textDiv.style.color = 'white';
        textDiv.style.padding = '6px 10px';
        textDiv.style.borderRadius = '16px';
        textDiv.style.fontFamily = 'Arial';
        textDiv.style.fontSize = '12px';
        textDiv.style.fontWeight = 'bold';
        textDiv.style.position = 'absolute';
        textDiv.style.whiteSpace = 'nowrap';
        textDiv.innerHTML = text;

        // Create overlay and position it
        const overlay = new google.maps.OverlayView();
        overlay.onAdd = function() {
            this.getPanes().floatPane.appendChild(textDiv);
        };
        overlay.onRemove = function() {
            textDiv.parentNode.removeChild(textDiv);
        };
        overlay.draw = function() {
            const point = this.getProjection().fromLatLngToDivPixel(
                new google.maps.LatLng(position.lat(), position.lng() + 0.0002)
            );
            if (point) {
                textDiv.style.left = (point.x + 15) + 'px';
                textDiv.style.top = (point.y - 15) + 'px';
            }
        };
        overlay.setMap(map);
    }

    // Creates a MARKER + Text for the destination (no close button)
    function createMarkerWithText(position, text, color) {
        // Add a marker
        new google.maps.Marker({
            position,
            map,
            icon: {
                url: "https://maps.google.com/mapfiles/ms/icons/red-dot.png",
                scaledSize: new google.maps.Size(30, 30)
            }
        });

        // Create custom overlay for text
        const textDiv = document.createElement('div');
        textDiv.style.backgroundColor = color;
        textDiv.style.color = 'white';
        textDiv.style.padding = '6px 10px';
        textDiv.style.borderRadius = '16px';
        textDiv.style.fontFamily = 'Arial';
        textDiv.style.fontSize = '12px';
        textDiv.style.fontWeight = 'bold';
        textDiv.style.position = 'absolute';
        textDiv.style.whiteSpace = 'nowrap';
        textDiv.innerHTML = text;

        // Create overlay and position it
        const overlay = new google.maps.OverlayView();
        overlay.onAdd = function() {
            this.getPanes().floatPane.appendChild(textDiv);
        };
        overlay.onRemove = function() {
            textDiv.parentNode.removeChild(textDiv);
        };
        overlay.draw = function() {
            const point = this.getProjection().fromLatLngToDivPixel(
                new google.maps.LatLng(position.lat(), position.lng() + 0.0002)
            );
            if (point) {
                textDiv.style.left = (point.x + 15) + 'px';
                textDiv.style.top = (point.y - 15) + 'px';
            }
        };
        overlay.setMap(map);
    }

    window.onload = initMap;
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\vlocus\resources\views/frontend/index.blade.php ENDPATH**/ ?>