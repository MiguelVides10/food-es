<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Acerca de</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>Acerca de nosotros</h3>
   <p><a href="home.php">Inicio</a> <span> / Acerca de</span></p>
</div>

<!-- about section starts  -->

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/about-img.svg" alt="">
      </div>

      <div class="content">
         <h3>¿Por qué elegirnos?</h3>
         <p>Somos una familia apasionada por la gastronomía y el buen servicio, que nos gusta rodearnos con gente de los mismos gustos para disfrutar de atenderle de la mejor manera.</p>
         <a href="menu.html" class="btn">Nuestro menú</a>
      </div>

   </div>

</section>

<!-- about section ends -->

<!-- steps section starts  -->

<section class="steps">

   <h1 class="title">Simples pasos</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/step-1.png" alt="">
         <h3>Elegir orden</h3>
         <p>Elige la mejor opción para tí, para que disfrutes de la mejor manera uno de nuestros platillos.</p>
      </div>

      <div class="box">
         <img src="images/step-2.png" alt="">
         <h3>Entrega rápida</h3>
         <p>Contamos con un servicio muy eficiente para que disfrutes de tu platillo cuanto antes.</p>
      </div>

      <div class="box">
         <img src="images/step-3.png" alt="">
         <h3>Disfruta la comida</h3>
         <p>Disfruta de nuestros platillos en un ambiente agradable y comodo, para una mejor experiencia.</p>
      </div>

   </div>

</section>

<!-- steps section ends -->








<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->=






<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   grabCursor: true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
      slidesPerView: 1,
      },
      700: {
      slidesPerView: 2,
      },
      1024: {
      slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>