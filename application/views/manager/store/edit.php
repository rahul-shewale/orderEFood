<div class="conatiner">
    <form action="<?php echo base_url().'manager/store/edit/'.$store['r_id'];?>" method="POST"
        class="form-container mx-auto  shadow-container" style="width:90%" enctype="multipart/form-data">
        <h3 class="mb-3 p-2 bg-primary mb-3">Edit "<?php echo $store['r_name'] ?>" Restaurant Info</h3>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Restaurant Name</label>
                    <input type="text" name="res_name"  class="form-control
                    <?php echo (form_error('res_name') != "") ? 'is-invalid' : '';?>" placeholder="Add restaurant name"
                        value="<?php echo set_value('res_name', $store['r_name']);?>">
                    <?php echo form_error('res_name'); ?>
                </div>
                <div class="form-group">
                    <label class="control-label">Bussiness E-mail</label>
                    <input type="text" name="email" class="form-control form-control-danger
                    <?php echo (form_error('email') != "") ? 'is-invalid' : '';?>" placeholder="example@gmail.com"
                        value="<?php echo set_value('email', $store['r_email']);?>">
                    <?php echo form_error('email'); ?>
                </div>
                <div class="form-group">
                    <label class="control-label">Phone</label>
                    <input type="text" name="phone" class="form-control
                    <?php echo (form_error('phone') != "") ? 'is-invalid' : '';?>" placeholder="phone no"
                        value="<?php echo set_value('phone', $store['r_phone']);?>">
                        <?php echo form_error('phone'); ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Open Hours</label>
                    <select name="o_hr" id="o_hr" class="form-control
                    <?php echo (form_error('o_hr') != "") ? 'is-invalid' : '';?>" data-placeholder="Choose a Category">
                        <option value="">--Select your Hours--</option>
                        <option value="8am" <?php echo $store['o_hr'] == "8am" ? "selected" : "";?>>8am</option>
                        <option value="9am" <?php echo $store['o_hr'] == "9am" ? "selected" : "";?>>9am</option>
                        <option value="10am" <?php echo $store['o_hr'] == "10am" ? "selected" : "";?>>10am</option>
                        <option value="11am" <?php echo $store['o_hr'] == "11am" ? "selected" : "";?>>11am</option>
                    </select>
                    <?php echo form_error('o_hr'); ?>
                </div>
                <div class="form-group">
                    <label class="control-label">Close Hours</label>
                    <select name="c_hr" id="c_hr" class="form-control
                    <?php echo (form_error('c_hr') != "") ? 'is-invalid' : '';?>" data-placeholder="Choose a Category">
                        <option value="">--Select your Hours--</option>
                        <option value="6pm <?php echo $store['c_hr'] == "6pm" ? "selected" : "";?>">6pm</option>
                        <option value="7pm" <?php echo $store['c_hr'] == "7pm" ? "selected" : "";?>>7pm</option>
                        <option value="8pm" <?php echo $store['c_hr'] == "8pm" ? "selected" : "";?>>8pm</option>
                    </select>
                    <?php echo form_error('c_hr'); ?>
                </div>
                <div class="form-group">
                    <label class="control-label">Open Days</label>
                    <select name="o_days" id="o_days" class="form-control 
                    <?php echo (form_error('o_days') != "") ? 'is-invalid' : '';?>" data-placeholder="Choose a Category"
                        tabindex="1">
                        <option value="">--Select your Days--</option>
                        <option value="mon-fri <?php echo $store['o_days'] == "mon-fri" ? "selected" : "";?>">mon-fri</option>
                        <option value="mon-sat" <?php echo $store['o_days'] == "mon-sat" ? "selected" : "";?>>mon-sat</option>
                        <option value="24hr-x7" <?php echo $store['o_days'] == "24hr-x7" ? "selected" : "";?>>24hr-x7</option>
                    </select>
                    <?php echo form_error('o_days'); ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group has-danger">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control 
                    <?php echo(!empty($errorImageUpload))  ? 'is-invalid' : '';?>">
                    <br>
                    <?php echo (!empty($errorImageUpload)) ? $errorImageUpload : '';?>

                    <?php if($store['r_img'] != '' && file_exists('./public/uploads/restaurant/thumb/'.$store['r_img'])) { ?>
                    <img class="mt-1" src="<?php echo base_url().'public/uploads/restaurant/thumb/'.$store['r_img']; ?>">
                    <?php } else {?>
                    <img width="300" src="<?php echo base_url().'public/uploads/no-image.png'?>">
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label class="control-label">Select Category</label>
                    <select name="c_name" id="c_name"
                        class="form-control <?php echo (form_error('c_name') != "") ? 'is-invalid' : '';?>">
                        <option value="">--Select Category--</option>
                        <?php 
                if (!empty($cats)) { 
                    foreach($cats as $cat) {
                        ?>
                        <option value="<?php echo $cat['c_id'];?>">
                            <?php echo $cat['c_name'];?>
                        </option>
                        <?php }
                }
                ?>
                    </select>
                    <?php echo form_error('c_name');?>
                </div>
                <h3 class="box-title m-t-40">Store Address</h3>
                <div class="form-group">
                    <textarea name="address" type="text" style="height:70px;"
                        class="form-control
            <?php echo (form_error('address') != "") ? 'is-invalid' : '';?>"><?php echo set_value('address', $store['r_address']);?></textarea>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success ml-2">Submit</button>
            <a href="<?php echo base_url().'manager/store/index'?>" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
<script>
    const o_hr = document.getElementById("o_hr");
    const c_hr = document.getElementById("c_hr");
    const o_days = document.getElementById("o_days");
    const c_name = document.getElementById("c_name");

    o_hr.value = "<?php echo $_POST['o_hr']; ?>";
    c_hr.value = "<?php echo $_POST['c_hr']; ?>";
    o_days.value = "<?php echo $_POST['o_days']; ?>";
    c_name.value = "<?php echo $_POST['c_name']; ?>";
</script>