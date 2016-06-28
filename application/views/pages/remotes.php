<?php 
	$this->load->view('partial/header.php');
?>
<nav class="navbar bg-blue navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
         <a class="navbar-brand title-header" href="<?php echo base_url('manages/remotes'); ?>">
            <i class="glyphicon glyphicon-off"></i> កម្មវិធីបិទបើកភ្លើងតាមអុីុនធឺណែត
         </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li>
              <a title="Manage Profile" class="nav-white" href="<?php echo base_url('logins/profile/'.$this->session->userdata('uid')); ?>"><i class="glyphicon glyphicon-user"></i></a>
            </li>
            <li>
              <a title="Go to Remoter" target="_blank" class="nav-white" href="<?php echo base_url('manages/remoter'); ?>"><i class="glyphicon glyphicon-th"></i></a>
            </li>
            <li>
              <a title="Sign me out" class="nav-white" href="<?php echo base_url('logins/sign_out'); ?>"><i class="glyphicon glyphicon-log-in"></i></a>
            </li>
        </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<div class="container content">
	<?php 
    foreach ($floors->result() as $floor) {
  ?>
  <p class="clearfix"></p>
  <h3 class="floor-name"><?php echo $floor->fname; ?></h3>
      <?php  
        $rooms = $this->Manage->get_room_by_floor_id($floor->fid);
        foreach ($rooms->result() as $room) {
      ?>
      <p class="clearfix"></p>
        <h4 class="room-name"><?php echo $room->rname; ?></h4>
         <div class="row">
        <?php 
          $equipments = $this->Manage->get_all_equipments_by_room_id($room->rid);
          foreach ($equipments->result() as $equipment) {
        ?>
         
            <div class="box">
              <div class="contac">
                  <a id="on_<?php echo $equipment->eid; ?>" stype="<?php echo $equipment->etype; ?>" sid="<?php echo $equipment->eid; ?>" href="#" class="btn-on switch <?php echo $equipment->eremote?'btn-disable':'btn-active'; ?>">​បើក</a>
                  <p class="clearfix"></p>
                  <img id="contac_<?php echo $equipment->eid; ?>" class="switch_contac" src="<?php echo $equipment->eremote?base_url('image/img_on.png'):base_url('image/img_off.png'); ?>"/>
                   <p class="clearfix"></p>
                  <a id="off_<?php echo $equipment->eid; ?>" stype="<?php echo $equipment->etype; ?>" sid="<?php echo $equipment->eid; ?>" href="#" class="btn-off switch <?php echo $equipment->eremote?'btn-active':'btn-disable'; ?>">បិទ</a>
              </div>
              <div class="equipment">
                <b><?php echo $room->rname; ?></b>
                <p style="color: #E65100;"><?php echo $equipment->eid; ?></p>
                <?php 
                    if($equipment->etype==1){
                ?>
                       
                       <img id="e_device_<?php echo $equipment->eid; ?>" imgid="<?php echo $equipment->eid; ?>" class='equipment_device' src="<?php echo $equipment->eremote?base_url('image/lamp_on.png'):base_url('image/lamp_off.png'); ?>"/>

                <?php    }else{
                 ?>
                 <br/>
                      <img id="e_device_air<?php echo $equipment->eid; ?>" imgid="<?php echo $equipment->eid; ?>" class='equipment_device for-air' src="<?php echo $equipment->eremote?base_url('image/air_on.png'):base_url('image/air_off.png'); ?>"/>
                       <br/> <br/>

                 <?php } ?>
                  
                  <p><?php echo $equipment->ename; ?></p>
              </div>
            </div>
          
      <?php 
        }
      ?>
      </div>
      <?php 
      }
      ?>
     
  <?php 
    } 
  ?>
</div>
<script type="text/javascript">
  $(document).ready(function(){
      $(document).on('click','.btn-on',function(e){
          e.preventDefault();
          var type = $(this).attr('stype');
          var id = $(this).attr('sid');
          if(type==1){
            update_lamp(1, id);
          }else{
            update_air(1, id);
          }
      });

      $(document).on('click','.btn-off',function(e){
          e.preventDefault();
          var type = $(this).attr('stype');
          var id = $(this).attr('sid');
          if(type==1){
            update_lamp(0, id);
          }else{
            update_air(0, id);
          }
      });


      function update_air(estatus, eid){
          $.ajax({
            url:"<?php echo base_url('manages/update_air');?>",
            data:{
              status:estatus,
              id:eid
            },
            type:"POST",
            dataType:"json",
            success:function(data){
               if(data.status){
                  setTimeout(function(){
                    off_air(eid);
                  },1500);
               }else{
                  $.notify(data.message,'error');
               }
            }
          });
      }

      function off_air(eid){
          $.ajax({
            url:"<?php echo base_url('manages/air_off');?>",
            data:{
              id:eid
            },
            type:"POST",
            dataType:"json",
            success:function(data){
               if(data.status){
                  // alert('update vinh herx');
               }else{
                  $.notify(data.message,'error');
               }
            }
          });
      }

      function update_lamp(estatus, eid){
          $.ajax({
            url:"<?php echo base_url('manages/update_lamp');?>",
            data:{
              status:estatus,
              id:eid
            },
            type:"POST",
            dataType:"json",
            success:function(data){
               if(data.status){
                  if(estatus==1){
                    $('#on_'+eid).removeClass('btn-active');
                    $('#on_'+eid).addClass('btn-disable');
                    $('#off_'+eid).removeClass('btn-disable');
                    $('#off_'+eid).addClass('btn-active');
                    $('#contac_'+eid).attr('src','<?php echo base_url('image/img_on.png'); ?>');
                    $('#e_device_'+eid).attr('src','<?php echo base_url('image/lamp_on.png'); ?>'); 
                  }else{
                    $('#off_'+eid).removeClass('btn-active');
                    $('#off_'+eid).addClass('btn-disable');
                    $('#on_'+eid).removeClass('btn-disable');
                    $('#on_'+eid).addClass('btn-active');
                    $('#contac_'+eid).attr('src','<?php echo base_url('image/img_off.png'); ?>');
                    $('#e_device_'+eid).attr('src','<?php echo base_url('image/lamp_off.png'); ?>'); 
                  }
               }else{
                  $.notify(data.message,'error');
               }
            }
          });
      }

      setInterval(function(){ get_isremote(); }, 100);
      function get_isremote(){
        $.ajax({
          url:'<?php echo base_url("manages/get_remote"); ?>',
          type:'post',
          dataType:'json',
          success:function(data){
            if(data.status){
              var tmp = data.message;
              var output = tmp.split(",");
                $('.btn-off').removeClass('btn-active');
                $('.btn-off').addClass('btn-disable');
                $('.btn-on').removeClass('btn-disable');
                $('.btn-on').addClass('btn-active');
                $('.switch_contac').attr('src','<?php echo base_url('image/img_off.png'); ?>');
                $('.for-air').attr('src','<?php echo base_url('image/air_off.png'); ?>');
              $.each(output, function( i, val ) {
                $('#on_'+val).removeClass('btn-active');
                $('#on_'+val).addClass('btn-disable');
                $('#off_'+val).removeClass('btn-disable');
                $('#off_'+val).addClass('btn-active');
                $('#contac_'+val).attr('src','<?php echo base_url('image/img_on.png'); ?>');
                $('#e_device_air'+val).attr('src','<?php echo base_url('image/air_on.png'); ?>'); 
              });
            }else{
              $('.btn-off').removeClass('btn-active');
              $('.btn-off').addClass('btn-disable');
              $('.btn-on').removeClass('btn-disable');
              $('.btn-on').addClass('btn-active');
              $('.switch_contac').attr('src','<?php echo base_url('image/img_off.png'); ?>');
              $('.for-air').attr('src','<?php echo base_url('image/air_off.png'); ?>');
            }
          }
        });
      }

  });
</script>
<?php 
	$this->load->view('partial/footer.php');
?>