jQuery(document).ready(function ($) {

    function loadCustomers(page = 1) {
        let search = $("#cmp-search").val();

        $("#cmp-table-body").html("<tr><td colspan='6'>Loading...</td></tr>");

        $.ajax({
            url: cmp_ajax_obj.ajax_url,
            type: "POST",
            data: {
                action: "cmp_fetch_customers",
                search: search,
                page: page
            },
            success: function (response) {

                let html = "";

                if (response.data.length > 0) {
                    $.each(response.data, function (i, c) {
                        html += `
                        <tr>
                            <td>${c.name}</td>
                            <td>${c.email}</td>
                            <td>${c.phone}</td>
                            <td>${c.dob}</td>
                            <td>${c.age}</td>
                            <td>${c.city}</td>
                            <td>${c.country}</td>
                        </tr>`;
                    });
                } else {
                    html = `<tr><td colspan="6">No customers found.</td></tr>`;
                }

                $("#cmp-table-body").html(html);

                // Pagination
                let pag_html = "";
                for (let i = 1; i <= response.total_pages; i++) {
                    let active = (i == page) ? "cmp-active" : "";
                    pag_html += `<a href="#" class="cmp-page-btn ${active}" data-page="${i}">${i}</a> `;
                }

                $("#cmp-pagination").html(pag_html);
            }
        });
    }

    loadCustomers();

    $("#cmp-search").on("keyup", function () {
        loadCustomers(1);
    });

    $(document).on("click", ".cmp-page-btn", function (e) {
        e.preventDefault();
        loadCustomers($(this).data("page"));
    });

});
