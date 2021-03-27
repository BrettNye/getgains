<?php
    require_once('./session/sessioncheck.php');
    require_once('header.php');
    require_once('./user/user.php');

    $user = new User;
?>

<style>
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 15% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
</style>

<div>
    <div>
        <div>
        <h2>Body Weight</h2>
        <a id="weight-modal">+</a>
        <?php
          $LBS = number_format($user->getCurrentWeight($_SESSION['user_id'])/16, 2, '.', '');
          
          echo "<p>" . $LBS . " LBS</p>"
        ?>
        </div>
    </div>
</div>

<!-- The Modal -->
<div id="userWeightModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <form id="weight-form" method="POST" action="../getgains/functional_pages/update_weight.php">
        Pounds: <input type="number" name="pounds"/>
        ounces: <input type="number" name="ounces"/>
        <button type="submit">Log</button>
    </form>
  </div>

</div>
<script>
// Get the modal
var modal = document.getElementById("userWeightModal");

// Get the button that opens the modal
var btn = document.getElementById("weight-modal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

</script>
<?php
    require_once('footer.php');
?>