<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Busca de Produtos em Cards com JavaScript e TailwindCSS</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.15/tailwind.min.css">
</head>

<body>
  <div class="container mx-auto py-8">
    <div class="w-full mb-4">
      <label for="busca" class="block text-gray-700 font-bold mb-2">Buscar produtos:</label>
      <input type="text" id="busca" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Digite o termo de busca...">
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <img src="https://images.unsplash.com/photo-1523217582562-09d0def993a6" alt="Produto 1" class="w-full h-48 object-cover">
        <div class="p-4">
          <h3 class="font-bold text-xl mb-2">Produto 1</h3>
          <p class="text-gray-700 mb-4">Descrição do Produto 1</p>
          <p class="text-gray-700 text-lg font-bold mb-2">R$ 19,99</p>
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
            Adicionar ao carrinho
          </button>
        </div>
      </div>

      <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <img src="https://images.unsplash.com/photo-1593642634378-bf2590e8ab6c" alt="Produto 2" class="w-full h-48 object-cover">
        <div class="p-4">
          <h3 class="font-bold text-xl mb-2">Produto 2</h3>
          <p class="text-gray-700 mb-4">caixa do Produto 2</p>
          <p class="text-gray-700 text-lg font-bold mb-2">R$ 29,99</p>
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
            Adicionar ao carrinho
          </button>
        </div>
      </div>

      <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <img src="https://images.unsplash.com/photo-1519681393784-d120267933ba" alt="Produto 3" class="w-full h-48 object-cover">
        <div class="p-4">
          <h3 class="font-bold text-xl mb-2">Produto 3</h3>
          <p class="text-gray-700 mb-4">Descrição do Produto 3</p>
          <p class="text-gray-700 text-lg font-bold mb-2">R$ 39,99</p>
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
            Adicionar ao carrinho
          </button>
        </div>
      </div>
      <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <img src="https://images.unsplash.com/photo-1529321885785-5a810fda9662" alt="Produto 4" class="w-full h-48 object-cover">
        <div class="p-4">
          <h3 class="font-bold text-xl mb-2">Produto 4</h3>
          <p class="text-gray-700 mb-4">Descrição do Produto 4</p>
          <p class="text-gray-700 text-lg font-bold mb-2">R$ 49,99</p>
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
            Adicionar ao carrinho
          </button>
        </div>
      </div>

      <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <img src="https://images.unsplash.com/photo-1533086816-eb2d9337d231" alt="Produto 5" class="w-full h-48 object-cover">
        <div class="p-4">
          <h3 class="font-bold text-xl mb-2">Produto 5</h3>
          <p class="text-gray-700 mb-4">Descrição do Produto 5</p>
          <p class="text-gray-700 text-lg font-bold mb-2">R$ 59,99</p>
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
            Adicionar ao carrinho
          </button>
        </div>
      </div>

      <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <img src="https://images.unsplash.com/photo-1514173840967-6c01c0bc5a92" alt="Produto 6" class="w-full h-48 object-cover">
        <div class="p-4">
          <h3 class="font-bold text-xl mb-2">Produto 6</h3>
          <p class="text-gray-700 mb-4">Descrição do Produto 6</p>
          <p class="text-gray-700 text-lg font-bold mb-2">R$ 69,99</p>
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
            Adicionar ao carrinho
          </button>
        </div>
      </div>
    </div>
    <div id="mensagem-nenhum-resultado" class="mt-4 bg-yellow-100 text-yellow-900 p-4 rounded-lg hidden">
      Nenhum resultado encontrado para a busca.
    </div>
  </div>
  <script>
    const inputBusca = document.getElementById('busca');
    const mensagemNenhumResultado = document.getElementById('mensagem-nenhum-resultado');

    inputBusca.addEventListener('keyup', () => {
      const termoBusca = inputBusca.value.toLowerCase();
      const cards = document.querySelectorAll('.grid > div');
      let resultadosEncontrados = 0;

      cards.forEach(card => {
        const titulo = card.querySelector('h3').textContent.toLowerCase();
        const descricao = card.querySelector('p:nth-of-type(1)').textContent.toLowerCase();

        if (titulo.includes(termoBusca) || descricao.includes(termoBusca)) {
          card.style.display = 'block';
          resultadosEncontrados++;
        } else {
          card.style.display = 'none';
        }
      });

      if (resultadosEncontrados === 0) {
        mensagemNenhumResultado.style.display = 'block';
      } else {
        mensagemNenhumResultado.style.display = 'none';
      }
    });
  </script>
</body>

</html>