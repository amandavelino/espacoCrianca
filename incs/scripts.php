<script src="./bower_components/jquery/dist/jquery.min.js"></script>
<script src="./bower_components/jquery.easing/js/jquery.easing.min.js"></script>
<script src="./js/smoothscroll.min.js"></script>
<script src="./bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
<?php /* Lightview */ ?>
<script src="./js/spinners/spinners.min.js"></script>
<script src="./js/lightview/lightview.js"></script>
<?php /* Maps API Javascript */ ?>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCKUSCO1t-zVQWRsD9JdHZjnT36ZjPvy7M"></script>
<!-- Caixa de informação -->
<script src="./js/infobox.js"></script>
<script src="./js/markerclusterer.js"></script>
<script src="./js/mapa.js"></script>
<script>

    var botaoMenu = $("#menu-mobile"),
        menu = $("#menu-principal"),
        logo = $(".logo > img"),
        scrolled = $(window).scrollTop();

    function checarPosicaoScroll(){

        if(scrolled > 196){
            if(!$("body").hasClass("smaller-menu")){
                $("body").addClass("smaller-menu");
            }//
         }else{
            if($("body").hasClass("smaller-menu")){
                $("body").removeClass("smaller-menu");
            }//
         }//end if

    }// end checarPosicaoScroll

    function goToSessao(e)
    {
        var sessao = $(e).offset().top - 90; //offset das sessões margin-top para o header
        $("html, body").stop().animate({ scrollTop: sessao }, 700, "easeInOutQuad"); //easeInOutQuart
    }//end goToSessao

    function openMenu()
    {
        menu.css({zIndex: 10});
        menu.stop().animate({
            opacity: 1
        }, 500, "easeInOutQuad", function() {
            $(this).addClass("menu-ativo");
        }); 
    }//end openMenu
    
    function closeMenu()
    {
        menu.stop().animate({
            opacity: 0
        }, 500, "easeInOutQuad", function() {
            $(this).removeClass("menu-ativo").css({zIndex: -10, display: "none"});
        });  
    }//end closeMenu

    $(document).ready(function(){ 

        //Menu
        menu.css({"opacity": 0});
        botaoMenu.click(function(){
            if(!menu.hasClass("menu-ativo")){
                menu.css({display: "block"});
                openMenu();
            }else{
                closeMenu();
            }
            return false;
        });//

        //Ao clicar nos links do menu
        $("#menu-principal a").click(function()
        {
            var e = $(this).attr("href");
            goToSessao(e);
            closeMenu();
            return false;
        });

        //Slider Principal
        $('.owl-home').owlCarousel({
            autoplay: true,
            autoplayTimeout: 7000,
            autoplayHoverPause: true,
            center: true,
            smartSpeed: 500,
            items: 1,
            nav: false,
            dots: true,
            navText: ['<i class="fa fa-chevron-left fa-3x" aria-hidden="true"></i>','<i class="fa fa-chevron-right fa-3x" aria-hidden="true"></i>'],
            loop: true,
            margin: 0
        });

        //Sessão Sobre nossa escola
        var id_loader = 0;

        //Carregando os valores de cada artigo nas versões 992px em diante
        $(".link-others").on("click", function(){

            var altura;
            var conteudo_load;
            //id do item/article
            var id_string = $(this).closest("article").attr("id");
            var id_article = $("#" + id_string);
            
            //console.log("id_anterior: ", id_anterior);

            //conteúdo a ser carregado
            var conteudo = id_article.find(".ss-conteudo-interno").html();
            //criando box-loader-conteudo
            var box_loader_conteudo = "<div class='box-loader-conteudo'><span class='btn-close'><i class='fa fa-times' aria-hidden='true'></i></span><div class='loader-conteudo'><div class='conteudo-load'></div></div></div>";            
            //box-loader mais próxima
            var box_loader = $(this).closest(".box-loader");
            //console.log(conteudo);

            //Functions
            function openBoxLoaderConteudo()
            {
                box_loader.find(".box-loader-conteudo").stop().animate({
                    height: altura 
                }, 500, "easeInOutQuad", function() {

                    $(this).find(".btn-close").on("click", function(){
                        console.log('Clicou 1');
                        $(this).closest(".box-loader-conteudo").stop().animate({
                            height: 0
                        }, 500, "easeInOutQuad", function() {
                            $(this).remove();
                        });  
                    });// 
                
                });
            }//

            function calcularAltura(){
                //3- Pegando a altura da box antes de mostrar o conteúdo
                altura = box_loader.find(".conteudo-load").height();
                altura += 90;
                //console.log(altura);
            }//

            function closeOpenBoxLoaderConteudo(){                
                box_loader.find(".box-loader-conteudo").stop().animate({
                    height: 0
                }, 500, "easeInOutQuad", function() {

                    //inserindo id 
                    $(this).attr("id", "loader-" + id_string);
                    id_loader = $(this).attr("id");
                    console.log("id_loader atual c/ elem: ", id_loader);   

                    // Carrega o conteúdo
                    $(this).find(".conteudo-load").html(conteudo);  
                    calcularAltura();
                    //Depois abre .box-loader-conteudo
                    openBoxLoaderConteudo();           
                });             
            }//

            function closeBoxLoaderConteudo(){
                altura = 0;
                box_loader.find(".box-loader-conteudo").stop().animate({
                    height: altura
                }, 500, "easeInOutQuad", function() {
                    $(this).remove();
                });             
            }//            

            //Não existe .box-loader-conteudo, então inserindo no html
            if(!$(this).closest(".box-loader").find(".box-loader-conteudo").length > 0){

                //1 - Inserindo o box-loader-conteudo em .box-loader
                $(this).closest(".box-loader").append(box_loader_conteudo);  

                //Inserindo id 
                $(this).closest(".box-loader").find(".box-loader-conteudo").attr("id", "loader-" + id_string);
                id_loader = $(this).closest(".box-loader").find(".box-loader-conteudo").attr("id");

                //2 - Carregando o conteudo dentro de .conteudo-load antes de abrir .box-loader-conteudo
                $(this).closest(".box-loader").find(".conteudo-load").html(conteudo);  

                //Depois que carregar o conteúdo abre .box-loader-conteudo
                calcularAltura();
                openBoxLoaderConteudo();                  

            }else{
                //Existe box-loader-conteudo, então carregar conteúdo novo
                id_loader = $(this).closest(".box-loader").find(".box-loader-conteudo").attr("id");

                if(id_loader != "loader-" + id_string){
                    //Fecha .box-loader-conteudo e abre novamento com o parâmetro
                    closeOpenBoxLoaderConteudo();  
                }               

            }//end else

            return false;           
        });//

        //Carregando os valores de cada artigo nas versões abaixo de 992px - mobile
        $(".link-mobile").on("click", function(){

            var artigo          = $(this).closest("article"),
                heightHeader    = artigo.find(".ss-conteudo-interno header").height(),
                heightP         = artigo.find(".ss-conteudo-interno p").height() + 30, //30: margens top e bottom de <p>
                heightTotal     = heightHeader + heightP;

            if(!artigo.hasClass("opened")){
                $(this).closest(".ss-item-conteudo").find(".ss-conteudo-interno").stop().animate({
                    height: heightTotal
                }, 500, "easeInOutQuad", function() {
                    artigo.addClass("opened");
                    $(this).closest(".ss-item-conteudo").find(".link-mobile").html("Saiba mais<i class='fa fa-caret-up' aria-hidden='true'></i>");
                }); 
            }else{
                $(this).closest(".ss-item-conteudo").find(".ss-conteudo-interno").stop().animate({
                    height: 170
                }, 500, "easeInOutQuad", function() {
                    artigo.removeClass("opened");
                    $(this).closest(".ss-item-conteudo").find(".link-mobile").html("Saiba mais<i class='fa fa-caret-down' aria-hidden='true'></i>");
                }); 
            }//
            
            return false;
        });//

        //Testemunhos
        $('.owl-testemunhos').owlCarousel({
            autoplay: true,
            autoplayTimeout: 7000,
            autoplayHoverPause: true,              
            items: 1,
            nav: true,
            navText: ['<i class="fa fa-arrow-circle-left fa-2x" aria-hidden="true"></i>','<i class="fa fa-arrow-circle-right fa-2x" aria-hidden="true"></i>'],
            loop: true,
            margin: 0
        });        

    });//
    
    $(window).on('scroll', function(){

        //atualizando a posição quando o scroll ocorrer...
        scrolled = $(window).scrollTop();
        checarPosicaoScroll();

    });//on scroll

</script> 