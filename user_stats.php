<?php
    require_once('./session/sessioncheck.php');
    require_once('header.php');
    require_once('./user/user.php');

    $user = new User;

    $data = $user->getWeightLog($_SESSION['user_id'], 0);
    $weight = $data[0];
    $dates = $data[1];
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<div>
    <div class="d-flex justify-content-center mt-5">
        <div class="weight d-flex flex-column">
          <div class="header-container d-flex justify-content-between align-items-center bg-dark p-0">
            <p class="header m-0 p-0 ml-2 text-light">Body Weight</p>
            <a id="weight-modal" class="text-light mr-2">+</a>
          </div>
          <p class="ml-2">
        <?php
          $LBS = number_format($user->getCurrentWeight($_SESSION['user_id']), 1, '.', '');
          
          echo "Current: " . $LBS . " LBS"
        ?>
          </p>
          <canvas id="myChart" width="100" height="100"></canvas>
        </div>
      </div>
  </div>

<!-- The Modal -->
<div id="userWeightModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content d-flex flex-column justify-content-center align-items-center w-25">
    <div class="w-75 d-flex justify-content-center">
    <p class="modal-header m-0 p-0 ml-2">Log Body Weight</p>
    </div>
    <span class="close mr-2">&times;</span>
    <form id="weight-form" class="d-flex flex-column align-items-center mt-4" method="POST" action="../getgains/functional_pages/update_weight.php">
        <input class=" w-50" type="number" step=".1" name="weight" Placeholder="225.2 LBS"/>
        <button class="btn btn-dark w-75 mt-3" type="submit">Log</button>
    </form>
    <button>1W</button>
    <button>1M</button>
    <button>6M</button>
    <button>1Y</button>
  </div>

</div>
<script>
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: <?php echo $dates; ?>,
            datasets: [{
                label: 'Weight in LBS',
                data: <?php echo $weight; ?>,
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1,
                fill: false
            }]
        }
    });
  </script>

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