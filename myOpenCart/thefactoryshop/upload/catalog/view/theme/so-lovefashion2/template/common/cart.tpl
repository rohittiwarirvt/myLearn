<?php
    global $config;
    $text_items_full = explode(" ", $text_items);
	
    $text_items_number = $text_items_full[0];
    $store_id = $config->get('config_store_id');
	$array = array($text_items_full[1] , $text_items_full[2], $text_items_full[3]);
	$text_title = implode(" ", $array);
	
?>


<div id="cart" class=" btn-group btn-shopping-cart">
	
  <div data-loading-text="<?php echo $text_loading; ?>" class="top_cart dropdown-toggle" data-toggle="dropdown">
		<h3 class="title-mod"><?php echo $header_title_cart;?></h3>
		<span class="text"><?php echo $text_title;?></span>
		<span class="number"><?php echo $text_items_number;?></span>
  </div>


  <ul class="tab-content content dropdown-menu pull-right shoppingcart-box" role="menu">
    
      <?php if ($products || $vouchers) { ?>
      <li>
          <div class="added_items"><?php echo (count($products) <= 3 ? '' : 'Last 3 added item(s) from '.count($products)) ; ?></div>
      </li>
      <li>
          <table class="table table-striped" style="max-height: 300px;display: block;overflow-y: auto;">

              <?php
         $i = 0;
         $products1 = array_reverse($products);
         ?>
              <?php foreach ($products1 as $product) : ?>
              <?php $i ++; ?>
                  <?php if ($i < 100): ?>
                  <tr>
					<td class="media">
						
						<?php if ($product['thumb']) { ?>
						  <small class="img-item media-left">
						  <a href="<?php echo $product['href']; ?>">
							  <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="preview" />
						  </a>
						  <a onclick="cart.remove('<?php echo $product['cart_id']; ?>');" class="remove fa fa-times fa-delete"></a>
						  </small>
						<?php } ?>
						<small class="media-body">
						<a class="cart_product_name " href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
						<span style="display: block;">Quantity: <?php echo $product['quantity']; ?></span>
						<?php if ($product['option']) { ?>
						<span>
						<?php foreach ($product['option'] as $option) { ?>
						- <small><?php echo $option['name']; ?> <?php echo $option['value']; ?></small>
						<?php } ?>
						</span>
						<?php } ?>
						</small>
						
						<?php if ($product['recurring']) { ?>
						<br />
						- <small><?php echo $text_recurring; ?> <?php echo $product['recurring']; ?></small>
						<?php } ?>
						
					</td>
                    
					<td class="text-center price-item">
						 <small class="btn"><?php echo $product['total']; ?></small>
					</td>
                       
                  </tr>
                  <?php endif; ?>
              <?php endforeach; ?>
              <?php foreach ($vouchers as $voucher) { ?>
              <tr>
                  <td class="text-center"></td>
                  <td class="text-left"><?php echo $voucher['description']; ?></td>
                  <td class="text-right">x&nbsp;1</td>
                  <td class="text-right"><?php echo $voucher['amount']; ?></td>
                  <td class="text-center text-danger">
                      <button type="button" onclick="voucher.remove('<?php echo $voucher['key']; ?>');" title="<?php echo $button_remove; ?>" class="btn btn-danger btn-xs">
                          <i class="fa fa-times"></i>
                      </button>
                  </td>
              </tr>
              <?php } ?>
          </table>
      </li>
      <li>
          <div>
              <table class="table table-bordered">
                  <?php foreach ($totals as $total) { ?>
                  <tr>
                      <td class="text-left"><strong><?php echo $total['title']; ?></strong></td>
                      <td class="text-right"><?php echo $total['text']; ?></td>
                  </tr>
                  <?php } ?>
              </table>
              <p class="text-right">
                  <a class="btn view-cart" href="<?php echo $cart; ?>"><i class="fa fa-shopping-cart"></i><?php echo $text_cart; ?></a>&nbsp;&nbsp;&nbsp;
                  <a class="btn btn-mega checkout-cart" href="<?php echo $checkout; ?>"><i class="fa fa-share"></i><?php echo $text_checkout; ?></a>
              </p>
          </div>
      </li>
      <?php } else { ?>
      <li>
          <p class="text-center"><?php echo $text_empty; ?></p>
      </li>
      <?php } ?>
  </ul>
</div>
