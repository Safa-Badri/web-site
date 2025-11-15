<?php 
$about = true;
include_once("header.php");
include_once("main.php");
?>
<div class="container">


<div class="container about-container">
    <h1>About Us</h1>
    <p>
        Welcome to our Order Management platform! We are dedicated to providing businesses with an efficient, 
        user-friendly solution for managing their orders, tracking inventory, and optimizing their workflow. 
        Our mission is to streamline your order management process so you can focus on what matters most—growing your business.
    </p>
    
    <h2>Our Team</h2>
    <div class="team-section">
        <div class="team-member">
            <img src="images\happy_person.jpg" alt="Team Member 1">
            <div class="team-member-info">
                <h4>John Doe</h4>
                <p>CEO & Founder</p>
                <p>John brings over 10 years of experience in tech and business development, leading our team to success.</p>
                <a href="#">LinkedIn</a>
            </div>
        </div>

        <div class="team-member">
            <img src="images\1735221472_435899564_1667588447315147_5897844832425435782_n.jpg" alt="Team Member 2">
            <div class="team-member-info">
                <h4>Jane Smith</h4>
                <p>Chief Technology Officer</p>
                <p>With a strong background in software development, Jane ensures our platform is innovative and scalable.</p>
                <a href="#">LinkedIn</a>
            </div>
        </div>

        <div class="team-member">
            <img src="images\man-lifestyle-portrait-hipster-serious-t-shirt-isolated-person-white-background-american-smile-confident-fashion-photo.jpg" alt="Team Member 3">
            <div class="team-member-info">
                <h4>Mary Johnson</h4>
                <p>Marketing Director</p>
                <p>Mary leads our marketing efforts, ensuring our services reach the businesses that need them the most.</p>
                <a href="#">LinkedIn</a>
            </div>
        </div>
    </div>
</div>
<style>
/* General Styles */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

/* Container */
.container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
}

/* Header */
h1 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

/* Paragraph */
p {
    text-align: center;
    color: #666;
    line-height: 1.6;
    margin-bottom: 40px;
}

/* Team Section */
.team-section {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 40px;
}

/* Team Member */
.team-member {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 30%;
    text-align: center;
    padding: 20px;
    transition: transform 0.3s ease;
}

.team-member:hover {
    transform: translateY(-10px);
}

/* Team Member Image */
.team-member img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    margin-bottom: 15px;
}

/* Team Member Info */
.team-member-info h4 {
    color: #333;
    margin-bottom: 5px;
}

.team-member-info p {
    color: #777;
    margin-bottom: 10px;
}

.team-member-info a {
    color: #007BFF;
    text-decoration: none;
    font-weight: bold;
}

.team-member-info a:hover {
    text-decoration: underline;
}
</style>
</div>
</div>
<?php 
include_once("footer.php");
?> 
