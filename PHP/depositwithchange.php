<form method="POST" action="https://bank2.cloudcoin.global/deposit_with_change">
<input type="hidden" id="stack" name="stack">

<div>
Account: <br>
<input name="account" size="50"><br>
Private Key: <br>
<input name="pk" size="50"><br><br>
Amount:<br>
<input type="text" id="amount" size="50" name="amount">
</div>
<div>
<br>
</div>
<div>
<br>
Select a text file:
<input type="file" id="fileInput"><br><br>
</div>
<button class="btn btn-large btn-success">POST Stack (after you choose File)</button>
</form>

<pre id="fileDisplayArea"><pre>		
		

	</pre></pre></div>
	  
	  
	  
	  <script>
	  
	  
	  window.onload = function() {
		var fileInput = document.getElementById('fileInput');
		var fileDisplayArea = document.getElementById('fileDisplayArea');

		fileInput.addEventListener('change', function(e) {
			var file = fileInput.files[0];
			//var textType = ([a-zA-Z0-9\s_\\.\-:])+(.stack)$ );

		//	if (file.type.match(textType)) {
				var reader = new FileReader();

				reader.onload = function(e) {
					fileDisplayArea.innerText = reader.result;
					var str = reader.result;
					str.replace(/\s/g, '');
					str = str.replace(/[^\x20-\x7E]/gmi, "");
					stack.value = str;
				}

				reader.readAsText(file);	
			//} else {
			//	fileDisplayArea.innerText = "File not supported!"
			//}
		});
}

	  
	  </script>
	  