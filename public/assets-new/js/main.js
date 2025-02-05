$(function () {
    routesSharedProject();
    $(document).on('click', '.nav-problem', function (e) {
        var problemMes = "A project is created to solve a problem.  If the project has not been created, then a problem cannot be identified to be solved.  The way to look at it, a project exists to solve a problem.  Please, go back to open a project or create a project in order to identify the problem to be solved"
        $(this).addClass('active')
        $("li .nav-link").not($(this)).removeClass('active');
        if ($(this).attr('href') == 'undefined') {
            $(this).attr('href', '')
            swalMessage(problemMes , 'Project Problem');
            return false;
        }
        if (!$(this).attr('href')) {
            swalMessage(problemMes , 'Project Problem');
        }
    })

    $(document).on('click', '.project-grid', function () {
        $(this).addClass('active')
        $("li .nav-link").not($(this)).removeClass('active');
        if ($(this).attr('href') == 'undefined') {
            $(this).attr('href', '')
            swalMessage(solutionMsg , 'Project Solution');
            return false;
        }
        localStorage.setItem("selected_problem", $(this).attr('href'));
        $('#nav-problem').attr('href', $(this).attr('href'))
    })


        $(document).on('click', '.nav-solution', function () {
            $(this).addClass('active')
            $("li .nav-link").not($(this)).removeClass('active');
            var solutionMsg = "A project is created to solve a problem.  A solution of problem is identified in that project to solve the identified problem.  Please, go back to open/create a project before identifying the solution for the problem"
            if ($(this).attr('href') == 'undefined') {
                $(this).attr('href', '')
                swalMessage(solutionMsg , 'Project Solution');
                return false;
            }
            if (!$(this).attr('href')) {
                swalMessage(solutionMsg , 'Project Solution');
            }
        })

    $(document).on('click', '.nav-solution-func', function () {
        $(this).addClass('active')
        $("li .nav-link").not($(this)).removeClass('active');
        var solutionFunMsg = "The existence of a project to solve a problem, enables a function to be executed to solve that project.The project itself is viewed as container that includes: problem, solution, and solution function.  In order to identify the solution function, go back to open or create a project."
        if ($(this).attr('href') == 'undefined') {
            $(this).attr('href', '')
            swalMessage(solutionFunMsg, 'Project Solution Function');
            return false;
        }
        if (!$(this).attr('href')) {
            swalMessage(solutionFunMsg , 'Project Solution Function');
        }
    })

    $(document).on('click', '.nav-varification', function () {
        $(this).addClass('active')
        $("li .nav-link").not($(this)).removeClass('active');
        var verification = "A project is created to solve a problem.  If is possible to verify the solution of the problem as well as the problem itself.Without the existence of a project to solve a problem, it is not natural to verify or validate the solution of that problem.  Please go back to open or create a project before validating any project elements."
        if ($(this).attr('href') == 'undefined') {
            $(this).attr('href', '')
            swalMessage(verification , 'Project Verification');
            return false;
        }
        if (!$(this).attr('href')) {
            swalMessage(verification , 'Project Verification');
            return false;
        }
    })

    $(document).on('click', '.nav-relationship', function () {
        $(this).addClass('active')
        $("li .nav-link").not($(this)).removeClass('active');
        var relationship = "A project container includes problem, solution, solution function, validation entities, and verification.All those are considered to be project elements.  It is possible to show the relationships of elements that make up a project.Go back to open or crate a project in order to identify the relationships of projects elements."

        if ($(this).attr('href') == 'undefined') {
            $(this).attr('href', '')
            swalMessage(relationship , 'Project Relationship');
            return false;
        }
        if (!$(this).attr('href')) {
            swalMessage(relationship , 'Project Relationship');
            return false;
        }
    })

    $(document).on('click', '.nav-report', function () {
        $(this).addClass('active')
        $("li .nav-link").not($(this)).removeClass('active');
        var report = "No project is created or opened yet, therefore no project report or result.Please, go back to open or create a project in order to view the project report or result."

        if ($(this).attr('href') == 'undefined') {
            $(this).attr('href', '')
            swalMessage(report , 'Project Report ');
            return false;
        }
        if (!$(this).attr('href')) {
            swalMessage(report ,'Project Report ');
            return false;
        }
    })



}) //END

$(document).ready(function () {
    var hrefp = localStorage.getItem("selected_problem");
    if (typeof hrefp !== 'undefined') {
        $('#nav-problem').attr('href', hrefp)
    }
    var hrefs = localStorage.getItem("sol");
    if (typeof hrefs !== 'undefined') {
        $('#nav-solution').attr('href', hrefs)
    }
    var hrefsolfun = localStorage.getItem("sol-fun");
    if (typeof hrefsolfun !== 'undefined') {
        $('.nav-solution-func').attr('href', hrefsolfun)
    }

    var hrefverification = localStorage.getItem("varification");
    
    if (typeof hrefverification !== 'undefined') {
        $('.nav-varification').attr('href', hrefverification)
    }
})
function swalMessage(problemMes , header) {
    swal({
        title: header,
        text: problemMes,
        type: "info",
        showCancelButton: true,
        confirmButtonColor: '#00A14C',
    });
    return false;
}

function logout() {
    localStorage.clear();
}

//Routes function
function routes(){
    $('.nav-problem').click(function(){
        $(this).attr('href' , ''); 
        localStorage.setItem("selected_problem", $('#problem_nav').attr('href'));   
        $(this).attr('href' ,$('#problem_nav').attr('href'))
    })
    $('.nav-solution').click(function(){
        $(this).attr('href' , ''); 
        localStorage.setItem("sol", $('#solution_nav').attr('href'));   
        $(this).attr('href' ,$('#solution_nav').attr('href'))
    })
    $('.nav-solution-func').click(function(){
        $(this).attr('href' , '');
        localStorage.setItem("sol-fun", $('#solution_fun_nav').attr('href'));   
        $(this).attr('href' ,$('#solution_fun_nav').attr('href'))
    })
    $('.verification').click(function(){
        $(this).attr('href' , '');
        localStorage.setItem("varification", $('#verification').attr('href'));   
        $(this).attr('href' ,$('#verification').attr('href'))
    })
    //Relation
    $('.nav-relationship').click(function(){
            $(this).attr('href' , '');
            localStorage.setItem("relationship", $('#relationship').attr('href'));   
            $(this).attr('href' ,$('#relationship').attr('href'))
    })
}

function routesSharedProject(){
    localStorage.setItem("varification",$('#verification').attr('href'));
    var hrefverification = localStorage.getItem("varification");        
    if (typeof hrefverification !== 'undefined') {
        $('.nav-varification').attr('href', hrefverification)
    }
}



