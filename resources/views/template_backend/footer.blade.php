<footer class="main-footer">
  <div class="footer-left">
    Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval
      Azhar</a>
  </div>
  <div class="footer-right">

  </div>
</footer>
</div>
</div>

<!-- General JS Scripts -->
<script src="{{ asset('assets/modules/jquery.min.js')}}"></script>
<script src="{{ asset('assets/modules/popper.js')}}"></script>
<script src="{{ asset('assets/modules/tooltip.js')}}"></script>
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
<script src="{{ asset('assets/modules/moment.min.js')}}"></script>
<script src="{{ asset('assets/js/stisla.js')}}"></script>

<!-- JS Libraies -->
<script src="{{ asset('assets/modules/jquery.sparkline.min.js')}}"></script>
<script src="{{ asset('assets/modules/chart.min.js')}}"></script>
<script src="{{ asset('assets/modules/owlcarousel2/dist/owl.carousel.min.js')}}"></script>
<script src="{{ asset('assets/modules/summernote/summernote-bs4.js')}}"></script>
<script src="{{ asset('assets/modules/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>
<script src="{{ asset('assets/js/sweet/sweetalert2.all.min.js')}}"></script>
<script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{ asset('assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js')}}"></script>
<script src="{{ asset('assets/modules/jquery-selectric/jquery.selectric.min.js')}}"></script>
<script src="{{ asset('assets/js/page/features-post-create.js')}}"></script>


<!-- Page Specific JS File -->
<script src="{{ asset('assets/js/page/index.js')}}"></script>

<!-- Template JS File -->
<script src="{{ asset('assets/js/script.js')}}"></script>
<script src="{{ asset('assets/js/scripts.js')}}"></script>
<script src="{{ asset('assets/js/custom.js')}}"></script>
<script src="{{ asset('assets/js/prism.js') }}"></script>
<script src="{{ asset('js/highlight.pack.js') }}"></script>
<script>hljs.initHighlightingOnLoad();</script>

<script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>
<script>
  var options = {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
  };
</script>
<script>
  const ckEditor = document.getElementById('content');
  if(ckEditor){
    ClassicEditor
          .create( document.querySelector( '#content' ))
          .then( editor => {
                  console.log( editor );
          } )
          .catch( error => {
                  console.error( error );
          } );
  }
  
</script>

<script>
  const typeEditor = document.getElementById('typeEditor')
  const textCKEditor = document.querySelector('.ckeditor')
  const textManual = document.querySelector('.manual')

 autosize(document.getElementById('manual'))
  textCKEditor.hidden = true
  typeEditor.innerHTML = 'Use CK Editor'


typeEditor.addEventListener('click', ()=>{
  if(typeEditor.textContent == 'Use Manual Editor'){
    textCKEditor.hidden = true
    textManual.hidden = false
    typeEditor.innerHTML = 'Use CK Editor'
  }else{
    textCKEditor.hidden = false
    textManual.hidden = true
    typeEditor.innerHTML = 'Use Manual Editor'

  }

})
  
</script>
</body>

</html>