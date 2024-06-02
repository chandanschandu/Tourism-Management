<div class="container-fluid">
    <form action="" id="book-form">
        <div class="form-group">
            <input name="vehicle_id" type="hidden"value="<?php echo $_GET['vehicle_id'] ?>" >
           
           
           <p style="color:red;"> please fill all the deatails below</p>
            <label>name<sup style="color:red";>*</sup> <input type="text" class='form form-control' placeholder="name on billing" name='name' > </label><br>
         <label>   from date   <input type="date" class='form form-control'    name='schedule1' required></label><br>
         <label>   to date   <input type="date" class='form form-control'    name='schedule2' required></label><br>
         <label>  number of days   <input type="number" class='form form-control'    name='schedule3' required></label><br>
         <p style="font-size:10px; opacity:0.5; color:red; ">  *booking will be in action from 00:00 am </p>
         <label>adhar card number<input type="number" minlength="12" maxlength="12"  class='form form-control' placeholder="for id proof" name='adar' required></label> <br>
         <label>email<input type="email"  name='email' type=""  class='form form-control' value="" placeholder="email" required></label>
         
          <label>number of peoples:<input type="number" class="form form-control"  name='howmany' placeholder="number of peoples" required></label> 
          
        </div>
    </form>
</div>
<script>
    $(function(){
        $('#book-form').submit(function(e){
            e.preventDefault();
            start_loader()
            $.ajax({
                url:_base_url_+"classes/Master.php?f=book_vehicle",
                method:"POST",
                data:$(this).serialize(),
                dataType:"json",
                error:err=>{
                    console.log(err)
                    alert_toast("an error occured",'error')
                    end_loader()
                },
                success:function(resp){
                    if(typeof resp == 'object' && resp.status == 'success'){
                        alert_toast("vehicle book Request Successfully sent.")
                        $('.modal').modal('hide')
                    }else{
                        console.log(resp)
                        alert_toast("an error occured",'error')
                    }
                    end_loader()
                }
            })
        })
    })
</script>