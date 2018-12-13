

var config = {
    apiKey: "AIzaSyDtjxwx6zB76-MXCprMmVDbPuHIW_J-qB0",
    authDomain: "easy-pay-lunch.firebaseapp.com",
    databaseURL: "https://easy-pay-lunch.firebaseio.com",
    projectId: "easy-pay-lunch",
    storageBucket: "easy-pay-lunch.appspot.com",
    messagingSenderId: "560229221564"
  };
  firebase.initializeApp(config);
  

  firebase.database().ref('Establecimiento/jbuywbeijwnvkj/food_station/producto/').on('value', function(snapshot) {

    var value = snapshot.val();
    var htmls = []; 
    $.each(value, function(index, value){
        if(value) {
            htmls.push('<tr>\
                <td><center>'+ value.nombre +'</center</td>\
                <td><center>'+ value.precio +'</center</td>\
                <td><center><img src='+ value.urlImagen +' style="height:50px; width:50px;"></center</td>\
                <td><center><a data-toggle="modal" data-target="#update-modal" class="btn btn-success updateData" data-id="'+index+'">Actualizar</a>\
                <a data-toggle="modal" data-target="#remove-modal" class="btn btn-danger removeData" data-id="'+index+'">Eliminar</a>\
                </center</td>\
            </tr>');
        } 
        document.getElementById("tbody").innerHTML=htmls;      
        
    });
    
});