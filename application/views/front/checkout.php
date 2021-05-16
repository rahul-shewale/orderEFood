<div class="container">
    <h2 class="mt-3">Order Preview</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="table-responsive-sm">
                <table class="table   table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Dish</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php if($this->cart->total_items() > 0) { 
                    foreach($cartItems as $item) { ?>
                        <tr>
                            <td>
                                <?php $image = $item['image'];?>
                                <img class="" width="100"
                                    src="<?php echo base_url().'public/uploads/dishesh/thumb/'.$image; ?>">
                            </td>
                            <td><?php echo $item['name']; ?></td>
                            <td><?php echo $item['price']; ?></td>
                            <td><?php echo $item['qty']; ?></td>
                            <td><?php echo $item['subtotal']; ?></td>
                        </tr>
                        <?php } ?>
                        <?php } else { ?>
                        <tr>
                            <td colspan="5">
                                <p>No items in your cart...</p>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4"></td>
                            <?php  if($this->cart->total_items() > 0) { ?>
                            <td class="text-left">Total: <b><?php echo $this->cart->total();?></b></td>
                            <?php } ?>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <form action="<?php echo base_url().'checkout/index';?>" method="POST"
                class="form-container  shadow-container" style="width:80%">
                <h3>Shipping info</h3>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea name="address" type="text" style="height:70px;"
                        class="form-control
                    <?php echo (form_error('address') != "") ? 'is-invalid' : '';?>"><?php echo set_value('address', $user['address']);?></textarea>
                    <?php echo form_error('address'); ?>
                </div>
                <p class="lead mb-0">Cash on delivery</p>
                <div class="container p-2 mb-3" style="background: #e5e5e5;">
                    Pay with Cash upon delivery
                </div>
                <div>
                    <a href="<?php echo base_url().'cart'; ?>" class="btn btn-warning"><i class="fas fa-angle-left"></i>
                        Back to cart</a>
                    <button type="submit" name="placeOrder" class="btn btn-success">Place Order <i
                            class="fas fa-angle-right"></i></button>
                </div>
                </from>
        </div>
    </div>
</div>