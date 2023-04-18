<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="manifest" href="manifest.json" />
  <link rel="icon" href="assets/images/favicon/2.png" type="image/x-icon" />
  <link rel="apple-touch-icon" href="assets/images/favicon/4.png" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="style.css" rel="stylesheet">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/4138468106.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/brands.min.css" integrity="sha512-sVSECYdnRMezwuq5uAjKQJEcu2wybeAPjU4VJQ9pCRcCY4pIpIw4YMHIOQ0CypfwHRvdSPbH++dA3O4Hihm/LQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>The Farmer's Market</title>
</head>

<body>
  <!-- Header section -->
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="assets/logo.png" alt="farm-mgmt-logo" style="width: 120px;"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="shop.php">Shop</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Log In</a>
          </li>
        </ul>
      </div>

      <div class="justify-content-end">
        <a class="nav-link" href="cart.php">
          <i class="fas fa-cart-plus" style="font-size: 25px;"></i>
        </a>
      </div>
    </div>
  </nav>
 <!-- Start of LiveChat (www.livechat.com) code -->
<script>
    window.__lc = window.__lc || {};
    window.__lc.license = 15338403;
    ;(function(n,t,c){function i(n){return e._h?e._h.apply(null,n):e._q.push(n)}var e={_q:[],_h:null,_v:"2.0",on:function(){i(["on",c.call(arguments)])},once:function(){i(["once",c.call(arguments)])},off:function(){i(["off",c.call(arguments)])},get:function(){if(!e._h)throw new Error("[LiveChatWidget] You can't use getters before load.");return i(["get",c.call(arguments)])},call:function(){i(["call",c.call(arguments)])},init:function(){var n=t.createElement("script");n.async=!0,n.type="text/javascript",n.src="https://cdn.livechatinc.com/tracking.js",t.head.appendChild(n)}};!n.__lc.asyncInit&&e.init(),n.LiveChatWidget=n.LiveChatWidget||e}(window,document,[].slice))
</script>
<noscript><a href="https://www.livechat.com/chat-with/15338403/" rel="nofollow">Chat with us</a>, powered by <a href="https://www.livechat.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a></noscript>
<!-- End of LiveChat code -->

  <!-- Hero section  -->
  <section class="hero-section" style="background-image: url('assets/farm-3.jpg');">
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-md-2 text-center">
          <h1 style="color: white;"><strong>THE FARMER'S MARKET</strong></h1>
          <a href="#" class="btn btn-main mt-3">Know More</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Our services section  -->
  <div class="container mt-4">
    <div class="service-content-block mb-4">
      <h3 class="text-uppercase text-center mb-4">Our Services</h3>
      <div class="row">
        <div class="col-sm-6 col-md-3">
          <img src="assets/poultry-farming1.jpg" alt="poultry farming image" class="collection-img border-all" />
          <div class="centered-text text-uppercase services-text" style="color: #9e5103;"><strong>Poultry Farming</strong></div>
        </div>
        <div class="col-sm-6 col-md-3">
          <img src="assets/cattle-farming.jpg" alt="cattle farming image" class="collection-img border-all" />
          <div class="centered-text text-uppercase services-text" style="color: #9e5103;"><strong>Cattle Farming</strong></div>
        </div>
        <div class="col-sm-6 col-md-3">
          <img src="assets/dairy-farming.jpg" alt="dairy farming image" class="collection-img border-all" />
          <div class="centered-text text-uppercase services-text" style="color: #9e5103;"><strong>Dairy Farming</strong></div>
        </div>
        <div class="col-sm-6 col-md-3">
          <img src="assets/broiler-chicken.jpg" alt="broiler chicken image" class="collection-img border-all" />
          <div class="centered-text text-uppercase services-text" style="color: #9e5103;"><strong>Broiler Chicken</strong></div>
        </div>
      </div>
    </div>

    <!-- Popular Products Section -->
    <section class="products-section-home mt-5">
      <div class="container">
        <div class="row">
          <div class="col-md-8 offset-md-2 text-center">
            <h2>POPULAR PRODUCTS</h2>
            <p> Check out our well-known products</p>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">

          <div class="row">
            <div class="card mt-5" style="max-width: 55%;">
              <div class="row">
                <div class="col-md-6">
                  <img src="assets/milk.jpg" class="card-img" alt="milk image">
                </div>
                <div class="col-md-6 ">
                  <div class="card-body">
                    <h3>MILK</h3>
                    <p class="card-text">Significant infrastructure investment is needed to support
                      the dairy industry's market. Furthermore, there are abundant
                      unexplored prospects in sectors including exports,
                      value-added dairy products, and organic/farm fresh milk.</p>
                    <a href="index.php" style="position: absolute; bottom: 00; right: 0;"><i class="fas fa-arrow-alt-circle-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row justify-content-end">
            <div class="card mt-5" style="max-width: 55%;">
              <div class="row">
                <div class="col-md-6">
                  <img src="assets/eggs.jpg" class="card-img" alt="eggs image">
                </div>
                <div class="col-md-6">
                  <div class="card-body">
                    <h3>EGGS</h3>
                    <p class="card-text">Fresh eggs from the farm? Well, it would be if it were true, 
                      but unless you are truly purchasing the eggs from a farm that produces them or 
                      a local supermarket that sells real eggs from a farm, the term "farm fresh" 
                      only refers to the fact that the eggs were obtained from chickens kept in battery cages. </p>
                    <a href="index.php"><i class="fas fa-arrow-alt-circle-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card mt-5" style="max-width: 55%;">
            <div class="row">
              <div class="col-md-6">
                <img src="assets/chicken.jpg" class="card-img" alt="chicken image container">
              </div>
              <div class="col-md-6">
                <div class="card-body">
                  <h3>CHICKEN</h3>
                  <p class="card-text">Chicken is the biggest domestic animal stock in the world 
                    by number of animals, and in the first decade of the twenty-first century, 
                    the fastest-growing segment of the world's meat production was chicken meat. 
                    Affordable, premium protein sources include poultry meat and eggs. </p>
                  <a href="index.php"><i class="fas fa-arrow-alt-circle-right"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="row justify-content-end">
            <div class="card mt-5" style="max-width: 55%;">
              <div class="row">
                <div class="col-md-6">
                  <img src="assets/butter.jpg" class="card-img" alt="butter image">
                </div>
                <div class="col-md-6">
                  <div class="card-body">
                    <h3>BUTTER</h3>
                    <p class="card-text">Today, butter is the most popular milk product produced 
                      in the developed dairy-producing nations of the world. 
                      The dairy industry's balance wheel is butter, which is produced from surplus milk 
                      and is used to produce more important goods when there is a shortage of buttermilk. </p>
                    <a href="index.php">&nbsp;<i class="fas fa-arrow-alt-circle-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Why Choose Us section -->
    <section class="advantages-section mt-5">
      <div class="container-fluid" style="padding-top: 70px;">
        <div class="row">
          <div class="col-md-8 offset-md-2 text-center mt-5">
            <h2 class="advt-heading mb-3 mt-45" style="color: black;">OUR ADVANTAGES</h2>
            <h3 style="color: black;">A Few Reasons Why You Should Visit Our Farm</h3><br><br>
          </div>
        </div>
      </div>
      <div class="container mt-3" style="padding-bottom: 120px;">
        <div class="row">
          <div class="col text-center">
            <img src="assets/circle-placeholder.png" alt="advantages-img-1">
            <p style="color: white;"><strong>Healthiest Produce</strong></p>
          </div>
          <div class="col text-center">
            <img src="assets/circle-placeholder.png" alt="advantages-img-2">
            <p style="color: white;"><strong>Last Much Longer</strong></p>
          </div>
          <div class="col text-center">
            <img src="assets/circle-placeholder.png" alt="advantages-img-3">
            <p style="color: white;"><strong>Community</strong></p>
          </div>
        </div>
      </div>
    </section>

    <!-- Testimonials section -->
    <section>
      <div class=" container-fluid" style="padding: 50px 0 50px 0;">
        <div class="row">
          <div class="col-md-8 offset-md-2 text-center mt-5">
            <h2 class="review-section-heading">WHAT OUR CUSTOMERS SAY ABOUT US</h2>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col mx-5 text-center" style="background: #57D064; padding-bottom: 60px;">
            <i class="fas fa-quote-left"></i>
            <p>Best Products<br>Reasonable prices<br>Freshly picked items</p>
            <br>
            <p><b>- Zuhi </b></p>
          </div>
          <div class="col mx-5 text-center" style="background: #C6CBD1; padding-bottom: 60px;">
            <i class="fas fa-quote-left"></i>
            <p>All organic products<br>Healthier Food<br>Freshest vegetables</p>
            <br>
            <p><b>- Param </b></p>
          </div>
          <div class="col mx-5 text-center" style="background: #57D064; padding-bottom: 60px;">
            <i class="fas fa-quote-left"></i>
            <p>Organic fertilization<br>Healthiest Eggs<br>Picked green</p>
            <br>
            <p><b>- Vraj </b></p>
          </div>
          <div class="col mx-5 text-center" style="background: #C6CBD1; padding-bottom: 60px;">
            <i class="fas fa-quote-left"></i>
            <p>All Fresh vegetables<br>Helthy quality products<br>Fresh crops</p>
            <br>
            <p><b>- Liza </b></p>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Footer section -->
  <footer>
    <div class="container py-4 mt-5">
      <div class="row mb-5">
        <div class="col-md-12 text-center">
          <a class="navbar-brand" href="index.php"><img src="assets/logo.png" alt="farm-mgmt-logo" style="width: 120px;"></a>
        </div>
      </div>
      <div class="footer-container">
        <div class="">
          <h5><strong>Shop</strong></h5>
          <p><a href="">Fresh Crops</a></p>
          <p><a href="">Dairy Products</a></p>
          <p><a href="">Poultry</a></p>
          <p><a href="">Live Stock</a></p>
        </div>
        <div class="">
          <h5><strong>About</strong></h5>
          <p><a href="">About Us</a></p>
          <p><a href="">Farm Management</a></p>
          <p><a href="">Contact Us</a></p>
          <p><a href="">Learn More</a></p>
          <p><a href="">Stores</a></p>
        </div>
        <div class="">
          <div class="d-block">
            <h5><strong>Contact Us</strong></h5>
            <p><a href="mailto:group5@farmmngmnt.com">group5@farmmgmt.com</a></p>
            <p><a href="tel:226 754 6785">226 754 6785</a></p>
            <p><a href="">Kitchener, ON.</a></p>
          </div>
          <div class="pl-40 mt-26">
            <div class="follow-us-text">
              <h5>Follow Us On</h5>
            </div>
            <div class="brand-icons">
              <i class="fab fa-instagram" style="color: #d62976;"></i>
              <i class="fab fa-linkedin" style="color: #0072b1;"></i>
              <i class="fab fa-facebook" style="color: #2b6fe3;"></i>
              <i class="fab fa-twitter" style="color: #00acee;"></i>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-12 text-center pt-4">
          <p><b>&copy; Copyright 2023 Farm Management System.</b></p>
        </div>
      </div>
    </div>
  </footer>

</body>

</html>