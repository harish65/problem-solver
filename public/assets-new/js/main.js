$(function () {
    $(document).on('click', '.nav-problem', function (e) {
        var problemMes = "A project is created to solve a problem.  If the project has not been created, then a problem cannot be identified to be solved.  The way to look at it, a project exists to solve a problem.  Please, go back to open a project or create a project in order to identify the problem to be solved"
        $(this).addClass('active')
        $("li .nav-link").not($(this)).removeClass('active');
        if ($(this).attr('href') == 'undefined') {
            $(this).attr('href', '')
            swalMessage(problemMes);
            return false;
        }
        if (!$(this).attr('href')) {
            swalMessage(problemMes);
        }
    })

    $(document).on('click', '.project-grid', function () {
        $(this).addClass('active')
        $("li .nav-link").not($(this)).removeClass('active');
        if ($(this).attr('href') == 'undefined') {
            $(this).attr('href', '')
            swalMessage(solutionMsg);
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
            swalMessage(solutionMsg);
            return false;
        }
        if (!$(this).attr('href')) {
            swalMessage(solutionMsg);
        }
    })

    $(document).on('click', '.nav-solution-func', function () {
        $(this).addClass('active')
        $("li .nav-link").not($(this)).removeClass('active');
        var solutionFunMsg = "The existence of a project to solve a problem, enables a function to be executed to solve that project.The project itself is viewed as container that includes: problem, solution, and solution function.  In order to identify the solution function, go back to open or create a project."
        if ($(this).attr('href') == 'undefined') {
            $(this).attr('href', '')
            swalMessage(solutionFunMsg);
            return false;
        }
        if (!$(this).attr('href')) {
            swalMessage(solutionFunMsg);
        }
    })

    $(document).on('click', '.nav-varification', function () {
        $(this).addClass('active')
        $("li .nav-link").not($(this)).removeClass('active');
        var verification = "A project is created to solve a problem.  If is possible to verify the solution of the problem as well as the problem itself.Without the existence of a project to solve a problem, it is not natural to verify or validate the solution of that problem.  Please go back to open or create a project before validating any project elements."
        if ($(this).attr('href') == 'undefined') {
            $(this).attr('href', '')
            swalMessage(verification);
            return false;
        }
        if (!$(this).attr('href')) {
            swalMessage(verification);
            return false;
        }
    })

    $(document).on('click', '.nav-relationship', function () {
        $(this).addClass('active')
        $("li .nav-link").not($(this)).removeClass('active');
        var relationship = "A project container includes problem, solution, solution function, validation entities, and verification.All those are considered to be project elements.  It is possible to show the relationships of elements that make up a project.Go back to open or crate a project in order to identify the relationships of projects elements."

        if ($(this).attr('href') == 'undefined') {
            $(this).attr('href', '')
            swalMessage(relationship);
            return false;
        }
        if (!$(this).attr('href')) {
            swalMessage(relationship);
            return false;
        }
    })

    $(document).on('click', '.nav-report', function () {
        $(this).addClass('active')
        $("li .nav-link").not($(this)).removeClass('active');
        var report = "No project is created or opened yet, therefore no project report or result.Please, go back to open or create a project in order to view the project report or result."

        if ($(this).attr('href') == 'undefined') {
            $(this).attr('href', '')
            swalMessage(report);
            return false;
        }
        if (!$(this).attr('href')) {
            swalMessage(report);
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
function swalMessage(problemMes) {
    swal({
        title: "No project created",
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

