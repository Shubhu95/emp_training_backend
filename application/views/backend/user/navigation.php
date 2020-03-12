<?php
	$status_wise_courses = $this->crud_model->get_status_wise_courses();
 ?>
 <!-- ========== Left Sidebar Start ========== -->
 <div class="left-side-menu">

   <div class="slimscroll-menu" id="left-side-menu-container">

     <!-- LOGO -->
     <a href="javascript: void(0);" class="logo text-center">
       <span class="logo-lg">
         <img src="<?php echo base_url('uploads/system/logo-light.png'); ?>" alt="" height="26">
       </span>
       <span class="logo-sm">
         <img src="<?php echo base_url('uploads/system/logo-light-sm.png'); ?>" alt="" height="16">
       </span>
     </a>

     <!--- Sidemenu -->
     <ul class="metismenu side-nav">

        <li class="side-nav-item">
           <a href="<?php echo site_url('user/courses'); ?>" class="side-nav-link <?php if ($page_name == 'courses' || $page_name == 'course_add' || $page_name == 'course_edit')echo 'active';?>">
              <i class="dripicons-archive"></i>
              <span><?php echo get_phrase('courses'); ?></span>
           </a>
        </li>
        <li class="side-nav-item">
           <a href="<?php echo site_url('user/instructor_revenue'); ?>" class="side-nav-link <?php if ($page_name == 'report' || $page_name == 'invoice')echo 'active';?>">
              <i class="dripicons-media-shuffle"></i>
              <span><?php echo get_phrase('instructor_revenue'); ?></span>
           </a>
        </li>

        <li class="side-nav-item">
        <a href="javascript: void(0);" class="side-nav-link <?php if ($page_name == 'system_settings' || $page_name == 'frontend_settings' || $page_name == 'payment_settings' || $page_name == 'instructor_settings' || $page_name == 'smtp_settings' || $page_name == 'manage_language' ): ?> active <?php endif; ?>">
           <i class="dripicons-toggles"></i>
           <span> <?php echo get_phrase('settings'); ?> </span>
           <span class="menu-arrow"></span>
        </a>
        <ul class="side-nav-second-level" aria-expanded="false">
           <li class = "<?php if($page_name == 'payment_settings') echo 'active'; ?>">
              <a href="<?php echo site_url('user/payment_settings'); ?>"><?php echo get_phrase('payment_settings'); ?></a>
           </li>
        </ul>
     </li>

     </ul>
     <!-- End Sidebar -->
     <div class="clearfix"></div>
   </div>
   <!-- Sidebar -left -->
 </div>
 <!-- Left Sidebar End -->
