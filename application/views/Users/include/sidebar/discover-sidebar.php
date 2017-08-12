<form action="search">
	<input type="text" class="input input-full-width input-search-by-keyword" placeholder="Search by keyword">
</form>
<h3 class="heading-h3 category-name">Filter by</h3>
<hr class="hr hr-full-width hr-body">
<p class="category-subname">
	Look For
</p>
<ul class="list category-list">
	<li class="list-item">
		Accounts
	</li>
	<li class="list-item">
		Photos
	</li>
	<li class="list-item">
		Contests
	</li>
	<li class="list-item">
		Events
	</li>
</ul>
<p class="category-subname">
	Filter
</p>
<form action="" method="POST">
	<div class="search-input-row">
		<div class="settings-row">
			<select type="text" class="input" id="add-breed" name="serch_breed">
				<?php
				if (isset($_GET['breed'])) { ?>
				<option selected value="<?= $_GET['breed'];?>"><?= $_GET['breed'];?></option>
				<?php } else{ ?>
				 <option value="Select a breed" disabled selected>Select a breed</option>
				<?php } ?>
				<option value="Airedale Terrier">Airedale Terrier</option>
				<option value="Airedale">Airedale</option>
				<option value="Basset Hound">Basset Hound</option>
				<option value="Basenji">Basenji</option>
				<option value="Border Collie">Border Collie</option>
				<option value="Beagle">Beagle</option>
				<option value="Bloodhound">Bloodhound</option>
				<option value="Chow Chow">Chow Chow</option>
				<option value="Boxer">Boxer</option>
				<option value="Bulldog">Bulldog</option>
				<option value="Chihuahua">Chihuahua</option>
				<option value="Cocker Spaniel">Cocker Spaniel</option>
				<option value="Fox Terrier">Fox Terrier</option>
				<option value="Corgi">Corgi</option>
				<option value="Dachshund">Dachshund</option>
				<option value="Dalmatian">Dalmatian</option>
				<option value="Doberman">Doberman</option>
				<option value="German Shepherd">German Shepherd</option>
				<option value="Golden Retriever">Golden Retriever</option>
				<option value="Great Dane">Great Dane</option>
				<option value="Irish Setter">Irish Setter</option>
				<option value="Greyhound">Greyhound</option>
				<option value="Newfoundland">Newfoundland</option>
				<option value="Saint Bernard">Saint Bernard</option>
			</select>
		</div>

	</div>
	<div class="search-input-row">
		<?php
		if (isset($_GET['location'])) {
			$str_location = str_replace('+', ' ', $_GET['location']);?>
			<input type="text" class="input input-full-width input-search-by-keyword" name="serch_location" placeholder="Choose location" value="<?php echo $str_location; ?>">
			<?php } else { ?>
			<input type="text" class="input input-full-width input-search-by-keyword" name="serch_location" placeholder="Choose location">
			<?php	} ?>
			
		</div>
		<div class="search-input-row flex-wrapper">
			<input type="text" class="input input-full-width input-search-by-keyword" name="serch_agefrom" placeholder="Age from">
			<input type="text" class="input input-full-width input-search-by-keyword" name="serch_ageto" placeholder="Age to">
		</div>
		<hr class="hr hr-full-width hr-body">
		<input type="submit" class="link button button-cta-green button-full-width contest-button" name="apply_filter" value="Apply filters">
	</form>