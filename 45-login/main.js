const username = document.getElementById('username');
const password = document.getElementById('password');
const button = document.getElementById('button');
const createSessionButton = document.getElementById('create-session-button');
const logoutButton = document.getElementById('logout-button');

button.addEventListener('click', (e) => {
    e.preventDefault();
    const data = {
        username: username.value,
        password: password.value
    };
    console.log(data);
});

createSessionButton.addEventListener('click', () => {
    console.log('Crear sesión clicado');
    // Aquí puedes agregar la lógica para crear una nueva sesión
});

logoutButton.addEventListener('click', () => {
    console.log('Cerrar sesión clicado');
    // Aquí puedes agregar la lógica para cerrar sesión
});

function hizoClick() {
    window.location.href = '../home.html';
}