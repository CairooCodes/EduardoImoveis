<div id="addUserModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
  <div class="relative w-full h-full max-w-7xl md:h-auto">
    <!-- Modal content -->
    <form action="./controllers/add_product.php" method="post" enctype="multipart/form-data" class="relative bg-white rounded-lg shadow">
      <!-- Modal header -->
      <div class="flex items-start justify-between p-4 border-b rounded-t">
        <h3 class="text-xl font-semibold text-gray-900">
          Adicionar Produto
        </h3>
        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="addUserModal">
          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
        </button>
      </div>
      <!-- Modal body -->
      <div class="p-6 space-y-6">
        <div class="grid grid-cols-6 gap-6">
          <div class="col-span-6 sm:col-span-3">
            <label class="block mb-2 text-sm font-medium text-gray-900">Nome</label>
            <input type="text" name="name" id="name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="Nome do Produto" required="">
          </div>
          <div class="col-span-6 sm:col-span-3">
            <label for="last-name" class="block mb-2 text-sm font-medium text-gray-900">Preço</label>
            <input type="text" name="price" id="price" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="Valor" required="">
          </div>
          <div class="col-span-6 sm:col-span-3">
            <label for="categoria" class="block mb-2 text-md font-medium text-gray-900">Categoria</label>
            <a href="categorias.php" class="mb-2 text-sm font-medium text-gray-700"><i class="bi bi-plus-circle"></i> Adicionar Categoria</a>
            <select class="uppercase shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" name="categorie_id">
              <?php foreach ($categories as $categorie) { ?>
                <option value="<?php echo $categorie['id']; ?>"><?php echo $categorie['name']; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-span-6 sm:col-span-3">
            <label for="minmax-range" class="block mb-2 text-sm font-medium text-gray-900">Estrelas</label>
            <input id="minmax-range" name="stars" onchange="visibleStars();" type="range" min="0" max="5" value="0" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
            <div id="showStars" class="flex">
            </div>
            <script>
              let countStars;

              function visibleStars() {
                let concat = '';
                countStars = document.getElementById('minmax-range').value;
                countStars = parseInt(countStars);
                for (i = 0; i < 5; i++) {
                  if (i < countStars && countStars != 0) {
                    concat += '<svg style="color: #ffd700 !important" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" /></svg>'
                  } else {
                    concat += '<svg style="color: #ffd700 !important" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16"><path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" /></svg>'
                  }
                }
                document.getElementById('showStars').innerHTML = "";
                document.getElementById('showStars').innerHTML = concat;
              }
              visibleStars();
            </script>
          </div>
          <div class="col-span-6 sm:col-span-3">
            <label class="block mb-2 text-sm font-medium text-gray-900">Imagem</label>
            <input type="file" id="img" name="img">
          </div>
          <div class="col-span-6 sm:col-span-3">
            <label for="last-name" class="block mb-2 text-sm font-medium text-gray-900">Link</label>
            <input type="text" name="link" id="link" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="Link">
          </div>
        </div>
        <textarea name="description" id="description"></textarea>
        <input type="file" name="imagens[]" multiple>
        <!-- Modal footer -->
        <div class="flex items-center">
          <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Cadastrar Produto</button>
        </div>
    </form>
  </div>
</div>