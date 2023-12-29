/**
 * Obtener datos meteorológicos y mostrarlos en la página así como hacer uso de la API DE CHUCK NORRIS.
 *
 * Esta función asincrónica utiliza la API de el-tiempo.net para obtener datos meteorológicos
 * de una ubicación específica y muestra la información en la página web. También maneja errores
 * en caso de que la obtención de datos no sea exitosa.
 *
 * @return {void}
 * @throws {Error} Si no se pueden obtener las datos meteorológicos.
 * @author Elias Cardozo <al405647@uji.es>
 * @author Marc Bordes <al405682@uji.es>
 * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * @version 1.0
 */


async function obtenirDadesMeteorologiques() {
    const apiUrl = 'https://www.el-tiempo.net/api/json/v2/provincias/48/municipios/48020';

    try {
        const response = await fetch(apiUrl);

        if (!response.ok) {
            throw new Error('No s\'ha pogut obtenir les dades meteorològiques.');
        }

        const dades = await response.json();
        var father = document.getElementById("papa");
        var child = document.createElement("p");
        var child_image = document.createElement("img");
        child_image.setAttribute("width", "80px");
        var estado = "Tiempo: " + dades.stateSky.description + "\nHumedad: " + dades.humedad + "\nTemperatura: " + dades.temperatura_actual + "ºC";

        /*src=`${getIcon(data.stateSky.id)}.svg`*/
        var link = 'https://www.el-tiempo.net' + dameLink(dades.stateSky.id) + '.svg';
        console.log(link);
        child_image.setAttribute("src", link);
        console.log(dades)
        child.innerText = estado;
        father.appendChild(child);
        father.appendChild(child_image);
    } catch (error) {
        console.error('Error:', error.message);
    }
}

// Executar la funció al carregar la pàgina
obtenirDadesMeteorologiques();
/*Esta función es la que estaba en la página de eltiempo.net, son los autores y propietarios */
function dameLink(codigoIcono) {
    const folderImages = "/themes/eltiempo-theme/assets/img/weather-static/";
    let icons = { rain: ["25", "25n", "44", "45", "46", "44n", "45n", "46n"], thunderstorms: ["64", "63", "62", "61", "54", "53", "52", "51", "64n", "63n", "62n", "61n", "54n", "53n", "52n", "51n"], snow: ["74", "73", "72", "71", "36", "35", "34", "33", "74n", "73n", "72n", "71n", "36n", "35n", "34n", "33n"], cloudy: ["16", "15", "14", "16n", "15n", "14n"], "partly-cloudy-day-rain": ["23", "24", "26", "43"], "partly-cloudy-night-rain": ["23n", "24n", "26n", "43n"], "clear-day": ["11"], "clear-night": ["11n"], "partly-cloudy-day": ["17", "13", "12"], "partly-cloudy-night": ["17n", "13n", "12n"], "fog-day": ["81", "82"], "fog-night": ["81n", "82n"] };
    for (let [code, values] of Object.entries(icons)) {
        if (values.includes(codigoIcono)) {
            return `${folderImages}${code}`
        }
    } return `${folderImages}clear-day`
};

let aside = document.createElement("aside");
document.body.appendChild(aside);

// Hacer una petición fetch a la API de Chuck Norris esta no es asíncrona por decisión del equipo
fetch("https://api.chucknorris.io/jokes/random")
    .then(response => response.json()) // Convertir la respuesta a JSON
    .then(data => {
        // Mostrar el chiste en el elemento <aside>
        aside.textContent = data.value;
    })
    .catch(error => {
        console.error(error);
    });