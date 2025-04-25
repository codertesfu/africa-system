<?php
$file = 'info_posts.json';
$uploadDir = 'uploads/';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $date = date("Y-m-d H:i:s");
    $imagePath = '';

    // Handle image upload
    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        $targetFile = $uploadDir . $imageName;
        $imageType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($imageType, $allowedTypes)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $imagePath = $targetFile;
            }
        }
    }

    $newPost = [
        'title' => $title,
        'content' => $content,
        'date' => $date,
        'image' => $imagePath
    ];

    $posts = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    $posts[] = $newPost;
    file_put_contents($file, json_encode($posts, JSON_PRETTY_PRINT));

    echo "<script>alert('Post added successfully!'); window.location.href='index.php';</script>";
    exit();
}

$posts = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="logo.jpg" type="image/x-icon">
    <!-- For different types of image formats (optional) -->
    <link rel="icon" href="logo.jpg" type="image/png">
    <link rel="apple-touch-icon" href="path_to_your_image/apple-touch-icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <title>Africa Driving License School - Hawassa</title>

    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Nunito', sans-serif;
        }
body {
  font-family: "Segoe UI", sans-serif;
  margin: 0;
  padding: 0;
}
        h2 {
  font-size: 2rem;
  text-align: center;
  color: #004b8d;
  margin-bottom: 40px;
  position: relative;
}

h2::after {
  content: "";
  display: block;
  width: 60px;
  height: 4px;
  background: #ffb400;
  margin: 10px auto 0;
  border-radius: 2px;
}

  #courses {
    background: linear-gradient(to right, #f7f8fc, #eef1f7);
    padding: 80px 20px;
    font-family: 'Segoe UI', sans-serif;
  }

  .container {
    max-width: 1200px;
    margin: auto;
  }

  .course-card {
    background-color: #fff;
    border-radius: 16px;
    padding: 25px;
    margin: 20px 0;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .course-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
  }

  .course-card h3 {
    font-size: 1.5rem;
    color: #2c3e50;
    margin-bottom: 10px;
  }

  .course-card p {
    color: #555;
    line-height: 1.6;
    font-size: 1rem;
  }

  @media (min-width: 768px) {
    .courses .container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
    }

    .course-card {
      margin: 0;
    }
  }

/* About Section */
.about {
  background: #ffffff;
  text-align: center;
  padding: 80px 20px;
}
.about p {
  max-width: 800px;
  margin: auto;
  font-size: 18px;
  line-height: 1.6;
}
.cta-btn {
  display: inline-block;
  margin-top: 20px;
  padding: 12px 30px;
  background: none;
  color: none;
  text-decoration: none;
  border-radius: 30px;
  font-weight: 600;
  transition: 0.3s;
}
.cta-btn:hover {
  background: none;
  color: none;
}




/* Footer Section Styling */
footer {
  background-color: #1a1a1a; /* Soft black background */
  color: #f1f1f1; /* Light text for contrast */
  padding: 40px 20px;
  font-family: Arial, sans-serif;
  box-shadow: 0px -4px 10px rgba(0, 0, 0, 0.2); /* Subtle shadow */
}

/* Contact Section */
.contact-section {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  text-align: left;
}

/* Contact Info Styling */
.contact-info {
  max-width: 50%;
  padding-right: 20px;
}

/* Branches Styling */
.branches {
  max-width: 40%;
}

.branches p {
  font-weight: 600;
  font-size: 1.4em;
  color: #ff9a8b; /* Soft coral color for the heading */
  margin-bottom: 15px;
  padding-bottom: 5px;
  border-bottom: 2px solid #ff9a8b; /* Add a stylish bottom border */
  display: inline-block; /* Make the border fit the text width */
  letter-spacing: 1px; /* Add space between letters for elegance */
  text-transform: uppercase; /* Make the text uppercase for emphasis */
}

/* Branches List Styling */
.branches ul {
  list-style-type: none;
  padding: 0;
}

.branches li {
  margin: 5px 0;
  font-size: 1.1em;
  color: #f1f1f1; /* Light color for branches */
  transition: color 0.3s ease; /* Smooth transition on hover */
}

/* Hover effect on branch list items */
.branches li:hover {
  color: #ff9a8b; /* Change color on hover for branches */
  cursor: pointer; /* Add pointer cursor to indicate clickable items */
}

/* Equal Styling for h2 and p */
footer h2, footer p {
  font-size: 1.2em; /* Set both h2 and p to the same font size */
  line-height: 1.8;
  margin: 15px 0; /* Same margin for both */
  color: #f1f1f1; /* Light color for both */
}

/* Specific Styling for h2 */
footer h2 {
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
}

/* Links Styling */
footer a {
  color: white; /* Soft coral color for links */
  text-decoration: none;
  font-weight: 500;
  transition: color 0.3s ease-in-out;
}

footer a:hover {
  color: #ffffff; /* White color on hover */
  text-decoration: underline;
}

/* Responsive Design */
@media (max-width: 768px) {
  footer {
    padding: 30px 10px;
  }

  .contact-section {
    flex-direction: column;
  }

  footer h2, footer p {
    font-size: 1em;
  }
}



.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  background: no;
  color: white;
  padding: 20px;
  z-index: 999;
  transition: transform 0.4s ease-in-out;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    pointer-events: auto;
  z-index: 9999;
}


.navbar h1.logo {
  font-size: 22px;
  margin: 0;
}


  .logo-container {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 0px;
    margin-bottom: 0px;
    flex-wrap: wrap;
  }

  .logo-container img {
    width: 70px; /* Adjust size as needed */
    height: auto;
    margin-right: 20px; /* Spacing between image and text */
  }

  .logo {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 4rem;
    text-align: center;
    background: linear-gradient(90deg, #ffffff, #b0b0b0, #1E90FF); /* White → Gray → Blue */
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-weight: 900;
    margin-top: 0;
    animation: fadeInScale 1.5s ease-out forwards, pulseText 2s ease-in-out infinite;
    opacity: 0;
  }

  @keyframes fadeInScale {
    0% {
      transform: scale(0.5);
      opacity: 0;
    }
    100% {
      transform: scale(1);
      opacity: 1;
    }
  }

  @keyframes pulseText {
    0% {
      background: linear-gradient(90deg, #ffffff, #b0b0b0, #1E90FF);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    50% {
      background: linear-gradient(90deg, #1E90FF, #b0b0b0, #ffffff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    100% {
      background: linear-gradient(90deg, #ffffff, #b0b0b0, #1E90FF);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
  }
.navbar nav ul {
    list-style: none;
    display: flex;
    gap: 25px;
    margin: 0;
    padding: 0;
}

.navbar nav ul li a {
    color: skyblue;
    text-decoration: none;
    font-size: 18px;
    font-weight: 600;
    padding: 10px 15px;
    border-radius: 8px;
    transition: all 0.3s ease-in-out;
    background: rgba(255, 255, 255, 0.1);
}

.navbar nav ul li a:hover {
    background: #ffb400;
    color: #002855;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}
       .hero {
    height: 100vh;
    position: relative;
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    animation: backgroundChange 15s infinite ease-in-out;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
    transition: background-image 1s ease-in-out;
    background-image: url('a.png'); /* Initial */
}

        .hero .hero-content {
            z-index: 1;
        }

        .hero h2 {
            font-size: 3.5em;
            margin-bottom: 20px;
            animation: slideInUp 1s ease-out;
        }

        .hero p {
            font-size: 1.2em;
            margin-bottom: 30px;
            animation: fadeInUp 1s ease-in-out;
        }

        .cta-btn {
            background-color: none;
            color: #004225;
            padding: 12px 30px;
            font-size: 18px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            animation: bounceIn 1s ease-out;
        }

        .cta-btn:hover {
            background-color: skyblue;
        }

        /* Animations */
        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInUp {
            0% {
                transform: translateY(100px);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes bounceIn {
            0% {
                transform: scale(0.6);
                opacity: 0;
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes backgroundChange {
            0% {
                background-image: url('a.png');
            }

            33% {
                background-image: url('b.png');
            }

            66% {
                background-image: url('c.png');
            }

            100% {
                background-image: url('a.png');
            }
        }
h2.section-title {
  text-align: center;
  font-size: 36px;
  font-weight: bold;
  color: #023e8a;
  margin-bottom: 20px;
}

p.section-description {
  max-width: 900px; /* Limit width for better readability */
  margin: 30px auto; /* Center horizontally with space around */
  padding: 20px 25px; /* Add internal spacing */
  font-size: 18px;
  line-height: 1.8;
  text-align: justify;
  color: #333;
  background-color: #f9f9f9; /* Soft background */
  border-left: 5px solid #0077b6; /* Stylish left border */
  border-radius: 12px;
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05); /* Subtle shadow */
  transition: all 0.3s ease-in-out;
}

p.section-description:hover {
  background-color: #eef9ff; /* Light hover effect */
  border-left-color: #00b4d8;
  transform: scale(1.01);
}

/* About Section Styling */
.about {
  background-color: #fff;
  padding: 50px 20px;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
}

/* Info Cards Layout */
.info-cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 30px;
  margin-top: 40px;
}

.info-card {
  background-color: white;
  color: #fff;
  padding: 30px;
  border-radius: 15px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.info-card h3 {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 20px;
}

.info-card p, .info-card ul {
  font-size: 16px;
  line-height: 1.6;
}

.info-card ul {
  list-style-type: none;
  padding: 0;
}

.info-card ul li {
  margin-bottom: 10px;
}

/* Hover Effects */
.info-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
}

.info-card h3 {
  color: #00b4d8;
}

.info-card p, .info-card ul {
  color: #e1f5fe;
}

/* Call-to-Action Button */
.cta-btn {
  display: inline-block;
  background-color: none;
  color: #fff;
  padding: 15px 30px;
  font-size: 18px;
  text-decoration: none;
  border-radius: 5px;
  margin-top: 40px;
  text-align: center;

}

.cta-btn:hover {
  background-color: none;
}

/* Responsive Design */
@media (max-width: 768px) {
  .section-title {
    font-size: 28px;
  }
  
  .cta-btn {
    width: 100%;
    padding: 15px;
  }
}


/* Styling for Paragraphs <p> */
p {
  font-size: 18px;
  line-height: 1.6;
  color: #e1f5fe;
  margin-bottom: 20px; /* Adds space between paragraphs */
}

/* Special styling for "Mission", "Vision", and "Core Values" paragraphs */
.info-card p {
  font-size: 16px;
  color: skyblue;
  text-align: justify;
}

/* Add padding and margin to make text more readable */
section p {
  padding: 0 15px;
  margin: 20px 0;
}
#loader {
      position: fixed;
      width: 100%;
      height: 100%;
      background: white;
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 9999;
    }

    .spinner {
      border: 8px solid #f3f3f3;
      border-top: 8px solid #3498db;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    #content {
      display: none;
    }

    

  .subtitle {
    text-align: center;
    color: #6b7280;
    margin-bottom: 25px;
  }

  

/* Fade-in animation for the loader */
@keyframes fadeIn {
  0% { opacity: 0; }
  100% { opacity: 1; }
}

/* Fade-in animation for the text */
@keyframes fadeInText {
  0% { opacity: 0; transform: translateY(20px); }
  100% { opacity: 1; transform: translateY(0); }
}

  .stats-section {
    padding: 60px 20px;
    background-color: #f4f4f4;
    text-align: center;
    display: flex;
    justify-content: space-between; /* Align cards to left, center, and right */
    gap: 50px;
  }

  .stat-card {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    border: 2px solid #007bff;
    border-radius: 10px;
    padding: 40px;
    background-color: #fff;
    width: 220px;
    text-align: center;
    box-sizing: border-box;
    margin: 10px;
    transition: background-color 0.3s ease;
    position: relative; /* For absolute positioning of the info */
  }

  .stat-card-icon {
    font-size: 3rem;
    margin-bottom: 20px;
    color: #007bff;
  }

  .stat-card-number {
    font-size: 40px;
    font-weight: bold;
    color: #333;
  }

  /* Hover effect */
  .stat-card:hover {
    background-color: #e0f7fa; /* Change background on hover */
  }

  /* Information displayed on hover */
  .stat-card-info {
    display: none;
    position: absolute;
    bottom: 10px;
    font-size: 16px;
    color: #007bff;
    width: 100%;
    text-align: center;
  }

  .stat-card:hover .stat-card-info {
    display: block;
  }

     .post-container {
            max-width: 900px;
            margin: auto;
        }
        h2 {
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .post-form {
            background: #fff;
            padding: 20px;
            margin-bottom: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .post-form input, .post-form textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .post-form button {
            padding: 10px 20px;
            background: #007bff;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
        }
        .post-form input[type="file"] {
            padding: 5px;
        }
        .post {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 5px solid #007bff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.08);
        }
        .post h3 {
            margin: 0 0 10px;
            color: #333;
        }
        .post img {
            max-width: 100%;
            margin-top: 10px;
            border-radius: 6px;
        }
        .date {
            color: #888;
            font-size: 0.9em;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>


    <header class="navbar" id="mainHeader">
        
          <div class="logo-container">
  
  <img src="logo.jpg" alt="Driving School Logo">
  <h1 class="logo">Africa Driving License School - Hawassa</h1>
</div>
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#courses">Courses</a></li>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#allcourses">All Courses</a></li>
                    <li><a href="#news">News</a></li>
                    <li><a href="#contact">Contact</a></li>
                    
                     
                </ul>
            </nav>
        
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br><br><br>
            <h2 style="color: white;">Welcome to Africa Driving License School - Hawassa</h2>
            <p>Our prices are commensurate with the capacity of our clients and we have arranged for our trainees to pay once, twice or three times as much as they can afford.

</p>
       




        </div>
    </section>


<div class="course-card" data-aos="fade-up">
  <h2><div style="font-size: 2rem;">📅</div>Year Established: <br><br><span class="year-established">0</span></h2>
</div>
<div class="course-card" data-aos="fade-up">
  <h2><div style="font-size: 2rem;">👥</div>Total Students: <br><br><span class="total-students">0</span></h2>
</div>
<div class="course-card" data-aos="fade-up">
  <h2><div style="font-size: 2rem;">👨‍🏫</div>Total Staff: <br><br><span class="total-staff">0</span></h2>
</div>

<!-- Include AOS JS (make sure to include this before the closing </body> tag) -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

<script>
  // Initialize AOS animations
  AOS.init({
    duration: 1200, // Set animation duration (in milliseconds)
    easing: 'ease-in-out', // Animation easing
    once: true // Ensure animations only happen once during the scroll
  });

  // Optional: Dynamic Number Animation (e.g., for total students or staff count)
  const stats = [
    { targetElement: '.total-students', targetValue: 3500 },
    { targetElement: '.total-staff', targetValue: 150 },
    { targetElement: '.year-established', targetValue: 2000 }
  ];

  stats.forEach(stat => {
    let current = 0;
    const targetElement = document.querySelector(stat.targetElement);
    const target = stat.targetValue;

    // Function to animate numbers
    function animateStatNumber() {
      const increment = target / 100;
      const updateNumber = () => {
        current += increment;
        if (current < target) {
          targetElement.textContent = Math.ceil(current);
          requestAnimationFrame(updateNumber);
        } else {
          targetElement.textContent = target;
        }
      };
      
      updateNumber();
    }

    // Trigger number animation once page loads
    window.addEventListener('load', animateStatNumber);
  });
</script>

<section id="courses" class="courses">
  <br><br> <br><br><br>
  <div class="container">
   

   
<div class="course-card" data-aos="fade-up">

  <h3>Basic Driving Course </h3>
  <p>Start from scratch with personalized instruction and practical road sessions.
  This course is ideal for complete beginners and includes theory and hands-on training with certified instructors.</p>
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="100">

  <h3>Defensive Driving </h3>
  <p>Learn safety-first skills to drive confidently in busy city traffic.
  It emphasizes anticipation of hazards, defensive techniques, and strategies to prevent accidents.</p>
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="200">
  
  <h3>License Exam Prep</h3>
  <p>Practice mock tests and get insider tips to pass your exam stress-free.
  Includes traffic laws, signs, and test simulations to boost your confidence and knowledge.</p>
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="300">

  <h3>Refresher Course </h3>
  <p>Sharpen your driving skills and regain road confidence quickly.
  Perfect for drivers returning after a break or those looking to improve their technique.</p>
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="400">
  
  <h3>Night Driving Training </h3>
  <p>Master driving after dark with focus on visibility and safety awareness.
  Covers use of headlights, glare control, and defensive driving under low-light conditions.</p>
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="500">
  
  <h3>Emergency Handling </h3>
  <p>React smartly during brake failure, skidding, and unexpected situations.
  Learn real-world techniques for staying safe under pressure with expert-guided scenarios.</p>
</div>



    </div>
  </div>
</section>

<br><br><br><br><br><br>
<!-- About Section -->
<section id="about" class="about">
  <br><br><br><br><br>
  <div class="container">
     <h2>About Africa Driving License School</h2>
    <p class="section-description" style="color: gray;">
      Africa Driving License School, located in Hawassa, is a leading institution dedicated to providing top-notch driving education. Our school aims to equip students with both the theoretical knowledge and practical skills needed to become confident, responsible, and skilled drivers. By offering structured and comprehensive driving programs, we focus on ensuring that our students are well-prepared not only for their driving exams but also for real-world driving situations.

We believe in promoting road safety and creating a culture of responsible driving. With expert instructors and state-of-the-art training vehicles, we provide a supportive environment for learning. Our goal is to foster safe driving habits, reduce traffic accidents, and contribute to a safer driving environment in Hawassa and beyond.


    </p>
    <br><br>
    <p class="section-description" style="color: gray;"><span style="color: black;">"Promotion and Motivation"</span> The Africa Driving License School is committed to shaping responsible and skilled drivers. However, the current manual processes hinder the school’s ability to promote these values efficiently. Manual registration, lack of real-time student progress tracking, poor communication, and disorganized scheduling limit both student motivation and the institution's ability to encourage progress effectively.

A digital solution can address these challenges by providing automated registration, transparent progress tracking, and direct communication between students and instructors. A system that allows students to track their progress and receive real-time updates can motivate them to strive for improvement. Additionally, the introduction of a digital platform for scheduling and notifications ensures that students never miss important classes or exams, keeping them engaged and motivated.

Implementing an online payment system will also increase transparency, allowing students to monitor their payments and reducing confusion. This complete digital transformation will foster a more professional, motivating environment where students feel supported and encouraged to achieve their goals.

</p>
    <br><br>
  <p class="section-description" style="color: gray;"><span style="color: black;">"Background of Africa Driving License School"</span> The Africa Driving License School was established with the mission of providing quality driver education and training to individuals seeking to obtain a driving license. As a key institution dedicated to road safety and responsible driving, the school has been instrumental in equipping learners with the necessary skills and knowledge for both practical and theoretical driving tests.

Over time, however, the institution has faced several operational challenges due to its reliance on outdated, manual processes. Registration, record-keeping, scheduling, and payment handling are all conducted on paper, making the system slow, inefficient, and prone to errors. These manual methods have limited the school’s ability to streamline operations and provide timely feedback to students, ultimately affecting overall service delivery.

As the demand for driving courses continues to grow, it has become increasingly clear that the school must adopt modern technology to keep pace with the changing needs of its students and the broader community. Digitalization will not only improve operational efficiency but also create a more transparent, reliable, and accessible learning environment. The school recognizes that by addressing its current challenges through automation and digitization, it will be better positioned to deliver high-quality education, improve student satisfaction, and contribute to the development of safer drivers.</p>
<br><br>
    <div class="info-cards">
      <div class="info-card" id="mission-card">
        <h3>Mission</h3>
        <p>The mission of Africa Driving License School is to provide comprehensive driving education ensuring students gain both theoretical knowledge and practical experience.</p>
      </div>

      <div class="info-card" id="vision-card">
        <h3>Vision</h3>
        <p>To be the leading driving education institution in Hawassa, recognized for producing highly competent and responsible drivers.</p>
      </div>

      <div class="info-card" id="values-card">
        <h3>Core Values</h3>
<p>
  We uphold safety, integrity, and excellence in all we do. Committed to community, we ensure accessible, respectful, and high-quality driving education for all.
</p>

      </div>
    </div>
  </div>
</section>
    <br><br>
    <br><br>

<section id="allcourses" class="courses">
  <br><br> <br><br><br><br><br><br><br><br>
  <h2>All Courses</h2>
  <div class="container">

<div class="course-card" data-aos="fade-up" data-aos-delay="600">
  <h3><span class="sign">🚗</span> Highway Driving</h3>
  <p>Develop confidence and precision in high-speed environments with expert guidance on lane discipline and safe overtaking.</p>
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="700">
  <h3><span class="sign">🅿️</span> Parallel Parking Mastery</h3>
  <p>Master one of the trickiest skills in driving with step-by-step coaching and practice in various real-life scenarios.</p>
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="800">
  <h3><span class="sign">🚙</span> Automatic Transmission</h3>
  <p>Learn to handle automatic vehicles with smooth gear transition, hill starts, and city navigation techniques.</p>
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="900">
  <h3><span class="sign">🚗</span> Manual Gear Training</h3>
  <p>Get hands-on experience managing clutch, brake, and gear systems, especially in rough terrains and traffic jams.</p>
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="1000">
  <h3><span class="sign">🌧️</span> Weather Condition Driving</h3>
  <p>Prepare for rain, fog, and windy conditions with training focused on visibility, control, and cautionary maneuvers.</p>
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="1100">
  <h3><span class="sign">👴</span> Senior Citizen Driving</h3>
  <p>Special sessions designed for senior drivers focusing on confidence, comfort, and safety in familiar areas.</p>
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="1200">
  <h3><span class="sign">👩‍🦰</span> Women’s Driving Program</h3>
  <p>A comfortable, supportive space for women learners led by expert female instructors to build road skills and independence.</p>
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="1300">
  <h3><span class="sign">👦</span> Teen Driver Safety</h3>
  <p>Designed for young drivers focusing on traffic rules, awareness, and responsible driving habits from an early age.</p>
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="1400">
  <h3><span class="sign">🌍</span> Eco-Friendly Driving</h3>
  <p>Learn fuel-saving techniques and how to reduce emissions with smart driving practices and smooth acceleration habits.</p>
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="1500">
  <h3><span class="sign">🚐</span> Fleet Driver Training</h3>
  <p>Corporate-focused training for company drivers emphasizing safety, vehicle care, and time-efficient routes.</p>
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="1600">
  <h3><span class="sign">🤝</span> Driving Etiquette & Ethics</h3>
  <p>Understand respectful behavior on the road, from yielding to pedestrians to avoiding aggressive driving.</p>
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="1700">
  <h3><span class="sign">⛰️</span> Mountain Driving</h3>
  <p>Get trained in climbing, descending, and handling curves safely with real-world scenarios on hilly terrains.</p>
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="1800">
  <h3><span class="sign">⛑️</span> First Aid for Drivers</h3>
  <p>Learn emergency response skills including CPR and how to handle injuries until professional help arrives.</p>
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="1900">
  <h3><span class="sign">⚖️</span> Traffic Law & Ethics</h3>
  <p>Study legal responsibilities, driving rights, and moral obligations of all licensed drivers in Ethiopia.</p>
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="2000">
  <h3><span class="sign">👶</span> Child Passenger Safety</h3>
  <p>Get trained in secure child seating, booster seats, and child-lock systems to ensure safe family travel.</p>
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="2100">
  <h3><span class="sign">🔧</span> Car Maintenance Basics</h3>
  <p>Learn to check oil, coolant, tire pressure, and other basics to keep your vehicle in safe, working order.</p>
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="2200">
  <h3><span class="sign">⚠️</span> Hazard Perception</h3>
  <p>Sharpen your awareness of road hazards and learn to react swiftly in fast-changing traffic conditions.</p>
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="2300">
  <h3><span class="sign">🧼</span> Car Wash & Detailing</h3>
  <p>Get hands-on with car cleaning techniques, interior detailing, and polishing methods for vehicle care.</p>
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="2400">
  <h3><span class="sign">🏍️</span> Motorcycle Safety</h3>
  <p>For two-wheeler drivers—focuses on balancing, protective gear, and handling in different weather conditions.</p>
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="2500">
  <h3><span class="sign">🎯</span> Driving Test Simulation</h3>
  <p>Experience a real-like test environment with score feedback and areas to improve before your actual license test.</p>
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="2600">
  <h3><span class="sign">🚕</span> Taxi & Ride-Share Driver Training</h3>
  <p>Focus on customer service, route planning, and efficient, respectful urban transport techniques.</p>
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="2700">
  <h3><span class="sign">🌧️</span> Slippery Road Control</h3>
  <p>Learn how to manage icy or wet roads, including hydroplaning recovery and speed control tips.</p>
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="2800">
  <h3><span class="sign">📱</span> Hands-Free Tech Usage</h3>
  <p>Stay safe while using mobile maps or calls by learning hands-free solutions and dashboard tech etiquette.</p>
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="2900">
  <h3><span class="sign">🚛</span> Trailer & Towing Skills</h3>
  <p>For those handling trailers—backing up, hitching, and safe towing techniques taught in practical settings.</p>
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="3000">
  <h3><span class="sign">🏙️</span> Urban Navigation Skills</h3>
  <p>Navigate city streets with confidence, avoid congestion, and use shortcuts effectively with GPS and maps.</p>
</div>

<!-- New Courses -->

<div class="course-card" data-aos="fade-up" data-aos-delay="3100">
  <h3><span class="sign">🌙</span> Night Driving Techniques</h3>
  <p>Enhance visibility and defensive driving during low-light conditions, including proper headlight use and glare avoidance.</p>
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="3200">
  <h3><span class="sign">⚡</span> Emergency Maneuvers</h3>
  <p>Practice evasive actions, emergency braking, and steering techniques to avoid accidents in critical situations.</p>
</div>

</div>
</section>
<section id="allcourses" class="courses">
  <br><br> <br><br><br><br><br><br><br><br>
  <h2>Simulation Exercise</h2>
  <div class="container">

<div class="course-card" data-aos="fade-up" data-aos-delay="600">
 <img src="a.jpg" style="width: 350px;">
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="700">
  <img src="b.jpg" style="width: 340px; height: 200px;">
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="800">
  <img src="c.jpg" style="width: 350px; height: 200px;">
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="900">
  <img src="d.jpg" style="width: 350px;">
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="1000">
  <img src="e.jpg" style="width: 350px; height: 250px;">
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="1100">
  <img src="f.jpg" style="width: 350px; height: 250px;">
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="900">
  <img src="g.jpg" style="width: 350px;">
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="1000">
  <img src="h.jpg" style="width: 350px; height: 250px;">
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="1100">
  <img src="i.jpg" style="width: 350px; height: 250px;">
</div>


<div class="course-card" data-aos="fade-up" data-aos-delay="900">
  <img src="j.jpg" style="width: 330px; height: 250px;">
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="1000">
  <img src="k.jpg" style="width: 350px; height: 250px;">
</div>

<div class="course-card" data-aos="fade-up" data-aos-delay="1100">
  <img src="l.jpg" style="width: 350px; height: 250px;">
</div>







</div>
</section>

    <br><br>
    <br><br> <br><br> <br><br> <br><br>
<!-- Contact Section -->


</section>
<section id="news">
<div class="post-container">
    <br> <br><br> <br><br><br> <br>

    <h2>📢 Latest News </h2>

    <?php 
    if (!empty($posts)) {
        $posts = array_reverse($posts);
        foreach ($posts as $post): ?>
            <div class="post" data-aos="fade-up">
                <h3><?= htmlspecialchars($post['title']) ?></h3>
                <p class="date">📅 <?= htmlspecialchars($post['date']) ?></p>
                <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                <?php if (!empty($post['image'])): ?>
                    <img src="<?= htmlspecialchars($post['image']) ?>" alt="Post Image">
                <?php endif; ?>
            </div>
    <?php endforeach; } else {
        echo "<p>No information posted yet.</p>";
    } ?>
</div>
</section>
<!-- Footer -->
<footer>
  <section id="contact" class="contact-section">
    <div class="contact-info">
      <p><strong>🏫 School Name:</strong> Africa Driving License School - Hawassa</p>
      <p><strong>📍 Address:</strong> Hawassa City, Sidama Region, Ethiopia</p>
      <p><strong>📧 Email:</strong> <a href="mailto:info@africadrivers.com">info@africadrivers.com</a></p>
      <p><strong>☎️ Phone:</strong> +251 91 234 5678</p>
      <p><strong>📠 Fax:</strong> +251 46 220 3344</p>
      <p><strong>📲 Telegram:</strong> <a href="https://t.me/AfricaDrivingSchool" target="_blank">https://t.me/AfricaDrivingSchool</a></p>
      <p><strong>📘 Facebook:</strong> <a href="https://web.facebook.com/AfricaDrivingSchoolHawassa" target="_blank">Africa Driving School - Hawassa</a></p>
      <p><strong>🌐 Website:</strong> <a href="http://www.africadrivers.com" target="_blank">www.africadrivers.com</a></p>
    </div>

    <!-- Branches -->
    <div class="branches">
      <p style="color: white;"><strong>🌍 Our Branches:</strong></p>
      <ul>
        <li>Africa Driving License School Hawassa Branch :- 046-0000000</li>
        <br><br>
        <li>Africa Driving License School Addis Ababa Branch:- 011-000000</li>
      </ul>
    </div>
  </section>

</footer>
<div style="padding: 20px; background-color: black; color: white; font-family: Arial, sans-serif; border-top: 5px solid #FFD700; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
   <p style="text-align: left; margin: 0;">This is the Official website of Africa Driving License School of Hawassa © 2025 | Powered By Tesfu A. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="#" style="color: #fff; text-decoration: none;">Privacy Policy</a> | 
      <a href="#" style="color: #fff; text-decoration: none;">Terms of Service</a> |
      <a href="#" style="color: #fff; text-decoration: none;">FAQ</a> |
      <a href="#" style="color: #fff; text-decoration: none;">Sitemap</a> |
      <a href="#" style="color: #fff; text-decoration: none;">APIs</a></p>
</div>
<script>
document.addEventListener("DOMContentLoaded", () => {
  const sections = document.querySelectorAll("section");
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = 1;
          entry.target.style.transform = "translateY(0)";
        }
      });
    },
    { threshold: 0.1 }
  );

  sections.forEach((section) => {
    section.style.opacity = 0;
    section.style.transform = "translateY(60px)";
    section.style.transition = "all 0.8s ease-out";
    observer.observe(section);
  });
});
// JavaScript for Animating Info Cards
window.addEventListener("DOMContentLoaded", function () {
  const infoCards = document.querySelectorAll(".info-card");

  infoCards.forEach(card => {
    card.addEventListener("mouseenter", () => {
      card.style.transform = "translateY(-10px)";
      card.style.boxShadow = "0 15px 30px rgba(0, 0, 0, 0.2)";
    });

    card.addEventListener("mouseleave", () => {
      card.style.transform = "translateY(0)";
      card.style.boxShadow = "0 10px 25px rgba(0, 0, 0, 0.1)";
    });
  });
});

// Optional: Smooth Scroll for CTA Button
document.querySelector(".cta-btn").addEventListener("click", function (event) {
  event.preventDefault();
  const target = document.querySelector("#contact");
  target.scrollIntoView({ behavior: "smooth" });
});
let header = document.getElementById('mainHeader');
  let isHidden = false;

  document.addEventListener('mousemove', function (e) {
    if (e.clientY < 80) {
      // Show if mouse is near top (80px)
      if (isHidden) {
        header.classList.remove('hide');
        isHidden = false;
      }
    } else {
      // Hide otherwise
      if (!isHidden) {
        header.classList.add('hide');
        isHidden = true;
      }
    }
  });
    window.onload = function () {
    setTimeout(function () {
      document.getElementById("loader").style.display = "none";
      document.getElementById("content").style.display = "block";
      document.body.style.overflow = "auto";
    }, 3000); // 3000 milliseconds = 3 seconds
  };


</script>


</body>

</html>
