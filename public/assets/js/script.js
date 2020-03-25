document.addEventListener('DOMContentLoaded', () => {
    const flashdata = document.querySelector('.flashdata').getAttribute('data-flashdata')
    if (flashdata) {
        if (flashdata.includes('Success')) {
            Swal.fire({
                type: 'success',
                text: flashdata,
            })
        } else {
            Swal.fire({
                type: 'error',
                text: flashdata,
            })
        }
    }


    // DELETE CATEGORY
    const btnDeletes = document.querySelectorAll('.btn-delete');
    btnDeletes.forEach(btnDelete => {
        btnDelete.addEventListener('click', function (e) {
            e.preventDefault();
            let href = this.dataset.id
            Swal.fire({
                title: 'Hapus Data',
                text: 'Apa kamu yakin ?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.value) {
                    let form = document.getElementById(`form-${href}`)
                    form.submit();
                }
            })
        })
    })

})

const showModals = document.querySelectorAll('.show-modal');
showModals.forEach(btn => {
    btn.addEventListener('click', function () {
        const id = this.dataset.id
        fetch(`http://localhost:8000/category/${id}/edit`)
            .then(response => response.json())
            .then(response => {
                const categoryDetail = showDetailCategory(response)
                const modalBody = document.querySelector('.bungkus')
                modalBody.innerHTML = categoryDetail
                const formAction = document.getElementById('editCategory');
                console.log(formAction)
                formAction.action = `/category/${response.id}`
            })
    })
})



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

function showDetailCategory(category) {
    return `
          <div class="form-group">
            <label for="name">Category</label>
            <input type="text" class="form-control" name="name"
              value="${category.name}">
          </div>
    `
}
