<?php 
$accueil = true;
include_once("header.php");
include_once("main.php");


?>

<div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
        <!--Slides-->
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <img class="d-block w-100" src="images/4.jpg" alt="First slide">
                 <div class="gradient"></div>
                  <div class="carousel-caption">
                    <h1>Optimizing order management for a seamless online experience.</h1>
                  </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/3.jpeg" alt="Second slide">
                 <div class="gradient"></div>
                  <div class="carousel-caption">
                   <h1>Driving seamless order operations for better user satisfaction..</h1>
                  </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/2.jpeg" alt="Third slide">
                 <div class="gradient"></div>
                  <div class="carousel-caption">
                   <h1>Delivering excellence through streamlined order handling.</h1>
                  </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/1.jpeg" alt="Third slide">
                 <div class="gradient"></div>
                  <div class="carousel-caption">
                   <h1>Boosting efficiency in online order processing.</h1>
                  </div>
            </div>
        </div>
        <!--/.Slides-->
        <!--/.Controls-->
        <ol class="carousel-indicators">
            <li data-target="#carousel-thumb" data-slide-to="0" class="active"> <img class="d-block w-100" src="images/4.jpg" class="img-fluid">
               
            </li>
            <li data-target="#carousel-thumb" data-slide-to="1"><img class="d-block w-100" src="images/3.jpeg" class="img-fluid">
               
            </li>
            <li data-target="#carousel-thumb" data-slide-to="2"><img class="d-block w-100" src="images/2.jpeg" class="img-fluid">
                
            </li>
            <li data-target="#carousel-thumb" data-slide-to="3"><img class="d-block w-100" src="images/1.jpeg" class="img-fluid">
                
            </li>
        </ol>
</div>

</tbody>



    </div>
    </main>
<?php 
include_once("footer.php");
?>
