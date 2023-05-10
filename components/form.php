<section>
    <div class="pt-10 form">
        <div class="lg:w-2/3 pt-20 px-4 pb-8 mx-auto lg:pb-16">
            <div class="swiper-slide shadow-inner bg-color1 bg-opacity-70 shadow-md rounded-xl border border-gray-300">
                <div class="max-w-screen-xl px-4 pt-8 mx-auto mb-3 text-center">
                    <h1 class="mt-5 text-gray-900 font-semibold lg:text-3xl text-xl">Nossos anuncios podem chegar primeiro para você</h1>
                </div>
                <form action="./admin/controllers/add_lead.php" method="post">
                    <div class="lg:flex justify-center m-5">
                        <div>
                            <input class="lg:w-72 w-full mr-5 mt-2 bg-gray-50 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus-ring-2 focus:ring-blue-500 focus:ring-opacity-20 rounded-md px-3 py-3 text-sm text-gray-800 placeholder-gray-600 focus:outline-none transition duration-400 ease-in-out" type="text" name="name" id="name" placeholder="Nome">
                        </div>
                        <div>
                            <input class="lg:w-72 w-full  mr-5 mt-2 bg-gray-50 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus-ring-2 focus:ring-blue-500 focus:ring-opacity-20 rounded-md px-3 py-3 text-sm text-gray-800 placeholder-gray-600 focus:outline-none transition duration-400 ease-in-out" type="email" name="email" id="email" placeholder="Email">
                        </div>
                        <input type="hidden" value="1" name="type">
                        <div>
                            <button class="lg:mt-0 mt-2 flex justify-center items-center lg:w-14 w-full lg:h-14 h-12 bg-color1 rounded-lg lg:rounded-full">
                                <svg class="hidden lg:block" width="30" height="30" viewBox="0 0 25 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M25 11.5L0 0L4.5 11.5L0 22.5L25 11.5Z" fill="white" />
                                </svg>
                                <span class="lg:hidden" type="submit">Enviar</span>
                            </button>
                        </div>
                    </div>
                </form>
                <div class="font-sm text-center mb-5">
                    <small class="text-gray-900">Concordo em receber mensagens e compartilhar meus dados pessoais com a Eduardo Imóveis. Consulte nossas <a href="#" class="text-blue-800">Políticas de Privacidade</a></small>
                </div>
            </div>
        </div>
    </div>
</section>