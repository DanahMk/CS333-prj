<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>IT Room Booking System</title>
    <style>
        :root{
        --first-color:#243642;
        --seconed-color: #387478;
        --third-color:#629584;
        --forth-color: #E2F1E7;}

        /* About Us Section Styling */
        #about-us {
            background-color: var(--forth-color); 
            padding: 50px 20px;
            text-align: center;
            color: var(--first-color);
            font-family: 'Arial', sans-serif;}

        #about-us h2 {
            font-size: 40px;
            color: var(--first-color); 
            margin-bottom: 20px;}
        
        #about-us h2 span {
            font-size: 40px;
            color: var(--seconed-color); 
            margin-bottom: 20px;}    

        #about-us p {
            font-size: 18px;
            line-height: 1.6;
            max-width: 900px;
            margin: 0 auto 20px auto;}

        #about-us .btn {
            background-color: var(--first-color);
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            display: inline-block;
            margin-top: 20px;
            transition: 0.3s ease;}

        #about-us .btn:hover {
            background-color: var(--seconed-color);}

        /* Contact Us Section Styling */
        #contact-us {
            background-color: var(--forth-color); 
            padding: 50px 20px;
            text-align: center;
            color: var(--first-color);
            font-family: 'Arial', sans-serif;}

        #contact-us h2 {
            font-size: 40px;
            color: var(--first-color); 
            margin-bottom: 20px;}
        
        #contact-us h2 span{
            font-size: 40px;
            color: var(--seconed-color); 
            margin-bottom: 20px;}    

        #contact-us p {
            font-size: 18px;
            line-height: 1.6;
            max-width: 900px;
            margin: 0 auto 20px auto;}

        /* Contact Form Styling */
        #contact-us form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            text-align: left;}

        #contact-us .form-group {margin-bottom: 20px;}

        #contact-us label {
            font-size: 16px;
            color: #34495e;
            display: block;
            margin-bottom: 8px;}

        #contact-us textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #bdc3c7;
            border-radius: 4px;
            font-size: 16px;
            color: #2c3e50;
            resize: vertical; /* Allow vertical resizing of the textarea */
        }

        #contact-us button[type="submit"] {
            background-color: var(--first-color);
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        #contact-us button[type="submit"]:hover {
            background-color: var(--seconed-color);
        }

        #contact-us textarea:focus,
        #contact-us button[type="submit"]:focus {
            outline: none;
            border-color: var(--seconed-color);
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            #about-us h2, #contact-us h2 {
                font-size: 28px; 
            }

            #about-us p, #contact-us p {
                font-size: 16px;
            }

            #contact-us form {
                padding: 20px;
            }

            #contact-us button[type="submit"] {
                font-size: 14px;
                padding: 10px 15px;
            }
        }
    </style>
</head>
<body>
    <!--Header start-->    
    <header class="header">
        
        <!-- this is for  uob logo-->
        <a href="#" class="logo"><img src="images/UOB LOGO.png" alt="uob logo"></a>
        <!-- this is for  uob logo end-->    
        
        <!--navbar-->
        <nav class="navbar">
            <a href="#home">Home</a>
            <a href="php/profile.php">Profile</a>
            <a href="#rooms">Rooms</a>
            <a href="#about-us">About us</a>
            <a href="#contact-us">Contact us</a>
        </nav>
        <!--navbar end-->
        <div class="icons">
            <div class="fas fa-search" id="search-btn"></div>
            <div class="fas fa-bars" id="menu-btn"></div>
        </div>

        <div class="search-form">
            <input type="search" id="search-box" placeholder="search here...">
            <label for="search-box" class="fas fa-search"></label>
        </div>
    </header>
    <!--Header end-->
    <!--Home section start-->
    <section class="home" id="home">
        <div class="content">
            <h3>Welcome to IT College<span> Room Booking System</span></h3>
            <p>room booking system for the IT College, in corporating various
                features to enhance user experience and administrative
                capabilities..</p>
            <a href="php/rooms.php" class="btn">Start Booking Rooms</a> 
               
        </div>
    </section>
    <!--Home section end-->

    <!-- About Us Section -->
<section id="about-us" class="about-us-section">
    <div class="section-container">
        <h2>About <span>Us</span></h2>
        <p>Welcome to IT College's Room Booking System! Our platform is designed to streamline 
            the process of reserving rooms for students, faculty, and staff. Whether you need 
            a space for a class, meeting, or study session, our system provides an easy to use
            interface to check availability, book rooms, and manage schedules. We aim to create
            a seamless experience for everyone involved in the academic environment, ensuring
            that all your room reservation needs are met efficiently.</p>
            <a href="#" class="btn">Read More</a>
        
    </div>
</section>

<!-- Contact Us Section -->
<section id="contact-us" class="contact-us-section">
    <div class="section-container">
        <h2><span>Contact </span>Us</h2>
        <p>If you have any questions or need assistance, please don't hesitate to reach out to us. We are here to help!</p>
        <form action="/submit-message" method="POST">
            <div class="form-group">
                <label for="message">Your Message</label>
                <textarea id="message" name="message" rows="6" required placeholder="Write your message here..."></textarea>
            </div>

            <button type="submit" class="submit-button">Send Message</button>
        </form>
        </form>
    </div>
</section>

    <!-- footer section starts -->
    <section class="footer">
        <div class="box-container">

            <div class="box">
                <h3> Room Booking System </h3>
                <p>room booking system for the IT College, in corporating various
                    features to enhance user experience and administrative
                    capabilities..</p>
            </div>

            <div class="box">
                <h3>category</h3>
                <a href="#"> about us</a>
                <a href="#"> Special Offers</a>
                <a href="#"> Terms & Conditions</a>
                <a href="#"> privacy policy</a>
                <a href="#"> contact us</a>
                <a href="#"> FAQs</a>
            </div>

            <div class="box">
                <h3>important links</h3>
                <a href="#" target="_blank" class="fab fa-linkedin"></a>
                <a href="#" target="_blank" class="fab fa-instagram"></a>
                <a href="#">Call Us: +973 1663 3366 </a>
                <a href="#">Email Us: uob@itcollege.edu</a>
                
            </div>
        </div>
        <div class="end"> &copy;2024-2025 by <span> University of Bahrain</span></div>
    </section><!-- section ends -->

    <!--java script file link-->
    <script src="js/scripts.js"></script>
</body>
</html>
