{** block-description:billibuys_home_slider **}

<script type="text/javascript" src="js/modernizr.custom.28468.js"></script>
<script type="text/javascript" src="js/jquery-timing.min.js"></script>
<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> -->
<script type="text/javascript" src="js/jquery.cslider.js"></script>

<link rel="stylesheet" type="text/css" href="css/style.css" />

{capture name="slide"}
	{literal}
		$lang_group = {$lang_group}
		$step_subheading = {$step_subheading}
		$step_number = {$step_number}
	{/literal}
{/capture} 

<div id="da-slider" class="da-slider buyerslider">

	<div class="da-slide">
		<h2>{$lang.for_the_buyers}</h2>
		<p>{$lang.step} 1 {$lang.request_a_product}</p>
		<span class="slide-body">{$lang.step_1_buyer}</span>

		<div class="da-img stickimg">
			<img src="http://placekitten.com/400/80" />
		</div>

		<!-- <p>{$lang.step_1_buyer}</p> -->
		<div class="da-img">
			<img src="http://placekitten.com/350/250" />
		</div>
	</div>

	<div class="da-slide">
		<h2>{$lang.for_the_buyers}</h2>
		<p>{$lang.step} 2 {$lang.get_bids}</p>
		<span class="slide-body">{$lang.step_2_buyer}</span>
		<!-- <p>{$lang.step_1_buyer}</p> -->

		<div class="da-img stickimg">
			<img src="http://placekitten.com/400/80" />
		</div>

		<div class="da-img">
			<img src="http://placekitten.com/350/250" />
		</div>

		<div class="da-img">
			<img src="http://placekitten.com/350/250" />
		</div>
	</div>

	<div class="da-slide">
		<h2>{$lang.for_the_buyers}</h2>
		<p>{$lang.step} 3 {$lang.purchase_items}</p>
		<span class="slide-body">{$lang.step_3_buyer}</span>
		<!-- <p>{$lang.step_1_buyer}</p> -->

		<div class="da-img stickimg">
			<img src="http://placekitten.com/400/80" />
		</div>

		<div class="da-img">
			<img src="http://placekitten.com/350/250" />
		</div>
	</div>

	<nav class="da-arrows">
        <span class="da-arrows-prev"></span>
        <span class="da-arrows-next"></span>
    </nav>

</div>

<div id="da-slider" class="da-slider sellerslider">

	<div class="da-slide">
		<h2>{$lang.for_the_sellers}</h2>
		<p>{$lang.step} 1</p>
		<span class="slide-body">{$lang.step_1_seller}</span>
		<!-- <p>{$lang.step_1_buyer}</p> -->

		<div class="da-img stickimg">
			<img src="http://placekitten.com/400/80" />
		</div>

		<div class="da-img">
			<img src="http://placekitten.com/350/250" />
		</div>
	</div>

	<div class="da-slide">
		<h2>{$lang.for_the_sellers}</h2>
		<p>{$lang.step} 2</p>
		<span class="slide-body">{$lang.step_2_seller}</span>
		<!-- <p>{$lang.step_1_buyer}</p> -->

		<div class="da-img stickimg">
			<img src="http://placekitten.com/400/80" />
		</div>

		<div class="da-img">
			<img src="http://placekitten.com/350/250" />
		</div>
	</div>

	<div class="da-slide">
		<h2>{$lang.for_the_sellers}</h2>
		<p>{$lang.step} 3</p>
		<span class="slide-body">{$lang.step_3_seller}</span>
		<!-- <p>{$lang.step_1_buyer}</p> -->

		<div class="da-img stickimg">
			<img src="http://placekitten.com/400/80" />
		</div>

		<div class="da-img">
			<img src="http://placekitten.com/350/250" />
		</div>
	</div>

	<div class="da-slide">
		<h2>{$lang.for_the_sellers}</h2>
		<p>{$lang.step} 4</p>
		<span class="slide-body">{$lang.step_4_seller}</span>
		<!-- <p>{$lang.step_1_buyer}</p> -->

		<div class="da-img stickimg">
			<img src="http://placekitten.com/400/80" />
		</div>
		
		<div class="da-img">
			<img src="http://placekitten.com/350/250" />
		</div>
	</div>	

	<nav class="da-arrows">
        <span class="da-arrows-prev"></span>
        <span class="da-arrows-next"></span>
    </nav>
</div>

<div class="find_out_how_subbtn">
	{$lang.find_out_how}
</div>