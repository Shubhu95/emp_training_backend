<script type="text/javascript">
//saving the current progress and starting from the saved progress
var newProgress;
var savedProgress;
var currentProgress = '<?php echo lesson_progress($lesson_id); ?>';
var lessonType = '<?php echo $lesson_details['lesson_type']; ?>';

<?php

if(!empty($provider))
{
   $provider=$provider;
}

else
{
   $provider='';
}

?>

var videoProvider = '<?php echo $provider; ?>';


function markThisLessonAsCompleted(lesson_id) {
  var progress;
  if ($('input#'+lesson_id).is(':checked')) {
    progress = 1;
  }else{
    progress = 0;
  }
  $.ajax({
    type : 'POST',
    url : '<?php echo site_url('user/save_course_progress'); ?>',
    data : {lesson_id : lesson_id, progress : progress},
    success : function(response){
      currentProgress = response;
    }
  });
}


var timer = setInterval(function(){
  console.log('Current Progress is '+currentProgress);
  if (lessonType == 'video' && videoProvider == 'html5' && currentProgress != 1) {
    getCurrentTime();
  }
}, 1000);

$(document).ready(function() {
  if (lessonType == 'video' && videoProvider == 'html5') {
    var totalDuration = document.querySelector('#player').duration;

    if (currentProgress == 1 || currentProgress == totalDuration) {
      document.querySelector('#player').currentTime = 0;
    }else {
      document.querySelector('#player').currentTime = currentProgress;
    }
  }
});
var counter = 0;
player.on('canplay', event => {
  if (counter == 0) {
    if (currentProgress == 1) {
      document.querySelector('#player').currentTime = 0;
    }else{
      document.querySelector('#player').currentTime = currentProgress;
    }
  }
  counter++;
});

function getCurrentTime() {
  var lesson_id = '<?php echo $lesson_id; ?>';
  newProgress = document.querySelector('#player').currentTime;
  var totalDuration = document.querySelector('#player').duration;

  console.log('Current Progress is '+currentProgress);
  console.log('New Progress is '+newProgress);

  if (newProgress != savedProgress && newProgress > 0 && currentProgress != 1) {

    // if the user watches the entire video the lesson will be marked as seen automatically.
    if (totalDuration == newProgress) {
      newProgress = 1;
      $('input#'+lesson_id).prop('checked', true);
    }

    // update the video prgress here.
    $.ajax({
      type : 'POST',
      url : '<?php echo site_url('user/save_course_progress'); ?>',
      data : {lesson_id : lesson_id, progress : newProgress},
      success : function(response){
        savedProgress = response;
      }
    });
  }
}

// playr.onprogress = function() {
//   console.log(player.currentTime);
// 	if(document.querySelector('#player').currentTime != 0){
//  		console.log(document.querySelector('#player').currentTime);
//  	}
// };
</script>
