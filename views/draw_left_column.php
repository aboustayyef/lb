<?php $s = $_SESSION['channel']; 

function ischannel($s, $channelname){
  if ($channelname == NULL && $s == NULL) {
    echo " selected ";
  }else{
    if ($s == $channelname) {
      echo " selected ";
    }
  }
}

//build url for current page
$self_url = $_SERVER['PHP_SELF']; //script without parameters
if (isset($_SESSION['channel'])) {
  $self_url .= '?channel='.$_SESSION['channel'].'&view='; // add channel
}else{
  $self_url .= '?view=';
}
?>
<div id="left-col-wrapper">
  <!-- <?php echo $_SESSION['viewtype'] ?> -->
  <button class="leftNav-dismiss">×</button>
  <div id ="viewtype">
    <h4 class="sectionheader">Posts Layout <sup>New!</sup></h4>
    <div id="icons">
      
      <a href="<?php echo $self_url.'cards' ?>">
      <img src="<?php echo WEBPATH . 'img/interface/view-icon-card';
        if ($_SESSION['viewtype']=='cards') {
          echo '-selected';
        }
        echo '.png' ;?>" width ="25" height ="25" alt=""></a>
      
      <a href="<?php echo $self_url.'timeline' ?>">
      <img src="<?php echo WEBPATH . 'img/interface/view-icon-timeline';
        if ($_SESSION['viewtype']=='timeline') {
          echo '-selected';
        }
        echo '.png' ;?>" width ="25" height ="25" alt=""></a>

      <a href="<?php echo $self_url.'compact' ?>">  
      <img src="<?php echo WEBPATH . 'img/interface/view-icon-compact';
        if ($_SESSION['viewtype']=='compact') {
          echo '-selected';
        }
        echo '.png' ;?>" width ="25" height ="25" alt=""></a>
    </div>
  </div>

<h4 class="sectionheader">Statistics <sup>New!</sup></h4>
<div class="label level1"><a href="<?php echo WEBPATH . '?pagewanted=top'; ?>"><i class ="icon-bar-chart"></i>Top Posts &amp; Blogs</a></div>

  <div id ="channels">
    <h4 class="sectionheader">User Area<sup>New!</sup></h4>

      <div class = "label level1"><i class ="icon-star"></i>My Favorite Bloggers</div>
      <div class ="label level1"><i class ="icon-envelope"></i>My Saved Posts</div>
      

      <h4 class="sectionheader">Channels</h4>
      <a href="<?php echo WEBPATH ?>">
        <div class = " <?php ischannel($s, null); ?> label folder level1">
          <i class ="icon-folder-open-alt"></i>
          All
        </div>
      </a>
      <a href ="<?php echo WEBPATH . '?channel=fashion'; ?>">
        <div class = " <?php ischannel($s,'fashion'); ?> label level2">
          <i class="icon-umbrella"></i>
          Fashion &amp; Style
        </div>
      </a>
      <a href ="<?php echo WEBPATH . '?channel=food'; ?>">
        <div class = " <?php ischannel($s,'food'); ?> label level2">
          <i class="icon-coffee"></i>
          Food &amp; Health
        </div>
      </a>
      <a href ="<?php echo WEBPATH . '?channel=society'; ?>">
        <div class = " <?php ischannel($s,'society'); ?> label level2">
          <i class="icon-smile"></i>
          Society &amp; Fun News
        </div> 
      </a>
      <a href ="<?php echo WEBPATH . '?channel=politics'; ?>">
        <div class = " <?php ischannel($s,'politics'); ?> label level2">
          <i class="icon-globe"></i>
          Politics &amp; Current Affairs
        </div>     
      </a>
      <a href ="<?php echo WEBPATH . '?channel=tech'; ?>">
        <div 
          class = " <?php ischannel($s,'tech'); ?> label level2">
          <i class="icon-laptop"></i>
          Tech &amp; Business
        </div>
      </a>
      <a href ="<?php echo WEBPATH . '?channel=media'; ?>">
        <div class = " <?php ischannel($s,'media'); ?> label level2">
          <i class="icon-music"></i>
          Music, TV &amp; Film
        </div>
      </a>
      <a href ="<?php echo WEBPATH . '?channel=design'; ?>">
        <div class = " <?php ischannel($s,'design'); ?> label level2">
          <i class="icon-picture"></i>
          Advertising &amp; Design
        </div>     
      </a> 

  </div>

</div> <!-- /left-col-wrapper -->