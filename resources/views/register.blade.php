<!-- register -->

<div class="modal fade" id="exampleModal2" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content" style="border:none;">
				<div class="modal-header">
					<h5 class="modal-title">Register</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body">
					<form action="{{url('rotp')}}" method="post" id="registrationForm">
						@csrf

						<div class="form-group">
							<label class="col-form-label">Your Name</label>
							<input type="text" class="form-control" placeholder="Enter name" name="name" required="">
						</div>

						<div class="form-group">
							<label class="col-form-label">Email</label>
							<input type="email" class="form-control" placeholder="Enter email" name="email" required="">
						</div>

						<div class="form-group">
							<label class="col-form-label">Password</label>
							<input type="password" class="form-control" placeholder="Enter password" name="password" id="pass" required="" onchange="validatePassword()">
							<div class="btn-warning mt-2" id="passError"></div>
						</div>

						<div class="form-group">
							<label class="col-form-label">Re-enter Password</label>
							<input type="password" class="form-control" placeholder="Re-enter password" name="repass" id="password1" required="" onchange="validatePasswordMatch()">
							<div id="passwordMatchError" class="btn-warning mt-3"></div>
						</div>

						<div class="right-w3l">
							<button type="submit" class="form-control btn-primary" id="registerBtn">Register</button>
						</div>

						<p class="text-center dont-do mt-3">Do have an account?
							<a href="#" data-dismiss="modal" data-toggle="modal" data-target="#exampleModal">
								Log in</a>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>

<!-- log in -->
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content" style="border: none;">
				<div class="modal-header">
					<h5 class="modal-title text-center">Verify OTP</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="{{url('customer')}}" method="post">
						@csrf
						<div class="form-group">
							<label class="col-form-label">Enter OTP</label>
							<input type="number" class="form-control" placeholder="Enter OTP" name="rotp" required="">
							<div id="emailError" class="btn-warning mt-3"></div>
						</div>
						<div class="right-w3l">
							<input type="submit" class="form-control" value="Verify OTP">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>


<script>

$(document).ready(function () {

        $("#registerBtn").on("click", function () {
         
            var formData = $("#registrationForm").serialize();

            $.ajax({
                type: "POST",
                url: $("#registrationForm").attr("action"),
                data: formData,
                dataType: "json",
                success: function (response) {
					$("exampleModal2").modal('hide');
                    $("#exampleModal3").modal('show');   
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });

	function validatePassword() {
        var passwordInput = document.getElementById('pass');
        var passwordError = document.getElementById('passwordError');
        var password = passwordInput.value;
        if (password.length < 8) {
            passError.innerHTML = ' Password must be at least 8 characters long.';
        }
    }

	function validatePasswordMatch() {
        var passwordInput = document.getElementById('pass');
        var password1Input = document.getElementById('password1');
        var passwordMatchError = document.getElementById('passwordMatchError');

        var password = passwordInput.value;
        var password1 = password1Input.value;

	
			if (password !== password1) {
            	passwordMatchError.innerHTML = 'Passwords do not match.';
			}
        
    }
</script>