<?php
$activeurl1= $this->uri->segment(1);
$activeurl2= $this->uri->segment(2);
$activeurl3= $this->uri->segment(3);
$activeurl=$activeurl1."/".$activeurl2."/".$activeurl3;
//echo $activeurl;
?>
<div class="col-md-12">

<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url();?>" ><span class="glyphicon glyphicon-home" aria-hidden="true"></span> </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="  <?php echo (isset($active) && $active=='overview')? "active":""?>"><a href="<?php echo base_url();?>overview"><?=lang('menu_overview')?></a></li>
        <li class="  <?php echo (isset($active) && $active=='geo_coverage')? "active":""?>"><a href="<?php echo base_url();?>geo_coverage"><?=lang('menu_geo_coverage')?></a></li>
        
        
        <li class="  <?php echo (isset($active) && $active=='about_us')? "active":""?>"><a href="<?php echo base_url();?>about_us"><?=lang('menu_about_us')?></a></li> 
        <li class="  <?php echo (isset($active) && $active=='contact_us')? "active":""?>"><a href="<?php echo base_url();?>contact_us"><?=lang('menu_contact_us')?></a></li>
        <li class="  <?php echo (isset($active) && $active=='gallery')? "active":""?>"><a href="<?php echo base_url();?>gallery"><?=lang('menu_photo_gallery')?></a></li> 
        
		<?php if ($this->authentication->is_signed_in()) : ?>
        <li <?php echo $activeurl=='dashboard//'?' class="active"':'' ?>><a href="./dashboard"><?=lang('menu_dashboard')?></a></li>       
        <?php endif; ?>  
        
      </ul>
     <ul class="nav navbar-nav">
            <!--<li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>-->
            
            <li class="dropdown">
              
           
           	 <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        	<span class="glyphicon glyphicon-font" aria-hidden="true"></span> <?php 
							if($this->session->userdata('site_lang'))
							echo ucfirst($this->session->userdata('site_lang'));
							else
							echo "English";							
							?> <b class="caret"></b></a>

                        <ul class="dropdown-menu" role="menu">
                        <li><?php echo anchor('langswitch/switchLanguage/english', 'English'); ?></li>
						<li><?php echo anchor('langswitch/switchLanguage/bangla', 'Bangla'); ?></li>
             </ul>
           
           
            </li>
            
            
          </ul> 
     <ul class="nav navbar-nav navbar-right">
           <!-- <li><a href="../navbar/">Default</a></li>
            <li><a href="../navbar-static-top/">Static top</a></li>
            <li class="active"><a href="./">Fixed top <span class="sr-only">(current)</span></a></li>-->
            
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<?php if ($this->authentication->is_signed_in()) : ?>
                        	<span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
							<?php 
							echo $account->username; 
			
							$all_user_role=$this->site_model->get_all_user_role($account->id);
							echo "(";
							foreach ($all_user_role as $user_role) :
								echo $this->site_model->get_role_name_by_id($user_role->role_id).' ';
							endforeach; 
            				echo ")";
							
							?> <b class="caret"></b></a>
						<?php else : ?>
                        	<span class="glyphicon glyphicon-user" aria-hidden="true"></span> <b class="caret"></b></a>
						<?php endif; ?>

                        <ul class="dropdown-menu" role="menu">
							<?php if ($this->authentication->is_signed_in()) : ?>
                                <li class="dropdown-header">Account Info</li>
								<li><?php echo anchor('account/account_profile', lang('website_profile')); ?></li>
								<li><?php echo anchor('account/account_settings', lang('website_account')); ?></li>
								<?php if ($account->password) : ?>
									<li><?php echo anchor('account/account_password', lang('website_password')); ?></li>
								<?php endif; ?>
								<!--<li><?php //echo anchor('account/account_linked', lang('website_linked')); ?></li>-->    
                                <?php if ($this->authorization->is_permitted( array('retrieve_users', 'retrieve_roles', 'retrieve_permissions') )) : ?>
                                    <li class="divider"></li>
                                    <li class="dropdown-header">Admin Panel</li>
                                    <?php if ($this->authorization->is_permitted('retrieve_users')) : ?>
                                        <li><?php echo anchor('account/manage_users', lang('website_manage_users')); ?></li>
                                    <?php endif; ?>

                                    <?php if ($this->authorization->is_permitted('retrieve_roles')) : ?>
                                        <li><?php echo anchor('account/manage_roles', lang('website_manage_roles')); ?></li>
                                    <?php endif; ?>

                                    <?php if ($this->authorization->is_permitted('retrieve_permissions')) : ?>
                                        <li><?php echo anchor('account/manage_permissions', lang('website_manage_permissions')); ?></li>
                                    <?php endif; ?>
                                <?php endif; ?>

								<li class="divider"></li>
								<li><?php echo anchor('account/sign_out', lang('website_sign_out')); ?></li>
							<?php else : ?>
								<li><?php echo anchor('account/sign_in', lang('website_sign_in')); ?></li>
							<?php endif; ?>

                        </ul>
                    </li>

            
            
          </ul> 
    <?php
    if ($this->authentication->is_signed_in()):
    ?>
     <form class="navbar-form navbar-right" role="search" id="search-form"  name="search-form" action="./dashboard/patient_barcode_search" method="post">
             
     <div class="input-group">                 
        <input type="text" class="form-control input-sm" name="search_param" placeholder="<?=lang('website_search_term')?>" value="<?=set_value('search_param')?>">
        <span class="input-group-btn">
            <button class="btn btn-default btn-sm" type="submit"><span class="glyphicon glyphicon-search"></span></button>
        </span>
     </div>            
    </form>
    <?php
    endif;
    ?>        
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  
  
  
  
</nav>



</div> <!-- col-md-12 -->
            
            