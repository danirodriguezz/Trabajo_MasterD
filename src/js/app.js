document.addEventListener("DOMContentLoaded", function() {
    eventListener();
    darkMode();
});

function eventListener() {
    const mobileMenu = document.querySelector(".mobile-menu");
    mobileMenu.addEventListener("click", function() {
        navegacionResponsive();
    });
    const metodoContacto = document.querySelectorAll("input[name='contacto[contacto]']");
    console.log(metodoContacto);
    metodoContacto.forEach(input => input.addEventListener("click", mostrarMetodosContacto));

};

function navegacionResponsive() {
    const navegacion =  document.querySelector(".navegacion");
    navegacion.classList.toggle("mostrar");
};

function darkMode() {
    const preferDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    
    if(preferDarkMode.matches) {
        document.body.classList.add("dark-mode");
    } else {
        document.body.classList.remove("dark-mode");
    };
    
    preferDarkMode.addEventListener("change", function() {
        if(preferDarkMode.matches) {
            document.body.classList.add("dark-mode");
        } else {
            document.body.classList.remove("dark-mode");
        };
    })
};

function mostrarMetodosContacto(e) {
    const contactoDiv = document.querySelector("#contacto");
    if(e.target.value === "Teléfono") {
        contactoDiv.innerHTML = `
        <label for="telefono">Teléfono</label>
        <input type="tel" placeholder="Tu Teléfono" id="telefono" name="contacto[telefono]">
        <p>Eliga la fecha y hora para ser contactado</p>
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="contacto[fecha]">
        <label for="hora">Hora:</label>
        <input type="time" id="hora" min="9:00" max="18:00" name="contacto[hora]">
        `;
    } else {
        contactoDiv.innerHTML = `
        <label for="emial">E-mail</label>
        <input type="email" placeholder="Tu E-mail" id="email" name="contacto[email] required" >
        `;
    };
};