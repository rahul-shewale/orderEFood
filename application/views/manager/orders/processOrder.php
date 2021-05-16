<div class="container table-responsive m-t-20">
    <h2 class="py-3">View user orders</h2>
    <table id="myTable" class="table table-bordered table-striped dataTable">
        <tbody>
            <tr>
                <td><strong>username:</strong></td>
                <td><?php echo $order['username'] ?></td>
            </tr>
            <tr>
                <td><strong>Title:</strong></td>
                <td><?php echo $order['d_name'] ?></td>
            </tr>
            <tr>
                <td><strong>Quantity:</strong></td>
                <td><?php echo $order['o_quantity'] ?></td>
            </tr>
            <tr>
                <td><strong>Price:</strong></td>
                <td><?php echo $order['o_price'] ?></td>
            </tr>
            <tr>
                <td><strong>Address:</strong></td>
                <td><?php echo $order['address'] ?></td>
            </tr>
            <tr>
                <td><strong>Date:</strong></td>
                <td><?php echo $order['order_date'] ?></td>
            </tr>
            <form method="post" action="<?php echo base_url().'manager/orders/updateOrder/'.$order['o_id']; ?>">
                <tr>
                    <td><strong>Selct Order Status:</strong></td>
                    <td>
                        <select class="form-control" name="status"
                            class="<?php echo (form_error('status') != "") ? 'is-invalid' : '';?>">
                            <option>Select Status</option>
                            <option value="in process">In Process</option>
                            <option value="closed">Closed</option>
                            <option value="rejected">Rejected</option>
                        </select>
                        <?php echo form_error('status');?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><button class="btn btn-info btn-block" type="submit">Submit</button></td>
                </tr>
            </form>
        </tbody>
    </table>
</div>