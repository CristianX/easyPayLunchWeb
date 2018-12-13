
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
var fichero2;
var storageRef;
var imagenesFBRef;

var image_url='';

var downloadURL;


function inicializar(){
    fichero2=document.getElementById("fichero2");
    fichero2.addEventListener("change",subirImagenProducto, false);

    ficheroact=document.getElementById("ficheroact");
    ficheroact.addEventListener("change",subirImagenProducto, false);

    storageRef=firebase.storage().ref();

    imagenesFBRef=firebase.database().ref().child("Establecimiento/sdbhsdbvjnwihb/producto/");

}

function subirImagenProducto(){
     //self.aux='funciona';
    var imagenproducto=fichero2.files[0];
    var uploadTask=storageRef.child('Imagenes_Producto/'+imagenproducto.name).put(imagenproducto);
    document.getElementById("progresoproducto").className="";
    console.log('llego aca');
uploadTask.on('state_changed',
    function (snapshot){
        var barraProgreso=(snapshot.bytesTransferred/ snapshot.totalBytes)*100;
       document.getElementById("barra-de-producto").style.width=barraProgreso+ "%";
       
    },
    function (error){
        alert("hubo un error");

    },
    function (){
         downloadURL=uploadTask.snapshot.ref.getDownloadURL().then(function(downloadURL) {
         console.log("File available at", downloadURL);
          self.image_url=downloadURL;
           
           //$http.post("/addPromocion", {imagen: self.image_url});

          document.getElementById("progresoproducto").className="hidden";
          //document.getElementById("imagen").innerHTML=self.image_url; 
        });
        
    });
}
function subirImagenAactualizar(){
     //self.aux='funciona';
    var imagenproducto=ficheroact.files[0];
    var uploadTask=storageRef.child('Imagenes_Producto/'+imagenproducto.name).put(imagenproducto);
    document.getElementById("progresoact").className="";
    console.log('llego aca');
uploadTask.on('state_changed',
    function (snapshot){
        var barraProgreso=(snapshot.bytesTransferred/ snapshot.totalBytes)*100;
       document.getElementById("barra-de-act").style.width=barraProgreso+ "%";
       
    },
    function (error){
        alert("hubo un error");

    },
    function (){
         downloadURL=uploadTask.snapshot.ref.getDownloadURL().then(function(downloadURL) {
         console.log("File available at", downloadURL);
          self.image_url=downloadURL;
           
           //$http.post("/addPromocion", {imagen: self.image_url});

          document.getElementById("progresoact").className="hidden";
          //document.getElementById("imagen").innerHTML=self.image_url; 
        });
        
    });
}

