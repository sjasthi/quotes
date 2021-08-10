function takeshot() { 
            let div = 
                document.getElementById('capture'); 
  
            // Use the html2canvas 
            // function to take a screenshot 
            // and append it 
            // to the output div 
            html2canvas(div).then( 
                function (canvas) { 
                    document 
                    .getElementById('output') 
                    .appendChild(canvas); 
                }) 
        }    
   

    	function capture(){
    		html2canvas(document.getElementById("convert")).then(function(canvas){
    			 // Create an AJAX object
		        var ajax = new XMLHttpRequest();
		 
		        // Setting method, server file name, and asynchronous
		        ajax.open("POST", "save-capture.php", true);
		 
		        // Setting headers for POST method
		        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		 
		        // Sending image data to server
		        ajax.send("image=" + canvas.toDataURL("image/jpeg", 0.9));
		 
		        // Receiving response from server
		        // This function will be called multiple times
		        ajax.onreadystatechange = function () {
		 
		            // Check when the requested is completed
		            if (this.readyState == 4 && this.status == 200) {
		 
		                // Displaying response from server
		                console.log(this.responseText);
		            }
		        };
    		})
    	}
    	
