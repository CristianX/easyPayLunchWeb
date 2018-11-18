var config = {
    apiKey: "AIzaSyDtjxwx6zB76-MXCprMmVDbPuHIW_J-qB0",
    authDomain: "easy-pay-lunch.firebaseapp.com",
    databaseURL: "https://easy-pay-lunch.firebaseio.com",
    projectId: "easy-pay-lunch",
    storageBucket: "easy-pay-lunch.appspot.com",
    messagingSenderId: "560229221564"
  };
  firebase.initializeApp(config);
  
window.onload=inicializar;
var fichero;
var storageRef;
var imagenesFBRef;

var image_url='';

var downloadURL;


function inicializar(){
    fichero=document.getElementById("fichero");
    fichero.addEventListener("change",subirImagenAfirebase, false);
    storageRef=firebase.storage().ref();

    imagenesFBRef=firebase.database().ref().child("Establecimiento/jbuywbeijwnvkj/food_station/producto");

}


function subirImagenAfirebase(){
    var imagenASubir=fichero.files[0];
    var uploadTask=storageRef.child('Imagenes_Producto/'+imagenASubir.name).put(imagenASubir);
    document.getElementById("progreso").className="";

uploadTask.on('state_changed',
    function (snapshot){
        var barraProgreso=(snapshot.bytesTransferred/ snapshot.totalBytes)*100;
       document.getElementById("barra-de-progreso").style.width=barraProgreso+ "%";
       
    },
    function (error){
        alert("hubo un error");

    },
    function (){
         downloadURL=uploadTask.snapshot.ref.getDownloadURL().then(function(downloadURL) {
         console.log("File available at", downloadURL);
          self.image_url=downloadURL;
          document.getElementById("progreso").className="hidden";
        });
        
    });
}