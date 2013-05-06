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
		errorStatus = false;
		var ideContent = editor.getValue();	
		var practice_ID = $('input[name="practice_ID"]').val();
		var data = {practice_ID: practice_ID};
		$.ajax({
		type: "POST",
		dataType:   'json',
		url: baseUrl+'practice/getHighestPriorityCount',
		data: data
		,success:    function(json)
		            {
		                if (json.status == "success")   
		                {
		                	var highestPriority = json.priority;
		                	
		                	for (var i=1; i<=highestPriority; i++)
							  {
							  	
							  	data = {currentPriority: i};
							  	// get rules for the current priority from database
							  	$.ajax({
								type: "POST",
								dataType:   'json',
								url: baseUrl+'practice/getRules',
								data: data
								,success:    function(json)
								            {
								                if (json.status == "success")   
								                {
								                	json.currentRules.forEach(function(){
								                		//get rule and error
								                		rule = json.currentRules[0].rule;
								                		error = json.currentRules[0].error;
								                		//check if rule exists in the IDE content
								                		if (ideContent.indexOf(rule)== -1) {
														  //append errors to hidden div
														  $('#errors').append('<p>'+error+'</p>')
														  errorStatus = true;
														} else {
														 
														}
								                		
								                	})
								                	
								                }
								                
								             }
								       });
							  	
							  	
							  }//end for each current priority
							if(errorStatus == true){alert('me')}  
		                }
		                
		               }
		              
		});
		
	});
	
});



