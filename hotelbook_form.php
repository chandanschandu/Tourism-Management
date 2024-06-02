<div class="container-fluid">
    <form action="" id="book-form">
        <div class="form-group">
            <input name="hotel_id" type="hidden" value="<?php echo $_GET['hotel_id'] ?>">
            
           
            <label>name <input type="text" class='form form-control' placeholder="name on billing" name='name' > </label><br>
         <label>   from date   <input type="date" class='form form-control'    name='schedule1' required></label><br>
         <label>   to date   <input type="date" class='form form-control'    name='schedule2' required></label><br>
         <label>  number of days   <input type="number" class='form form-control'    name='schedule3' required></label><br>
         <p style="font-size:10px; opacity:0.5; color:red; ">  *booking will be action after chek-in hotel </p>
         <label>adhar card number<input type="number"  minlength="12" maxlength="12" class='form form-control' placeholder="for id proof" name='adar' required></label> <br>
         <label>email<input type="email" type=""  class='form form-control' value="" placeholder="email" name='email' required></label>
           
          <label>number of peoples:<input type="number" class="form form-control"  name='howmany1' placeholder="number of peoples" required></label> 
          <label>number of rooms:<input type="number" class="form form-control"  name='howmany2' placeholder="number of peoples" required></label> 
          
          
         </div>
    </form>
</div>
<script>
    $(function(){
        $('#book-form').submit(function(e){
            e.preventDefault();
            start_loader()
            $.ajax({
                url:_base_url_+"classes/Master.php?f=book_hotel",
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
                        alert_toast(" hotelBook Request Successfully sent.")
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