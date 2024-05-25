@include('templates.header')

<x-navbar />

<h2 class="text-center">Register User</h2>
<br>
<form action="/create" method="post" class="form-group" style="width:70%; margin-left:15%;" action="/action_page.php">
@csrf   
   <label>Username:</label>
   <input type="text" class="form-control" placeholder="Enter Username" name="username"><br>

   <label>Email:</label>
   <input type="text" class="form-control" placeholder="Enter Email" name="email"><br>

   <label>Password:</label>
   <input type="password" class="form-control" placeholder="Enter Password" name="password"><br>

   <button type="submit" value="Add student" class="btn btn-primary">Submit</button>
</form>

@include('templates.footer')