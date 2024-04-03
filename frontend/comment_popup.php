<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta
            http-equiv="X-UA-Compatible"
            content="IE=edge"
        />
        <meta
            name="viewport"
            content="width=device-width, 
                   initial-scale=1.0"
        />
        <style>
            .popup {
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(
                    0,
                    0,
                    0,
                    0.4
                );
                display: none;
            }
            .popup-content {
                background-color: white;
                margin: 10% auto;
                padding: 20px;
                border: 1px solid #888888;
                width: 30%;
                font-weight: bolder;
            }
            .popup-content button {
                display: block;
                margin: 0 auto;
            }
            .show {
                display: block;
            }
        </style>
    </head>

    <body>
    
        <h3>
            Create popup box using HTML and CSS
        </h3>
        <button id="myButton">Click me</button>
        <div id="myPopup" class="popup">
             <div class="popup-content">
            <form action="/action_page.php" class="form-container">
    			
  			  <label for="comment_text" style="font-size:10;text-align:center"><b>Add Comment</b></label>
    			<textarea name="comment_text" class="form-control border-3" id="exampleFormControlTextarea1" rows="6" style=" width: 100%; resize: none"></textarea>

    		 <button name="submit" type="submit" class="button-color button-width fs-5 btn btn-primary fw-bold">Submit</button>
             
    		<button id="closePopup">Close</button>
  			</form>
            </div>
        </div>

        <script>
            myButton.addEventListener(
                "click",
                function () {
                    myPopup.classList.add("show");
                }
            );
            closePopup.addEventListener(
                "click",
                function () {
                    myPopup.classList.remove(
                        "show"
                    );
                }
            );
            window.addEventListener( //when clicking outside the popup it closes
                "click",
                function (event) {
                    if (event.target == myPopup) {
                        myPopup.classList.remove(
                            "show"
                        );
                    }
                }
            );
        </script>
    </body>
</html>