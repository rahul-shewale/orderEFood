<div class="container">
    <div class="container shadow-container">
        <?php if($this->session->flashdata('success') != ""):?>
        <div class="alert alert-success">
            <?php echo $this->session->flashdata('success');?>
        </div>
        <?php endif ?>
        <?php if($this->session->flashdata('error') != ""):?>
        <div class="alert alert-danger">
            <?php echo $this->session->flashdata('error');?>
        </div>
        <?php endif ?>
        <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
                <h2>Restaurent Managers</h2>
            </div>
            <input class="form-control mb-3" id="myInput" type="text" placeholder="Search .." style="width:50%;">
        </div>
        <br>
        <div class="table-responsive-sm">
            <table class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Manager Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <?php if(!empty($managers)) {?>
                    <?php foreach($managers as $manager) { ?>
                    <tr>
                        <td><?php echo $manager['m_id']; ?></td>
                        <td><?php echo $manager['m_username']; ?></td>
                        <td><?php echo $manager['m_phone']; ?></td>
                        <td><?php echo $manager['m_email']; ?></td>
                        <td>
                            <a href="<?php echo base_url().'admin/manager/edit/'.$manager['m_id'];?>"
                                class="btn btn-info mb-1"><i class="fas fa-cog mr-1"></i> Edit</a>
                            <a href="javascript:void(0);" onclick="deleteManager(<?php echo $manager['m_id']; ?>)"
                                class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php } else {?>
                    <tr>
                        <td colspan="5">Records not found</td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
function deleteManager(id) {
    if (confirm("Are you sure you want to delete manager?")) {
        window.location.href = '<?php echo base_url().'admin/manager/delete/';?>' + id;
    }
}

$(document).ready(function() {
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>