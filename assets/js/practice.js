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
	
});



