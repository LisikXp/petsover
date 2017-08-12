<input type="text" name="dog_name" placeholder="Dog name">
<label class="btn btn-default btn-sm center-block btn-file">
	<img id="image" src="https://cdn3.iconfinder.com/data/icons/faticons/32/user-01-512.png" />   
	<i class="fa fa-upload fa-2x" aria-hidden="true"></i>
	<input id="userfile" type="file" name="filename" size="5000" style="display: none;">
</label>
<p><input list="breed" name="breed" placeholder="Select breed">
	<datalist id="breed">
		<option value="Чебурашка"></option>
		<option value="Крокодил Гена"></option>
		<option value="Шапокляк"></option>
	</datalist></p>
	<input name="bdate" type="text" id="datepicker" placeholder="Day of birth"><br>
	<input type="text" name="country" placeholder="Your country"><br>
	<input type="text" name="city" placeholder="Your city"><br>
	<button class="add_dog">Add another dog?</button>