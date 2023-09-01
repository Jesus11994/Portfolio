<div>
  <!-- Content wrapper -->
  <div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard</span> / Email</h4>
      <div class="row">
        <div class="col-md-12">
          <div class="card mb-4">
            <hr class="my-0" />
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">

                </div>
                <div class="col-md-4"></div>

              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive text-nowrap">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>email</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                  @foreach($users as $item) 
                    <tr>
                      <td><strong>{{$loop->iteration}}</strong></td>
                      <td>{{$item->name}}</td>
                      <td>{{$item->email }}</td>
                      <td>
                      <a class="dropdown-item"  wire:click="edit({{$item->id}})" type="button"
                              class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#smallModal"><i
                                class="bx bx-edit-alt me-1"></i>
                              Edit</a>
                      </td>
                    </tr>
                  @endforeach
          
                  </tbody>
                </table>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
   <!-- / Content -->
  </div>

  <div wire:ignore.self class="modal fade" id="smallModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel2">Modal User</h5>
                              <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                              ></button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col mb-3">
                                  <label for="nameSmall" class="form-label">Name</label>
                                  <input type="text" id="nameSmall" wire:model.defer="name" class="form-control" placeholder="Enter Name" />
                                </div>
                              </div>
                              <div class="row g-2">
                                <div class="col mb-0">
                                  <label class="form-label" for="emailSmall">Email</label>
                                  <input type="text" class="form-control" wire:model.defer="email" id="emailSmall" placeholder="xxxx@xxx.xx" />
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                              </button>
                              @if($Gband ==1)
                              <button type="button" class="btn btn-primary" wire:loading.attr="disabled" wire:click.prevent="saveEdit(),imageedt">Save changes</button>
                            @else
                              <button type="button" class="btn btn-primary" wire:loading.attr="disabled" wire:click.prevent="savePro(),image">Save Project</button>
                            @endif

                            </div>
                          </div>
                        </div>
                      </div>
  <!--/ Basic Bootstrap Table -->

</div>
