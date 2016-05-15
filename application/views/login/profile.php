<?php 
	$this->load->view('partial/header.php');
?>
<div class="container">
    <div class="card card-container">
        <p id="profile-name" class="profile-name-card">Update Your Profile</p>

        <form id="profile" class="form-signin" action="<?php echo base_url('logins/update_profile/'.$this->session->userdata('uid')); ?>" method="POST">

            <span id="reauth-email" class="reauth-email"></span>
            <label>Fullname* </label>
            <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Your name" value="<?php echo set_value('fullname')?set_value('fullname'):$profile->uname; ?>" autofocus>
            <span class="error"><?php echo form_error('fullname'); ?></span>

            <label>Username*</label>
            <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="<?php echo set_value('username')?set_value('username'):$profile->uauthename; ?>">
            <span class="error"><?php echo form_error('username'); ?></span>

            <label>Old Password*</label>
            <input type="password" id="old_pass" name="old_pass" class="form-control" placeholder="Old Password">
            <span class="error"><?php echo form_error('old_pass'); ?></span>

            <label>New Password*</label>
            <input type="password" id="new_pass" name="new_pass" class="form-control" placeholder="New Password">
            <span class="error"><?php echo form_error('new_pass'); ?></span>

            <label>Confirm Password*</label>
            <input type="password" id="con_pass" name="con_pass" class="form-control" placeholder="Confirm Password">
            <span class="error"><?php echo form_error('con_pass'); ?></span>

            <!-- <img id="loading" src="<?php echo base_url('image/loading.gif');?>" style="width: 98%; margin: 0 auto;"/> -->

            <button id="submit" class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Update now</button>
            <center><a class="btn-warning btn" href="<?php echo base_url('manages'); ?>">Go back</a></center>
        </form>
    </div>
</div>

<?php 
if($save!=''){
?>
<script type="text/javascript">
	$.notify('<?php echo $save; ?>','success');
</script>
<?
}
	$this->load->view('partial/footer.php');
?>