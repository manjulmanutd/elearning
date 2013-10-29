<p>Hello,</p>
 <p>&nbsp;&nbsp;&nbsp;&nbsp;A new session has been booked. Details here:</p>
 <p>Course: <?php echo $this->trainee_model->getCourseNameById($courseId)->course_name;?></p>
 <p>Lesson: <?php echo $this->trainee_model->getLessonNameById($courseId)->lesson_name;?></p>
 <p>Training Date: <?php echo $booking_date;?></p>
 <p>Timeslot: <?php echo $this->trainee_model->getTrainingNameById($timeslot)->start_time." to ".
                                                               $this->trainee_model->getTrainingNameById($timeslot)->end_time;?></p>
<br/>

 <p>Thanks</p>