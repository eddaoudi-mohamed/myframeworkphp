
<h3>Register Form</h3> 
<?php $form =  app\core\form\Form::begin("/register" , "post") ?>
<?php echo $form->field($model , "name" ) ?>
<?php echo $form->field($model , "email")->emailField()?> 

<button type="submit">Register</button>
<?php echo app\core\form\Form::end() ?> 



<!-- <form action="/register" method="post"> 
    <input type="text" name="name" value="" id="">
    <input type="text" name="email" id=""> 
    <input type="submit" value="Register">
</form>  -->



<p>
 Alredy have Accounte?<a href="/login">sing in</a>
</p>
