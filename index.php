<?php	
	session_start();
	if(!isset($_SESSION['email'])){
		header("Location: login.php");
	}

	require_once 'connect.php';

	$sql = "select * from tb_company";
	$listCompany = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>CRUD</title>
		<link rel="shortcut icon" href="https://img.icons8.com/wired/64/000000/work-light.png">
		<!------------------------------------------------Bootstrap------------------------------------------------------>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="css/index.css">
	</head>
	<body>
		<header>
			<div class="account-name">Account: <?php echo $_SESSION['email'] ?></div>
			<div class="logout">
				<a href="logout.php" style="text-decoration: none;">
					<button class="btn-logout" type="button" name="logout">
						Logout
					</button>
				</a>
			</div>
		</header>

		<section class="content">
			<div class="title">Example CRUD</div>
			<div class="create-btn">
				<a data-role="create" style="text-decoration: none;">
					<button class="btn-logout" style="width: 200px;" type="button" name="create" data-toggle="modal" data-target="#createModal">
						Create Company
					</button>
				</a>
			</div>
			<div class="crud-table">
				<table class="table table-hover">
				  <thead>
				    <tr>
				      <th scope="col">ID</th>
				      <th scope="col">Company</th>
				      <th scope="col">Contact</th>
				      <th scope="col">Country</th>
				      <th scope="col"></th>
				      <th scope="col"></th>
				    </tr>
				  </thead>
				  <tbody id="crud-table-tbody">
				  	<?php while($row = mysqli_fetch_assoc($listCompany)){ ?>
					    <tr id="<?php echo $row['id']; ?>">
					      <th scope="row"><?php echo $row['id']; ?></th>
					      <td data-target="company"><?php echo $row['company']; ?></td>
					      <td data-target="contact"><?php echo $row['contact']; ?></td>
					      <td data-target="country"><?php echo $row['country']; ?></td>
					      <td>
					      	<a data-role="update" data-id="<?php echo $row['id']; ?>" style="text-decoration: none;">
										<button class="btn-logout" type="button" name="update" data-toggle="modal" data-target="#exampleModal">
											Update
										</button>
									</a>
								</td>
					      <td>
					      	<a data-role="delete" data-id="<?php echo $row['id']; ?>" style="text-decoration: none;">
										<button class="btn-logout" id="delete" type="button" name="delete">
											Delete
										</button>
									</a>
								</td>
					    </tr>
				  	<?php } ?>
				  </tbody>
				</table>
			</div>
		</section>

		<!------------------------------------------------Create Modal------------------------------------------------------------>
		<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Create Company</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <form id="create-form">
		      <div class="modal-body">		        
	          <div class="form-group">
	            <label for="company" class="col-form-label">Company: <span class="badge badge-danger" id="c-company-err"></span></label>
	            <input type="text" class="form-control" id="c-company" data-toggle="tooltip" data-placement="top" title="Tooltip on top" onkeypress="return /[.,*a-z0-9 ]/i.test(event.key)">
	          </div>
	          <div class="form-group">
	            <label for="contact" class="col-form-label">Contact: <span class="badge badge-danger" id="c-contact-err"></span></label>
	            <input type="text" class="form-control" id="c-contact" onkeypress="return /[.a-z1-9 ]/i.test(event.key)">
	          </div>
	          <div class="form-group">
	            <label for="country" class="col-form-label">Country: <span class="badge badge-danger" id="c-country-err"></span></label>
	            <input type="text" class="form-control" id="c-country" onkeypress="return /[a-z ]/i.test(event.key)">
	          </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="reset" class="btn btn-secondary pull-left">Reset</button>
		        <button type="button" id="create" class="btn btn-primary">Create</button>
		      </div>
		      </form>
		    </div>
		  </div>
		</div>


		<!------------------------------------------------Update Modal------------------------------------------------------------>
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Update Company</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <form>
		      <div class="modal-body">		        
	          <div class="form-group">
	            <label for="company" class="col-form-label">Company: <span class="badge badge-danger" id="u-company-err"></label>
	            <input type="text" class="form-control" id="company" onkeypress="return /[.,*a-z1-9 ]/i.test(event.key)">
	          </div>
	          <div class="form-group">
	            <label for="contact" class="col-form-label">Contact: <span class="badge badge-danger" id="u-contact-err"></label>
	            <input type="text" class="form-control" id="contact" onkeypress="return /[.a-z1-9 ]/i.test(event.key)">
	          </div>
	          <div class="form-group">
	            <label for="country" class="col-form-label">Country: <span class="badge badge-danger" id="u-country-err"></label>
	            <input type="text" class="form-control" id="country" onkeypress="return /[a-z ]/i.test(event.key)">
	          </div>
	          <input type="hidden" id="id">
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="reset" class="btn btn-secondary pull-left">Reset</button>
		        <button type="button" id="update" class="btn btn-primary">Update</button>
		      </div>
		      </form>
		    </div>
		  </div>
		</div>

		<!------------------------------------------------Ajax------------------------------------------------------>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<!------------------------------------------------Bootstrap------------------------------------------------->
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
		<!------------------------------------------------SweetAlert2----------------------------------------------->
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
		<!------------------------------------------------Custom Script--------------------------------------------->
		<script type="text/javascript">
			$(document).ready(function(){
				//Open update modal
				$(document).on('click', 'a[data-role=update]', function(){
					var id = $(this).data('id');
					var company = $('#' + id ).children('td[data-target=company]').text();
					var contact = $('#' + id ).children('td[data-target=contact]').text();
					var country = $('#' + id ).children('td[data-target=country]').text();

					$('#company').val(company);
					$('#contact').val(contact);
					$('#country').val(country);
					$('#id').val(id);
				});

				//Delete confirm alert
				$(document).on('click', 'a[data-role=delete]', function(){
					var id = $(this).data('id');
					Swal.fire({
					  title: 'Delete company with id = ' + id + ', Are you sure?',
					  text: "You won't be able to revert this!",
					  icon: 'warning',
					  showCancelButton: true,
					  confirmButtonColor: '#3085d6',
					  cancelButtonColor: '#d33',
					  confirmButtonText: 'Yes, delete it!'
					}).then((result) => {
					  if (result.value) {
					  	$.ajax({
								url: 'delete-company.php',
								method: 'post',
								data: {id: id},
								success: function(response){
									Swal.fire(
							      'Deleted!',
							      'Your file has been deleted.',
							      'success'
							    );
							    $('tr[id=' + id + ']').remove();
								}
							});
					  }
					})
				});

				//Update
				$('#update').click(function(){
					var id = $('#id').val();
					var company = $('#company').val();
					var contact = $('#contact').val();
					var country = $('#country').val();

					if(company == "" || company == null){
						var company_err = "Can't null";
					} else company_err = "";
					$('#u-company-err').text(company_err);
					if(contact == "" || contact == null){
						var contact_err = "Can't null";
					} else contact_err = "";
					$('#u-contact-err').text(contact_err);
					if(country == "" || country == null){
						var country_err = "Can't null";
					} else country_err = "";
					$('#u-country-err').text(country_err);

					if(company_err == "" && contact_err == "" && country_err == ""){
						$.ajax({
							url: 'update-company.php',
							method: 'post',
							data: {company: company, contact: contact, country: country, id: id},
							success: function(response){
								$('#' + id ).children('td[data-target=company]').text(company);
								$('#' + id ).children('td[data-target=contact]').text(contact);
								$('#' + id ).children('td[data-target=country]').text(country);

								$('#exampleModal').modal('toggle');
								Swal.fire(
								  'Created!',
								  'You updated a company!',
								  'success'
								);
							}
						});
					}
				});

				//Create
				$('#create').click(function(){
					var company = $('#c-company').val();
					var contact = $('#c-contact').val();
					var country = $('#c-country').val();

					if(company == "" || company == null){
						var company_err = "Can't null";
					} else company_err = "";
					$('#c-company-err').text(company_err);
					if(contact == "" || contact == null){
						var contact_err = "Can't null";
					} else contact_err = "";
					$('#c-contact-err').text(contact_err);
					if(country == "" || country == null){
						var country_err = "Can't null";
					} else country_err = "";
					$('#c-country-err').text(country_err);

					if(company_err == "" && contact_err == "" && country_err == ""){
						$.ajax({
							url: 'create-company.php',
							method: 'post',
							data: {company: company, contact: contact, country: country},
							success: function(response){
								var id = parseInt(response);
								var markup = "<tr id='" + id + "'><th scope='row'>" + id +"</th><td data-target='company'>" + company + "</td><td data-target='contact'>" + contact + "</td><td data-target='country'>" + country + "</td><td><a data-role='update' data-id='" + id +"' style='text-decoration: none;'><button class='btn-logout' type='button' name='update' data-toggle='modal' data-target='#exampleModal'>Update</button></a></td><td><a data-role='delete' data-id='" + id + "' style='text-decoration: none;'><button class='btn-logout' id='delete' type='button' name='delete'>Delete</button></a></td></tr>";
								$('#crud-table-tbody').append(markup);
								$('#create-form').trigger('reset');
								console.log(response);
								$('#createModal').modal('toggle');
								Swal.fire(
								  'Created!',
								  'You created a company!',
								  'success'
								);
							}
						});
					}
				});
			});
		</script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#createModal").on("hidden.bs.modal", function(){
				  $('#c-company-err').text("");
				  $('#c-contact-err').text("");
				  $('#c-country-err').text("");
				});

				$("#exampleModal").on("hidden.bs.modal", function(){
				  $('#u-company-err').text("");
				  $('#u-contact-err').text("");
				  $('#u-country-err').text("");
				});
			});
		</script>
	</body>
</html>