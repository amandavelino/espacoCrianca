<script src="./bower_components/jquery/dist/jquery.min.js"></script>
<script src="./bower_components/jquery.easing/js/jquery.easing.min.js"></script>
<script src="./js/smoothscroll.min.js"></script>
<script src="./bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
<?php /* Lightview */ ?>
<script type="text/javascript" src="./js/spinners/spinners.min.js"></script>
<script type="text/javascript" src="./js/lightview/lightview.js"></script>
<script>

    $(document).ready(function(){ 

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

        //Carregando os valores de cada artigo
        $(".link-mais").on("click", function(){

            var conteudo_load;
            var existe = false;
            if($(".box-loader-conteudo").length > 0){
                existe = true;
                console.log('O elemento SIM existe.');
            }else{
                console.log('O elemento NÃO existe.');
            }

            //id do item/article
            var id_string = $(this).closest("article").attr("id");
            var id_article = $("#" + id_string);

            //conteúdo a ser carregado
            var conteudo = id_article.find(".ss-conteudo-interno").html();
            
            //criando box-loader-conteudo
            var box_loader_conteudo = "<div class='box-loader-conteudo'><span class='btn-close'><i class='fa fa-times' aria-hidden='true'></i></span><div class='loader-conteudo'><div class='conteudo-load'></div></div></div>";            
            
            //box-loader mais próxima
            var box_loader = $(this).closest(".box-loader");
            //console.log(conteudo);
   
            //1 - Inserindo o box-loader-conteudo em .box-loader

            //Se já existe atualizando apenas o conteúdo... e não inserir novamente
            if(existe == false){
                box_loader.append(box_loader_conteudo);
                //2 - Depois de inserir .box_loader_conteudo no DOM, encontrando .conteudo-load 
                conteudo_load = box_loader.find(".conteudo-load");          
                //3 - Carregando o conteudo dentro de .conteudo-load
                conteudo_load.html(conteudo);  
            }else{
                conteudo_load.html(conteudo); 
            }

            //Depois que carregar o conteúdo animar .box-loader-conteudo

            //console.log();
            return false;           
        });

    });//
    
</script> 