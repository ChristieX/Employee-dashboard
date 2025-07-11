$(document).ready(function () {
    function loadEmployeeData() {
        $.ajax({
            url: "./server/load-employee.php",
            type: 'POST',
            success: function (data) {
                $('.employee-data').html(data);
            }
        });
    };
    loadEmployeeData();

    $(document).on("click", ".delete-btn",function(){
        if(!confirm("Are you sure you want to delete this employee?")) {
            return;
        }
        var employeeId = $(this).data("id");
        var element = $(this);
        $.ajax({
            url: "./server/delete-employee.php",
            type: 'POST',
            data: { id: employeeId },
            success: function (response) {
                if (response == 1) {
                    element.closest("tr").fadeOut();
                    alert("Employee deleted successfully.");
                } else {
                    alert("Error deleting employee.");
                }
            }
        });
    })

$(document).on("click", ".edit_btn", function () {
    var employeeId = $(this).data("id");

    $('.modal-body').html(''); 

    $.ajax({
        url: "./server/edit-employee-form.php",
        type: 'POST',
        data: { id: employeeId },
        success: function (data) {
            $('.modal-body').html(data);
        }
    });
});


    $(document).on("click", "#update-employee", function (e) {
        e.preventDefault();
        var empId = $("#empId").val();
        var first_name = $("#first_name").val();
        var last_name = $("#last_name").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        var dob = $("#dob").val();
        var gender = $("#gender").val();
        var skills = [];
        $(".skill-row").each(function () {
            var id = $(this).find(".skill-id").val();
            var skill = $(this).find(".skill").val();
            var level = $(this).find(".level").val();
            if (skill && level) {
                skills.push({ id: id || null, skill: skill, level: level });
            }
        });
        $.ajax({
            url: "./server/save-edit.php",
            type: 'POST',
            data: {
                id: empId,
                first_name: first_name,
                last_name: last_name,
                email: email,
                phone: phone,
                dob: dob,
                gender: gender,
                skills: JSON.stringify(skills)
            },
            success: function (response) {

                if (response == 1) {
                $(this).find('.modal-body').html('');
                    loadEmployeeData();
                } else {
                    alert("Error updating employee.");
                }
            }
        });
    });

    $("#live-search").on("keydown", function () {
        var input = $(this).val().toLowerCase();
        if(input!=""){
            $.ajax({
                url: "./server/load-employee.php",
                type: 'POST',
                data: input !== "" ? { search: input } : {},
                success: function (data) {
                    $('.employee-data').html(data);
                }
            });
        }
    });
});