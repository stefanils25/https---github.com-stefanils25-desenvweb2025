document.addEventListener("DOMContentLoaded", () => {
    const radios = document.querySelectorAll('.escala input[type="radio"]');

    if (radios.length === 0) return;

    radios.forEach(radio => {
        radio.addEventListener("change", () => {
            limparSelecao();
            marcarSelecionado(radio);
        });
    });

    function limparSelecao() {
        document
            .querySelectorAll(".escala label.ativo")
            .forEach(label => label.classList.remove("ativo"));
    }

    function marcarSelecionado(radio) {
        const label = radio.closest("label");
        if (!label) return;

        label.classList.add("ativo");
    }
});
