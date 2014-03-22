<div class="loginPage">
  <?php 

  // This page is the static page of where the login button lives
  // it is passed along the $parameters array with keys 'urlToSave', 'blogToFave' & 'redirectUrl'

  // build the redirect part of the Facebook Login Button. It carries along the parameters so that after login is succesful
  // the instructions to favorite and save will be passed along

  // Prepare the Login button. Display later, through the body
  $loginRedirectUrl = WEBPATH.'?pagewanted=login';
  if (!empty($parameters['urlToSave'])) {
    $loginRedirectUrl .= '&urltosave='.urlencode($parameters['urlToSave']);
  }
  if (!empty($parameters['blogToFave'])) {
    $loginRedirectUrl .= '&blogtofave='.$parameters['blogToFave'];
  }
  if (!empty($parameters['redirectUrl'])) {
    $loginRedirectUrl .= '&redirecturl='.urlencode($parameters['redirectUrl']);
  }

?>
  <!-- The Page Itself -->
  <div class="loginMain">
    <h2>Message</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id, dolore, asperiores at fugit ipsa vel magni tempora? In, ullam, hic, doloribus quia ea odit saepe rem deserunt vero praesentium veniam nulla tempore officiis perferendis illum inventore quo beatae aperiam magnam provident illo enim optio eaque aliquid laboriosam cumque quos non.</p>
    <img src= "http://placehold.it/300x300">
    <div class="thebutton">
      <?php LbUser::showFacebookSigninButton($loginRedirectUrl); ?>
    </div>
  </div>

</div>