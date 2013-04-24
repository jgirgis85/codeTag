$(document).ready(function() {
	
	// activating the selectable question answers
	
	$( "#selectable" ).selectable({
		selected: function(){
    		$(".ui-selected", this).each(function(){
     	 	$(this).find('.outerCircle').removeClass('outerCircle').addClass('outerCircleSelected');
     	 	answer_ID = $(this).attr('id');
     	 	question_ID = $(this).find('input[name=question_ID]').val();
     	 	lesson_ID = $(this).find('input[name=lesson_ID]').val();
     	 	quiz_ID = $(this).find('input[name=quiz_ID]').val();
     	 	course_ID = $(this).find('input[name=course_ID]').val();
     	 	oldPosition = $(this).find('input[name=position]').val();
     	 	position = parseInt(oldPosition)+1;
     	 	
     	 	 window.location =   baseUrl+'quizzes/view/'+quiz_ID+'/'+lesson_ID+'/'+course_ID+'/'+position+'/'+question_ID+'/'+answer_ID;
		           
		                	
		               
     	 	
     	 	
     	 	
    });
	
	}
	});
	
	
	
	//hover effect for the selectable answers
	
	$('.answerItem').hover(function(){$(this).find('.outerCircle').css('background-color','#3ea9a1')},function(){$(this).find('.outerCircle').css('background-color','#aaa');});
	
	
	// deleteting question
	
	//check that this is not the only button in the quiz and if yes display a warning
	
	$('button[name="deleteQuestion"]').click(function(){
		
		question_ID = $(this).attr('id');
		quiz_ID = $('input[name="quiz_ID"]').val();
		lesson_ID = $('input[name="lesson_ID"]').val();
		course_ID = $('input[name="course_ID"]').val();
		
		$.ajax({
		            type:       'POST',
		            url:        baseUrl+'quizzes/countQuestions/'+quiz_ID,
		            dataType:   'json',
		            success:    function(json)
		            {
		                if (json.status == "success")   
		                {
		                    if(json.count== 1)
		                    {
		                    	// dismiss the current modal
								$('#DeleteQuestionModel'+question_ID).modal('hide');
								
								//display a warning modal
								$('#DeleteQuestionWarningModel').modal('show');
								
		                    }else{
		                    	
		                    	// run the delete question function in the quizzes controller
		                    	$.ajax({
		                    		
						            type:       'POST',
						            url:        baseUrl+'quizzes/deleteQuestion/'+question_ID+'/'+quiz_ID+'/'+lesson_ID+'/'+course_ID,
						            dataType:   'json',
						            success:    function(json)
						            {
						                if (json.status == "success")   
						                {
						                	//redirect to the quiz page
						                	window.location = baseUrl+'quizzes/edit/'+quiz_ID+'/'+lesson_ID+'/'+course_ID;
						                	
						                }
						                
						                else  
						                
						                { 
						                		alert('Error occured please try again later')
						                }
						                
						             }
						             
						            });
		                     }
		                   
		                }
		                else  
		                { 
		                		alert('Error occured please try again later')
		                }
		            }
		        });
	});
	
	// activating the sorting function for the edit quiz page and changing the question position in the database
	
	$( "#sortable" ).sortable({stop:function(i) {
		$.ajax({
		type: "GET",
		dataType:   'json',
		url: baseUrl+'quizzes/sortQuestions',
		data: $("#sortable").sortable("serialize")
		,success:    function(json)
		            {
		                if (json.status == "success")   
		                {
		                	
		                }
		               }
		});
	
	}
	});
	// define baseUrl
	
	baseUrl = 'http://localhost:888/codeTag/'
	
	// saving notes
	
	$('button[name="save"]').click(function(){
		video_ID = $('input[name="video_ID"]').val();
		user_ID = $('input[name="user_ID"]').val();
		body = $('textarea[name="note"]').val();
		if(noteFlag = $('input[name="note_flag"]').val()=='exist'){
			
			//get the note id  
			
			
			//update it with the new body
			var data = {body: body,video_ID:video_ID,user_ID:user_ID};
			
			$.ajax({
		            type:       'POST',
		            url:        baseUrl+'notes/update',
		            data:       data,
		            dataType:   'json',
		            beforeSend : function (){
					$("p.note_feedback_saving").css('visibility','visible');
				},complete : function(){
					$("p.note_feedback_saving").css('visibility','hidden');
				},
		            success:    function(json)
		            {
		                if (json.status == "success")   
		                {
		                    	
		 						
		                   
		                }
		                else  
		                { 
		                		alert('Error occured please try again later')
		                }
		            }
		        });
			
		}else if(noteFlag = $('input[name="note_flag"]').val()=='no_note'){
			
			user_ID = $('input[name="user_ID"]').val();
			
			var data = {body: body,user_ID:user_ID,video_ID:video_ID};
			
			$.ajax({
		            type:       'POST',
		            url:        baseUrl+'notes/add',
		            data:       data,
		            dataType:   'json',
		            beforeSend : function (){
					$("p.note_feedback_saving").css('visibility','visible');
				},complete : function(){
					$("p.note_feedback_saving").css('visibility','hidden');
				},
		            success:    function(json)
		            {
		                if (json.status == "success")   
		                {
		                    	$('input[name="note_flag"]').val('exist');
		 						
		                   
		                }
		                else  
		                { 
		                		alert('Error occured please try again later')
		                }
		            }
		        });
			
			
		}
	})
	
	
	
	// validation rules for registeration form
	$("#signup").validate({
		
		rules:{
		
			fname:"required",
			lname:"required",
			username:"required",
		
		email:{
		
			required:true,
			email: true
		
		},
		
		passwd:{
		
			required:true,
			minlength: 8
		
		}
			},
		
			errorClass: "help-inline"
		
		});
		
		/////////// end of registeration form validation rules
		
		
	///////////////////// validation for the edit course dialog
	$("#editCourse").validate({
		
		rules:{
		
			img:"required",
			title:"required",
			desc:"required"
		},
		
			errorClass: "help-inline"
		
		});
		
	/////////// end of edit course dialog validation rules	
		
	///////////////////// validation for the Add course dialog
	$("#addCourse").validate({
		
		rules:{
		
			img:"required",
			title:"required",
			desc:"required"
		},
		
			errorClass: "help-inline"
		
		});
		
	/////////// end of Add course dialog validation rules		
	///////////////////// validation for the edit lesson dialog
	$("#editLesson").validate({
		
		rules:{
		
			img:"required",
			title:"required",
			desc:"required"
		},
		
			errorClass: "help-inline"
		
		});
		
	/////////// end of edit lesson dialog validation rules	
		
	///////////////////// validation for the Add lesson dialog
	$("#addLesson").validate({
		
		rules:{
		
			img:"required",
			title:"required",
			desc:"required"
		},
		
			errorClass: "help-inline"
		
		});
		
	/////////// end of Add lesson dialog validation rules		
	///////////////////// validation for the Add Video dialog
	$("#addVideo").validate({
		
		rules:{
		
			sec:"required",
			min:"required",
			title:"required",
			desc:"required",
			embedUrl:"required"
		},
		
			errorClass: "help-inline"
		
		});
		
	/////////// end of Add Video dialog validation rules
			
	///////////////////// validation for the Add Video dialog
	$("#editVideo").validate({
		
		rules:{
		
			sec:"required",
			min:"required",
			title:"required",
			desc:"required",
			embedUrl:"required"
		},
		
			errorClass: "help-inline"
		
		});
		
	/////////// end of Add Video dialog validation rules	
		
	///////////////////// validation for the Add Quiz dialog
	$("#addQuiz").validate({
		
		rules:{
		
			question:"required",
			rAns:"required",
			title:"required",
			wAns1:"required",
			wAns2:"required",
			wAns3:"required"
		},
		
			errorClass: "help-inline"
		
		});
		
	/////////// end of Add Quiz dialog validation rules	
		
	///////////////////// validation for the edit Question dialog
	$("#editQuestion").validate({
		
		rules:{
		
			question:"required",
			rAns:"required",
			wAns1:"required",
			wAns2:"required",
			wAns3:"required"
		},
		
			errorClass: "help-inline"
		
		});
		
	/////////// end of edit Question dialog validation rules	
		
	///////////////////// validation for the edit Question dialog
	$("#addQuestion").validate({
		
		rules:{
		
			question:"required",
			rAns:"required",
			wAns1:"required",
			wAns2:"required",
			wAns3:"required"
		},
		
			errorClass: "help-inline"
		
		});
		
	/////////// end of edit Question dialog validation rules		
   	
   	
 });



