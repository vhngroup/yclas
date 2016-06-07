<?php defined('SYSPATH') or die('No direct script access.');?>
<div class="pad_10tb">
	<div class="container">
		<div class="col-xs-12">
			<div class="page-header">
				<h3><?=__('Orders')?></h3>
			</div>

			<div class="panel panel-default">
				<ul class="list-group orders-list">
					<?foreach($orders as $order):?>
						<li class="list-group-item" id="tr<?=$order->pk()?>">
							<div class="order-item">
								<a href="#" data-toggle="modal" data-target="#viewOrderID<?=$order->id_order?>" title="<?=HTML::chars($order->ad->title)?>">
									<?=Text::limit_chars($order->ad->title, 50, NULL, TRUE)?>
								</a> <i class="fa fa-share-square-o"></i>
							</div>
							<div class="order-info pad_5tb">
							<span class="badge"><?=Model_Order::product_desc($order->id_product)?></span>
								<?if ($order->status == Model_Order::STATUS_CREATED):?>
									<span class="badge badge-warning"> <?=i18n::format_currency($order->amount, $order->currency)?> <i class="fa fa-clock-o"></i></span>
								<?else:?>
									<span class="badge badge-success"> <?=i18n::format_currency($order->amount, $order->currency)?> <i class="fa fa-check"></i></span>
								<?endif?>
							</div>
							<div class="order-date text-right">
								<?=$order->created?>
							</div>
						<div class="modal fade" id="viewOrderID<?=$order->id_order?>" tabindex="-1" role="dialog" aria-labelledby="viewOrder">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="viewOrder">#<?=$order->pk()?></h4>
									</div>
									<div class="modal-body">
										<p><a href="<?=Route::url('ad', array('controller'=>'ad','category'=>$order->ad->category->seoname,'seotitle'=>$order->ad->seotitle))?>">
											<?=HTML::chars($order->ad->title)?>
											</a></p>
										<p><b><?=__('Product') ?> :</b> <?=Model_Order::product_desc($order->id_product)?></p>
										<p><b><?=__('Date') ?> :</b> <?=$order->created?></p>
										<p><b><?=__('Date Paid') ?> :</b> <?=$order->pay_date?></p>
										<hr>
										<p  class="text-right">
											<b><?=__('Total') ?>:</b>
											<?if ($order->status == Model_Order::STATUS_CREATED):?>
												<span class="order-unpaid"><?=i18n::format_currency($order->amount, $order->currency)?> <i class="fa fa-clock-o"></i></span>
											<?else:?>
												<span class="order-paid"><?=i18n::format_currency($order->amount, $order->currency)?> <i class="fa fa-check"></i></span>
											<?endif?>	
										</p>
									</div>
									<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<?if ($order->status == Model_Order::STATUS_CREATED):?>
										<a class="btn btn-success" href="<?=Route::url('default', array('controller'=> 'ad','action'=>'checkout' , 'id' => $order->id_order))?>">
										<i class="glyphicon glyphicon-shopping-cart"></i> <?=__('Pay')?>   
										</a>
									<?else:?>
										<a class="btn btn-success disabled" href="#" disabled><?=Model_Order::$statuses[$order->status]?></a>
									<?endif?>
									</div>
								</div>
							</div>
						</div>
						</li>					
					<?endforeach?>
				</ul>
			</div>

			<div class="text-center">
				<?=$pagination?>
			</div>
		</div>
	</div>
</div>