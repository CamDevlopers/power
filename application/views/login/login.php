<?php 
	$this->load->view('partial/header.php');
?>

<div class="container">
    <div class="card card-container">
        <img id="profile-img" class="image-login" src="<?php echo base_url('image/logo_AEU.png'); ?>" />
        <p id="profile-name" class="profile-name-card">ASIA EURO UNIVERSITY (AEU)

</p>

        <form id="signin" class="form-signin" action="<?php echo base_url('logins/check_account'); ?>" method="POST">
            <span id="reauth-email" class="reauth-email"></span>
            <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" value="<?php echo set_value('username'); ?>" autofocus>
            <span class="error"><?php echo form_error('username'); ?></span>
            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password">
            <span class="error"><?php echo form_error('password'); ?></span>
            <img id="loading" src="<?php echo base_url('image/loading.gif');?>" style="width: 98%; margin: 0 auto;"/>
            <button id="submit" class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
        </form>

        <a href="#" class="forgot-password">
            Forgot the password?
        </a>
    </div>
</div>

<script type="text/javascript">
    $('#loading').hide();
    $.validator.setDefaults({
        submitHandler: function() {

          $('#loading').show();
          $('#submit').hide();
           var username = $("#inputUsername").val();
           var pwd = $("#inputPassword").val();
           $.ajax({
                url:"<?php echo base_url('logins/check_account');?>",
                type:"POST",
                dataType:"json",
                data:{
                    "username":username,
                    "password":pwd
                },
                success:function(data){
                    if(data.status){
                        $.notify(data.message,'success');
                        setTimeout(function(){
                            $('#loading').hide();
                            $('#submit').show();
                            window.location.replace("<?php echo base_url('manages/remotes');?>");
                        }, 2000);
                    }else{
                        $.notify(data.message,'error');
                        $('#loading').hide();
                        $('#submit').show();
                    }
                }
           });
        }
    });
    $(document).ready(function(){
        $('#signin').validate({
            rules:{
                username:{
                    required:true
                },
                password:{
                    required:true,
                    minlength:5
                }

            },
            messages:{
                username:{
                    required:"The Username field is required!"
                },
                password:{
                    required:"The Password field is required!",
                    minlength:"The Password field must contain at least 5 character!"
                }
            }
        });
    });
</script>
<?php 
	$this->load->view('partial/footer.php');
?>