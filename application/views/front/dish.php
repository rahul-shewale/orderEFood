<div class="container p-4">
    <div class="row welcome text-center welcome">
        <div class="col-12">
            <h1 class="display-4">Menu of <?php echo $res['r_name']; ?></h1>
        </div>
    </div>
    <div class="container res-card">
        <div class="card">
            <?php $img = $res['r_img'];?>
            <img src="<?php echo base_url().'public/uploads/restaurant/thumb/'.$img; ?>" class="card-img-top" />
            <div class="card-body">
                <h4 class="card-title font-weight-bold text-primary"><?php echo $res['r_name']; ?></h4>
                <p class="card-text lead"><?php echo $res['r_address']; ?></p>
                <p class="card-text">
                    Some quick example text to build on the card title and make up the
                    bulk of the card's content.
                </p>
            </div>
        </div>
    </div>
</div>
<div class="container p-4 dish-card">
    <div class="row">
        <?php if(!empty($dishesh)) { ?>
        <?php foreach($dishesh as $dish) { ?>
        <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
            <div class="card mb-4 shadow-sm">
                <?php $image = $dish['d_img'];?>
                <img class="card-img-top" src="<?php echo base_url().'public/uploads/dishesh/thumb/'.$image; ?>">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title"><?php echo $dish['d_name']; ?></h4>
                        <h4 class="text-muted"><b>$<?php echo $dish['d_price']; ?></b></h4>
                    </div>
                    <p class="card-text"><?php echo $dish['d_about']; ?></p>
                    <a href="<?php echo base_url().'Dish/addToCart/'.$dish['d_id']; ?>" class="btn btn-success"><i
                            class="fas fa-shopping-cart"></i> Add to
                        Cart</a>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php } else { ?>
        <div class="jumbotron">
            <h1>No records found</h1>
        </div>
        <?php } ?>
    </div>
    <hr class="my-4">
</div>