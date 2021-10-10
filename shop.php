<?php

session_start();

include("includes/db.php");
include("includes/header.php");
include("functions/functions.php");
include("includes/main.php");

?>
<!-- MAIN -->
<main>
  <!-- HERO -->
  <div class="nero">
    <div class="nero__heading">
      <span class="nero__bold">shop</span>
    </div>
  </div>
</main>

<style>
  .shop-container {
    width: 100%;
    display: flex;
  }

  @media (max-width: 700px) {
    .shop-container {
      flex-direction: column;
    }
  }

  .shop-container .shop-sidebar {
    width: 600px;
  }

  .shop-container .shop-products {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
  }


  .product-shop {
    width: 400px;
    height: 500px;
    background: white;
    box-shadow: 20px 20px 60px #bebebe,
      -20px -20px 60px #ffffff;
    margin: 20px;
    padding: 20px;
  }

  .product-shop .product-price {
    width: 100%;

    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
  }

  .product-shop .product-price .left>a {
    font-size: 2.5rem;
  }

  .product-shop .product-price .right .right-price>p {
    margin: 0
  }

  .product-shop .product-buttons {
    width: 100%;
    height: fit-content;
    display: flex;
    align-items: center;
    justify-content: space-around;
  }

  .product-shop a img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    background-position: center;
    margin-bottom: 25px;
  }
</style>


<div class="shop-container">
  <div class="shop-sidebar">
    <?php include("includes/sidebar.php"); ?>
  </div>

  <div class="shop-products">
    <?php getProducts(); ?>
  </div>
</div>







<center>

  <ul class="pagination">

    <?php getPaginator(); ?>

  </ul>

</center>











<?php

include("includes/footer.php");

?>

<script src="js/jquery.min.js"> </script>

<script src="js/bootstrap.min.js"></script>

<script>
  $(document).ready(function() {

    /// Hide And Show Code Starts ///

    $('.nav-toggle').click(function() {

      $(".panel-collapse,.collapse-data").slideToggle(700, function() {

        if ($(this).css('display') == 'none') {

          $(".hide-show").html('Show');

        } else {

          $(".hide-show").html('Hide');

        }

      });

    });

    /// Hide And Show Code Ends ///

    /// Search Filters code Starts ///

    $(function() {

      $.fn.extend({

        filterTable: function() {

          return this.each(function() {

            $(this).on('keyup', function() {

              var $this = $(this),

                search = $this.val().toLowerCase(),

                target = $this.attr('data-filters'),

                handle = $(target),

                rows = handle.find('li a');

              if (search == '') {

                rows.show();

              } else {

                rows.each(function() {

                  var $this = $(this);

                  $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();

                });

              }

            });

          });

        }

      });

      $('[data-action="filter"][id="dev-table-filter"]').filterTable();

    });

    /// Search Filters code Ends ///

  });
</script>


<script>
  $(document).ready(function() {

    // getProducts Function Code Starts

    function getProducts() {

      // Manufacturers Code Starts

      var sPath = '';

      var aInputs = $('li').find('.get_manufacturer');

      var aKeys = Array();

      var aValues = Array();

      iKey = 0;

      $.each(aInputs, function(key, oInput) {

        if (oInput.checked) {

          aKeys[iKey] = oInput.value

        };

        iKey++;

      });

      if (aKeys.length > 0) {

        var sPath = '';

        for (var i = 0; i < aKeys.length; i++) {

          sPath = sPath + 'man[]=' + aKeys[i] + '&';

        }

      }

      // Manufacturers Code ENDS

      // Products Categories Code Starts

      var aInputs = Array();

      var aInputs = $('li').find('.get_p_cat');

      var aKeys = Array();

      var aValues = Array();

      iKey = 0;

      $.each(aInputs, function(key, oInput) {

        if (oInput.checked) {

          aKeys[iKey] = oInput.value

        };

        iKey++;

      });

      if (aKeys.length > 0) {

        for (var i = 0; i < aKeys.length; i++) {

          sPath = sPath + 'p_cat[]=' + aKeys[i] + '&';

        }

      }

      // Products Categories Code ENDS

      // Categories Code Starts

      var aInputs = Array();

      var aInputs = $('li').find('.get_cat');

      var aKeys = Array();

      var aValues = Array();

      iKey = 0;

      $.each(aInputs, function(key, oInput) {

        if (oInput.checked) {

          aKeys[iKey] = oInput.value

        };

        iKey++;

      });

      if (aKeys.length > 0) {

        for (var i = 0; i < aKeys.length; i++) {

          sPath = sPath + 'cat[]=' + aKeys[i] + '&';

        }

      }

      // Categories Code ENDS

      // Loader Code Starts

      $('#wait').html('<img src="images/load.gif">');

      // Loader Code ENDS

      // ajax Code Starts

      $.ajax({

        url: "load.php",

        method: "POST",

        data: sPath + 'sAction=getProducts',

        success: function(data) {

          $('#Products').html('');

          $('#Products').html(data);

          $("#wait").empty();

        }

      });

      $.ajax({
        url: "load.php",
        method: "POST",
        data: sPath + 'sAction=getPaginator',
        success: function(data) {
          $('.pagination').html('');
          $('.pagination').html(data);
        }

      });

      // ajax Code Ends

    }

    // getProducts Function Code Ends

    $('.get_manufacturer').click(function() {

      getProducts();

    });


    $('.get_p_cat').click(function() {

      getProducts();

    });

    $('.get_cat').click(function() {

      getProducts();

    });


  });
</script>

</body>

</html>