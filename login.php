<?php
   session_start();
   require 'db_conf.inc.php';
   include 'user.php';
if (isset($_POST['InputEmail'])) {
   $form_content = array( 'UUID'  => $_SESSION['FBID'],
                          'mail' => $_POST['InputEmail'],
                          'name' => $_SESSION['FULLNAME'],
                          'bg'   => $_POST['bgurl'],
                          'fbuname' => $_SESSION['USERNAME'],
                          'insta' => $_POST['insta'],
                          'scuname' => $_POST['snapchat'],
                          'twhandle' => $_POST['twitterhandle'],
                          'tumbuname' => $_POST['tumblr'],
                          'perid' => $_POST['perid'],
                          'meerkat' => $_POST['meerkatid'],
                          'tagline' => array('1' => $_POST['tagline1'],
                                            '2' => $_POST['tagline2']),
                          'website' => $_POST['website']);

    $person = new User($form_content);
    $person->writeDB();
  }
?>
<html xmlns:fb = "http://www.facebook.com/2008/fbml">

   <head>
      <title>Meet RAGE | Login with Facebook</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
   </head>

   <body>
     <div class="container" style="height:40px;">
     </div
     </div>
      <?php if ($_SESSION['FBID']): ?>      <!--  After user login  -->

         <div class = "container">

            <div class = "hero-unit">
               <h1>Hello <?php echo $_SESSION['USERNAME']; ?></h1>
            </div>

            <div class = "span4">

               <ul class = "nav nav-list">
                  <li class = "nav-header">Image</li>

                  <li><img src = "https://graph.facebook.com/<?php
                     echo $_SESSION['FBID']; ?>/picture" class="img-circle"></li>

                  <li class = "nav-header">Facebook ID</li>
                  <li><?php echo  $_SESSION['FBID']; ?></li>

                  <li class = "nav-header">Facebook fullname</li>

                  <li><?php echo $_SESSION['FULLNAME']; ?></li>

                  <li class = "nav-header">Facebook Email</li>

                  <li><?php echo $_SESSION['EMAIL']; ?></li>

                  <form class="" action="login.php" method="post">
                    <div class="form-group">
                      <label for="InputEmail">Email address</label>
                      <input type="email" class="form-control" id="InputEmail" name="InputEmail"placeholder="Email">
                    </div>
                    <div class="form-group">
                      <label for="insta">Instagram Handle(username)</label>
                      <div class="input-group">
                        <span class="input-group-addon">@</span>
                        <input type="text" class="form-control" id="insta" name="insta" placeholder="jj_wedemeyer">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="snapchat">Snapchat</label>
                      <div class="input-group">
                        <span class="input-group-addon">@</span>
                        <input type="text" class="form-control" id="snapchat" name="snapchat" placeholder="jj_wedemeyer">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="twitterhandle">Twitter Handle</label>
                      <div class="input-group">
                        <span class="input-group-addon">@</span>
                        <input type="text" class="form-control" id="twitterhandle" id="twitterhandle" placeholder="jj_wedemyer">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="tumblr">Tumblr</label>
                      <div class="input-group">
                        <span class="input-group-addon">@</span>
                        <input type="text" class="form-control" id="tumblr" name="tumblr" placeholder="tumblr">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="perid">Periscope</label>
                      <div class="input-group">
                        <span class="input-group-addon">@</span>
                        <input type="text" class="form-control" id="perid" name="perid" placeholder="perid">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="meerkat">Meerkat</label>
                      <div class="input-group">
                        <span class="input-group-addon">@</span>
                        <input type="text" class="form-control" id="meerkat" name="meerkat" placeholder="meerkat user">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="bgurl">Background</label>
                      <div class="input-group">
                        <span class="input-group-addon">imgur</span>
                        <input type="text" class="form-control" id="bgurl" name="bgurl" placeholder="http://imgur.com/asdqwe">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="tagline">Your tagline(s)</label>
                      <div class="input-group">
                        <input type="text" class="form-control" id="tagline1" name="tagline1" placeholder="e.g. STRONK CS:GO Playing RUSSIAN">
                        <input type="text" class="form-control" id="tagline2" name="tagline2" placeholder="tagline l. 2">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>

                  </form>

                  <div><a href="logout.php">Logout</a></div>

               </ul>

            </div>
         </div>

         <?php else: ?>     <!-- Before login -->

         <div class = "container">
            <h1>Login with Facebook</h1>
            Not Connected

            <div>
              <button type="button" class="btn btn-primary">
                <a href = "fbconfig.php">Login with Facebook</a></button>
            </div>
         </div>

      <?php endif ?>

   </body>
</html>
