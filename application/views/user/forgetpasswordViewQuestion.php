<!DOCTYPE html>
<html>
<head>
	<title> Forget Password</title>
</head>
<body>


<form method="post" action="forgetpasswordCheckAnswer">
     <label for="question">Your Question Is :</label>
     <input type="text" size="50" id="question" name="question" value="<?php if(!empty($question[0]->question)) echo $question[0]->question; else echo set_value('question'); ?>" disabled/>
     <br/>


     <label for="answer">Please Enter Your Answer :</label>
     <input type="text" size="20" id="answer" name="answer" value="<?php echo set_value('answer'); ?>"/>
     <span style="color:red"> <?php echo form_error('answer'); ?> <?php if(!empty($wrongAnswerMsg)) echo $wrongAnswerMsg; ?> </span>
     <br/>

    <input type="hidden" size="50" id="question" name="question" value="<?php if(!empty($question[0]->question)) echo $question[0]->question; else echo set_value('question'); ?>" />

    
     <input type="submit" value="Add"/>
</form>

</body>
</html>