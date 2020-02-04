<html>
<footer style="background-color:#424949" >
		<center>
			<h2 style="color:white" >Welcome to Practical 4</h2>
      <?php
        if(!$_SESSION["ID"] == ""){
          echo '<form action="logout.php">
            <input type="submit" value="Logout"><br><br>
          </form>';
        } else {
          echo "<h4 style='color:white'>Please sign in or register to continue</h4><br>";
        }
        ?>
    </center>
	</footer>

  </html>
