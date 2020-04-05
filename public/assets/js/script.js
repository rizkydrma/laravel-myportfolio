document.addEventListener("DOMContentLoaded", () => {
    //Inisiasi title penting untuk pengkondisian untuk menentukan controller yang akan di gunakan
    let title = document.getElementsByTagName("title");
    title = title[0].text.toLowerCase();

    // NOTIFICATION SWEETALERT
    // ambil text/pesan di dalam tag yang mengganadung data-flashdata
    const flashdata = document
        .querySelector(".flashdata")
        .getAttribute("data-flashdata");
    if (flashdata) {
        // jika terdapat text success
        if (flashdata.includes("Success")) {
            Swal.fire({
                type: "success",
                text: flashdata
            });
        } else {
            Swal.fire({
                type: "error",
                text: flashdata
            });
        }
    }

    // DELETE
    const btnDeletes = document.querySelectorAll(".btn-delete");
    btnDeletes.forEach(btnDelete => {
        btnDelete.addEventListener("click", function(e) {
            e.preventDefault();
            let href = this.dataset.id;
            Swal.fire({
                title: "Hapus Data",
                text: "Apa kamu yakin ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus!"
            }).then(result => {
                if (result.value) {
                    let form = document.getElementById(`form-${href}`);
                    form.submit();
                }
            });
        });
    });

    // DELTE MULTIPLE
    if (
        title.includes("tag") == true ||
        title.includes("category") == true ||
        title.includes("user") == true ||
        title.includes("post") == true ||
        title.includes("source") == true
    ) {
        const checkAll = document.getElementById("checkbox-all");
        const checkbox = document.querySelectorAll(".sub-check");
        checkAll.addEventListener("click", function() {
            checkbox.forEach(check =>
                check.checked == true
                    ? (check.checked = false)
                    : (check.checked = true)
            );
        });
        const btnDeleteAll = document.getElementById("btn-deleteAll");
        btnDeleteAll.addEventListener("click", function() {
            const id = [];
            checkbox.forEach(check => {
                // jika checkbox true push data ke dalam array
                if (check.checked == true) {
                    id.push(check.dataset.id);
                }
            });
            // cek apakah array tersebut kosong
            if (id.length <= 0) {
                alert("Plese select row");
            } else {
                const confirmation = confirm("Are you sure to delete this row");
                // jika confirmasi true
                if (confirmation) {
                    // gabungkan array agar dapat di proses delete
                    const checkSelected = id.join(",");

                    // cek controller yang akan digunakan
                    if (title.includes("tag")) {
                        let route = "tag";
                        // panggil fungsi multiple delete
                        multipleDelete(route, checkSelected);
                    } else if (title.includes("category")) {
                        let route = "category";
                        // panggil fungsi multiple delete
                        multipleDelete(route, checkSelected);
                    } else if (title.includes("user")) {
                        let route = "user";
                        // panggil fungsi multiple delete
                        multipleDelete(route, checkSelected);
                    } else if (title.includes("post")) {
                        let route = "post-comment";
                        // panggil fungsi multiple delete
                        multipleDelete(route, checkSelected);
                    } else if (title.includes("source")) {
                        let route = "source-comment";
                        // panggil fungsi multiple delete
                        multipleDelete(route, checkSelected);
                    }
                }
            }
        });
    }
    // Fungsi ajax delete multiple data
    function multipleDelete(route, checkSelected, options) {
        $.ajax({
            url: `/${route}/deleteAll`,
            method: "get",
            data: {
                id: checkSelected
            },
            success: function() {
                // jika sucsess reload halaman
                window.location.reload();
            }
        });
    }
    const showModals = document.querySelectorAll(".show-modal");

    // REUSABLE FUNGSI FETCH DATA
    // FETCH DATA SESUAI URL YANG DIBLEMPAR
    if (title.includes("tag")) {
        showModals.forEach(btn => {
            btn.addEventListener("click", function() {
                const id = this.dataset.id;
                let url = `http://localhost:8000/tag/${id}/edit`;
                let route = "tag";
                fetchData(url, route);
            });
        });
    } else {
        showModals.forEach(btn => {
            btn.addEventListener("click", function() {
                const id = this.dataset.id;
                let url = `http://localhost:8000/category/${id}/edit`;
                let route = "category";
                fetchData(url, route);
            });
        });
    }

    function fetchData(url, route) {
        fetch(url)
            .then(response => response.json())
            .then(response => {
                const categoryDetail = showDetailCategory(response);
                const modalBody = document.querySelector(".bungkus");
                modalBody.innerHTML = categoryDetail;
                const formAction = document.getElementById("editModal");
                formAction.action = `/${route}/${response.id}`;
            });
    }

    function showDetailCategory(category) {
        return `
          <div class="form-group">
            <label for="name">Category</label>
            <input type="text" class="form-control" name="name"
              value="${category.name}">
          </div>
    `;
    }
});

// EDIT CATEGORY

// const showModals = document.querySelectorAll('.show-modal');
// showModals.forEach(showModal => {
//     showModal.addEventListener('click', async function (e) {
//         if (e.target.classList.contains('show-modal')) {
//             const id = e.target.dataset.id;
//             const categoryDetail = await getDetailCategory(id);
//             updateModalUi(categoryDetail);
//             const formAction = document.getElementById('editCategory');
//             console.log(formAction)
//             formAction.action = "/category/" + categoryDetail.id
//         }
//     })
// })

// function getDetailCategory(id) {
//     return fetch(`http://localhost:8000/category/${id}/edit`)
//         .then(response => response.json())
//         .then(response => response);
// }

// function updateModalUi(categoryDetail) {
//     const modalDetail = showDetailCategory(categoryDetail);
//     const modalBody = document.querySelector('.bungkus');
//     modalBody.innerHTML = modalDetail;
// }
