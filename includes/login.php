<div id="loginform">

	<form action="login.php" method="post">
		<ul class="a">
			<li>
				<input type="text" name="username" id="username" placeholder="Username"/>
			</li>
			<li>
				<input type="password" name="password" id="password" placeholder="Password"/>
			</li>
			<li>
				<input type="submit" value="Log In" class="bg-blue ui-button login"/>
			</li>
		</ul>
	</form>
</div>
<div id="signupform" class="rfloat">
	<form action="register.php" method="post">
		<table class="form very-small-font">
				<tr>
					<td class="register">Username:</td>
					<td class="register"><input type="text" name="username" class="textboxUI" placeholder="Username"/></td>
				</tr>
				<tr>
					<td class="register">Password:</td>
					<td><input type="password" name="password"  class="textboxUI" placeholder="Password"/></td>
				</tr>
				<tr>
					<td class="register">Just Once more:</td>
					<td><input type="password" name="password_again"  class="textboxUI" placeholder="Re-type Password"/></td>
				</tr>
				<tr>
					<td class="register">Your First Name:</td>
					<td><input type="text" name="first_name"  class="textboxUI" placeholder="First Name"/></td>
				</tr>
				<tr>
					<td class="register">And Last:</td>
					<td><input type="text" name="last_name"  class="textboxUI" placeholder="Last Name"/></td>
				</tr>
				<tr>
					<td class="register">College:</td>
					<td><input type="text" name="college"  class="textboxUI" placeholder="College"/></td>
				</tr>
				<tr>
					<div id="dobContainer"><td class="register">Birthday<td><?php include 'includes/date.php'; ?></td></div>
				</tr>
				<tr>
				<td class="register">You Are:</td>
				<td><input type="radio" id="male" value="Male" name="gender">Male<input type="radio" id="Female" name="gender" value="Female">Female</td>
				</tr>
				<tr>
					<td class="register">How can we reach you?</td>
					<td><input type="text" name="email"  class="textboxUI" placeholder="Email"/></td>
				</tr>
				<tr>
					<td colspan="2" align="right"><input type="submit" value="Register" class="ui-button bg-blue"></td>
					
				</tr>
			</table>
	</form>
</div>