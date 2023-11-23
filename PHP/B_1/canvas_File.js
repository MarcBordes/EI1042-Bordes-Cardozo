function mostrarFoto(nodo, imagen) {
  var reader = new FileReader();
  reader.addEventListener("load", function () {
    imagen.src = reader.result;
  });
  reader.readAsDataURL(nodo.files[0]);
}

function getMousePos(canvas, evt) {
  var rect = canvas.getBoundingClientRect();
  return {
    x: evt.clientX - rect.left,
    y: evt.clientY - rect.top,
  };
}

function limpiar(context, canvas) {
  context.clearRect(0, 0, canvas.width, canvas.height);
}

function dibuja(context) {
  context.fillStyle = "rgb(200,0,0)";
  context.fillRect(20, 10, 40, 40);
}
function dibujaEnRaton(context, coors) {
  context.fillStyle = "rgb(200,200,0)";
  context.fillRect(coors.x, coors.y, 10, 31);
}
function activarCanvas(imagen){
   var canvas = document.querySelector("#sketchpad");
   var context = canvas.getContext("2d");
   canvas.addEventListener("click", function (evt) {
     coors = getMousePos(canvas, evt);
     dibujaEnRaton(context, coors);
   });
 
   document.querySelector("#dibujar").addEventListener("click", function () {
     dibuja(context);
   });
   document.querySelector("#copiar").addEventListener("click", function () {
     context.drawImage(imagen, 0, 0, 600, 500);
   });
   document.querySelector("#limpiar").addEventListener("click", function () {
     limpiar(context, canvas);
   });
   document.querySelector("#guardar").addEventListener("click", function () {
     imagen.src = canvas.toDataURL("image/png");
   });
}
function ready() {
  var imagen = null;
  var fichero = document.querySelector("#foto_cliente");
  var child = document.createElement("img");
  child.setAttribute("width", "600px");
  child.setAttribute("hight", "500px");
  child.setAttribute("background-color", "lightblue");
  child.setAttribute("id", "imagen");
  imagen = fichero.parentNode.appendChild(child);
  fichero.addEventListener("change", function (event) {
    if (fichero.files[0]["type"] == "image/png") 
      {mostrarFoto(this, imagen);
      }
    else alert("Seleccione una imagen PNG");
  });
  activarCanvas(imagen);


}

ready();
