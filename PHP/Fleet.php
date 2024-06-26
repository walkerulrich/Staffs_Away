<?php

    $host = 'localhost';
    $dbname = 'staffs_airways';
    $username = 'root';
    $password = 'Sun@!77Jetty:com';

    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // session_start();
    // include 'Base.php'; // Include your base configuration file
    // global $base;

    // Fetch initial set of planes for the fleet section
    $initialCount = 6;
    $query = "SELECT * FROM Rental_planes LIMIT $initialCount"; // Get initial planes
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $initialPlanes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../image/aircraft__1_-removebg-preview.png" type="image/x-icon">
    <title>Plane Rental</title>
    <link rel="stylesheet" href="../CSS/ourcss.css"> <!-- Include your custom CSS -->
    <script src="../js/javascript.js"></script> <!-- Include your JavaScript -->
</head>
<body>
    <!-- Header and Navigation Bar -->
    <header>
        <nav class="navbar">
            <div class="container">
              <img src="../Img_logo/aircraft-removebg-preview.png" alt="Plane Rental Logo" class="logo">
              <ul class="nav-links">
                <li><a href="home.php">Home</a></li>
                <li><a href="plane_rental_homepage.php">Rent a Plane</a></li>
                <li><a href="Fleet.php">Aircraft</a></li>
                <li><a href="#">About Us</a></li>
                <?php
                    if(isset($_SESSION['user_id'])){
                    echo "<li><a href=\"profile.php\">Profile</a></li>";
                    if($_SESSION['admin_id'] == 1){
                        echo "<li><a href=\"admin.php\">Admin</a></li>";
                    }
                    echo "<li><a href=\"Logout.php\">Logout</a></li>";
                    }
                    else {
                    echo "<li><a href=\"Login.php\">Log In</a></li>
                            <li><a href=\"Registration.php\">Sign Up</a></li>";
                    }
                ?>
              </ul>
            </div>
          </nav>
    </header>

    <!-- Fleet Section: Display planes for rental -->
    <section class="bg-gray-50 py-24" style="margin-top: 150px">
        <div class="container1 mx-auto px-4">
            <div class="container -mx-4 flex flex-wrap items-center mb-6">
                <div class="px-4 w-full md:flex-1">
                    <h2 class="font-medium mb-1 text-primary-500 text-xl">Our Fleet</h2>
                    <h3 class="capitalize font-bold mb-4 text-4xl text-gray-900">Planes for All Your Needs</h3>
                    <div class="bg-primary-500 mb-6 pb-1 w-2/12"></div>
                    <p class="text-gray-600">
                       <i><b>Explore our fleet of modern planes available for rental. Whether you're planning a business trip or a leisurely getaway, we have the perfect aircraft for you.</b></i>
                    </p>
                </div>
            </div>

            <div class="-mx-3 flex flex-wrap justify-center mb-122" id="plane-container">
                <?php
                    // Display initial planes (first 6)
                    foreach ($initialPlanes as $plane) {
                        echo "
                        <div class='p-3 w-full md:w-6/12 lg:w-4/12'>
                            <div class='bg-white border shadow-md text-gray-500'>
                                <a href='plane_detail.php?rental_id={$plane['rental_id']}'>
                                    <img src='{$plane['image_path']}' class='hover:opacity-90 w-full' alt='Plane' width='600' height='450' />
                                </a>
                                <div class='p-6'>
                                    <h4 class='font-bold mb-2 text-gray-900 text-xl'>
                                        <a href='plane_detail.php?rental_id={$plane['rental_id']}' class='hover:text-gray-500'>{$plane['model']}</a>
                                    </h4>
                                    <p>{$plane['description']}</p>
                                    <hr class='border-gray-200 my-4' />
                                    <div class='flex items-center justify-between'>
                                        <div class='inline-flex items-center py-1 space-x-1'>
                                            <span>{$plane['rating']}</span>
                                            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='currentColor' width='1.125em' height='1.125em' class='text-primary-500'>
                                                <g>
                                                    <path d='M12 18.26l-7.053 3.948 1.575-7.928L.587 8.792l8.027-.952L12 .5l3.386 7.34 8.027.952-5.935 5.488 1.575 7.928z'></path>
                                                </g>
                                            </svg>
                                            <span>({$plane['number_of_reviews']} reviews)</span>
                                        </div>
                                        <p class='font-bold text-gray-900'>$${plane['rental_price_per_hour']}/hour</p>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    }
                ?>
            </div>

            <div class="flex justify-center mt-8">
                <button id="plane-see-more" class="bg-primary-500 hover:bg-primary-600 px-6 py-2 text-white">
                    See More
                </button>
                <button id="plane-see-less" class="bg-primary-500 hover:bg-primary-600 px-6 py-2 text-white" style="display: none; margin-left: 20px">
                    See Less
                </button>
            </div>
        </div>

        <!-- JavaScript for See More / See Less -->
        <script>
            const allPlanes = <?php echo json_encode($allPlanes); ?>;
            let currentStartIndex = 6;
            const planesPerPage = 3; // Number of planes to add per "See More"

            // Function to load additional planes
            function loadPlanes(startIndex, count) {
                const container = document.getElementById("plane-container");

                for (let i = startIndex; i < startIndex + count; i++) {
                    if (i >= allPlanes.length) {
                        break; // Exit if there are no more planes to display
                    }

                    const plane = allPlanes[i];
                    const planeDiv = document.createElement("div");
                    planeDiv.className = "p-3 w-full md:w-6/12 lg:w-4/12"; // Adjusted className

                    planeDiv.innerHTML = `
                        <div class='bg-white border shadow-md text-gray-500'>
                            <a href='plane_detail.php?rental_id=${plane['rental_id']}'>
                                <img src='${plane['image_path']}' class='hover:opacity-90 w-full' alt='Plane' />
                            </a>
                            <div class='p-6'>
                                <h4 class='font-bold mb-2 text-gray-900 text-xl'>
                                    <a href='plane_detail.php?rental_id=${plane['rental_id']}' class='hover:text-gray-500'>${plane['model']}</a>
                                </h4>
                                <p>${plane['description']}</p>
                                <hr class='border-gray-200 my-4' />
                                <div class='flex items-center justify-between'>
                                    <div class='inline-flex items-center py-1 space-x-1'>
                                        <span>${plane['rating']}</span>
                                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='currentColor' class='text-primary-500' width='1.125em' height='1.125em'>
                                            <g>
                                                <path d='M12 18.26l-7.053 3.948 1.575-7.928L.587 8.792l8.027-.952L12 .5l3.386 7.34 8.027.952-5.935 5.488 1.575 7.928z'></path>
                                            </g>
                                        </svg>
                                        <span>(${plane['number_of_reviews']} reviews)</span>
                                    </div>
                                    <p class='font-bold text-gray-900'>$${plane['rental_price_per_hour']}/hour</p>
                                </div>
                            </div>
                        </div>
                    `;

                    container.appendChild(planeDiv);
                }
            }

            // Function to remove planes (for "See Less")
            function removePlanes(count) {
                const container = document.getElementById("plane-container");

                for (let i = 0; i < count; i++) {
                    if (container.childNodes.length <= 6) {
                        break; // Don't remove if fewer than initial planes
                    }

                    container.removeChild(container.lastChild);
                }

                currentStartIndex -= count; // Adjust the index
            }

            // "See More" button event
            document.getElementById("plane-see-more").addEventListener("click", function() {
                loadPlanes(currentStartIndex, planesPerPage);
                currentStartIndex += planesPerPage;

                if (currentStartIndex >= allPlanes.length) {
                    this.style.display = "none"; // Hide "See More" when all planes are displayed
                }

                document.getElementById("plane-see-less").style.display = "block"; // Show "See Less"
            });

            // "See Less" button event
            document.getElementById("plane-see-less").addEventListener("click", function() {
                removePlanes(planesPerPage);

                if (currentStartIndex < allPlanes.length) {
                    document.getElementById("plane-see-more").style.display = "block"; // Show "See More" if more planes can be displayed
                }

                if (currentStartIndex <= 6) {
                    this.style.display = "none"; // Hide "See Less" if only initial planes are displayed
                }
            });
        </script>
    </section>

    <?php
                // Fetch the initial set of planes (first 6)
                $initialCount = 6; // Initial count of planes
                $query = "SELECT * FROM planes LIMIT $initialCount"; // Fetch the first 6 planes
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $initialPlanes = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Fetch all planes for "See More"
                $query = "SELECT * FROM planes"; // Fetch all planes
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $allPlanes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <section class="bg-gray-50 py-24">
                <div class="container mx-auto px-4">
                    <div class="-mx-4 flex flex-wrap items-center mb-6">
                        <div class="px-4 w-full md:flex-1">
                            <h2 class="font-medium mb-1 text-primary-500 text-xl">Our Top Planes</h2>
                            <h3 class="capitalize font-bold mb-4 text-4xl text-gray-900">Planes for All Your Needs</h3>
                            <div class="bg-primary-500 mb-6 pb-1 w-2/12"></div>
                        </div>
                    </div>

                    <div class="-mx-3 flex flex-wrap justify-center mb-12" id="plane-container">
                        <?php
                        // Display initial planes (first 6)
                        for ($i = 0; $i < 6; $i++) {
                            if ($i >= count($allPlanes)) {
                                break;
                            }

                            $plane = $allPlanes[$i];

                            echo "
                            <div class='p-3 w-full md:w-6/12 lg:w-4/12'>
                                <div class='bg-white border shadow-md text-gray-500'>
                                    <a href='plane_detail.php?plane_id=${plane['plane_id']}'>
                                        <img src='IMG_6281.JPG' class='hover:opacity-90 w-full' alt='Plane' width='600' height='450' />
                                    </a>
                                    <div class='p-6'>
                                        <h4 class='font-bold mb-2 text-gray-900 text-xl'>
                                            <a href='#' class='hover:text-gray-500'>{$plane['model']}</a>
                                        </h4>
                                        <p class='mb-2 text-sm'>{$plane['description']}</p>
                                        <hr class='border-gray-200 my-4' />
                                        <div class='flex items-center justify-between'>
                                            <div class='inline-flex items-center py-1 space-x-1'>
                                                <span>{$plane['rating']}</span>
                                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='currentColor' width='1.125em' height='1.125em' class='text-primary-500'>
                                                    <g>
                                                        <path d='M12 18.26l-7.053 3.948 1.575-7.928L.587 8.792l8.027-.952L12 .5l3.386 7.34 8.027.952-5.935 5.488 1.575 7.928z'></path>
                                                    </g>
                                                </svg>
                                                <span>({$plane['number_of_reviews']} reviews)</span>
                                            </div>
                                            <p class='font-bold text-gray-900'>\${$plane['rental_price_per_hour']}/h</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ";
                        }
                        ?>
                    </div>

                    <div class="flex justify-center mt-8">
                        <button id="plane-see-more" class="bg-primary-500 hover:bg-primary-600 px-6 py-2 text-white">
                            See More
                        </button>
                        <button id="plane-see-less" class="bg-primary-500 hover:bg-primary-600 px-6 py-2 text-white" style="display: none; margin-left: 20px">
                            See Less
                        </button>
                    </div>
                </div>

                <script>
                    const allPlanes = <?php echo json_encode($allPlanes); ?>;
                    let currentStartIndex = 6;
                    const planesPerPage = 3;

                    // Function to load additional planes
                    function loadPlanes(startIndex, count) {
                        const container = document.getElementById("plane-container");

                        for (let i = startIndex; i < startIndex + count; i++) {
                            if (i >= allPlanes.length) {
                                break;
                            }

                            const plane = allPlanes[i];

                            const planeDiv = document.createElement("div");
                            planeDiv.className = "p-3 w-full md:w-6/12 lg:w-4/12";

                            planeDiv.innerHTML = `
                            <div class='bg-white border shadow-md text-gray-500'>
                                <a href='plane_detail.php?plane_id=${plane['plane_id']}'>
                                    <img src='IMG_6308.WEBP' class='hover:opacity-90 w-full' alt='Plane' width='600' height='450' />
                                </a>

                                <div class='p-6'>
                                    <h4 class='font-bold mb-2 text-gray-900 text-xl'>
                                        <a href='plane_detail.php?plane_id=${plane['plane_id']}' class='hover:text-gray-500'>${plane['model']}</a>
                                    </h4>
                                    <p class='mb-2 text-sm'>${plane['description']}</p>
                                    <hr class='border-gray-200 my-4' />
                                    <div class='flex items-center justify-between'>
                                        <div class='inline-flex items-center py-1 space-x-1'>
                                            <span>${plane['rating']}</span>
                                            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='currentColor' width='1.125em' height='1.125em' class='text-primary-500'>
                                                <g>
                                                    <path d='M12 18.26l-7.053 3.948 1.575-7.928L.587 8.792l8.027-.952L12 .5l3.386 7.34 8.027.952-5.935 5.488 1.575 7.928z'></path>
                                                </g>
                                            </svg>
                                            <span>(${plane['number_of_reviews']} reviews)</span>
                                        </div>
                                        <p class='font-bold text-gray-900'>\$${plane['rental_price_per_hour']}/h</p>
                                    </div>
                                </div>
                            </div>`;

                            container.appendChild(planeDiv);
                        }
                    }
                        
                    // Function to remove planes (for "See Less")
                    function removePlanes(count) {
                        const container = document.getElementById("plane-container");

                        for (let i = 0; i < count; i++) {
                            if (container.childNodes.length <= 6) {
                                break; // Don't remove if fewer than initial planes
                            }

                            container.removeChild(container.lastChild);
                        }

                        currentStartIndex -= count;
                    }

                    document.getElementById("plane-see-more").addEventListener("click", function() {
                        loadPlanes(currentStartIndex, planesPerPage);
                        currentStartIndex += planesPerPage;

                        if (currentStartIndex >= allPlanes.length) {
                            this.style.display = "none"; // Hide "See More" if all planes are displayed
                        }

                        document.getElementById("plane-see-less").style.display = "block"; // Show "See Less"
                    });

                    document.getElementById("plane-see-less").addEventListener("click", function() {
                        removePlanes(planesPerPage);

                        if (currentStartIndex < allPlanes.length) {
                            document.getElementById("plane-see-more").style.display = "block"; // Show "See More" if not all planes are displayed
                        }

                        if (currentStartIndex <= 6) {
                            this.style.display = "none"; // Hide "See Less" if only initial planes are displayed
                        }
                    });
                </script>
            </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
          <div class="footer-section about">
            <img src="../image/aircraft__1_-removebg-preview.png" alt="Aircraft Image">
            <p>With STAFFS_AIRWAYS, you can easily rent a plane for your travel needs. Explore our fleet and rent with ease.</p>
            <div class="contact">
              <span><i class="fas fa-phone"></i> +33 234 567 890</span>
              <span><i class="fas fa-envelope"></i> staff.airways@gmail.com</span>
            </div>
            <div class="social">
              <a href="#"><i class="fab fa-facebook"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
              <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
          </div>
          <div class="footer-section links">
            <h2>Quick Links</h2>
            <ul>
              <li><a href="../html/home.html">Home</a></li>
              <li><a href="Fleet.php">Aircraft</a></li>
              <li><a href="plane_rental_homepage.php">Plane Rentals</a></li>
              <li><a href="#">Contact</a></li>
            </ul>
          </div>
          <div class="footer-section contact-form">
            <h2>Contact Us</h2>
            <form action="#">
              <input type="email" name="email" class="text-input contact-input" placeholder="Your email address">
              <textarea name="message" class="text-input contact-input" placeholder="Your message"></textarea>
              <button type="submit" class="btn contact-btn">
                <i class="fas fa-envelope"></i> 
                Send Message
              </button>
            </form>
          </div>
        </div>
        <div class="footer-bottom">
          &copy; 2024 STAFFS_AIRWAYS | Designed by Your Name
        </div>
    </footer>
</body>
</html>
