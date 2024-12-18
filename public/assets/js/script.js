/*!
 * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
 * Copyright 2013-2023 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
 */
//
// Scripts
//

window.addEventListener("DOMContentLoaded", (event) => {
    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector("#sidebarToggle");
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener("click", (event) => {
            event.preventDefault();
            document.body.classList.toggle("sb-sidenav-toggled");
            localStorage.setItem(
                "sb|sidebar-toggle",
                document.body.classList.contains("sb-sidenav-toggled")
            );
        });
    }
});

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    //Admin - Department Module
    $(document).on("click", "#department_edit_btn", function () {
        const departmentId = $(this).data("id");
        const departmentName = $(this).data("name");
        const departmentStatus = $(this).data("status");

        $("#edit_department_name").val(departmentName);
        $("#edit_department_status").val(departmentStatus);

        $("#departmentEditForm").attr(
            "action",
            "/admin/departments/" + departmentId
        );
    });

    $(document).on("click", "#department_delete_btn", function () {
        var id = $(this).data("id");
        if (id) {
            var form = $("#departmentDeleteForm");
            form.attr("action", "/admin/departments/" + id);
        }
    });
    //Admin - Department Head Module

    $(document).on("click", "#department_head_edit_btn", function () {
        var departmentHeadId = $(this).data("id");
        var url = $(this).data("url");

        if (departmentHeadId) {
            var editUrl = url;
            editUrl = editUrl.replace(":id", departmentHeadId);

            $.ajax({
                url: editUrl,
                type: "GET",
                success: function (response) {
                    $("#edit_department").val(response.department_id);
                    $("#edit_employee_name").val(response.name);
                    $("#edit_email").val(response.email);

                    $("#departmentHeadEditForm").attr(
                        "action",
                        "/admin/department-heads/" + response.id
                    );
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                },
            });
        }
    });

    $(document).on("click", "#department_head_delete_btn", function () {
        var id = $(this).data("id");
        if (id) {
            var form = $("#departmentHeadDeleteForm");
            form.attr("action", "/admin/department-heads/" + id);
        }
    });

    $(document).on("click", "#weekly_update_delete_btn", function () {
        var id = $(this).data("id");
        if (id) {
            var form = $("#WeeklyUpdateDeleteForm");
            form.attr("action", "/employee/weekly-updates/" + id);
        }
    });

    $(document).on("click", ".view-btn", function () {
        var weeklyUpdateId = $(this).data("id");
        var url = $(this).data("url");

        if (weeklyUpdateId) {
            var viewUrl = url;
            viewUrl = viewUrl.replace(":id", weeklyUpdateId);

            $.ajax({
                url: viewUrl,
                type: "GET",
                success: function (response) {
                    console.log(response);

                    const content =
                        response.content !== null ? response.content : "--";

                    const file = response.file !== null ? response.file : "";
                    const downloadLink =
                        response.file !== null
                            ? `/assets/image/uploads/weeklyupdates/${response.file}`
                            : "#";
                    console.log(response);
                    $("#view_emp_name").html(response.user.name);
                    $("#view_dept_name").html(response.department.name);
                    $("#view_created_at").html(response.formatted_created_at);
                    $("#view_note_content").html(content);
                    $("#view_note_attachement")
                        .attr("href", downloadLink)
                        .text(file);
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                },
            });
        }
    });

    //clear modal data when close popup
    $(".modal").on("hidden.bs.modal", function () {
        $(".modal-backdrop").remove();
        $(this).find("form").trigger("reset");
    });
});
