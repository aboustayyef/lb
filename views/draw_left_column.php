<?php $s = $_SESSION['channel']; 

function ischannel($s, $channelname){
  if ($channelname == NULL && $s == NULL  && $_SESSION['pagewanted']=='browse') {
    echo " selected ";
  }else{
    if ($s == $channelname && $_SESSION['pagewanted']=='browse') {
      echo " selected ";
    }
  }
}

//build url for current page
$self_url = $_SERVER['PHP_SELF']; //script without parameters
if (isset($_SESSION['channel'])) {
  $self_url .= '?channel='.$_SESSION['channel'].'&pagewanted='.$_SESSION['pagewanted'].'&view='; // add channel
}else{
  $self_url .= '?pagewanted='.$_SESSION['pagewanted'].'&view=';
}
?>
<div id="left-col-wrapper">
  <div class="left-col-inner">
    <!-- <?php echo $_SESSION['viewtype'] ?> -->
    <button class="leftNav-dismiss">×</button>

<!-- <h4 class="sectionheader">Statistics <sup>New!</sup></h4>
  <div class="label level1"><a href="<?php echo WEBPATH . '?pagewanted=top'; ?>"><i class ="icon-bar-chart"></i>Top Posts &amp; Blogs</a></div> -->

  <div id ="channels">
    <h4 class="sectionheader">User Area<sup>New!</sup></h4>
    <?php 
        if (isset($_SESSION['LebaneseBlogs_user_id'])){ // user logged in
          ?>
        <div class="userBox">
          <img src="<?php echo $_SESSION['lebaneseblogs_Facebook_Profile_Pic']; ?>" alt="" width ="50" height = "50" class="profilePic">
          <h4 class="userName"><?php echo $_SESSION['LebaneseBlogs_Facebook_FirstName']; ?></h4>
          <a href="<?php echo WEBPATH.'facebooklogout.php'; ?>" class ="signout"> Sign out</a>
        </div>
        <?php
        } 
        ?>
        <div class = "label level1 <?php if ( $_SESSION['pagewanted']=='favorites') { echo 'selected';} ?>">
          <a href="<?php echo WEBPATH.'userlogin.php?from=favorites&amp;redirect='.WEBPATH.'?pagewanted=favorites' ?>"><i class ="icon-star"></i>My Favorite Bloggers</a>
        </div>
        <div class = "label level1 <?php if ( $_SESSION['pagewanted']=='saved') { echo 'selected';} ?>">
          <a href="<?php echo WEBPATH.'userlogin.php?from=saved&amp;redirect='.WEBPATH.'?pagewanted=saved' ?>"><i class ="icon-envelope"></i>My Saved Posts</a>
        </div>
        
        <h4 class="sectionheader">Posts to Show</h4>
        <a href="<?php echo WEBPATH ?>">
          <div class = " <?php ischannel($s, null); ?> label folder level1">
            <i class ="icon-home"></i>
            Show All
          </div>
        </a>
        <a href ="<?php echo WEBPATH . '?channel=fashion'; ?>">
          <div class = " <?php ischannel($s,'fashion'); ?> label level1">
            <i class="icon-umbrella"></i>
            Fashion &amp; Style
          </div>
        </a>
        <a href ="<?php echo WEBPATH . '?channel=food'; ?>">
          <div class = " <?php ischannel($s,'food'); ?> label level1">
            <i class="icon-coffee"></i>
            Food &amp; Health
          </div>
        </a>
        <a href ="<?php echo WEBPATH . '?channel=society'; ?>">
          <div class = " <?php ischannel($s,'society'); ?> label level1">
            <i class="icon-smile"></i>
            Society &amp; Fun News
          </div> 
        </a>
        <a href ="<?php echo WEBPATH . '?channel=politics'; ?>">
          <div class = " <?php ischannel($s,'politics'); ?> label level1">
            <i class="icon-globe"></i>
            Politics &amp; Current Affairs
          </div>     
        </a>
        <a href ="<?php echo WEBPATH . '?channel=tech'; ?>">
          <div 
          class = " <?php ischannel($s,'tech'); ?> label level1">
          <i class="icon-laptop"></i>
          Tech &amp; Business
        </div>
      </a>
      <a href ="<?php echo WEBPATH . '?channel=media'; ?>">
        <div class = " <?php ischannel($s,'media'); ?> label level1">
          <i class="icon-music"></i>
          Music, TV &amp; Film
        </div>
      </a>
      <a href ="<?php echo WEBPATH . '?channel=design'; ?>">
        <div class = " <?php ischannel($s,'design'); ?> label level1">
          <i class="icon-picture"></i>
          Advertising &amp; Design
        </div>     
      </a> 

    </div>
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
          <div class="credits">
            Designed and developed by <a href ="http://twitter.com/beirutspring">Mustapha Hamoui</a>
          </div>
        </div> <!-- /left-col-inner -->
</div> <!-- /left-col-wrapper -->