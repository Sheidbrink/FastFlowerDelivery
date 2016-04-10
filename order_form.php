<?php
	echo '<form method="post">
		<table cellpadding="5">
			<tr>
				<td>Flowers:</td>
				<td><input id="addOrder" type="text" name="addOrder"> </id>
			</tr>
			<tr>
				<td>Address:</td>
				<td><input id="orderAddress" type="text" name="orderAddress"> </td>
			</tr>
			<tr>
				<td>City:</td>
				<td><input id="orderCity" type="text" name="orderCity"> </td>
			</tr>
			<tr>
				<td>State:</td>
				<td><input id="orderState" type="text" name="orderState"> </td>
			</tr>
			<tr>
				<td>Urgent:</td>
				<td>
					<select name="urgent">
						<option value="true">True</option>
						<option value"false">False</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><input type="submit" value="Place Order"></td>
			</tr>
		</table>
		</form>';
?>
