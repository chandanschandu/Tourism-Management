<section class="page-section">
    <div class="container">
    <div class="w-100 justify-content-between d-flex">
        <h4><b>billing Details</b></h4>
        <a href="./?page=my_account" class="btn btn btn-primary btn-flat"><div class="fa fa-angle-left"></div> Back to Booking List</a> 
    </div>
        <hr class="border-warning">
        <div class="col-md-6">
            <form action="" id="billing">
            <input type="hidden" name="id" value="<?php echo $_settings->userdata('id') ?>">
               
                <div class="form-group">
                    <label for="username" class="control-label">Username</label>
                    <input type="text" name="username" class="form-control form" value="<?php echo $_settings->userdata('username') ?>" required>
                </div><div class="form-group">
                    <label for="username" class="control-label">email</label>
                    <input type="text" name="email" class="form-control form" value="<?php echo $_settings->userdata('email') ?>" required>
                </div>
                <div class="form-group">
                    <label for="adress" class="control-label">adress</label>
                    <input type="text" name="adress" class="form-control form" value="" placeholder="(Enter value to change password)">
                </div>
                
                <div class="form-group">
                    <label for="number" class="control-label">mobile-number</label>
                    <input type="number" name="mnumber" class="form-control form" value="<?php echo $_settings->userdata('mnumber') ?>" placeholder="(Enter mobile number )">
                </div>
                <div class="form-group">
                    <label for="upi" class="control-label">UPI-ID</label>
                    <input type="upiidr" name="mnumber" class="form-control form" value="<?php echo $_settings->userdata('upiid') ?>" placeholder="(Enter UPI-ID )">
                </div>
                <!-- <div class="form-group"> -->
                    <!-- <label for="number" class="control-label">packge name</label> -->
                    <!-- <input type="text" name="packagid" class="form-control form" value=" " placeholder="package-name"> -->

                <!-- </div> -->
                
                
                  <button class="cls" style="color:black; backgound-color:yellow;">  <a href="qr.html" style=""> pay </a></button>
               
            </form>
        </div>
    </div>
</section>

<script>

</script>