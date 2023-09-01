<div>
  <!-- Content wrapper -->
  <div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard</span> / Portfolio</h4>
      <div class="row">
        <div class="col-md-12">
          <div class="card mb-4">
            <hr class="my-0" />
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">

                </div>
                <div class="col-md-4"></div>

                <div class="col-md-2 ">
                  <button type="button" data-bs-toggle="modal" data-bs-target="#basicModal" class="btn btn-primary"  wire:click="openmodal()"
                    >New</button>
                </div>

              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive text-nowrap">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name Project</th>
                      <th>Description</th>
                      <th>Image</th>
                      <th>Status</th>
                      <th>Actions</th>

                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                  @foreach($proyec as $item) 
                    <tr>
                      <td><strong>{{$loop->iteration}}</strong></td>
                      <td>{{$item->PRO_NAME}}</td>
                      <td>{{ Str::limit($item->PRO_DESC, 30) }}</td>
                      <td><img src="data:image/{{$item->PRO_IMAGExt}};base64,{{$item->PRO_IMAGE}}" class="imgcel" alt=""></td>
                      <td>
                        @if($item->PRO_STATUS == 1)
                        <a type="button" wire:click="statuschange({{$item->id}},0)" ><span class="badge bg-label-success" >Public</span></a>
                        @else
                        <a type="button" wire:click="statuschange({{$item->id}},1)"><span class="badge bg-label-danger" >Draft</span></a>
                        @endif
                      </td>
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu">

                            <a class="dropdown-item"  wire:click="edit({{$item->id}})" type="button"
                              class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal"><i
                                class="bx bx-edit-alt me-1"></i>
                              Edit</a>
                            <a class="dropdown-item" wire:click="delete({{$item->id}})" type="button"
                              class="btn btn-primary"><i class="bx bx-trash me-1"></i> Delete</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                  @endforeach
          
                  </tbody>
                </table>
                <div>{{$proyec->links('livewire.componentes.pagination')}}</div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <!-- / Content -->
  </div>
  <!--/ Basic Bootstrap Table -->

  <div class="col-lg-4 col-md-6">

    <!-- Small Modal -->
    <div wire:ignore.self class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel2">Project Modal</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
                  <div class="col mb-3">
                    <label class="form-label">Name Project</label>
                    <input type="text"  class="form-control" placeholder="Project name"
                      wire:model.defer="name" />
                    @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                  </div>
            </div>

            <div >
              <!-- Contenido del modal -->
              <div class="row">
                  <div class="col mb-3">
                      <label class="form-label">Description Project</label>
                      {{--<trix-editor ></trix-editor>--}}
                      <textarea  class="form-control" wire:model.defer="descri" rows="6"></textarea>
                      @error('descri') <span class="text-danger">{{ $message }}</span>@enderror
                  </div>
              </div>
          </div>
            @if($Gband==1)
            <div class="row">
                  <div class="col mb-3">
                    <label  class="form-label">Image Project</label>
                    <input type="file"  class="form-control"
                      wire:model.defer="imageedt" />
                    @error('imageedt') <span class="text-danger">{{ $message }}</span>@enderror
                  </div>
            </div>
            @if($imageedt)
              <div class="row">
                    <div style="text-align: center;">
                    <img src="{{$imageedt->temporaryUrl()}}" alt="" class="img-fluid imgspace">
                    </div>
              </div>
            @endif
            <div class="row">
                  <div  wire:loading wire:targe="imageedt" style="text-align: center;">
                  <div class="demo-inline-spacing">
                          <div class="spinner-border spinner-border-lg text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                          </div>

                   </div>
                  </div>
            </div>
            @else
              <div class="row">
                    <div class="col mb-3">
                      <label  class="form-label">Image Project</label>
                      <input type="file" class="form-control"
                        wire:model.defer="image" />
                      @error('image') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
              </div>
              @if($image)
              <div class="row">
                    <div style="text-align: center;">
                    <img src="{{$image->temporaryUrl()}}" alt="" class="img-fluid imgspace">
                    </div>
              </div>
              @endif
              <div class="row">
                  <div  wire:loading wire:targe="image" style="text-align: center;">
                  <div class="demo-inline-spacing">
                          <div class="spinner-border spinner-border-lg text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                          </div>

                   </div>
                  </div>
            </div>
            @endif
            
             
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          @if($Gband ==1)
            <button type="button" class="btn btn-primary" wire:loading.attr="disabled" wire:click.prevent="saveEdit(),imageedt">Save changes</button>
          @else
            <button type="button" class="btn btn-primary" wire:loading.attr="disabled" wire:click.prevent="savePro(),image">Save Project</button>
          @endif

          </div>
        </div>
      </div>
    </div>
  </div>

</div>
