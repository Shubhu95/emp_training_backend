<p>Hi <?php echo ucfirst($user_details['first_name']); ?>, </p>
<p>Your have successfully submitted the quiz.</p>
<p>Course Name: <?php echo $quiz_details->course_title; ?></p>
<p>Quiz: <?php echo $quiz_details->quiz_title; ?></p>
<p class="card-text">
    <?php 
      echo get_phrase('you_got').' '.$total_correct_answers.' '.get_phrase('out_of').' '.$total_questions.' '.get_phrase('correct');
    ?>.
</p>
<p>You can check your detailed quiz result as attached below. </p>

<br>
<p>Thanking You!</p>
<p><b>vTrain</b></p>
