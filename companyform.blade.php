<form action="submit" method="POST">
	@csrf
	<input type="text" name="name" placeholder="Category_name" >
	<br><br>
	<input type="text" name="address" placeholder="subcategory_name" >
	<br><br>
	<button type="submit">Insert</button>
</form>

