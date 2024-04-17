<?php
  session_start();
?>

<html>
  <head>
    <meta charset="UTF-8" />
    <title>Bài tập thực hành 5</title>
  </head>
  <frameset rows="85,*,85" border="no">
    <frame name="top" src="./View/t1.html" />
    <frameset cols="190, *, 190">
      <?php if(isset($_SESSION['username'])): ?>
        <frame name="sidebar" target="main" src="./View/t2_login.html" />
      <?php else: ?>
        <frame name="sidebar" target="main" src="./View/t2.html" />
      <?php endif; ?>
      <frame name="main" src="./View/t3.html" />
      <frame name="right" src="./View/t4.html" />
    </frameset>
    <frame name="bottom" src="./View/t5.html" />
  </frameset>
</html>
