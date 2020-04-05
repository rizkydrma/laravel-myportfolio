@extends('template_backend.main')

@section('title', $title)

@section('content')
<div class="row">
  @foreach ($user as $item)
  <div class="col-lg-6 col-sm-12">
    <div class="card">
    <form action="{{ route('bio.update', $item->id) }}" method="POST">
        <div class="card-header">
          <h4>About Me</h4>
          <button type="button" class="btn btn-primary btn-sm mr-2" id="edit-about">Edit About </button>
          <button type="submit" class="btn btn-success btn-sm" id="save-about" hidden>Save About </button>
        </div>
        <div class="card-body">
            @csrf
            <textarea name="about" id="textAbout" cols="50" rows="5" class="" style="border: 0px" disabled>@if ($item->about)
              {{ $item->bio->about }}
              @endif
            </textarea>
        </div>
      </form>
    </div>
  </div>
  @endforeach

  <div class="col-lg-6 col-sm-12">
    <div class="card">
      <div class="card-header">
        <h4>Skill</h4>
        <button type="button" class="btn btn-primary btn-sm" id="add-skill" data-toggle="modal" data-target="#skillModal">Add Skill</button>
      </div>
      <div class="card-body">
        @foreach ($skills as $item)
        <div class="mb-4">
          <div class="float-right">
            <div class="d-flex">

              <a href="" class="text-primary edit-skill" data-id="{{ $item->id }}" data-toggle="modal" data-target="#skillModalEdit">
                <i class="fas fa fa-edit"></i>
              </a>
              
              <form action="{{ route('skill.delete', $item->id) }}" method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="text-danger" style="border: none; background-color: white;">
                  <i class="fas fa fa-trash"></i>
                </button>
              </form>
            </div>
            
          </div>
        <div class="font-weight-bold mb-1">{{ $item->name }}</div>
          <div class="progress" data-height="3">
          <div class="progress-bar {{$item->color}}" role="progressbar" data-width="{{ $item->percentase }}%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
          </div>                          
        </div>
        @endforeach
    
      </div>
    </div>
  </div>
</div>
<div class="card-body p-0">
  <div class="card-header">
    <h4 class="d-inline m-3">Recent Project</h4>
    <button type="button" class="btn btn-primary btn-sm rounded-pill" id="add-project" data-toggle="modal" data-target="#addProject">Add Project</button>
  </div>
  <div class="table-responsive">
    <table class="table table-striped">
      <tr>
        <th class="text-center">
          No
        </th>
        <th>Title</th>
        <th>Technology</th>
        <th>Deskripsi</th>
        <th>Action</th>
      </tr>
      @foreach ($projects as $item => $data)
      <tr>
        <td class="p-0 text-center">
          {{ $item + $projects->firstitem() }}
        </td>
        <td>{{ $data->title }}</td>
        <td>{{ $data->technology }}</td>
        <td>{{ $data->deskripsi }}</td>
        <td>
          <div class="d-inline d-flex">
            <a href="" class="btn btn-primary btn-action mr-1 edit-project" data-id={{ $data->id }}
              data-toggle="modal" data-target="#editProject"
              ><i class="fas fa-pencil-alt"></i></a>
            <form action="{{ route('project.destroy', $data->id) }}}" method="POST" id="form-{{ $data->id }}">
              @csrf
              @method('delete')
              <button type="submit" class="btn btn-danger btn-action btn-delete" title="Delete"
                data-id={{ $data->id }}><i class="fas fa-trash"></i></a>

            </form>
          </div>
        </td>
      </tr>
      @endforeach
      @forelse($projects as $data)
      @empty
      <tr class='text-center'>
        <td colspan="5">Tidak ada data</td>
      </tr>
      @endforelse
    </table>
    </table>
    {{ $projects->links() }}
  </div>
</div>

@section('modal')

<!-- Modal -->
<div class="modal fade" id="skillModal" tabindex="-1" role="dialog" aria-labelledby="skillModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="skillModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('skill.store') }}" method="POST">
        <div class="modal-body">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="name">Name Skill</label>
            <input type="text" class="form-control" id="name" placeholder="Enter a skill" name="name">
          </div>
          <label for="customRange2">Percentase Skill</label>
          <input type="range" class="custom-range" min="0" max="100" id="customRange2" name="percentase">
          <div class="form-group">
            <label for="color">Pick a Color</label>
            <select class="form-control" id="color" name="color">
              <option value="bg-primary">bg-primary</option>
              <option value="bg-success">bg-success</option>
              <option value="bg-warning">bg-warning</option>
              <option value="bg-danger">bg-danger</option>
              <option value="bg-info">bg-info</option>
              <option value="bg-secondary">bg-secondary</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit-->
<div class="modal fade" id="skillModalEdit" tabindex="-1" role="dialog" aria-labelledby="skillModalEditLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="skillModalEditLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST" id="formEditSkill">
        {{ csrf_field() }}
        @method('put')
        <div class="modal-body" id="bodyEditSkill">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Project-->
<div class="modal fade" id="addProject" tabindex="-1" role="dialog" aria-labelledby="addProjectLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addProjectLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('project.store') }}" method="POST">
        {{ csrf_field() }}
        <div class="modal-body">
          <div class="form-group">
            <label for="name">Title</label>
            <input type="text" class="form-control
            @error('title')
            is-invalid
            @enderror
            " placeholder="Enter a Title" name="title"
            value="{{ old('title') }}"
            >
            @error('title')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="name">Technology</label>
            <input type="text" class="form-control
            @error('technology')
            is-invalid
            @enderror
            " id="technology" placeholder="Enter a technology" name="technology"
            value="{{ old('technology') }}"
            >
            @error('technology')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control
            @error('deskripsi')
            is-invalid
            @enderror
            " cols="30" rows="10" placeholder="Enter a deskripsi"
              id="deskripsi">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Project Edit-->
<div class="modal fade" id="editProject" tabindex="-1" role="dialog" aria-labelledby="editProjectLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editProjectLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('project.store') }}" method="POST" id="form-project">
        {{ csrf_field() }}
        @method('put')
        <div class="modal-body" id="body-project">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection



<script>
const editAbout = document.getElementById('edit-about');
const addSkill = document.getElementById('add-skill');
const editSkill = document.querySelectorAll('.edit-skill');

const saveAbout = document.getElementById('save-about');
const textAbout = document.getElementById('textAbout');

editAbout.addEventListener('click', function(e){
  e.preventDefault();
  textAbout.disabled = (textAbout.disabled) ? false : true;
  saveAbout.hidden = (saveAbout.hidden) ? false : true ;
})

editSkill.forEach(btn => {
  btn.addEventListener('click', function(){
    const id = this.dataset.id;
    let url = `http://localhost:8000/skill/${id}/edit`;
    getDataSkill(url);
  })
})

function getDataSkill(url){
  fetch(url)
    .then(response => response.json())
    .then(response => {
      const skillDetail = showDetailSkill(response);
      const bodyEditSkill = document.getElementById('bodyEditSkill');
      bodyEditSkill.innerHTML = skillDetail;
      const formAction = document.getElementById('formEditSkill');
      formAction.action = `/skill/${response.id}`
    })
}

function showDetailSkill(data){
  return `
  <div class="modal-body" id="bodyEditSkill">
          <div class="form-group">
            <label for="name">Name Skill</label>
            <input type="text" class="form-control" id="name" placeholder="Enter a skill" name="name" value=${data.name}>
          </div>
          <label for="customRange2">Percentase Skill</label>
          <input type="range" class="custom-range" min="0" max="100" id="customRange2" name="percentase" value="${data.percentase}">
          <div class="form-group">
            <label for="color">Pick a Color</label>
            <select class="form-control" id="color" name="color">
              <option value="${data.color}"> ${data.color} </option>
              <option value="bg-primary">bg-primary</option>
              <option value="bg-success">bg-success</option>
              <option value="bg-warning">bg-warning</option>
              <option value="bg-danger">bg-danger</option>
              <option value="bg-info">bg-info</option>
              <option value="bg-secondary">bg-secondary</option>
            </select>
          </div>
        </div>
  `
}

const editProject = document.querySelectorAll('.edit-project');



editProject.forEach(btn => {
  btn.addEventListener('click', function(e){
    e.preventDefault();
    const id = this.dataset.id;
    let url = `http://localhost:8000/project/${id}/edit`;
    getDataProject(url);
  })
})

function getDataProject(url){
  fetch(url)
    .then(response => response.json())
    .then(response => {
      const projectDetail = showDetailProject(response);
      const bodyProject = document.getElementById('body-project');
      bodyProject.innerHTML = projectDetail;
      const formProject = document.getElementById('form-project');
      formProject.action = `/project/${response.id}`
    })
}

function showDetailProject(data){
  return `
        <div class="modal-body" id="body-project">
          <div class="form-group">
            <label for="name">Title</label>
            <input type="text" class="form-control
            @error('title')
            is-invalid
            @enderror
            " placeholder="Enter a Title" name="title"
            value="${data.title}"
            >
            @error('title')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="name">Technology</label>
            <input type="text" class="form-control
            @error('technology')
            is-invalid
            @enderror
            " id="technology" placeholder="Enter a technology" name="technology"
            value="${data.technology}"
            >
            @error('technology')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control
            @error('deskripsi')
            is-invalid
            @enderror
            " cols="30" rows="10" placeholder="Enter a deskripsi"
              id="deskripsi">${data.deskripsi}</textarea>
            @error('deskripsi')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          
        </div>
  `
}

</script>
@endsection