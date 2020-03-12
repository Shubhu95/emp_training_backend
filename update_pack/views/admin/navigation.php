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

      <li class="side-nav-item <?php if ($page_name == 'dashboard')echo 'active';?>">
				<a href="<?php echo site_url('admin/dashboard'); ?>" class="side-nav-link">
					<i class="dripicons-view-apps"></i>
					<span><?php echo get_phrase('dashboard'); ?></span>
				</a>
			</li>

      <li class="side-nav-item <?php if ($page_name == 'categories' || $page_name == 'category_add' || $page_name == 'category_edit' ): ?> active <?php endif; ?>">
				<a href="javascript: void(0);" class="side-nav-link <?php if ($page_name == 'categories' || $page_name == 'category_add' || $page_name == 'category_edit' ): ?> active <?php endif; ?>">
					<i class="dripicons-network-1"></i>
					<span> <?php echo get_phrase('categories'); ?> </span>
					<span class="menu-arrow"></span>
				</a>
				<ul class="side-nav-second-level" aria-expanded="false">
					<li class = "<?php if($page_name == 'categories' || $page_name == 'category_edit') echo 'active'; ?>">
						<a href="<?php echo site_url('admin/categories'); ?>"><?php echo get_phrase('categories'); ?></a>
					</li>

					<li class = "<?php if($page_name == 'category_add') echo 'active'; ?>">
						<a href="<?php echo site_url('admin/category_form/add_category'); ?>"><?php echo get_phrase('add_new_category'); ?></a>
					</li>
				</ul>
			</li>

      <li class="side-nav-item">
				<a href="<?php echo site_url('admin/courses'); ?>" class="side-nav-link <?php if ($page_name == 'courses' || $page_name == 'course_add' || $page_name == 'course_edit')echo 'active';?>">
					<i class="dripicons-archive"></i>
					<span><?php echo get_phrase('courses'); ?></span>
				</a>
			</li>
			<li class="side-nav-item">
				<a href="<?php echo site_url('admin/users'); ?>" class="side-nav-link <?php if ($page_name == 'users' || $page_name == 'user_add' || $page_name == 'user_edit')echo 'active';?>">
					<i class="dripicons-user-group"></i>
					<span><?php echo get_phrase('students'); ?></span>
				</a>
			</li>

			<li class="side-nav-item <?php if ($page_name == 'enrol_history' || $page_name == 'enrol_student'): ?> active <?php endif; ?>">
				<a href="javascript: void(0);" class="side-nav-link <?php if ($page_name == 'enrol_history' || $page_name == 'enrol_student'): ?> active <?php endif; ?>">
					<i class="dripicons-network-3"></i>
					<span> <?php echo get_phrase('enrolment'); ?> </span>
					<span class="menu-arrow"></span>
				</a>
				<ul class="side-nav-second-level" aria-expanded="false">
					<li class = "<?php if($page_name == 'enrol_history') echo 'active'; ?>">
						<a href="<?php echo site_url('admin/enrol_history'); ?>"><?php echo get_phrase('enrol_history'); ?></a>
					</li>

					<li class = "<?php if($page_name == 'enrol_student') echo 'active'; ?>">
						<a href="<?php echo site_url('admin/enrol_student'); ?>"><?php echo get_phrase('enrol_a_student'); ?></a>
					</li>
				</ul>
			</li>

			<li class="side-nav-item">
				<a href="javascript: void(0);" class="side-nav-link <?php if ($page_name == 'admin_revenue' || $page_name == 'instructor_revenue' || $page_name == 'invoice'): ?> active <?php endif; ?>">
					<i class="dripicons-box"></i>
					<span> <?php echo get_phrase('report'); ?> </span>
					<span class="menu-arrow"></span>
				</a>
				<ul class="side-nav-second-level" aria-expanded="false">
					<li class = "<?php if($page_name == 'admin_revenue') echo 'active'; ?>" > <a href="<?php echo site_url('admin/admin_revenue'); ?>"><?php echo get_phrase('admin_revenue'); ?></a> </li>
					<?php if (get_settings('allow_instructor') == 1): ?>
							<li class = "<?php if($page_name == 'instructor_revenue') echo 'active'; ?>" >
									<a href="<?php echo site_url('admin/instructor_revenue'); ?>">
											<?php echo get_phrase('instructor_revenue');?> <span class = "badge badge-danger badge-pill"><?php echo $this->db->get_where('payment', array('instructor_payment_status' => 0))->num_rows() ?></span>
									</a>
							</li>
					<?php endif; ?>
				</ul>
			</li>

			<li class="side-nav-item">
				<a href="<?php echo site_url('admin/message'); ?>" class="side-nav-link <?php if ($page_name == 'message' || $page_name == 'message_new' || $page_name == 'message_read')echo 'active';?>">
					<i class="dripicons-message"></i>
					<span><?php echo get_phrase('message'); ?></span>
				</a>
			</li>

			<li class="side-nav-item  <?php if ($page_name == 'system_settings' || $page_name == 'frontend_settings' || $page_name == 'payment_settings' || $page_name == 'instructor_settings' || $page_name == 'smtp_settings' || $page_name == 'manage_language' || $page_name == 'about' || $page_name == 'themes' || $page_name == 'mobile_app' ): ?> active <?php endif; ?>">
			<a href="javascript: void(0);" class="side-nav-link">
				<i class="dripicons-toggles"></i>
				<span> <?php echo get_phrase('settings'); ?> </span>
				<span class="menu-arrow"></span>
			</a>
			<ul class="side-nav-second-level" aria-expanded="false">
				<li class = "<?php if($page_name == 'system_settings') echo 'active'; ?>">
					<a href="<?php echo site_url('admin/system_settings'); ?>"><?php echo get_phrase('system_settings'); ?></a>
				</li>
				<li class = "<?php if($page_name == 'frontend_settings') echo 'active'; ?>">
					<a href="<?php echo site_url('admin/frontend_settings'); ?>"><?php echo get_phrase('website_settings'); ?></a>
				</li>
				<li class = "<?php if($page_name == 'payment_settings') echo 'active'; ?>">
					<a href="<?php echo site_url('admin/payment_settings'); ?>"><?php echo get_phrase('payment_settings'); ?></a>
				</li>
				<li class = "<?php if($page_name == 'instructor_settings') echo 'active'; ?>">
					<a href="<?php echo site_url('admin/instructor_settings'); ?>"><?php echo get_phrase('instructor_settings'); ?></a>
				</li>
				<li class = "<?php if($page_name == 'manage_language') echo 'active'; ?>">
					<a href="<?php echo site_url('admin/manage_language'); ?>"><?php echo get_phrase('language_settings'); ?></a>
				</li>
				<li class = "<?php if($page_name == 'smtp_settings') echo 'active'; ?>">
					<a href="<?php echo site_url('admin/smtp_settings'); ?>"><?php echo get_phrase('smtp_settings'); ?></a>
				</li>
				<li class = "<?php if($page_name == 'theme_settings') echo 'active'; ?>">
					<a href="<?php echo site_url('admin/theme_settings'); ?>"><?php echo get_phrase('theme_settings'); ?></a>
				</li>
				<li class = "<?php if($page_name == 'about') echo 'active'; ?>">
					<a href="<?php echo site_url('admin/about'); ?>"><?php echo get_phrase('about'); ?></a>
				</li>
				<li class = "<?php if($page_name == 'mobile_app') echo 'active'; ?>">
					<a href="<?php echo site_url('admin/mobile_app'); ?>"><?php echo get_phrase('mobile_app'); ?></a>
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
