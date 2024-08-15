document.addEventListener('DOMContentLoaded', function() {
    // Função para carregar e parsear o CSV
    Papa.parse('empresas.csv', {
        download: true,
        header: true,
        complete: function(results) {
            const tabelaEmpresas = document.querySelector('#empresaTable tbody');
            
            results.data.forEach(empresa => {
                let row = tabelaEmpresas.insertRow();
                row.insertCell(0).textContent = empresa.cnpj;
                row.insertCell(1).textContent = empresa.nome;

                // Adiciona o evento de clique para abrir o modal
                row.addEventListener('click', function() {
                    // Limpa o CNPJ removendo pontos, barras e traços
                    const cnpjLimpo = limparCNPJ(empresa.cnpj);
                    fetchEmpresaData(cnpjLimpo);
                });
            });
        }
    });
});

// Função para limpar o CNPJ
function limparCNPJ(cnpj) {
    return cnpj.replace(/[.\-/]/g, ''); // Remove pontos, barras e traços
}

// function fetchEmpresaData(cnpj) {
//     const proxyUrl = 'https://cors-anywhere.herokuapp.com/'; // Proxy público para evitar CORS
//     const apiUrl = `https://receitaws.com.br/v1/cnpj/${cnpj}`;

//     fetch(proxyUrl + apiUrl)
//         .then(response => response.json())
//         .then(data => {
//             // Preenche os dados no modal
//             document.getElementById('empresaNome').textContent = data.nome;
//             document.getElementById('empresaAtividade').textContent = data.atividade_principal[0].text;

//             let socios = data.qsa.map(socio => `${socio.nome} (${socio.qual})`).join(', ');
//             document.getElementById('empresaSocios').textContent = socios;

//             document.getElementById('empresaEmail').textContent = data.email;
//             document.getElementById('empresaTelefone').textContent = data.telefone;

//             // Abre o modal
//             var modal = new bootstrap.Modal(document.getElementById('empresaModal'));
//             modal.show();
//         })
//         .catch(error => console.error('Erro ao buscar dados:', error));
// }


function fetchEmpresaData(cnpj) {
    // Chamada à API da ReceitaWS com o CNPJ limpo
    fetch(`https://receitaws.com.br/v1/cnpj/${cnpj}`)
        .then(response => response.json())
        .then(data => {
            // Preenche os dados no modal
            document.getElementById('empresaNome').textContent = data.nome;
            document.getElementById('empresaAtividade').textContent = data.atividade_principal[0].text;

            let socios = data.qsa.map(socio => `${socio.nome} (${socio.qual})`).join(', ');
            document.getElementById('empresaSocios').textContent = socios;

            document.getElementById('empresaEmail').textContent = data.email;
            document.getElementById('empresaTelefone').textContent = data.telefone;

            // Abre o modal
            var modal = new bootstrap.Modal(document.getElementById('empresaModal'));
            modal.show();
        })
        .catch(error => console.error('Erro ao buscar dados:', error));
}
