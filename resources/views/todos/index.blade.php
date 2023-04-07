<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

   <title>Todos</title>
</head>

<body>
   <div class="container">
      <div class="card mt-5">
         <div class="card-body">
            <h5 class="card-title">Todos App</h5>

            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
               {{ $error }}
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endforeach
            @endif

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
               {{ session('success') }}
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <form method="POST" action="/todos">
               @csrf
               <div class="mb-3">
                  <label for="name" class="form-label">Buat tugas baru</label>
                  <input type="text" class="form-control" name="name" id="name"
                     placeholder="Contoh: Mengerjakan tugas besar 1">
               </div>
               <button type="submit" class="btn btn-primary mb-3">Simpan</button>
            </form>
            <ul class="nav nav-tabs">
               <li class="nav-item">
                  <a class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button"
                     role="tab" aria-controls="home" aria-selected="true">Semua</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="active-tab" data-bs-toggle="tab" data-bs-target="#active" type="button"
                     role="tab" aria-controls="home" aria-selected="false">Aktif</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button"
                     role="tab" aria-controls="home" aria-selected="false">Selesai</a>
               </li>
            </ul>
            <div class="tab-content py-4">
               <div class="tab-pane  fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                  @foreach ($all_todos as $item)
                  <ol class="list-group">
                     <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                           <div>{{ $item->name }}</div>
                           <small>Created at: {{ $item->created_at }}</small>
                        </div>
                        <div class="d-flex flex-row">
                           @if (!$item->is_completed)
                           <a href="#" class="update-btn" data-id="{{ $item->id }}"><span class=" badge bg-success
                                                            rounded-pill mx-2">Selesaikan
                                 tugas</span></a>
                           @endif
                           <a href="#" class="delete-btn" data-id="{{ $item->id }}"><span
                                 class="badge bg-danger rounded-pill">delete</span></a>
                           <form id="delete-form-{{ $item->id }}" action="{{ route('todos.destroy', $item->id) }}"
                              method="POST" style="display: none;">
                              @csrf
                              @method('DELETE')
                           </form>
                           <form id="update-form-{{ $item->id }}" action="{{ route('todos.update', $item->id) }}"
                              method="POST" style="display: none;">
                              @csrf
                              @method('PUT')
                           </form>
                        </div>
                     </li>
                  </ol>
                  @endforeach
               </div>
               <div class="tab-pane fade" id="active" role="tabpanel" aria-labelledby="active-tab">
                  @foreach ($active_todos as $item)
                  <ol class="list-group">
                     <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                           <div>{{ $item->name }}</div>
                           <small>Created at: {{ $item->created_at }}</small>
                        </div>
                        <a href="#" class="delete-btn" data-id="{{ $item->id }}"><span
                              class="badge bg-danger rounded-pill">delete</span></a>
                        <form id="delete-form-{{ $item->id }}" action="{{ route('todos.destroy', $item->id) }}"
                           method="POST" style="display: none;">
                           @csrf
                           @method('DELETE')
                        </form>
                     </li>
                  </ol>
                  @endforeach
               </div>
               <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                  @foreach ($completed_todos as $item)
                  <ol class="list-group">
                     <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                           <div>{{ $item->name }}</div>
                           <small>Created at: {{ $item->created_at }}</small>
                        </div>
                        <a href="#" class="delete-btn" data-id="{{ $item->id }}"><span
                              class="badge bg-danger rounded-pill">delete</span></a>
                        <form id="delete-form-{{ $item->id }}" action="{{ route('todos.destroy', $item->id) }}"
                           method="POST" style="display: none;">
                           @csrf
                           @method('DELETE')
                        </form>
                     </li>
                  </ol>
                  @endforeach
               </div>
            </div>
         </div>
      </div>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
      integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
   </script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
      integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
   </script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

   <script>
      $(document).on('click', '.delete-btn', function(event) {
           event.preventDefault();
   
           if (confirm('Yakin ingin menghapus tugas ini?')) {
               var id = $(this).data('id');
               $('#delete-form-' + id).submit();
           }
      });

      $(document).on('click', '.update-btn', function(event) {
         event.preventDefault();
      
         var id = $(this).data('id');
         $('#update-form-' + id).submit();
      });
   </script>

</body>

</html>