<?php
  // include('../../API/getCountries.php');
?>


<!DOCTYPE html>
<html lang="en">
  <!-- Mirrored from product.geniusocean.com/genius-wallet/merchant/register by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 25 Nov 2023 16:01:04 GMT -->
  <!-- Added by HTTrack --><meta
    http-equiv="content-type"
    content="text/html;charset=UTF-8"
  /><!-- /Added by HTTrack -->
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Genius Admin-Merchant Register</title>
    <link
      rel="shortcut icon"
      type="image/png"
      href="../assets/images/5480339181644482400.png"
    />

    <link rel="stylesheet" href="../assets/merchant/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/merchant/css/font-awsome.min.css" />
    <link rel="stylesheet" href="../assets/merchant/css/style.css" />
    <link rel="stylesheet" href="../assets/merchant/css/custom.css" />
    <link rel="stylesheet" href="../assets/merchant/css/components.css" />
    <style>
      .logincard {
        margin-top: 60px !important;
        border-radius: 3px;
      }
    </style>
    <!-- Favicon -->
  </head>
  <body>
    <div id="app">
      <section class="section">
        <div class="container-xl">
          <div class="row">
            <div
              class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4"
            >
              <div class="card card-primary logincard">
                <div class="card-header d-flex justify-content-between">
                  <h4>User Register</h4>
                  <a href="../../index.html">Home</a>
                </div>

                <div class="card-body">
                  <form method="POST" action="#" class="needs-validation">
                    <input
                      type="hidden"
                      name="_token"
                      value="Iy0FRDBOIkaUKE25aJqtOAIIZbsRA1D2wpZGbg4r"
                    />
                    
                    <div class="form-group">
                      <label>Your Name</label>
                      <input
                        type="text"
                        class="form-control"
                        name="name"
                        tabindex="1"
                        required
                        value=""
                      />
                    </div>

                    <div class="form-group">
                      <label for="email">Email</label>
                      <input
                        id="email"
                        type="email"
                        class="form-control"
                        name="email"
                        tabindex="1"
                        value=""
                        required
                      />
                    </div>
                    <div class="form-group">
                      <label>Country</label>
                      <select
                        name="country"
                        class="form-control country"
                        required
                      >
                        <option value="">Select</option>
                        <?php
                                            foreach ($countries as $country) {
                                                $countryName = $country['name']['common'];
                                                echo "<option value='$countryName'>$countryName</option>";
                                            }
                                            ?>
                      </select>
                    </div>

                    
                    

                    <div class="form-group">
                      <label for="password" class="control-label"
                        >Password</label
                      >
                      <input
                        id="password"
                        type="password"
                        class="form-control"
                        name="password"
                        tabindex="2"
                      />
                    </div>
                    <div class="form-group">
                      <label for="password" class="control-label"
                        >Confirm Password</label
                      >
                      <input
                        id="password"
                        type="password"
                        class="form-control"
                        name="password_confirmation"
                        tabindex="2"
                      />
                    </div>
                    <div class="form-group">
                      <div
                        class="g-recaptcha"
                        data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"
                        data-callback="verifyCaptcha"
                      ></div>
                      <div id="g-recaptcha-error"></div>
                    </div>

                    <div class="form-group text-right">
                      <a href="login.html" class="float-left mt-3">
                        Already have an account ? Login
                      </a>
                      <button
                        type="submit"
                        class="btn btn-primary btn-lg btn-icon icon-right"
                        tabindex="4"
                      >
                        Register
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <script src="../assets/merchant/js/jquery.min.js"></script>
    <script src="../assets/merchant/js/bootstrap.min.js"></script>
    <script src="../assets/merchant/js/scripts.js"></script>
    <script src="../assets/admin/js/sweetalert2%409.js"></script>

    <script>
      function toast(type, msg) {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          onOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
          },
        });
        Toast.fire({
          icon: type,
          title: msg,
        });
      }

      function amount(amount, type) {
        if (type == 2) {
          return amount.toFixed(8);
        } else {
          return amount.toFixed();
        }
      }
    </script>
    <script src="../../../www.google.com/recaptcha/api.js"></script>
    <script>
      "use strict";
      function auto() {
        var code = $(".country option:selected").data("dial_code");
        $(".d_code").text(code);
        $("input[name=dial_code]").val(code);
      }
      auto();
      $(".country").on("change", function () {
        auto();
      });

      function recaptcha() {
        var response = grecaptcha.getResponse();
        if (response.length == 0) {
          document.getElementById("g-recaptcha-error").innerHTML =
            '<span class="text-danger">Captcha field is required.</span>';
          return false;
        }
        return true;
      }
    </script>
    <div class="cookie-section">
      <div class="container">
        <div class="js-cookie-consent cookie-consent">
          <span class="cookie-consent__message m-2">
            Our site use cookies when you visit our website, including any other
            media form, mobile website, or mobile application related or
            connected to help customize the site and improve your experience.
          </span>

          <button
            class="js-cookie-consent-agree cookie-consent__agree cmn--btn m-2"
          >
            Allow Cookie
          </button>
        </div>
      </div>
    </div>

    <script>
      window.laravelCookieConsent = (function () {
        const COOKIE_VALUE = 1;
        const COOKIE_DOMAIN = "product.geniusocean.com";

        function consentWithCookies() {
          setCookie("cookie_consent", COOKIE_VALUE, 7300);
          hideCookieDialog();
        }

        function cookieExists(name) {
          return (
            document.cookie.split("; ").indexOf(name + "=" + COOKIE_VALUE) !==
            -1
          );
        }

        function hideCookieDialog() {
          const dialogs = document.getElementsByClassName("cookie-section");
          for (let i = 0; i < dialogs.length; ++i) {
            dialogs[i].style.display = "none";
          }
        }

        function setCookie(name, value, expirationInDays) {
          const date = new Date();
          date.setTime(date.getTime() + expirationInDays * 24 * 60 * 60 * 1000);
          document.cookie =
            name +
            "=" +
            value +
            ";expires=" +
            date.toUTCString() +
            ";domain=" +
            COOKIE_DOMAIN +
            ";path=/" +
            "";
        }

        if (cookieExists("cookie_consent")) {
          hideCookieDialog();
        }

        const buttons = document.getElementsByClassName(
          "js-cookie-consent-agree"
        );

        for (let i = 0; i < buttons.length; ++i) {
          buttons[i].addEventListener("click", consentWithCookies);
        }

        return {
          consentWithCookies: consentWithCookies,
          hideCookieDialog: hideCookieDialog,
        };
      })();
    </script>
  </body>

  <!-- Mirrored from product.geniusocean.com/genius-wallet/merchant/register by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 25 Nov 2023 16:01:04 GMT -->
</html>
