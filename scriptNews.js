document.addEventListener("DOMContentLoaded", function () {
    const commentForm = document.getElementById("commentForm");
    const commentList = document.getElementById("commentList");

    commentForm.addEventListener("submit", function (event) {
        event.preventDefault();

        const nombre = document.getElementById("nombre").value;
        const comentario = document.getElementById("comentario").value;

        if (nombre.trim() === "" || comentario.trim() === "") {
            alert("Por favor, completa todos los campos.");
            return;
        }

        const li = document.createElement("li");
        li.innerHTML = `<strong>${nombre}:</strong> ${comentario}`;
        commentList.appendChild(li);

        document.getElementById("nombre").value = "";
        document.getElementById("comentario").value = "";
    });
});
