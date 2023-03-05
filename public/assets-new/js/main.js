$(function (){
    $(document).on('click','.nav-problem',function(e){ 

        var problemMes = "A project is created to solve a problem.  If the project has not been created, then a problem cannot be identified to be solved.  The way to look at it, a project exists to solve a problem.  Please, go back to open a project or create a project in order to identify the problem to be solved"
        if($(this).attr('href') == 'undefined'){
            $(this).attr('href' ,'') 

            swalMessage(problemMes);
            return false;
        }
        if(!$(this).attr('href')){
            swalMessage(problemMes);
        }
    })

    $(document).on('click','.project-grid',function(){
        
        if($(this).attr('href') == 'undefined'){
            $(this).attr('href','') 
            swalMessage(solutionMsg);
            return false;
        }
        localStorage.setItem("selected_problem", $(this).attr('href'));
        $('#nav-problem').attr('href' , $(this).attr('href'))
    })


    $(document).on('click','.nav-solution',function(){ 
        var solutionMsg = "A project is created to solve a problem.  A solution of problem is identified in that project to solve the identified problem.  Please, go back to open/create a project before identifying the solution for the problem"
        if($(this).attr('href') == 'undefined'){
            $(this).attr('href','') 
            swalMessage(solutionMsg);
            return false;
        }
        if(!$(this).attr('href')){
            swalMessage(solutionMsg);
        }
    })

    $(document).on('click','.nav-solution-func',function(){
        var solutionFunMsg = "The existence of a project to solve a problem, enables a function to be executed to solve that project.  The project itself is viewed as container that includes: problem, solution, and solution function.  In order to identify the solution function, go back to open or create a project."

        if($(this).attr('href') == 'undefined'){
            $(this).attr('href','') 
            swalMessage(solutionFunMsg);
            return false;
        }
        if(!$(this).attr('href')){
            swalMessage(solutionFunMsg);
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

    
function swalMessage(problemMes){
    swal({
        title: "No project created", 
        text: problemMes,
        type: "info",
        showCancelButton: true,
        confirmButtonColor: '#00A14C',
    });
    return false;
}

function logout(){
    localStorage.clear();
}

