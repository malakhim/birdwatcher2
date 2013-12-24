{** block-description:billibuys_home_page **}
<div class="container">
	<div class="panel panel-default" id="buyer_panel">
		<div class="panel_heading">
			{$lang.jumbotron_buyer_heading}
		</div>
		<div class="panel_subheading">{$lang.jumbotron_buyer_subheading}</div>
		<button type="button" id="buyer_btn_lrn_more" class="btn btn-primary">{$lang.learn_more_buyer}</button>
	</div>

	<div class="panel panel-default" id="seller_panel">
		<div class="panel_heading">
			{$lang.jumbotron_seller_heading}
		</div>
		<div class="panel_subheading">{$lang.jumbotron_seller_subheading}</div>
		<button type="button" id="seller_btn_lrn_more" class="btn btn-primary">{$lang.learn_more_seller}</button>
	</div>

	<div class="steps" id="buyer_steps">
		<div class="steps_heading">{$lang.how_does_billibuys_work} {$lang.for_buyers}?</div>
		<div class="steps_images" id="buyer_step_images">
			<span id="buyer_step_img_1">
				<img src="http://placekitten.com/220/240" alt="Step 1"/>
			</span>

			<span id="buyer_step_img_2">
				<img src="http://placekitten.com/220/240" alt="Step 2"/>
			</span>
			<span id="buyer_step_img_3">
				<img src="http://placekitten.com/220/240"  alt="Step 3"/>
			</span>
		</div>
		<div class="steps_text">
			<div id="buyer_step_heading_1">
				{$lang.step} 1
			</div>
			<div id="buyer_step_text_1">
				{$lang.step_1_buyer}
			</div>
		</div>

		<div class="steps_text">
			<div id="buyer_step_heading_2">
				{$lang.step} 2
			</div>
			<div id="buyer_step_text_2">
				{$lang.step_2_buyer}
			</div>
		</div>

		<div class="steps_text">
			<div id="buyer_step_heading_3">
				{$lang.step} 3
			</div>
			<div id="buyer_step_text_3">
				{$lang.step_3_buyer}
			</div>
		</div>

	</div>


</div>