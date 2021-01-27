$(function(){
    let button = $('#collapser-button')
    let nav_bar = $('.navbars-collapse')
    let links = $('#navbars-host li.nav-item a.nav-link')
    
    let link_active_before = $('#navbars-host li.nav-item a.nav-link.router-link-active.router-link-exact-active')
    let activ = document.querySelector('#navbars-host li.nav-item a.nav-link.router-link-active.router-link-exact-active').parentNode
    if(activ !== undefined){
    	$('#navbars-host li.nav-item.active').removeClass('active')
    	activ.classList.add('active')
    }
    
    


    links.click(function(){
        if($(this).parent().hasClass('active')){
        	
        }
        else{
        	$('#navbars-host li.nav-item.active').removeClass('active')
        	$(this).parent().addClass('active')
        }
        
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
