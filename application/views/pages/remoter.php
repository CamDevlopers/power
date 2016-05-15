<?php 
	$this->load->view('partial/header.php');
?>
<div class="container content-remoter">
	<div class="row">
		<?php 
			foreach ($equipments->result() as $equipment) {
		?>
		<div id="edivide_<?php echo $equipment->eid; ?>" class="box-remoter bg-black">
			<p><?php echo $equipment->ename; ?></p>
			<p><?php echo $equipment->eid; ?></p>
		</div>
		<?php	}
		?>
		<div class="box-remoter bg-black">
			<p>ម.ត្រជាក់</p>
			<p>29</p>
		</div>
		<div class="box-remoter bg-black">
			<p>ម.ត្រជាក់</p>
			<p>30</p>
		</div>
	</div>
	<p class="clearfix"></p>
	<input type="text" class="entry" id="lamp_entry" name="entry-remote">
</div>
<script type="text/javascript">
	$(document).ready(function(){
		//entry start 
        $("#lamp_entry").focus();
        $(document).on("click","body",function(){
            $('#lamp_entry').focus();
            $('#lamp_entry').val('');
        });

        var timer = 0;
        $(document).on("keyup","#lamp_entry",function(even){
        	event.preventDefault();
            if (timer) {
                clearTimeout(timer);
            }
            timer = setTimeout(after_press, 1500); 
        });

        function after_press(){
            var index_lamp = $("#lamp_entry").val();
            if(index_lamp.length>0){
                   if(index_lamp=='1'){
                        Update_on(2);
                   }else if(index_lamp=='2'){
                        Update_off(2);
                   }else if(index_lamp=='3'){
                        Update_on(3);
                   }else if(index_lamp=='4'){
                        Update_off(3);
                   }else if(index_lamp=='5'){
                        Update_on(5);
                   }else if(index_lamp=='6'){
                        Update_off(5);
                   }else if(index_lamp=='7'){
                        Update_on(6);
                   }else if(index_lamp=='8'){
                        Update_off(6);
                   }else if(index_lamp=='9'){
                        Update_on(8);
                   }else if(index_lamp=='10'){
                        Update_off(8);
                   }else if(index_lamp=='12'){
                        Update_on(9);
                   }else if(index_lamp=='13'){
                        Update_off(9);
                   }else if(index_lamp=='14'){
                        Update_on(11);
                   }else if(index_lamp=='15'){
                        Update_off(11);
                   }else if(index_lamp=='16'){
                        Update_on(12);
                   }else if(index_lamp=='17'){
                        Update_off(12);
                   }else if(index_lamp=='18'){
                        Update_on(14);
                   }else if(index_lamp=='19'){
                        Update_off(14);
                   }else if(index_lamp=='20'){
                        Update_on(15);
                   }else if(index_lamp=='21'){
                        Update_off(15);
                   }else if(index_lamp=='23'){
                        Update_on(17);
                   }else if(index_lamp=='24'){
                        Update_off(17);
                   }else if(index_lamp=='25'){
                        Update_on(18);
                   }else if(index_lamp=='26'){
                        Update_off(18);
                   }else if(index_lamp=='27'){
                        Update_on(20);
                   }else if(index_lamp=='28'){
                        Update_off(20);
                   }else if(index_lamp=='29'){
                        Update_on(21);
                   }else if(index_lamp=='30'){
                        Update_off(21);
                   }else if(index_lamp=='31'){
                        Update_on(22);
                   }else if(index_lamp=='32'){
                        Update_off(22);
                   }else if(index_lamp=='34'){
                        Update_on(23);
                   }else if(index_lamp=='35'){
                        Update_off(23);
                   }else if(index_lamp=='36'){
                        Update_on(25);
                   }else if(index_lamp=='37'){
                        Update_off(25);
                   }else if(index_lamp=='38'){
                        Update_on(26);
                   }else if(index_lamp=='39'){
                        Update_off(26);
                   }else if(index_lamp=='40'){
                        Update_on(27);
                   }else if(index_lamp=='41'){
                        Update_off(27);
                   }else if(index_lamp=='42'){
                        Update_on(28);
                   }else if(index_lamp=='43'){
                        Update_off(28);
                   }
                }
                $('#lamp_entry').focus();
                $('#lamp_entry').val('');
        }

        function Update_on(eid){
        	$.ajax({
        		url:'<?php echo base_url("manages/update_entry"); ?>',
        		type:'POST',
        		data:{
        			id:eid,
        			status:1
        		},
        		dataType:'json',
        		success:function(data){
        			if(data.status){
        				//alert(data.status);
        			}else{
        				$.notify(data.message,'error');
        			}
        		}
        	});
        }
         function Update_off(eid){
        	$.ajax({
        		url:'<?php echo base_url("manages/update_entry"); ?>',
        		type:'POST',
        		data:{
        			id:eid,
        			status:0
        		},
        		dataType:'json',
        		success:function(data){
        			if(data.status){
        				//alert(data.status);
        			}else{
        				$.notify(data.message,'error');
        			}
        		}
        	});
        }
  //entry end 
  
		setInterval(function(){ get_isremoter(); }, 100);
		function get_isremoter(){
			$.ajax({
				url:'<?php echo base_url("manages/get_remoter"); ?>',
				type:'post',
				dataType:'json',
				success:function(data){
					if(data.status){
						var tmp = data.message;
						var output = tmp.split(",");
						$('.box-remoter').removeClass('bg-white');
						$('.box-remoter').addClass('bg-black');
						$.each(output, function( i, val ) {
						  $('#edivide_'+val).removeClass('bg-black');
						  $('#edivide_'+val).addClass('bg-white');
						});
					}else{
						$('.box-remoter').removeClass('bg-white');
						$('.box-remoter').addClass('bg-black');
					}
				}
			});
		}
	});
</script>
<?php 
	$this->load->view('partial/footer.php');
?>