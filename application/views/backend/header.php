<div class="navbar-custom mb-3">
  <ul class="list-unstyled topbar-right-menu float-right mb-0">

        <li class="dropdown notification-list">
          <a class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-toggle="dropdown" id="topbar-userdrop"
          href="#" role="button" aria-haspopup="true" aria-expanded="false">
          <span class="account-user-avatar">
            <img src="<?php echo $this->user_model->get_user_image_url($this->session->userdata('user_id')); ?>" alt="user-image" class="rounded-circle">
          </span>
          <span>
            <?php
            $logged_in_user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();;
            ?>
            <span class="account-user-name mt-1"><?php echo $logged_in_user_details['first_name'].' '.$logged_in_user_details['last_name'];?> ( <?php echo strtolower($this->session->userdata('role')) == 'user' ? get_phrase('instructor') : get_phrase('admin'); ?> )</span>
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu profile-dropdown">

          <!-- Account -->
          <a href="<?php echo site_url(strtolower($this->session->userdata('role')).'/manage_profile'); ?>" class="dropdown-item notify-item">
            <i class="mdi mdi-account-circle mr-1"></i>
            <span><?php echo get_phrase('my_account'); ?></span>
          </a>

          <?php if (strtolower($this->session->userdata('role')) == 'admin'): ?>
            <!-- settings-->
            <a href="<?php echo site_url('admin/system_settings'); ?>" class="dropdown-item notify-item">
              <i class="mdi mdi-settings mr-1"></i>
              <span><?php echo get_phrase('settings'); ?></span>
            </a>

          <?php endif; ?>


          <!-- Logout-->
          <a href="<?php echo site_url('login/logout'); ?>" class="dropdown-item notify-item">
            <i class="mdi mdi-logout mr-1"></i>
            <span><?php echo get_phrase('logout'); ?></span>
          </a>
        </div>
      </li>

    </ul>
    <button class="button-menu-mobile open-left disable-btn">
      <i class="mdi mdi-menu"></i>
    </button>

    <div class="visit_website">
      <h4 style="float: left;"> <?php echo $this->db->get_where('settings' , array('key'=>'system_name'))->row()->value; ?></h4>
      <a href="<?php echo site_url('home'); ?>" target="" class="btn btn-success ml-3"><?php echo get_phrase('visit_website'); ?></a>
    </div>
  </div>
