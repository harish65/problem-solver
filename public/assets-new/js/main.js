$(function (){
    $(document).on('click','.nav-problem',function(e){ 
        if($(this).attr('href') == 'undefined'){
            $(this).attr('href' ,'') 
            swalMessage();
            return false;
        }
        if(!$(this).attr('href')){
            swalMessage();
        }
    })

    $(document).on('click','.project-grid',function(){
        if($(this).attr('href') == 'undefined'){
            $(this).attr('href','') 
            swalMessage();
            return false;
        }

        localStorage.setItem("selected_problem", $(this).attr('href'));
        $('#nav-problem').attr('href' , $(this).attr('href'))
    })


    $(document).on('click','.nav-solution',function(){ 
        
        if($(this).attr('href') == 'undefined'){
            $(this).attr('href','') 
            swalMessage();
            return false;
        }
        if(!$(this).attr('href')){
            swalMessage();
        }
    })

    $(document).on('click','.nav-solution-func',function(){ 
        if($(this).attr('href') == 'undefined'){
            $(this).attr('href','') 
            swalMessage();
            return false;
        }
        if(!$(this).attr('href')){
            swalMessage();
        }
    })

   
   
}) //END

$(document).ready(function(){
    var hrefp = localStorage.getItem("selected_problem");
        if(typeof hrefp !== 'undefined'){
            $('#nav-problem').attr('href' , hrefp)
        }
    

    var hrefs = localStorage.getItem("sol");
    if(typeof hrefs !== 'undefined'){
        $('#nav-solution').attr('href' , hrefs)
    }
    var hrefsolfun = localStorage.getItem("sol-fun");
    if(typeof hrefsolfun !== 'undefined'){
            $('.nav-solution-func').attr('href' , hrefsolfun)
    }

})

    
function swalMessage(){
    swal({
        title: "Please select project first", 
        type: "info",
        showCancelButton: true,
        confirmButtonColor: '#00A14C',
    });
    return false;
}

function logout(){
    localStorage.clear();
}

