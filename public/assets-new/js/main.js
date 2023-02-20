$(function (){
    $(document).on('click','.nav-problem',function(){
        if($(this).attr('href') ==  ''){       
            swalMessage();
        }
    })
    $(document).on('click','.grid-p-l',function(){
        localStorage.setItem("selected_problem", $(this).attr('href'));
        $('.nav-problem').attr('href' , $(this).attr('href'))
    })
}) //END

$(document).ready(function(){
    var href = localStorage.getItem("selected_problem");
    $('.nav-problem').attr('href' , href)
})



//////////Solution/////////////

$(function (){
    $(document).on('click','.nav-sol',function(){
        if($(this).attr('href') ==  ''){       
            swalMessage();
        }
    })
    $(document).on('click','.grid-p-l',function(){
        localStorage.setItem("selected_sol", $(this).attr('href'));
        $('.nav-sol').attr('href' , $(this).attr('href'))
    })
}) //END

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