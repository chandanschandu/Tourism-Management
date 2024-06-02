<div class="container-fluid">
    <form action="" id="book-form">
        <div class="form-group">
            <input name="package_id" type="hidden"value="<?php echo $_GET['package_id'] ?>" >
            <label>name <input type="text" class='form form-control' placeholder="name on billing" name='name' > </label><br>
         <label> date   <input type="date" class='form form-control'    name='schedule' required></label><br>
         <label>adhar card number<input type="number"  maxlength="12" minlength="12" class='form form-control' placeholder="for id proof" name='adar' required></label> <br>
         <label>email<input type="email" type=""  class='form form-control' value="" placeholder="email" required></label>
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
                url:_base_url_+"classes/Master.php?f=book_tour",
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
                        alert_toast("Book Request Successfully sent.")
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