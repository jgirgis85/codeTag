$(document).ready(function() {
	
	//////////////////////////////// code editor ///////////////////////////////////////
	 var delay;
	var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
        mode: 'text/html',
        theme:'monokai',
        autoCloseTags: true
      });
      
      editor.on("change", function() {
        clearTimeout(delay);
        delay = setTimeout(updatePreview, 300);
      });
      
      function updatePreview() {
        var previewFrame = document.getElementById('preview');
        var preview =  previewFrame.contentDocument ||  previewFrame.contentWindow.document;
        preview.open();
        preview.write(editor.getValue());
        preview.close();
      }
      setTimeout(updatePreview, 300);
      
      
      //check for practice answer
	
	$('button[name="check"]').click(function(){
		$('#errors').empty();
		var ideContent = editor.getValue();	
		var practice_ID = $('input[name="practice_ID"]').val();
		var data = {practice_ID: practice_ID,ideContent:ideContent};
		$.ajax({
		type: "POST",
		dataType:   'json',
		url: baseUrl+'practice/checkErrors',
		data: data
		,success:    function(json)
		            {
		                if (json.status == "success")   
		                {
		                	//if no errors found turn background to green and display congratulations
		                	//and change button to get back
		                	//and disable IDE
		                	//save result for this user in the practice result table(if result for this user already exist update it)
		                	 if(json.errors == ""){
		                	 	$('.sessionListBottomFlex').css('background-color','#468847');
		                	 	$('#errors').append('<h4>Congratulations you passed this task !</h4>')
		                	 	$('button[name="check"]').remove();
		                	 	$('#checkBtn').append('<button name="back" class="btn btn-warning">Back</button>')
		                	 	editor.setOption("readOnly", "nocursor");
		                	 	// set this practice as completed for the logged in user
		                	 	var data = {status:'completed',practice_ID:practice_ID}; 
		                	 	$.ajax({
									type: "POST",
									dataType:   'json',
									url: baseUrl+'practice/savePracticeResult',
									data: data
									,success:    function(json)
									            {
									                if (json.status == "success")   
									                {
									                	
									                	
									                	
									                	
									                }
									             
									             }
									             
									     });
		                	 	
		                	}else
		                	 //if there is errors append them to the footer and turn background red
		                	 {
		                	 	$('.sessionListBottomFlex').css('background-color','#c94843')
		                	 	for (var x=0; x < json.errors.length; x++) {
								   $('#errors').append('<p><span class="bigDot">&#8901; </span>'+json.errors[x]+'</p>');
								 };
		                	 	
		                	 }
		                }
		                
		               }
		              
		});
		
	});
	
});



