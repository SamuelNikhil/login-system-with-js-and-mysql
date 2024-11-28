const form = document.querySelector("form"); // Ensure form ID is correctly targeted
const statusTxt = document.querySelector(".button-area span"); // Select span using its ID

    form.onsubmit = (e) => {
        e.preventDefault(); // Prevent form from submitting

        // Show the status message after clicking submit
        statusTxt.style.display = "block";
        
        let xmlhttp = new XMLHttpRequest(); //creating an xml object

        xmlhttp.open("POST", "include/login-inc.php", true);

        xmlhttp.onload = () =>{ //once ajax loaded
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200) { //if ajax response is 200 and ready status is 4 means there is no error


                let response = xmlhttp.response; //storing ajax response msg in response variable

                //Check if the response contains an error (like "Incorrect login info!")
                if(response.indexOf("Incorrect login info!") != -1 || response.indexOf("Incorrect Password info!")  != -1 || response.indexOf("Fill in all fields!")  != -1){
                    
                    statusTxt.style.color = "red";
                    setTimeout(()=>{
                        
                        //Reload page if there is error
                        location.reload();
                    }, 900);
                }else{
                    
                    form.reset();
                    setTimeout(()=>{
                        
                        //redirecting the page if there is no error
                        window.location.href = "main.html";
                        // Hide the status message
                        statusTxt.style.display = "none";
                    }, 1000);
                }
                
                statusTxt.innerText = response;
            }

        }

        const formData = new FormData(form);
        xmlhttp.send(formData);
    };