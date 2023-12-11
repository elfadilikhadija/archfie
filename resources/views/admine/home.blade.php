@extends('admine.layout')
@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-3">
                <form method="POST" action="{{ route('admine.search') }}" class="input-group">
                    @csrf
                    <input type="text" class="form-control " name="query" placeholder="Rechercher..."
                        aria-label="Rechercher">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
            <div class="col-md-6">
                <div class="btn-group" role="group">
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="categoryDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-filter">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                            </svg>Filtrer par Catégorie
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                            @foreach ($categories as $category)
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('admine.filteredByCategory', $category->id) }}">
                                        {{ $category->nom }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="dropdown mx-3">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="divisionDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-filter">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                            </svg>Filtrer par Division
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="divisionDropdown">
                            @foreach ($divisions as $division)
                                <li><a class="dropdown-item"
                                        href="{{ route('admine.filteredByDivision', $division->id) }}">{{ $division->nom }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            {{-- hhh --}}
             <!-- Excel Filter Button -->
    <div class="col-md-3">
        <button class="btn btn-outline-secondary" onclick="filterByExtension('.xls, .xlsx')">
            Excel
        </button>
        <!-- CSV Filter Button -->
        <button class="btn btn-outline-secondary " onclick="filterByExtension('.csv')">
          CSV
        </button>
        <!-- PDF Filter Button -->
        <button class="btn btn-outline-secondary" onclick="filterByExtension('.pdf')">
          PDF
        </button>
    </div>
            {{-- kk --}}
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Objet</th>
                        <th>Numero</th>
                        <th>Destinateur</th>
                        <th>Destinataire</th>
                        <th>Date</th>
                        <th>Service</th>
                        <th>Division</th>
                        <th>Categorie</th>
                        <th>Fichier</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fichiers as $fich)
                        <tr>
                            <td>{{ $fich->id }}</td>
                            <td class="objet">{{ $fich->objet }}</td>
                            <td>{{ $fich->numero }}</td>
                            <td>{{ $fich->destinateurt }}</td>
                            <td>{{ $fich->destinataire }}</td>
                            <td>{{ $fich->date }}</td>
                            <td>{{ $fich->service->nom }}</td>
                            <td>{{ optional($fich->division)->nom }}</td>
                            <td>{{ $fich->categorie->nom }}</td>
                            <td>
                                <a href="{{ asset('storage/pdfs/' . $fich->fichier) }}" target="_blank">View PDF</a>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a data-toggle="modal" data-target="#updateModal"
                                    href="{{ route('admine.edit', ['id' => $fich->id]) }}" class="btn btn-sm btn-warning mx-2">  <i class="fa fa-edit " style="color:yellow"></i></a>
                                    <form action="{{ route('admine.destroy', ['id' => $fich->id]) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="deletfichier({{ $fich->id }})"> <i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
<!-- start  Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title"  id="updateModalLabel"><span>Modifier le fichier</span></h5>
                <button type="button" class="close bg-warning border-warning" data-dismiss="modal" aria-label="Close">
                    <span  aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body (Your Form Goes Here) -->
           <div class="modal-body">
    <form method="POST" class="border p-5" action="{{ route('fichiers.update', ['id' => $fich->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH') <!-- Use PATCH method for updating -->
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="objet" class="form-label">Objet:</label>
                    <input type="text" class="form-control" id="objet" name="objet" value="{{ $fich->objet }}" required>
                </div>

                <div class="mb-3">
                    <label for="numero" class="form-label">Numero:</label>
                    <input type="text" class="form-control" id="numero" name="numero" value="{{ $fich->numero }}" required>
                </div>

                <div class="mb-3">
                    <label for="destinateurt" class="form-label">Destinateur:</label>
                    <input type="text" class="form-control" id="destinateurt" name="destinateurt" value="{{ $fich->destinateurt }}" required>
                </div>

                <div class="mb-3">
                    <label for="destinataire" class="form-label">Destinataire:</label>
                    <input type="text" class="form-control" id="destinataire" name="destinataire" value="{{ $fich->destinataire }}" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="date" class="form-label">Date:</label>
                    <input type="date" class="form-control" id="date" name="date" value="{{ $fich->date }}" required>
                </div>
                <div class="mb-3">
                    <label for="division_id" class="form-label">Division:</label>
                    <select class="form-select" id="division_id" name="division_id" required>
                        @foreach ($divisions as $division)
                            <option value="{{ $division->id }}" @if($division->id === $fich->division_id) selected @endif>{{ $division->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="categorie_id" class="form-label">Categorie:</label>
                    <select class="form-select" id="categorie_id" name="categorie_id" required>
                        @foreach ($categories as $categorie)
                            <option value="{{ $categorie->id }}" @if($categorie->id === $fich->categorie_id) selected @endif>{{ $categorie->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="fichier" class="form-label">Fichier (PDF):</label>
                    <input type="file" class="form-control" id="fichier" name="fichier" accept=".pdf"> <!-- Update file input -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Update Fichier</button>
            </div>
        </div>
    </form>

</div>
        </div>
    </div>
</div>

{{-- end modal --}}
        {{-- code of pagination --}}
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-end">

                {{-- Previous Page Link --}}
                @if ($fichiers->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link" aria-hidden="true">Previous</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $fichiers->previousPageUrl() }}" aria-label="Previous">Previous</a>
                    </li>
                @endif
                {{-- Pagination Elements --}}
                @foreach ($fichiers as $page => $url)
                    <li class="page-item{{ $page == $fichiers->currentPage() ? ' active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
                {{-- Next Page Link --}}
                @if ($fichiers->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $fichiers->nextPageUrl() }}" aria-label="Next">Next</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link" aria-hidden="true">Next</span>
                    </li>
                @endif
            </ul>
        </nav>
        {{-- end of pagination --}}
     {{-- start script of delet button --}}
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function deletfichier(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(id).submit();
            }
        });
    }
</script>
     {{-- end script of delet button --}}
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function filterByExtension(extension) {
        // Get the file input element
        var fileInput = document.getElementById('fileInput');

        // Get the selected files
        var files = fileInput.files;

        // Filter files by extension
        var filteredFiles = Array.from(files).filter(file => {
            var fileName = file.name.toLowerCase();
            return fileName.endsWith(extension);
        });

        // Display the filtered files using SweetAlert
        Swal.fire({
            title: 'Filtered Files',
            html: 'Filtered Files: ' + filteredFiles.map(file => file.name).join('<br>'),
            icon: 'info'
            // You can customize the appearance and behavior of SweetAlert as needed
        });
    }
</script>
    </div>
@endsection
