<?php

if (isset($_GET['loginFailed'])) {

  $message = "Invalid Credentials ! Please try again.";
  echo "<script type='text/javascript'>alert('$message');</script>";

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="shortcut icon" type="image/jpg" href="img/chase_title.jpg" />

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/home_style.css" />
  <title>SAS BANK | Your's own bank</title>

  <script defer src="Javascript/script.js"></script>
</head>

<body>
  <header class="header">
    <nav class="nav">
      <img src="img/chase_title.jpg" alt="Bankist logo" class="nav__logo" id="logo" designer="Jonas" data-version-number="3.0" />
      <ul class="nav__links">
        <li class="nav__item">
          <a class="nav__link" href="customer_reg_form.php">Create Account</a>
        </li>
        <ul class="nav__links">
        <li class="nav__item">
          <a class="nav__link" href="debit_card_form.php">Apply Debit Card</a>
        </li>
        <li class="nav__item">
          <a class="nav__link" href="customer_login.php">E-Banking Login</a>
        </li>
        <li class="nav__item">
          <a class="nav__link" href="ebanking_reg_form.php">Register E-Banking</a>
        </li>
       
      </ul>
    </nav>

    <div class="header__title">
      <!-- <h1 onclick="alert('HTML alert')"> -->
      <h1>
        Your's
        <!-- Green highlight effect -->
        <span class="highlight">Own's</span>
        Trusted<br />
        <span class="highlight">Bank</span>
      </h1>
      <h4>A simpler banking experience for a simpler life.</h4>
      <button class="btn--text btn--scroll-to">Learn more &DownArrow;</button>
      <img src="img/hero.png" class="header__img" alt="Minimalist bank items" />
    </div>
  </header>

  <section class="section" id="section--1">
    <div class="section__title">
      <h2 class="section__description">Features</h2>
      <h3 class="section__header">
        Everything you need in a modern bank and more.
      </h3>
    </div>

    <div class="features">
      <img src="img/digital-lazy.jpg" data-src="img/digital.jpg" alt="Computer" class="features__img lazy-img" />
      <div class="features__feature">
        <div class="features__icon">
          <svg>
            <use xlink:href="img/icons.svg#icon-monitor"></use>
          </svg>
        </div>
        <h5 class="features__header">100% digital bank</h5>
        <p>

          Welcome to the future of banking with SASBank – your gateway to a 100% digital banking experience. We believe
          in making banking simple, convenient, and accessible anytime, anywhere. As a fully digital bank, we've
          eliminated the need for physical branches, allowing you to manage your finances seamlessly through our
          user-friendly mobile app or website.Join us in redefining the future of banking, where innovation meets your financial needs in the
          digital realm. Welcome to SASBank – where banking is as dynamic as your lifestyle.
        </p>
      </div>

      <div class="features__feature">
        <div class="features__icon">
          <svg>
            <use xlink:href="img/icons.svg#icon-trending-up"></use>
          </svg>
        </div>
        <h5 class="features__header">Watch your money grow</h5>
        <p>
          At SASBank, we understand the importance of financial growth and security. With our innovative and
          client-centric approach, we present to you a unique opportunity to "Watch Your Money Grow." Our range of
          tailored investment solutions is designed to empower you on your journey towards financial prosperity. Whether
          you are a seasoned investor or just starting, SASBank provides a diverse portfolio of investment options that
          align with your goals and risk tolerance.Choose SASBank for a secure
          and rewarding financial future.
        </p>
      </div>
      <img src="img/grow-lazy.jpg" data-src="img/grow.jpg" alt="Plant" class="features__img lazy-img" />

      <img src="img/card-lazy.jpg" data-src="img/card-lazy.jpg" alt="Credit card" class="features__img lazy-img" />
      <div class="features__feature">
        <div class="features__icon">
          <svg>
            <use xlink:href="img/icons.svg#icon-credit-card"></use>
          </svg>
        </div>
        <h5 class="features__header">Free debit card included</h5>
        <p>
          At SASBank, we're dedicated to enhancing your banking experience, and that's why we're thrilled to include a
          free debit card with our services. Enjoy the freedom to access your funds anytime, anywhere, with our sleek
          and secure debit card. Whether you're making everyday purchases, shopping online, or traveling, our card
          provides you with a hassle-free and reliable payment solution.Join SASBank today and enjoy the perks of a seamless, fee-free banking
          experience right at your fingertips.
        </p>
      </div>
    </div>
  </section>

  <section class="section" id="section--2">
    <div class="section__title">
      <h2 class="section__description">Operations</h2>
      <h3 class="section__header">
        Everything as simple as possible, but no simpler.
      </h3>
    </div>

    <div class="operations">
      <div class="operations__tab-container">
        <button class="btn operations__tab operations__tab--1 operations__tab--active" data-tab="1">
          <span>01</span>Instant Transfers
        </button>
        <button class="btn operations__tab operations__tab--2" data-tab="2">
          <span>02</span>Instant Loans
        </button>
        <button class="btn operations__tab operations__tab--3" data-tab="3">
          <span>03</span>Instant Closing
        </button>
      </div>
      <div class="operations__content operations__content--1 operations__content--active">
        <div class="operations__icon operations__icon--1">
          <svg>
            <use xlink:href="img/icons.svg#icon-upload"></use>
          </svg>
        </div>
        <h5 class="operations__header">
          Tranfser money to anyone, instantly! No fees, no BS.
        </h5>
        <p>
        SASBank puts the power of instant money transfers in your hands – no fees, no BS, just seamless financial transactions. Whether you need to send money to a friend, family member, or business associate, our platform ensures a hassle-free experience.
        </p>
      </div>

      <div class="operations__content operations__content--2">
        <div class="operations__icon operations__icon--2">
          <svg>
            <use xlink:href="img/icons.svg#icon-home"></use>
          </svg>
        </div>
        <h5 class="operations__header">
          Buy a home or make your dreams come true, with instant loans.
        </h5>
        <p>
          
Unlock the door to your dreams with SASBank's instant loans – whether you're looking to buy a home or turn your aspirations into reality, we've got you covered. Our commitment to making your financial journey smooth and accessible is reflected in our instant loan offerings
        </p>
      </div>
      <div class="operations__content operations__content--3">
        <div class="operations__icon operations__icon--3">
          <svg>
            <use xlink:href="img/icons.svg#icon-user-x"></use>
          </svg>
        </div>
        <h5 class="operations__header">
          No longer need your account? No problem! Close it instantly.
        </h5>
        <p>
        At SASBank, we understand that financial needs and circumstances can change. That's why we've made it easier than ever to manage your accounts. No longer need your account? No problem! With SASBank, you can close it instantly, hassle-free.


        </p>
      </div>
    </div>
  </section>

  <section class="section" id="section--3">
    <div class="section__title section__title--testimonials">
      <h2 class="section__description">Not sure yet?</h2>
      <h3 class="section__header">
        The Most Trusted Bank All Over Nepal.
      </h3>
    </div>

    <div class="slider">
      <div class="slide">
        <div class="testimonial">
          <h5 class="testimonial__header">Best financial decision ever!</h5>
          <blockquote class="testimonial__text">
            I just wanted to take a moment to express my sincere gratitude for the incredible financial journey I've
            experienced with SASBank. Choosing SASBank has undoubtedly been the best financial decision I've ever made!
            The seamless integration of cutting-edge technology and personalized service has transformed the way I
            manage my finances.

            From the user-friendly mobile app to the hassle-free account setup process, every interaction with SASBank
            has been a delight. The inclusion of a free debit card has added a layer of convenience that truly sets
            SASBank apart. I can confidently say that I now have a financial partner that not only understands my needs
            but also anticipates them.
          </blockquote>
          <address class="testimonial__author">
            <img src="img/user-1.jpg" alt="" class="testimonial__photo" />
            <h6 class="testimonial__name">Pushpa Kamal Dahal 'Prachanda'</h6>
            <p class="testimonial__location">Baluwatar, Nepal</p>
          </address>
        </div>
      </div>

      <button class="slider__btn slider__btn--left">&larr;</button>
      <button class="slider__btn slider__btn--right">&rarr;</button>
      <div class="dots"></div>
    </div>
  </section>

  <section class="section section--sign-up">
    <div class="section__title">
      <h3 class="section__header">
        The best day to join SAS Bank was one year ago. The second best is
        today!
      </h3>
    </div>
    <!-- <button class="btn btn--show-modal">Open your free account today!</button> -->
  </section>

  <footer class="footer">
    <ul class="footer__nav">
      <li class="footer__item">
        <a class="footer__link" href="contact.php">Contact Us</a>
      </li>
      <li class="footer__item">
        <a class="footer__link" href="news.php">News</a>
      </li>
      <li class="footer__item">
        <a class="footer__link" href="Privacy.php">Privacy Policy</a>
      </li>
      <li class="footer__item">
        <a class="footer__link" href="Carrier.php">Careers</a>
      </li>  
      <li class="footer__item">
        <a class="footer__link" href="staff_login.php">Admin Login</a>
      </li>   
    </ul>
    <img src="img/chase_title.jpg" alt="Logo" class="footer__logo" />
    <p class="footer__copyright">
      &copy; Copyright by
      <a>2023 SASBANK </a>
    </p>
  </footer>

  <div class="modal hidden">
    <button class="btn--close-modal">&times;</button>
    <h2 class="modal__header">
      Open your bank account <br />
      in just <span class="highlight">5 minutes</span>
    </h2>
    <form class="modal__form">
      <label>First Name</label>
      <input type="text" />
      <label>Last Name</label>
      <input type="text" />
      <label>Email Address</label>
      <input type="email" />
      <button class="btn">Next step &rarr;</button>
    </form>
  </div>
  <div class="overlay hidden"></div>

<script src="script.js"></script>
  </body>
</html>