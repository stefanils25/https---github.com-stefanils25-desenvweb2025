document.addEventListener("DOMContentLoaded", () => {

    const radios = document.querySelectorAll('.escala input[type="radio"]');

    if (radios.length === 0) return;

    // Adiciona evento a cada opção da escala
    radios.forEach(radio => {
        radio.addEventListener("change", () => {
            limparSelecao();
            marcarSelecionado(radio);
        });
    });

    // Remove classe dos outros labels
    function limparSelecao() {
        document.querySelectorAll(".escala label").forEach(label => {
            label.classList.remove("ativo");
        });
    }

    // Adiciona classe ao label selecionado
    function marcarSelecionado(radio) {
        const label = radio.closest("label");
        if (label) {
            label.classList.add("ativo");
        }
    }

});
