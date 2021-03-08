$(function(){
    let button = $('#collapser-button')
    let nav_bar = $('.navbars-collapse')
    let links = $('#navbars-host li a')
    let admin_li = $('#navbars-host .nav-link.dropdown-toggle')
    
    // let link_active_before = $('#navbars-host li.nav-item a.nav-link.router-link-active.router-link-exact-active')
    // let activ = document.querySelector('#navbars-host li.nav-item a.nav-link.router-link-active.router-link-exact-active')
    

    // if(activ !== null){
    //     let activate = document.querySelector('#navbars-host li.nav-item a.nav-link.router-link-active.router-link-exact-active').parentNode
    // 	if (activate !== undefined) {
    //         $('#navbars-host li.nav-item.active').removeClass('active')
    //         activate.classList.add('active')
    //     }
    // }
    // if ($('#navbars-host .nav-link.dropdown-toggle').hasClass('router-link-active')) {
    // }


    // $(document).ready(function(){
    //     $(window).on('hashchange', function(e){
    //     })
    // })
    
    


    links.click(function(){
        
        // if ($(this).parent().hasClass('dropdown-menu')) {
        //     if($(this).parent().parent().hasClass('active')){
                
        //     }
        //     else{
        //         $('#navbars-host li.nav-item.active').removeClass('active')
        //         $(this).parent().parent().addClass('active')
        //     }
        // }
        // else{
        //     if($(this).parent().hasClass('active')){
                
        //     }
        //     else{
        //         $('#navbars-host li.nav-item.active').removeClass('active')
        //         $(this).parent().addClass('active')
        //     }
        // }


        

        
    })  

})

$(function(){
    let button = $('#collapser-button')
    let nav_bar = $('.navbars-collapse')

    $(document).click(function(event){
        // else if($('.navbar-collapse.show') !== undefined){
        //     button.hide()
        // }
    })  

})
