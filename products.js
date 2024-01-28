 //DOMContentLoaded is used to make sure that the whole html is loaded before applying javascript

 function showAlert(message) {
    alert(message);
  }
  
  document.addEventListener('DOMContentLoaded', function() {
  
      /* Get the plushies and stickers links by using their class
       name (categories that are not filled yet) */
       const plushies = document.querySelector('#plushies');
       const stickers = document.querySelector('#stickers');
  
  
      //when the user click on the plushies category link the following event should happen (alert message)
      plushies.addEventListener('click', (event) => {
        event.preventDefault(); 
  /*       console.log("Plushies link clicked");*/      
        //this js method prevents the default bahvaior to a link which is following the URL 
        showAlert("Coming Soon");
      });
  
   //when the user click on the stickers category link the following event should happen (alert message)
   stickers.addEventListener('click', (event) => {
      event.preventDefault(); 
  /*     console.log("Stickers link clicked");*/    
      showAlert("Coming Soon");
    });
    });
  
