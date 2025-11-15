<footer class="footer mt-auto py-3 bg-body-tertiary">
<section class="footer-top">
            <!--Container-->
            <div class="container">
                <h2> RECENT WORK</h2>
                <div class="row text-center text-lg-left">
                    <div class="col-lg-2 col-md-4 col-xs-6">
                        <a href="#" class="d-block h-100"><img class="img-fluid img-thumbnail" src="images/1.jpeg" alt=""></a>
                    </div>
                    <div class="col-lg-2 col-md-4 col-xs-6">
                        <a href="#" class="d-block h-100"><img class="img-fluid img-thumbnail" src="images/2.jpeg" alt=""></a>
                    </div>
                    <div class="col-lg-2 col-md-4 col-xs-6">
                        <a href="#" class="d-block h-100"><img class="img-fluid img-thumbnail" src="images/3.jpeg" alt=""></a>
                    </div>
                    <div class="col-lg-2 col-md-4 col-xs-6">
                        <a href="#" class="d-block h-100"><img class="img-fluid img-thumbnail" src="images/4.jpg" alt=""></a>
                    </div>
                    <div class="col-lg-2 col-md-4 col-xs-6">
                        <a href="#" class="d-block h-100"><img class="img-fluid img-thumbnail" src="images/5.jpg" alt=""></a>
                    </div>
                    <div class="col-lg-2 col-md-4 col-xs-6">
                        <a href="#" class="d-block h-100"><img class="img-fluid img-thumbnail" src="images/6.jpeg" alt=""></a>
                    </div>
                </div>

            </div>
            <!-- /.container -->
        </section>
<section class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul>
                            <li><a href="accueil.php">welcome</a></li>
                            <li class="hidden">/</li>
                            <li><a href="home.php">home</a></li>
                            <li class="hidden">/</li>
                            <li><a href="clients.php">clients</a></li>
                            <li class="hidden">/</li>
                            <li><a href="articles.php">articles</a></li>
                            <li class="hidden">/</li>
                            <li><a href="commandes.php">commandes</a></li>
                            <li class="hidden">/</li>
                            <li><a href="contact.html">Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <p>(C) All Rights Reserved <a href="https://www.facebook.com/profile.php?id=100071882586246&mibextid=ZbWKwL" target="_blank">GC.tn</a> </p>
                    </div>
                </div>
            </div>
            <!-- /.container -->
        </section>
</footer>



 <!-- Return to Top -->
 <a href="javascript:" id="return-to-top"><i class="fa fa-long-arrow-up" aria-hidden="true"></i></a>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>
<!-- Custom JavaScript -->
<script src="js/animate.js"></script>
<script src="js/custom.js"></script>
<script>
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
</script>

<script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>
<script type="text/javascript">
      $(document).ready( function () {
      $("#datatable").dataTable({
      "oLanguage": {
     "sLengthMenu": "Afficher MENU Enregistrements",
     "sSearch": "Rechercher:",
     "sInfo":"Total de TOTAL enregistrements (_END_ / _TOTAL_)",
     "oPaginate": {
     "sNext": "Suivant",
     "sPrevious":"Précédent"}}})});
  </script>
  
<script  src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>


<script>
// Automatic Slideshow - change image every 4 seconds
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  myIndex++;
  if (myIndex > x.length) { myIndex = 1 }
  x[myIndex - 1].style.display = "block";
  setTimeout(carousel, 2000);
}
function afficherAlerte1() {
    alert("Let's discovore !");
  }

  function afficherAlerte2() {
    alert("Follow us !");
  }

  function afficherAlerte3() {
    alert(" Formulaire !");
  }
  </script>
    </body>
</html>
