<script type="text/javascript">
    function show_confirm()
    {
        return confirm("Are you sure you want to remove the lesson?");	
    }
    
    function selectBranch(){
    
 
        var selectedBranch = $("#selectBranch").find(':selected').attr('value');
    
        $.ajax({
            type: "GET",
            url: "getCoursesListByBranch/"+selectedBranch,
            data: "",
            success: function(msg){
                $("#selectCourse").html(msg);
               
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $("#tableList").html(xhr.responseText);
                alert(thrownError);
            }


        });
    
    }
    
    function selectCourse(){
    
 
        var selectedCourse = $("#selectCourse").find(':selected').attr('value');
    
        $.ajax({
            type: "GET",
            url: "getLessonByCourse/"+selectedCourse,
            data: "",
            success: function(msg){
                $("#tableList").html(msg);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $("#tableList").html(xhr.responseText);
                alert(thrownError);
            }


        });
    
    }
</script>
<div class="h_left"><h2>Lesson Management </h2></div>
<div class="seperator"></div>

<div class="add_new">
    <label>Select Branch:</label><select name="branch_id" id="selectBranch" onchange="selectBranch()">
         <option value="-1">Select a Branch to proceed</option>
       
        <?php foreach ($allBranches as $branch): ?>
            <option value="<?php echo $branch->branch_id; ?>"><?php echo $branch->branch_name; ?></option>
        <?php endforeach; ?>
    </select>
</div>
<div class="add_new">
    <label>Select course:</label>
    <select name="course_id" id="selectCourse" onchange="selectCourse()">
         <option value="-1">Select a Branch first</option>
       
    </select>
</div>

<div id="tableList">
   
</div>