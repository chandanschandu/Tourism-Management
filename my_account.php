    
</section>
<section class="page-section">
    <div class="container">
    <div class="w-100 justify-content-between d-flex">
        <h4><b>Booked Packages</b></h4>
        <a href="./?page=edit_account" class="btn btn btn-primary btn-flat"><div class="fa fa-user-cog"></div> Manage Account</a>
    </div>
        <hr class="border-warning">
        <table class="table table-stripped text-dark">
            <colgroup>
                <col width="5%">
                <col width="10">
                <col width="25">
                <col width="25">
                <col width="15">
                <col width="10">
            </colgroup>
            <thead>
                <tr>
                    <th>#</th>
                    <th>DateTime</th>
                    <th>Package</th>
                    <th>Schedule</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>payment</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i=1;
                    $qry = $conn->query("SELECT b.*,p.title FROM book_list b inner join `packages` p on p.id = b.package_id where b.user_id ='".$_settings->userdata('id')."' order by date(b.date_created) desc ");
                    while($row= $qry->fetch_assoc()):
                        $review = $conn->query("SELECT * FROM `rate_review` where package_id='{$row['id']}' and user_id = ".$_settings->userdata('id'))->num_rows;
                ?>
                    <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo date("d-m-Y H:i",strtotime($row['date_created'])) ?></td>
                        <td><?php echo $row['title'] ?></td>
                        <td><?php echo date("d-m-Y",strtotime($row['schedule'])) ?></td>
                        <td class="text-center">
                            <?php if($row['status'] == 0): ?>
                                <span class="badge badge-warning">Pending</span>
                            <?php elseif($row['status'] == 1): ?>
                                <span class="badge badge-primary">Confirmed</span>
                            <?php elseif($row['status'] == 2): ?>
                                <span class="badge badge-danger">Cancelled</span>
                            <?php elseif($row['status'] == 3): ?>
                                <span class="badge badge-success">Done</span>
                            <?php endif; ?>
                        </td>
                        <td text-align="center">
                                <button type="button" class="btn btn-flat btn-default border btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    Action
                                <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Edit</a>
                                <?php if($row['status'] == 3 && $review <= 0): ?>
                                    <a class="dropdown-item submit_review" href="javascript:void(0)" data-id="<?php echo $row['package_id'] ?>">Submit Review</a>
                                <?php endif; ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item cancel_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Cancel</a>
                                </div>
                        </td>
                        <td text-align="center">
                                <button type="button" class="btn btn-flat btn-default border btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    payment
                                <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item edit_data" href="./?page=payment" data-id="<?php echo $row['id'] ?>">make payment</a>
                                <?php if($row['status'] == 3 && $review <= 0): ?>
                                    <a class="dropdown-item submit_review" href="javascript:void(0)" data-id="<?php echo $row['package_id'] ?>">Submit Review</a>
                                <?php endif; ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item cancel_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Cancel</a>
                                </div>
                        </td>
                        
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</section>
<script>
    function cancel_book($id){
        start_loader()
        $.ajax({
            url:_base_url_+"classes/Master.php?f=update_book_status",
            method:"POST",
            data:{id:$id,status:2},
            dataType:"json",
            error:err=>{
                console.log(err)
                alert_toast("an error occured",'error')
                end_loader()
            },
            success:function(resp){
                if(typeof resp == 'object' && resp.status == 'success'){
                    alert_toast("Book cancelled successfully",'success')
                    setTimeout(function(){
                        location.reload()
                    },2000)
                }else{
                    console.log(resp)
                    alert_toast("an error occured",'error')
                }
                end_loader()
            }
        })
    }
    $(function(){
        $('.cancel_data').click(function(){
            _conf("Are you sure to cancel this booking?","cancel_book",[$(this).data('id')])
        })
        $('.submit_review').click(function(){
            uni_modal("Rate & Feedback","./rate_review.php?id="+$(this).data('id'),'mid-large')
        })
        $('table').dataTable();
    })
</script>
    
</section>
<section class="page-section">
    <div class="container">
    <div class="w-100 justify-content-between d-flex">
        <h4><b>Booked hotels</b></h4>
       
    </div>
        <hr class="border-warning">
        <table class="table table-stripped text-dark">
            <colgroup>
                <col width="5%">
                <col width="10">
                <col width="25">
                <col width="25">
                <col width="15">
                <col width="10">
            </colgroup>
            <thead>
                <tr>
                    <th>#</th>
                    <th>DateTime</th>
                    <th>hotel</th>
                    <th>from</th>
                    <th>till</th>
                    <th>peoples</th>
                    <th>rooms</th>
                    
                    <th>Status</th>
                    <th>Action</th>
                    <th>payment</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i=1;
                    $qry = $conn->query("SELECT b.*,p.title FROM hotelbook_list b inner join `hotels` p on p.id = b.hotel_id where b.user_id ='".$_settings->userdata('id')."' order by date(b.date_created) desc ");
                    while($row= $qry->fetch_assoc()):
                        $review = $conn->query("SELECT * FROM `rate_review1` where hotel_id='{$row['id']}' and user_id = ".$_settings->userdata('id'))->num_rows;
                ?>
                    <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo date("d-m-Y H:i",strtotime($row['date_created'])) ?></td>
                        <td><?php echo $row['title'] ?></td>
                        <td><?php echo date("d-m-Y",strtotime($row['schedule1'])) ?></td>
                        <td><?php echo date("d-m-Y",strtotime($row['schedule2'])) ?></td>
                        <td><?php echo $row['howmany1'] ?></td>
                        <td><?php echo $row['howmany2'] ?></td>
                       
                        <td class="text-center">
                            <?php if($row['status'] == 0): ?>
                                <span class="badge badge-warning">Pending</span>
                            <?php elseif($row['status'] == 1): ?>
                                <span class="badge badge-primary">Confirmed</span>
                            <?php elseif($row['status'] == 2): ?>
                                <span class="badge badge-danger">Cancelled</span>
                            <?php elseif($row['status'] == 3): ?>
                                <span class="badge badge-success">Done</span>
                            <?php endif; ?>
                        </td>
                        <td text-align="center">
                                <button type="button" class="btn btn-flat btn-default border btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    Action
                                <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Edit</a>
                                <?php if($row['status'] == 3 && $review <= 0): ?>
                                    <a class="dropdown-item submit_review" href="javascript:void(0)" data-id="<?php echo $row['hotel_id'] ?>">Submit Review</a>
                                <?php endif; ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item cancel_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Cancel</a>
                                </div>
                        </td>
                        <td text-align="center">
                                <button type="button" class="btn btn-flat btn-default border btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    payment
                                <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item edit_data" href="./?page=payment" data-id="<?php echo $row['id'] ?>">make-payment</a>
                                <?php if($row['status'] == 3 && $review <= 0): ?>
                                    <a class="dropdown-item submit_review" href="javascript:void(0)" data-id="<?php echo $row['hotel_id'] ?>">Submit Review</a>
                                <?php endif; ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item cancel_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Cancel</a>
                                </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</section>
<script>
    function cancel_book($id){
        start_loader()
        $.ajax({
            url:_base_url_+"classes/Master.php?f=update_hotelbook_status",
            method:"POST",
            data:{id:$id,status:2},
            dataType:"json",
            error:err=>{
                console.log(err)
                alert_toast("an error occured",'error')
                end_loader()
            },
            success:function(resp){
                if(typeof resp == 'object' && resp.status == 'success'){
                    alert_toast("Book cancelled successfully",'success')
                    setTimeout(function(){
                        location.reload()
                    },2000)
                }else{
                    console.log(resp)
                    alert_toast("an error occured",'error')
                }
                end_loader()
            }
        })
    }
    $(function(){
        $('.cancel_data').click(function(){
            _conf("Are you sure to cancel this booking?","cancel_book",[$(this).data('id')])
        })
        $('.submit_review').click(function(){
            uni_modal("Rate & Feedback","./rate_review.php?id="+$(this).data('id'),'mid-large')
        })
        $('table').dataTable();
    })
</script>
<!-- vehicle book-->
<section class="page-section">
    <div class="container">
    <div class="w-100 justify-content-between d-flex">
        <h4><b>Booked vehicles</b></h4>
       
    </div>
        <hr class="border-warning">
        <table class="table table-stripped text-dark">
            <colgroup>
                <col width="5%">
                <col width="10">
                <col width="25">
                <col width="25">
                <col width="15">
                <col width="10">
            </colgroup>
            <thead>
                <tr>
                    <th>#</th>
                    <th>DateTime</th>
                    <th>vehicle</th>
                    <th>from</th>
                    <th>till</th>
                    
                    <th>Status</th>
                    <th>Action</th>
                    <th>payment</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i=1;
                    $qry = $conn->query("SELECT b.*,p.title FROM vehiclebook_list b inner join `vehicles` p on p.id = b.vehicle_id where b.user_id ='".$_settings->userdata('id')."' order by date(b.date_created) desc ");
                    while($row= $qry->fetch_assoc()):
                        $review = $conn->query("SELECT * FROM `rate_review` where vehicle_id='{$row['id']}' and user_id = ".$_settings->userdata('id'))->num_rows;
                ?>
                    <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo date("d-m-Y H:i",strtotime($row['date_created'])) ?></td>
                        <td><?php echo $row['title'] ?></td>
                        <td><?php echo date("d-m-Y",strtotime($row['schedule1'])) ?></td>
                        <td><?php echo date("d-m-Y",strtotime($row['schedule2'])) ?></td>
                       
                      
                        <td class="text-center">
                            <?php if($row['status'] == 0): ?>
                                <span class="badge badge-warning">Pending</span>
                            <?php elseif($row['status'] == 1): ?>
                                <span class="badge badge-primary">Confirmed</span>
                            <?php elseif($row['status'] == 2): ?>
                                <span class="badge badge-danger">Cancelled</span>
                            <?php elseif($row['status'] == 3): ?>
                                <span class="badge badge-success">Done</span>
                            <?php endif; ?>
                        </td>
                        <td text-align="center">
                                <button type="button" class="btn btn-flat btn-default border btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    Action
                                <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Edit</a>
                                <?php if($row['status'] == 3 && $review <= 0): ?>
                                    <a class="dropdown-item submit_review" href="javascript:void(0)" data-id="<?php echo $row['hotel_id'] ?>">Submit Review</a>
                                <?php endif; ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item cancel_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Cancel</a>
                                </div>
                        </td>
                        <td text-align="center">
                                <button type="button" class="btn btn-flat btn-default border btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    payment
                                <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item edit_data" href="./?page=payment" data-id="<?php echo $row['id'] ?>">make-payment</a>
                                <?php if($row['status'] == 3 && $review <= 0): ?>
                                    <a class="dropdown-item submit_review" href="javascript:void(0)" data-id="<?php echo $row['hotel_id'] ?>">Submit Review</a>
                                <?php endif; ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item cancel_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Cancel</a>
                                </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</section>
<script>
    function cancel_book($id){
        start_loader()
        $.ajax({
            url:_base_url_+"classes/Master.php?f=update_book_status",
            method:"POST",
            data:{id:$id,status:2},
            dataType:"json",
            error:err=>{
                console.log(err)
                alert_toast("an error occured",'error')
                end_loader()
            },
            success:function(resp){
                if(typeof resp == 'object' && resp.status == 'success'){
                    alert_toast("Book cancelled successfully",'success')
                    setTimeout(function(){
                        location.reload()
                    },2000)
                }else{
                    console.log(resp)
                    alert_toast("an error occured",'error')
                }
                end_loader()
            }
        })
    }
    $(function(){
        $('.cancel_data').click(function(){
            _conf("Are you sure to cancel this booking?","cancel_book",[$(this).data('id')])
        })
        $('.submit_review').click(function(){
            uni_modal("Rate & Feedback","./rate_review.php?id="+$(this).data('id'),'mid-large')
        })
        $('table').dataTable();
    })
</script>