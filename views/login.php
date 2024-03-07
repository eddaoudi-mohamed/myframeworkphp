
<h3>Login Form</h3>
<?php $form =  app\core\form\Form::begin("/login" , "post") ?>
<?php echo $form->field($model , "name" ) ?>
<br/>
<?php echo $form->field($model , "email")->emailField()?> 

<button type="submit">Login</button>
<?php echo app\core\form\Form::end() ?> 

<p>
 I dont have an Accounte?<a href="/register">sing up</a>
</p>